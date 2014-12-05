<?php

namespace AppBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Doge;

class WowSuchData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $doges = [
            'original' => 'http://upload.wikimedia.org/wikipedia/en/5/5f/Original_Doge_meme.jpg',
            'follow your dreams' => 'http://www.fanaru.com/doge/image/18361-doge-follow-your-dreams.jpg',
            'twinkies' => 'http://www.slate.com/content/dam/slate/blogs/lexicon_valley/2014/02/13/doge_why_we_can_t_agree_on_how_to_pronounce_the_internet_meme_featuring/doge_twinkie.jpg.CROP.promovar-mediumlarge.jpg',
            'simple' => 'https://pbs.twimg.com/profile_images/378800000822867536/3f5a00acf72df93528b6bb7cd0a4fd0c.jpeg',
            'viper rt10' => 'http://static.fjcdn.com/pictures/Doge+wow+skill+doge_65934b_4755010.jpg',
            'jus do it' => 'http://2prowriting.files.wordpress.com/2013/12/doge-athlete.jpg',
            'indie' => 'http://i0.kym-cdn.com/photos/images/facebook/000/581/723/a8b.jpg',
            'much much' => 'http://lh6.ggpht.com/Q1u7RhClCDy9XLzipIQXPLgJz3FKAVa9oBGooxdtzSYadKhyyjkJEdQK_irBPsWQLFD2BNQbjluSolsotSf5PHA7gx0taEBdygs=s0?.jpg',
            'cookie' => 'http://barkpost-assets.s3.amazonaws.com/wp-content/uploads/2013/11/cookiedoge.jpg',
            'putin' => 'http://weknowmemes.com/wp-content/uploads/2013/11/doge-meme-26.jpg',
            'watch doges' => 'http://th00.deviantart.net/fs70/PRE/i/2013/356/6/9/watch_doges_by_thalessousa-d6yx2yf.jpg',
            'call of doge' => 'http://i.imgur.com/hH9b49C.png',
            'the walking doge' => 'http://2prowriting.files.wordpress.com/2014/03/doge-walking.jpg',
        ];
        foreach ($doges as $name => $imageUrl) {
            $doge = new Doge();
            $doge->setName($name);
            $doge->setImageUrl($imageUrl);
            $manager->persist($doge);
        }
        $manager->flush();
    }
}