<?php

namespace PPE_PHP_GSB\DAO;

use PPE_PHP_GSB\Domain\Famille;

class FamilleDAO extends DAO
{
    /**
     * Return a list of all familles, sorted by date (most recent first).
     *
     * @return array A list of all familles.
     */
    public function findAll() {
        $sql = "select * from famille order by id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $familles = array();
        foreach ($result as $row) {
            $familleId = $row['id'];
            $familles[$familleId] = $this->buildDomainObject($row);
        }
        return $familles;
    }

    /**
     * Returns an product matching the supplied id.
     *
     * @param integer $id The product id.
     *
     * @return \PPE_PHP_GSB\Domain\famille|throws an exception if no matching product is found
     */
    public function find($id) {
        $sql = "select * from famille where id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No famille matching id " . $id);
    }

    /**
     * Saves an product into the database.
     *
     * @param \PPE_PHP_GSB\Domain\Famille $famille The famille to save
     */
    public function save(Famille $famille) {
        $familleData = array(
            'id' => $famille->getId(),
            'nom' => $famille->getNom(),
            );

        if ($famille->getId()) {
            // The famille has already been saved : update it
            $this->getDb()->update('famille', $familleData, array('id' => $famille->getId()));
        } else {
            // The famille has never been saved : insert it
            $this->getDb()->insert('famille', $familleData);
            // Get the id of the newly created famille and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $famille->setId($id);
        }
    }

    /**
     * Removes an famille from the database.
     *
     * @param integer $id The famille id.
     */
    public function delete($id) {
        // Delete the famille
        $this->getDb()->delete('famille', array('id' => $id));
    }

    /**
     * Creates an Famille object based on a DB row.
     *
     * @param array $row The DB row containing Famille data.
     * @return \PPE_PHP_GSB\Domain\Famille
     */
    protected function buildDomainObject($row) {
        $famille = new Famille();
        $famille->setId($row['id']);
        $famille->setNom($row['nom']);
        return $famille;
    }
}
