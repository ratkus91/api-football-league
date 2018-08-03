<?php

namespace App\Tests;

use App\Entity\League;
use App\Entity\Team;
use App\Services\TeamService;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\ParameterBag;

class TeamServiceTest extends KernelTestCase
{
    /**
     * @var EntityManager|MockObject
     */
    private $em;

    protected function setUp()
    {
        parent::setUp();

        $this->em = $this->createMock(EntityManager::class);
    }

    /**
     * @group services
     */
    public function testSave()
    {
        // prepare the data
        $team = new Team();
        $league = (new League())
            ->setName('test')
            ->addTeam($team);

        // persisting & flushing should be once
        $this->em
            ->expects($this->once())
            ->method('persist');
        $this->em
            ->expects($this->once())
            ->method('flush');

        /** @var TeamService $service */
        $service = new TeamService($this->em);

        $newName = 'test1';
        $team2 = $service->save($league, $team, new ParameterBag(['name' => $newName]));
        // should be Team
        $this->assertInstanceOf(Team::class, $team2);
        // should have the same name
        $this->assertEquals($newName, $team2->getName());
    }
}
