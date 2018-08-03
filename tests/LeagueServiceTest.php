<?php

namespace App\Tests;

use App\Entity\League;
use App\Services\LeagueService;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LeagueServiceTest extends KernelTestCase
{
    /**
     * @var EntityManager|MockObject
     */
    private $em;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        self::bootKernel();
    }

    protected function setUp()
    {
        parent::setUp();

        $this->em = $this->createMock(EntityManager::class);
    }

    /**
     * @group services
     */
    public function testDelete()
    {
        $league = $this->createMock(League::class);

        /** @var LeagueService $service */
        $service = new LeagueService($this->em);
        $this->em
            ->expects($this->once())
            ->method('remove');
        $this->em
            ->expects($this->once())
            ->method('flush');

        $service->delete($league);
    }
}
