<?php

namespace App\Pcs\Entity;

class Pc
{
    protected $id;

    protected $vendeur;

    protected $os;

    public function __construct($id, $vendeur, $os)
    {
        $this->id = $id;
        $this->vendeur = $vendeur;
        $this->os = $os;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setVendeur($vendeur)
    {
        $this->vendeur = $vendeur;
    }

    public function setOs($os)
    {
        $this->os = $os;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getVendeur()
    {
        return $this->vendeur;
    }
    public function getOs()
    {
        return $this->os;
    }

    public function toArray()
    {
        $array = array();
        $array['id'] = $this->id;
        $array['vendeur'] = $this->vendeur;
        $array['os'] = $this->os;

        return $array;
    }
}
