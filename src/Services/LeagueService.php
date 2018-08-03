<?php

namespace App\Services;

use App\Entity\League;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class LeagueService.
 * manages the League entity.
 */
class LeagueService
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Deletes a league.
     *
     * @param League $league
     */
    public function delete(League $league)
    {
        $this->em->remove($league);
        $this->em->flush();
    }

    /**
     * Finds entities by params.
     *
     * @param ParameterBag $params
     *
     * @return mixed
     */
    public function findByParams(ParameterBag $params)
    {
        return $this->em->getRepository(League::class)->findByParams($params);
    }
}
