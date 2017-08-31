<?php

namespace AppBundle\Repository\Unit;

/**
 * UnitRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UnitRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByRace($race)
    {
        $qb = $this->createQueryBuilder('u');

        $qb->innerJoin('u.groupe', 'g')
            ->addSelect('g')
            ->where('u.race = :race')
            ->setParameter('race', $race)
            ->orderBy('u.name');

        return $qb;
    }

    public function findByFilter($race = null)
    {
        $queryBuilder = $this->createQueryBuilder('u');
        if( $race !== null){
            $queryBuilder->innerJoin('u.race', 'r')
                ->where('r.id = :id')
                ->setParameter('id', $race);
        }
        $queryBuilder->orderBy('u.name', 'ASC');

        $query = $queryBuilder->getQuery()->getResult();

        return $query;
    }
    public function getOrdering()
    {
        $queryBuilder = $this->createQueryBuilder('u');
        $queryBuilder->orderBy('u.name', 'ASC');

        return $queryBuilder;
    }
}