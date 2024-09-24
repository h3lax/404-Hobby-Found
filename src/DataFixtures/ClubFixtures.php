<?php

namespace App\DataFixtures;

use App\Entity\Club;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ClubFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Create 10 sample clubs
        for ($i = 0; $i < 10; $i++) {
            $club = new Club();
            $club->setName($faker->company);  // Random club name
            $club->setDescription($faker->paragraph);
            $club->setCreatedAt(new \DateTime());
            $club->setLastModifiedAt(new \DateTime());

            $manager->persist($club);

            // Set reference for EventFixtures
            $this->addReference('club_' . $i, $club);
        }

        $manager->flush();
    }
}
