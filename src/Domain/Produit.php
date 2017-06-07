<?php

namespace PPE_PHP_GSB\Domain;

class Produit 
{
    /**
     * Produit reference.
     *
     * @var integer
     */
    private $ref;

    /**
     * Produit nom.
     *
     * @var string
     */
    private $nom;

    /**
     * Produit dossage.
     *
     * @var string
     */
    private $dosage;

    /**
     * Produit prix.
     *
     * @var double
     */
    private $prix;

    /**
     * Produit text.
     *
     * @var text
     */
    private $contreIndication;

    /**
     * Produit effet.
     *
     * @var text
     */
    private $effetTherapeutique;

    /**
     * Produit dateSuppression.
     *
     * @var date
     */
    private $dateSuppression;

    /**
     * Produit idFamille.
     *
     * @var int
     */
    private $idFamille;


    public function getRef() {
        return $this->ref;
    }

    public function setRef($ref) {
        $this->ref = $ref;
    }


    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getDosage() {
        return $this->dosage;
    }

    public function setDosage($dosage) {
        $this->dosage = $dosage;
    }


    public function getPrix() {
        return $this->prix;
    }

    public function setPrix($prix) {
        $this->prix = $prix;
    }

    public function getContreIndication() {
        return $this->contreIndication;
    }

    public function setContreIndication($contreIndication) {
        $this->contreIndication = $contreIndication;
    }

    public function getEffetTherapeutique() {
        return $this->effetTherapeutique;
    }

    public function setEffetTherapeutique($effetTherapeutique) {
        $this->effetTherapeutique = $effetTherapeutique;
    }

    public function getDateSuppression() {
        return $this->dateSuppression;
    }

    public function setDateSuppression($dateSuppression) {
        $this->dateSuppression = $dateSuppression;
    }

    public function getIdFamille() {
        return $this->idFamille;
    }

    public function setIdFamille($idFamille) {
        $this->idFamille = $idFamille;
    }



}
