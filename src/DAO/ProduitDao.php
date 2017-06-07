<?php

namespace PPE_PHP_GSB\DAO;

use PPE_PHP_GSB\Domain\Produit;

class ProduitDAO extends DAO
{
    /**
     * Retourne une liste de l'ensemble des produits de la table produit.
     *
     * @return array une liste de tous les produits.
     */
    public function findAll() {
        $sql = "select * from produit where dateSuppression IS Null order by ref DESC";
        $result = $this->getDb()->fetchAll($sql);

        // Convertit les résultat query en un array d'objets
        $produits = array();
        foreach ($result as $row) {
            $produitRef = $row['ref'];
            $produits[$produitRef] = $this->buildDomainObject($row);
        }
        return $produits;
    }

      /**
         * Return a list of all produits, sorted by date (most recent first).
         *
         * @return array A list of produit of a famille.
         */
        public function findProduitFamille($idFam) {
            $sql = "select * from produit where idFamille=".$idFam." AND dateSuppression IS Null order by ref DESC";
            $result = $this->getDb()->fetchAll($sql);

            // Convert query result to an array of domain objects
            $produits = array();
            foreach ($result as $row) {
                $produitRef = $row['ref'];
                $produits[$produitRef] = $this->buildDomainObject($row);
            }
            return $produits;
        }


    /**
     * Retourne un produit en fonction de la ref.
     *
     * @param integer $ref la référence du produit.
     *
     * @return \PPE_PHP_GSB\Domain\produit|throws an exception if no matching produit is found
     */
    public function find($ref) {
        $sql = "select * from produit where ref=?";
        $row = $this->getDb()->fetchAssoc($sql, array($ref));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("Pas de produit pour cette reference " . $ref);
    }

    /**
     * Saves an produit into the database.
     *
     * @param \PPE_PHP_GSB\Domain\produit $produit The produit to save
     */
    public function save(Produit $produit) {
        
        $produitData = array(
            'nom'=> $produit->getNom(),
            'dosage'=> $produit->getDosage(),
            'prix'=> $produit->getPrix(),
            'contreIndication'=> $produit->getContreIndication(),
            'effetTherapeutique'=> $produit->getEffetTherapeutique(),
            'dateSuppression' => $produit->getDateSuppression(),
            'idFamille' => $produit->getIdFamille()
            );
        
        if ($produit->getRef()) {
            // The produit has already been saved : update it
            $this->getDb()->update('produit', $produitData, array('ref' => $produit->getRef()));
        } else {
            // The produit has never been saved : insert it
            $this->getDb()->insert('produit', $produitData);
            // Get the id of the newly created produit and set it on the entity.
            $ref = $this->getDb()->lastInsertId();
            $produit->setRef($ref);
        }
    }





    /**
     * Ajoute une date de suppression au produit le rendant impossible à consulter.
     *
     * @param integer $id The produit id.
     */
    public function delete($ref) {
        // Delete the produit
        $produitData = array( 'dateSuppression' => date('Y-m-j') );

        $this->getDb()->update('produit', $produitData, array('ref' => $ref));
    }

    /**
     * Creates an produit object based on a DB row. La dateSuppression est Null par defaut pas besoin de l'initialiser.
     *
     * @param array $row The DB row containing Produit data.
     * @return \PPE_PHP_GSB\Domain\Produit
     */
    protected function buildDomainObject($row) {
        $produit = new Produit();
        $produit->setRef($row['ref']);
        $produit->setNom($row['nom']);
        $produit->setDosage($row['dosage']);
        $produit->setPrix($row['prix']);
        $produit->setContreIndication($row['contreIndication']);
        $produit->setEffetTherapeutique($row['effetTherapeutique']);
        $produit->setIdFamille($row['idFamille']);
        return $produit;
    }
}