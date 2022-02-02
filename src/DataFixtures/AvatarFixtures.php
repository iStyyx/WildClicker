<?php

namespace App\DataFixtures;

use App\Entity\Avatar;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AvatarFixtures extends Fixture
{
    const AVATARS_BOYS = [
        'images/Characters/1-Boy.jpg',
        'images/Characters/2-Boy.jpg',
        'images/Characters/3-Boy.jpg',
    ];

    const AVATARS_GIRLS = [
        'images/Characters/1-Girl.jpg',
        'images/Characters/2-Girl.jpg',
        'images/Characters/3-GIrl.jpg',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::AVATARS_BOYS as $key => $avatarLink) {
            $avatar = new Avatar();
            $avatar->setName('Boy ' . $key+=1);
            $avatar->setLink($avatarLink);

            $manager->persist($avatar);
        }

        foreach (self::AVATARS_GIRLS as $key => $avatarLink) {
            $avatar = new Avatar();
            $avatar->setName('Girl ' . $key+=1);
            $avatar->setLink($avatarLink);

            $manager->persist($avatar);
        }
        $manager->flush();
    }
}
