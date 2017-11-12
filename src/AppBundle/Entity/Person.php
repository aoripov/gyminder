<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonRepository")
 */
class Person extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255, nullable=true)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255, nullable=true)
     */
    protected $lastName;

    /**
     * @var Pair
     * @ORM\OneToMany(targetEntity="Pair", mappedBy="partner1", nullable=true)
     */
    protected $pairs1;

    /**
     * @var Pair
     * @ORM\OneToMany(targetEntity="Pair", mappedBy="partner2", nullable=true)
     */
    protected $pairs2;

    /**
     * @var Cluster
     * @ORM\OneToOne(targetEntity="Cluster", inversedBy="trainer")
     * @ORM\JoinColumn(name="cluster_id", referencedColumnName="id", nullable=true)
     */
    protected $cluster;

    public function __construct()
    {
        parent::__construct();
        $this->pairs1 = new ArrayCollection();
        $this->pairs2 = new ArrayCollection();
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Person
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Person
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    public function __toString()
    {
        return $this->firstName . " " . $this->lastName;
    }

    /**
     * @return null|Cluster
     */
    public function getCluster()
    {
        return $this->cluster;
    }

    /**
     * @param Cluster $cluster
     */
    public function setCluster($cluster)
    {
        $this->cluster = $cluster;
    }
}

