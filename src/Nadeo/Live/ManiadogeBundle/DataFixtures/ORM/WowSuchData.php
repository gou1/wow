<?php

namespace Nadeo\Live\ManiadogeBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nadeo\Live\ManiadogeBundle\Entity\Doge;

class WowSuchData implements FixtureInterface
{
     /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $doge = new Doge();
        $doge->setName('original');
        $doge->setImageUrl('http://upload.wikimedia.org/wikipedia/en/5/5f/Original_Doge_meme.jpg');
        $manager->persist($doge);

        $doge = new Doge();
        $doge->setName('follow your dreams');
        $doge->setImageUrl('http://www.fanaru.com/doge/image/18361-doge-follow-your-dreams.jpg');
        $manager->persist($doge);

        $doge = new Doge();
        $doge->setName('twinkies');
        $doge->setImageUrl('http://www.slate.com/content/dam/slate/blogs/lexicon_valley/2014/02/13/doge_why_we_can_t_agree_on_how_to_pronounce_the_internet_meme_featuring/doge_twinkie.jpg.CROP.promovar-mediumlarge.jpg');
        $manager->persist($doge);

        $manager->flush();
    }
}
