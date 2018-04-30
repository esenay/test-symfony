<?php

namespace AppBundle\Service;


/**
 * Class HL7Parser
 * Parse HL7 text file
 * esenay - 20180430
 *
 * @package AppBundle\Service
 */
class HL7Parser
{
    private $file;
    private $parsedFile;

    /**
     * HL7Parser constructor.
     */
    public function __construct()
    {
        $this->file = null;
        $this->parsedFile = null;
    }

    /**
     * Parse a string in HL7 format array
     * @param string $file
     * @return null|array
     */
    public function parseFile($file)
    {
        $this->parsedFile = null;
        $this->file = $file;

        if(strlen($this->file)<=0) {
            return null;
        }
        $lines = preg_split('/\R/',$this->file);
        if($lines != false) {
            foreach ($lines as $line) {
                $segments = explode('|', $line);
                $idSeg = 0;
                foreach ($segments as $key => $value) {
                    // 3 first char are ID segment
                    if ($key == 0) {
                        $idSeg = $value;
                    } else {
                        if(strpos( $value, '^' ) !== false) {
                            $components = explode('^', $value);
                            $idComp = 1;
                            foreach ($components as $component) {
                                if(strpos( $component, '&' ) !== false) {
                                    $subComponents = explode('&', $component);
                                    $idSubComp = 1;
                                    foreach ($subComponents as $subComponent) {
                                        $this->parsedFile[$idSeg][$key][$idComp][$idSubComp] = $subComponent;
                                        $idSubComp = $idSubComp + 1;
                                    }
                                    unset($subComponents);
                                } else {
                                    $this->parsedFile[$idSeg][$key][$idComp] = $component;
                                }
                                $idComp = $idComp + 1;
                            }
                            unset($components);
                        } else {
                            $this->parsedFile[$idSeg][$key] = $value;
                        }
                    }
                }
                unset($segments);
            }
            unset($line);
        }
        unset($this->file);

        return $this->parsedFile;
    }

}