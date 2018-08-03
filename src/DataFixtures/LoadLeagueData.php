<?php

namespace App\DataFixtures;

use App\Entity\League;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadLeagueData extends Fixture implements FixtureInterface
{
    private static $list = [
        'Premier League 17/18',
        'Premier League 18/19',
    ];

    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (static::$list as $key => $leagueName) {
            $league = (new League())
                ->setName($leagueName);

            $manager->persist($league);

            // add a relation reference
            $this->addReference("league{$key}", $league);
        }

        $manager->flush();
    }
}
