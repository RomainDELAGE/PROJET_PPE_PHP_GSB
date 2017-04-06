<?php

namespace PPE_PHP_GSB\Domain;

class Famille 
{
    /**
     * Famille id.
     *
     * @var integer
     */
    private $id;

    /**
     * Famille title.
     *
     * @var string
     */
    private $nom;

    /**
     * Famille content.
     *
     * @var string
     */
    private $content;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }
    
}