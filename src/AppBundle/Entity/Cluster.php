<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cluster
 *
 * @ORM\Table(name="cluster")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClusterRepository")
 */
class Cluster
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\ManyToOne(targetEntity="Gym", inversedBy="clusters")
     * @ORM\JoinColumn(name="gym_id", referencedColumnName="id")
     */
    private $gym;


    /**
     * @var Person
     * @ORM\OneToOne(targetEntity="Person", mappedBy="cluster")
     */
    private $trainer;


    /**
     * @var array
     * @ORM\Column(name="weekDays", type="array")
     */
    private $weekDays;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime", nullable=true)
     */
    private $time;


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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Cluster
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @return null | Person
     */
    public function getTrainer()
    {
        return $this->trainer;
    }

    /**
     * @param Person $trainer
     */
    public function setTrainer($trainer)
    {
        $this->trainer = $trainer;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return null|Gym
     */
    public function getGym()
    {
        return $this->gym;
    }

    /**
     * @param Gym $gym
     */
    public function setGym($gym)
    {
        $this->gym = $gym;
    }

    /**
     * @return array
     */
    public function getWeekDays()
    {
        return $this->weekDays;
    }

    /**
     * @param array $weekDays
     */
    public function setWeekDays($weekDays)
    {
        $this->weekDays = $weekDays;
    }

    /**
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }
}

