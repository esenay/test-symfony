<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocDoctor
 *
 * Doctor class
 * esenay - 20180430
 *
 * @ORM\Table(name="doc_doctor", uniqueConstraints={@ORM\UniqueConstraint(name="DOC_RPPS", columns={"DOC_RPPS"})})
 * @ORM\Entity
 */
class DocDoctor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $docId;

    /**
     * @var PerPersonne
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\PerPersonne", cascade={"persist"})
     * @ORM\JoinColumn(name="PER_ID", referencedColumnName="PER_ID", nullable=false)
     */
    private $personn;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_RPPS", type="string", length=11, nullable=false)
     */
    private $docRpps;

    /**
     * @return int
     */
    public function getDocId()
    {
        return $this->docId;
    }

    /**
     * @return PerPersonne
     */
    public function getPersonn()
    {
        return $this->personn;
    }

    /**
     * @param PerPersonne $personn
     */
    public function setPersonn($personn)
    {
        $this->personn = $personn;
    }


    /**
     * @return int
     */
    public function getDocRpps()
    {
        return $this->docRpps;
    }

    /**
     * @param int $docRpps
     */
    public function setDocRpps($docRpps)
    {
        $this->docRpps = $docRpps;
    }


}
