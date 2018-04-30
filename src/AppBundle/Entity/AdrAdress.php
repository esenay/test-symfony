<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdrAdress
 *
 * Adress of a patient
 * esenay - 20180430
 *
 * @ORM\Table(name="adr_adress", uniqueConstraints={@ORM\UniqueConstraint(name="ADR_ID", columns={"ADR_ID"})})
 * @ORM\Entity
 */
class AdrAdress
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ADR_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $adrId;

    /**
     * @var string
     *
     * @ORM\Column(name="ADR_STREET", type="string", length=250, nullable=false)
     */
    private $adrStreet;

    /**
     * @var integer
     *
     * @ORM\Column(name="ADR_POSTAL_CODE", type="integer", nullable=false)
     */
    private $adrPostalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="ADR_CITY", type="string", length=250, nullable=false)
     */
    private $adrCity;

    /**
     * @return int
     */
    public function getAdrId()
    {
        return $this->adrId;
    }

    /**
     * @return string
     */
    public function getAdrStreet()
    {
        return $this->adrStreet;
    }

    /**
     * @param string $adrStreet
     */
    public function setAdrStreet($adrStreet)
    {
        $this->adrStreet = $adrStreet;
    }

    /**
     * @return int
     */
    public function getAdrPostalCode()
    {
        return $this->adrPostalCode;
    }

    /**
     * @param int $adrPostalCode
     */
    public function setAdrPostalCode($adrPostalCode)
    {
        $this->adrPostalCode = $adrPostalCode;
    }

    /**
     * @return string
     */
    public function getAdrCity()
    {
        return $this->adrCity;
    }

    /**
     * @param string $adrCity
     */
    public function setAdrCity($adrCity)
    {
        $this->adrCity = $adrCity;
    }


}
