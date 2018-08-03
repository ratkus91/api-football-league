<?php

namespace App\DataFixtures;

use App\Entity\League;
use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTeamData extends Fixture implements FixtureInterface, DependentFixtureInterface
{
    private static $list = [
        'Arsenal',
        'Chelsea',
        'Everton',
        'Fulham',
        'Burnley',
        'Liverpool',
        'Manchester City',
    ];

    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (static::$list as $key => $teamName) {
            /** @var League */
            $league = $this->getReference('league0');

            $team = (new Team())
                ->setName($teamName)
                ->setLeague($league)
                ->setStrip("Strip name $key");

            $manager->persist($team);
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            LoadLeagueData::class,
        ];
    }
}
