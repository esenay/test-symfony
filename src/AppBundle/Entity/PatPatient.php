<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PatPatient
 *
 * Patient class
 * esenay - 20180430
 *
 * @ORM\Table(name="pat_patient", indexes={@ORM\Index(name="fk_adr", columns={"ADR_ID"})})
 * @ORM\Entity
 */
class PatPatient
{

    /**
     * @var integer
     *
     * @ORM\Column(name="PAT_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $patId;

    /**
     * @var PerPersonne
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\PerPersonne", cascade={"persist"})
     * @ORM\JoinColumn(name="PER_ID", referencedColumnName="PER_ID", nullable=false)
     */
    private $personn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="PAT_BIRTHDATE", type="date", nullable=false)
     */
    private $patBirthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="PAT_GENDER", type="string", length=1, nullable=false)
     */
    private $patGender;

    /**
     * @var integer
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\AdrAdress", cascade={"persist"})
     * @ORM\JoinColumn(name="ADR_ID", referencedColumnName="ADR_ID")
     */
    private $adress;

    /**
     * @var DocDoctor
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DocDoctor", cascade={"persist"})
     * @ORM\JoinColumn(name="DOC_ID", referencedColumnName="DOC_ID", nullable=false)
     */
    private $doctor;

    /**
     * @return int
     */
    public function getPatId()
    {
        return $this->patId;
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
     * @return \DateTime
     */
    public function getPatBirthdate()
    {
        return $this->patBirthdate;
    }

    /**
     * @param \DateTime $patBirthdate
     */
    public function setPatBirthdate($patBirthdate)
    {
        $this->patBirthdate = $patBirthdate;
    }

    /**
     * @return string
     */
    public function getPatGender()
    {
        return $this->patGender;
    }

    /**
     * @param string $patGender
     */
    public function setPatGender($patGender)
    {
        $this->patGender = $patGender;
    }

    /**
     * @return AdrAdress
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * @param AdrAdress $adr
     */
    public function setAdress($adr)
    {
        $this->adress = $adr;
    }


    /**
     * @return DocDoctor
     */
    public function getDoctor()
    {
        return $this->doctor;
    }

    /**
     * @param DocDoctor $doctor
     */
    public function setDoctor($doctor)
    {
        $this->doctor = $doctor;
    }
}
