<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PerPersonne
 *
 * Personn information (name, firstname, etc.)
 * esenay - 20180430
 *
 * @ORM\Table(name="per_personne", uniqueConstraints={@ORM\UniqueConstraint(name="PER_ID", columns={"PER_ID"})})
 * @ORM\Entity
 */
class PerPersonne
{
    /**
     * @var integer
     *
     * @ORM\Column(name="PER_ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $perId;

    /**
     * @var string
     *
     * @ORM\Column(name="PER_NAME", type="string", length=50, nullable=false)
     */
    private $perName;

    /**
     * @var string
     *
     * @ORM\Column(name="PER_FIRSTNAME", type="string", length=50, nullable=false)
     */
    private $perFirstname;

    /**
     * @return int
     */
    public function getPerId()
    {
        return $this->perId;
    }

    /**
     * @return string
     */
    public function getPerName()
    {
        return $this->perName;
    }

    /**
     * @param string $perName
     */
    public function setPerName($perName)
    {
        $this->perName = $perName;
    }

    /**
     * @return string
     */
    public function getPerFirstname()
    {
        return $this->perFirstname;
    }

    /**
     * @param string $perFirstname
     */
    public function setPerFirstname($perFirstname)
    {
        $this->perFirstname = $perFirstname;
    }


}
