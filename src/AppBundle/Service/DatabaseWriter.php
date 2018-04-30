<?php

namespace AppBundle\Service;

use AppBundle\Entity\AdrAdress;
use AppBundle\Entity\DocDoctor;
use AppBundle\Entity\PatPatient;
use AppBundle\Entity\PerPersonne;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class DatabaseWriter
 * Set all information about doctor, patient in database
 * esenay - 20180430
 * @package AppBundle\Service
 */
class DatabaseWriter
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Save in database information about patient and doctor from a standard HL7 message array
     *
     * @param array $message
     */
    public function setFromHL7Message(array $message)
    {

        /*
        Patient information are :
        Nom : PID-5.1
        Prénom : PID-5.2
        Date de naissance : PID-7
        Genre : PID-8
        Adresse
        Rue : PID-11.1
        Code postal : PID-11.5
        Ville : PID-11.3

        Doctor information are :
        Nom : ROL-4.2
        Prénom : ROL-4.3
        RPPS : ROL-4.1 si ROL-4.13 = ‘RPPS’
        */

        // patient
        $per = new PerPersonne();
        if(isset($message['PID'][5][1])){
            $per->setPerName($message['PID'][5][1]);
        }
        if(isset($message['PID'][5][2])) {
            $per->setPerFirstname($message['PID'][5][2]);
        }
        $pat = new PatPatient();
        if(isset($message['PID'][7])) {
            $pat->setPatBirthdate(new \DateTime($message['PID'][7]));
        }
        if(isset($message['PID'][8])) {
            $pat->setPatGender($message['PID'][8]);
        }

        // adress
        $adr = new AdrAdress();
        if(isset($message['PID'][11][1])) {
            $adr->setAdrStreet($message['PID'][11][1]);
        }
        if(isset($message['PID'][11][3])) {
            $adr->setAdrCity($message['PID'][11][3]);
        }
        if(isset($message['PID'][11][5])) {
            $adr->setAdrPostalCode($message['PID'][11][5]);
        }

        // doctor
        if( isset($message['ROL'][4][13])
            && $message['ROL'][4][13] == 'RPPS'){
            // retreive from database if exists (doctor are unique by rpps number)
            $doc = $this->em->getRepository('AppBundle\Entity\DocDoctor')->findOneByDocRpps(intval($message['ROL'][4][1]));
            if(!$doc instanceof DocDoctor) {
                $perd = new PerPersonne();
                if(isset($message['ROL'][4][2])) {
                    $perd->setPerName($message['ROL'][4][2]);
                }
                if(isset($message['ROL'][4][3])) {
                    $perd->setPerFirstname($message['ROL'][4][3]);
                }
                $doc = new DocDoctor();
                $doc->setPersonn($perd);
                if(isset($message['ROL'][4][1])){
                    $doc->setDocRpps(intval($message['ROL'][4][1]));
                }
            }
            $pat->setDoctor($doc);
        }

        $pat->setPersonn($per);
        $pat->setAdress($adr);

        $this->em->persist($pat);
        $this->em->flush();

    }
}