<?php

namespace App\DataFixtures;

use App\Entity\BookCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookCategoryFixtures extends Fixture
{
    public const DEVICES_CATEGORY = 'devices';

    public const ANDROID_CATEGORY = 'android';

    public function load(ObjectManager $manager): void
    {
        $categories = [
          self::DEVICES_CATEGORY => (new BookCategory())->setTitle('Devices')->setSlug('devices'),
          self::ANDROID_CATEGORY => (new BookCategory())->setTitle('Android')->setSlug('android'),
        ];

        foreach ($categories as $category) {
            $manager->persist($category);
        }

        $manager->persist((new BookCategory())->setTitle('C#')->setSlug('C#'));

        $manager->flush();

        foreach ($categories as $code => $category) {
            $this->addReference($code, $category);
        }
    }
}
