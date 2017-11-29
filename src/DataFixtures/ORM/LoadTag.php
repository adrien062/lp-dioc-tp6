<?php

namespace App\DataFixtures\ORM;

use App\Entity\Tag;
use App\Entity\User;
use App\Slug\SlugGenerator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTag extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $tags = ["Cuisine", "Menuisier", "Vidéo"];

        foreach($tags as $tag){
            $slugGene = $this->container->get(SlugGenerator::class);
            $slug = $slugGene->generate($tag);

            $tag = new Tag($tag, $slug);

            $manager->persist($tag);

        }

        $manager->flush();
    }
}
