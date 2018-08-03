<?php

namespace App\Repository;

use App\Entity\League;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\ParameterBag;

class TeamRepository extends EntityRepository
{
    /**
     * @param ParameterBag $params
     * @param League|null  $league
     *
     * @return mixed
     */
    public function findByParams(ParameterBag $params, League $league = null)
    {
        $qb = $this->createQueryBuilder('t')
            ->select()
            ->leftJoin('t.league', 'l')
            ->setMaxResults($params->get('limit', 10))
            ->setFirstResult($params->get('offset', 0));

        if ($league) {
            $qb->andWhere('l.id = :league')
                ->setParameter('league', $league);
        }

        return $qb->getQuery()->getResult();
    }
}
