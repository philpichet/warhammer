<?php

namespace AppBundle\Repository\Army;

/**
 * OptionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OptionRepository extends \Doctrine\ORM\EntityRepository
{
	public function findByRace($race)
	{
		$qb = $this->createQueryBuilder('o');

		$qb->innerJoin('o.figurines','op')
			->addSelect('op')
			->innerJoin('op.figurine','f')
			->addSelect('f')
			->where('f.race = :race')
			->setParameter('race', $race);

		return $qb;
	}public function findByFigurine($figurine)
	{
		$qb = $this->createQueryBuilder('o');

		$qb->innerJoin('o.figurines','op')
			->addSelect('op')
			->where('op.figurine = :figurine')
			->setParameter('figurine', $figurine);

		return $qb;
	}
}
