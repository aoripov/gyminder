<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pair
 *
 * @ORM\Table(name="pair")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PairRepository")
 */
class Pair
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="pairs1")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     */
    private $partner1;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="pairs2")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     */
    private $partner2;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|Person
     */
    public function getPartner1()
    {
        return $this->partner1;
    }

    /**
     * @param Person $partner1
     */
    public function setPartner1($partner1)
    {
        $this->partner1 = $partner1;
    }

    /**
     * @return null|Person
     */
    public function getPartner2()
    {
        return $this->partner2;
    }

    /**
     * @param Person $partner2
     */
    public function setPartner2($partner2)
    {
        $this->partner2 = $partner2;
    }
}

