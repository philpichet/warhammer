<?php

namespace AppBundle\Repository\Army;

/**
 * PhotoFigurineRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PictureUnitRepository extends \Doctrine\ORM\EntityRepository
{
    public function findForUnit($unit)
    {
        $qb = $this->createQueryBuilder('ph');

        $qb->where('ph.unit = :unit')
            ->setParameter('unit', $unit);
        return $qb;
    }
}
