<?php

namespace App\Pcs\Repository;

use App\Pcs\Entity\Pc;
use Doctrine\DBAL\Connection;

/**
 * User repository.
 */
class PcRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

   /**
    * Returns a collection of users.
    *
    * @param int $limit
    *   The number of users to return.
    * @param int $offset
    *   The number of users to skip.
    * @param array $orderBy
    *   Optionally, the order by info, in the $column => $direction format.
    *
    * @return array A collection of users, keyed by user id.
    */
   public function getAll()
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('p.*')
           ->from('pcs', 'p');

       $statement = $queryBuilder->execute();
       $pcsData = $statement->fetchAll();
       $pcEntityList=array();
       foreach ($pcsData as $pcData) {
           $pcEntityList[$pcData['id']] = new Pc($pcData['id'], $pcData['vendeur'], $pcData['os']);
       }

       return $pcEntityList;
   }

   /**
    * Returns an User object.
    *
    * @param $id
    *   The id of the user to return.
    *
    * @return array A collection of users, keyed by user id.
    */
   public function getById($id)
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('p.*')
           ->from('pcs', 'p')
           ->where('id = ?')
           ->setParameter(0, $id);
       $statement = $queryBuilder->execute();
       $pcData = $statement->fetchAll();

       return new Pc($pcData[0]['id'], $pcData[0]['vendeur'], $pcData[0]['os']);
   }

    public function delete($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->delete('pcs')
          ->where('id = :id')
          ->setParameter(':id', $id);

        $statement = $queryBuilder->execute();
    }

    public function update($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->update('pcs')
          ->where('id = :id')
          ->setParameter(':id', $parameters['id']);

        if ($parameters['vendeur']) {
            $queryBuilder
              ->set('vendeur', ':vendeur')
              ->setParameter(':vendeur', $parameters['vendeur']);
        }

        if ($parameters['os']) {
            $queryBuilder
            ->set('os', ':os')
            ->setParameter(':os', $parameters['os']);
        }

        $statement = $queryBuilder->execute();
    }

    public function insert($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->insert('pcs')
          ->values(
              array(
                'vendeur' => ':vendeur',
                'os' => ':os'
              )
          )
          ->setParameter(':vendeur', $parameters['vendeur'])
          ->setParameter(':os', $parameters['os']);
        $statement = $queryBuilder->execute();
    }
}
