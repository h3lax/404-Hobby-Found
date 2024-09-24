<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EventFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Create 30 sample events and link them to clubs
        for ($i = 0; $i < 30; $i++) {
            $event = new Event();
            $event->setTitle($faker->sentence(3));
            $event->setDescription($faker->paragraph);
            $event->setDate($faker->dateTimeBetween('now', '+1 year'));
            $event->setCreateAt(new \DateTime());
            $event->setLastModifiedAt(new \DateTime());
            
            // Link event to a random club
            $clubReference = $this->getReference('club_' . rand(0, 9));
            $event->setClub($clubReference);
            
            $manager->persist($event);
        }

        $manager->flush();
    }

    // Declare dependency on ClubFixtures only
    public function getDependencies(): array
    {
        return [
            ClubFixtures::class,
        ];
    }
}
