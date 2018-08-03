<?php

namespace App\Services;

use App\Entity\League;
use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TeamService
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param League       $league
     * @param Team         $team
     * @param ParameterBag $params
     *
     * @return Team
     */
    public function save(League $league, Team $team, ParameterBag $params)
    {
        $params->has('name') && $team->setName($params->get('name'));
        $params->has('strip') && $team->setStrip($params->get('strip'));
        $team->setLeague($league);
        try {
            $this->em->persist($team);
            $this->em->flush();

            return $team;
        } catch (\Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    /**
     * Finds entities by params.
     *
     * @param ParameterBag $params
     * @param League       $league
     *
     * @return mixed
     */
    public function findByParams(ParameterBag $params, League $league)
    {
        return $this->em->getRepository(Team::class)->findByParams($params, $league);
    }
}
