<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * Parse files and import them ito database
     * esenay - 20180430
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        //$filesParsed = array();
        $nbParsedFiles = 0;
        $parser = $this->get('app.hl7parser');
        $databaseWriter = $this->get('app.database_writer');

        // find text files to parse
        $finder = new Finder();
        $finder->files()->in(__DIR__.'/../../../web/files')->name('*.txt');

        // parse each of them and write information into database
        foreach ($finder as $file) {
            $result = $parser->parseFile($file->getContents());
            if ($result != null){
                $databaseWriter->setFromHL7Message($result);
                $nbParsedFiles = $nbParsedFiles+1;
            }
        }

        // return number of file imported
        return $this->render('default/index.html.twig', array(
            'nbParsedFiles' => $nbParsedFiles,
        ));
    }
}
