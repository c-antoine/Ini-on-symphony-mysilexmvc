<?php

namespace App\Links\Repository;
use App\Links\Entity\Link;
use App\Links\Entity\PcRepository;
use App\Links\Entity\UserRepository;
use Doctrine\DBAL\Connection;

/**
 * Link repository.
 */
class LinkRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;
    protected $PcRepository;
    protected $UserRepository;
    public function __construct(Connection $db,  $pcRepository, $userRepository)
    {
        $this->db = $db;
        $this->PcRepository = $pcRepository;
        $this->UserRepository = $userRepository;
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
           ->select('l.*')
           ->from('links', 'l');

       $statement = $queryBuilder->execute();
       $linksData = $statement->fetchAll();
       $linkDataEntityList=array();
       foreach ($linksData as $linkData) {
           $linkDataEntityList[$linkData['id']] =
              new Link($linkData['id'],
                       $this->PcRepository->getById($linkData['id_user']),
                       $this->UserRepository->getById($linkData['id_pc']));
       }

       return $linkDataEntityList;
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
      $queryBuilder
      ->select('l.*')
      ->from('links', 'l')
      ->join('l', 'users', 'u', 'l.id_user = u.id')
      ->join('l', 'pcs', 'p', 'l.id_pc = p.id')
      ->where('l.id = :id')
      ->setParameter(':id', $id);
       $statement = $queryBuilder->execute();
       $linkData = $statement->fetchAll();
       foreach ($linksData as $linkData) {
           $linkDataEntityList[$linkData['id']] =
              new Link($linkData['id'],
                       $this->PcRepository->getById($linkData['id_user']),
                       $this->UserRepository->getById($linkData['id_pc']));
       }
   }

    public function delete($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->delete('links')
          ->where('id = :id')
          ->setParameter(':id', $id);

        $statement = $queryBuilder->execute();
    }

    public function update($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->update('links')
          ->where('id = :id')
          ->setParameter(':id', $parameters['id']);

        if ($parameters['id_user']) {
            $queryBuilder
              ->set('id_user', ':id_user')
              ->setParameter(':id_user', $parameters['id_user']);
        }

        if ($parameters['id_pc']) {
            $queryBuilder
            ->set('id_pc', ':id_pc')
            ->setParameter(':id_pc', $parameters['id_pc']);
        }

        $statement = $queryBuilder->execute();
    }

    public function insert($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->insert('links')
          ->values(
              array(
                'id_user' => ':id_user',
                'id_pc' => ':id_pc'
              )
          )
          ->setParameter(':id_user', $parameters['id_user'])
          ->setParameter(':id_pc', $parameters['id_pc']);
        $statement = $queryBuilder->execute();
    }
}
