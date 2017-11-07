<?php

namespace App\Links\Entity;
use App\Users\Entity\User;
use App\Pcs\Entity\Pc;

class Link
{
   protected $id;

   protected $User;

   protected $Pc;

   public function __construct($id, $user, $pc)
    {
        $this->id = $id;
        $this->User = $user;
        $this->Pc = $pc;
    }

   public function setId($id)
    {
        $this->id = $id;
    }

   public function setUser(User $user)
    {
        $this->User = $user;
    }

    public function getPc(){
        return $this->Pc;
    }

   public function setPc(Pc $pc)
    {
        $this->Pc = $pc;
    }

   public function getId()
    {
        return $this->id;
    }
    public function getUser()
    {
        return $this->User;
    }
    public function getNom()
    {
        return $this->User.getNom();
    }
}
