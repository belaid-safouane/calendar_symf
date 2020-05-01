<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Bookings
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    
    /**
     * @ORM\PrePersist
     * 
     * @return void
     */
  //  public function prePersist(){
    //    if(empty($this->date)){
            //si ma date de creation est vide alors une date sera créer à l'instant
        //    $this->date = new \DateTime();
      //  }
   // }

    /**
     * @ORM\Column(type="text")
     */
    private $timeslot;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date;


    public function __toString()
    {
        return $this->timeslot;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    

    public function getTimeslot(): ?string
    {
        return $this->timeslot;
    }

    public function setTimeslot(string $timeslot): self
    {
        $this->timeslot = $timeslot;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }
}
