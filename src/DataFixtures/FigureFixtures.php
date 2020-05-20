<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\DataFixtures;

use App\Entity\Figure;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class FigureFixtures.
 */
class FigureFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * A prefix reference constant for Figure
     *
     * @var string
     */
    public const FIGURE_REFERENCE_PREFIX = 'figure_';

    /**
     * Load fixtures in Figure table
     *
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $figure = new Figure();
        $figure
            ->setSlug('nose')
            ->setName('Nose')
            ->setDescription(
                'Grabs help all riders by stabilizing their drift through the air. 
                As you’d expect, grab the front (or ‘nose’) of your board with your leading hand. Purists 
                (and there are a lot of people guarding the purity of these grabs) insist that the best-looking 
                nose grabs are held at the actual tip of your board – not just somewhere nearby.'
            )
            ->setCreatedAt(new DateTime())
            ->setSnowboarder(
                $this->getReference(SnowboarderFixtures::SNOWBOARDER_REFERENCE_PREFIX.'1')
            )
            ->setCategory(
                $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'1')
            )
        ;
        $manager->persist($figure);
        $this->addReference(self::FIGURE_REFERENCE_PREFIX.'1', $figure);

        $figure = new Figure();
        $figure
            ->setSlug('mute')
            ->setName('Mute')
            ->setDescription(
                'Grabs help all riders by stabilizing their drift through the air. 
                Take your leading hand and grab hold of your toe edge anywhere between the bindings. 
                Straighten both legs and you’re doing a ‘stiffie’, or straighten your back leg only 
                (like Dom here) and you’re doing a mute tail poke. Two tricks for the price of one eh?'
            )
            ->setCreatedAt(new DateTime())
            ->setSnowboarder(
                $this->getReference(SnowboarderFixtures::SNOWBOARDER_REFERENCE_PREFIX.'2')
            )
            ->setCategory(
                $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'1')
            )
        ;
        $manager->persist($figure);
        $this->addReference(self::FIGURE_REFERENCE_PREFIX.'2', $figure);

        $figure = new Figure();
        $figure
            ->setSlug('indy')
            ->setName('Indy')
            ->setDescription(
                'Grabs help all riders by stabilizing their drift through the air. 
                The Indy is a bonefide classic grab. Reach down with your trailing hand and get some purchase 
                on your toe edge between your bindings. Then, to add some style, push your front leg out straight. 
                That’s living alright.'
            )
            ->setCreatedAt(new DateTime())
            ->setSnowboarder(
                $this->getReference(SnowboarderFixtures::SNOWBOARDER_REFERENCE_PREFIX.'3')
            )
            ->setCategory(
                $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'1')
            )
        ;
        $manager->persist($figure);
        $this->addReference(self::FIGURE_REFERENCE_PREFIX.'3', $figure);

        $figure = new Figure();
        $figure
            ->setSlug('tail')
            ->setName('Tail')
            ->setDescription(
                'Grabs help all riders by stabilizing their drift through the air. 
                Opposite to the nose grab – simply reach for the tail of your board with your trailing hand 
                and hold on for dear life. Land this one whilst still holding on to the grab and you automatically 
                gain entry into the snowboarding hall of fame. In your own head.'
            )
            ->setCreatedAt(new DateTime())
            ->setSnowboarder(
                $this->getReference(SnowboarderFixtures::SNOWBOARDER_REFERENCE_PREFIX.'1')
            )
            ->setCategory(
                $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'1')
            )
        ;
        $manager->persist($figure);
        $this->addReference(self::FIGURE_REFERENCE_PREFIX.'4', $figure);

        $figure = new Figure();
        $figure
            ->setSlug('melon')
            ->setName('Melon')
            ->setDescription(
                'Grabs help all riders by stabilizing their drift through the air. 
                A good meloncollie grab is like an indy: timeless. Hold onto your heel edge using your leading hand, 
                and grab anywhere between your bindings (it’ll probably feel easiest just behind the front foot) 
                then bone your front leg out. A great-looking melon grab makes you feel like a Kung Fu master 
                throwing a flying kick.'
            )
            ->setCreatedAt(new DateTime())
            ->setSnowboarder(
                $this->getReference(SnowboarderFixtures::SNOWBOARDER_REFERENCE_PREFIX.'2')
            )
            ->setCategory(
                $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'1')
            )
        ;
        $manager->persist($figure);
        $this->addReference(self::FIGURE_REFERENCE_PREFIX.'5', $figure);

        $figure = new Figure();
        $figure
            ->setSlug('stalefish')
            ->setName('Stalefish')
            ->setDescription(
                'Grabs help all riders by stabilizing their drift through the air. 
                Another classic – hold onto your heel edge between your bindings using your trailing hand. 
                Tip: because it’s a stretch to reach behind your rear binding, push your back foot across at the 
                same time. It’s extra stylee that way too.'
            )
            ->setCreatedAt(new DateTime())
            ->setSnowboarder(
                $this->getReference(SnowboarderFixtures::SNOWBOARDER_REFERENCE_PREFIX.'3')
            )
            ->setCategory(
                $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'1')
            )
        ;
        $manager->persist($figure);
        $this->addReference(self::FIGURE_REFERENCE_PREFIX.'6', $figure);

        $figure = new Figure();
        $figure
            ->setSlug('method')
            ->setName('Method')
            ->setDescription(
                'Grabs help all riders by stabilizing their drift through the air. 
                The humble method is universally hailed as the king of all grabs. Lift your board sideways and 
                then grab your heel edge either side of (but close to) the front binding with your leading hand. 
                Try to keep the board horizontal, and for extra style, push your back foot out and around – extending 
                your other arm for balance. Magic. Wanna turn this into a palm air (named after Shaun Palmer)? 
                Grab the heel edge just in front of the bindings but make sure you crank it out all the more, 
                you don’t want to be grabbing "nelon" now!'
            )
            ->setCreatedAt(new DateTime())
            ->setSnowboarder(
                $this->getReference(SnowboarderFixtures::SNOWBOARDER_REFERENCE_PREFIX.'1')
            )
            ->setCategory(
                $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'1')
            )
        ;
        $manager->persist($figure);
        $this->addReference(self::FIGURE_REFERENCE_PREFIX.'7', $figure);

        $figure = new Figure();
        $figure
            ->setSlug('japan')
            ->setName('Japan')
            ->setDescription(
                'Grabs help all riders by stabilizing their drift through the air. 
                To do Japan properly you’ll need to be very flexible. First, get the board sideways (like a method), 
                and then reach around your tucked front knee with your leading hand, grabbing the toe edge between 
                the bindings. Once you’ve got a good grip on the board, pull everything up and backwards, contorting 
                yourself into an almightily beautiful shape.'
            )
            ->setCreatedAt(new DateTime())
            ->setSnowboarder(
                $this->getReference(SnowboarderFixtures::SNOWBOARDER_REFERENCE_PREFIX.'2')
            )
            ->setCategory(
                $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'1')
            )
        ;
        $manager->persist($figure);
        $this->addReference(self::FIGURE_REFERENCE_PREFIX.'8', $figure);

        $figure = new Figure();
        $figure
            ->setSlug('seatbelt')
            ->setName('Seatbelt')
            ->setDescription(
                'Grabs help all riders by stabilizing their drift through the air. 
                To do a proper seatbelt air, push your front hand down across your body, then grab the tail 
                on the toeside. So called because your arm will be going across your body like a seatbelt.'
            )
            ->setCreatedAt(new DateTime())
            ->setSnowboarder(
                $this->getReference(SnowboarderFixtures::SNOWBOARDER_REFERENCE_PREFIX.'3')
            )
            ->setCategory(
                $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'1')
            )
        ;
        $manager->persist($figure);
        $this->addReference(self::FIGURE_REFERENCE_PREFIX.'9', $figure);

        $figure = new Figure();
        $figure
            ->setSlug('truckdriver')
            ->setName('Truck Driver')
            ->setDescription(
                'Grabs help all riders by stabilizing their drift through the air. 
                Another double-hander. This time hold on to both your heel and toe edge between your bindings.'
            )
            ->setCreatedAt(new DateTime())
            ->setSnowboarder(
                $this->getReference(SnowboarderFixtures::SNOWBOARDER_REFERENCE_PREFIX.'1')
            )
            ->setCategory(
                $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'1')
            )
        ;
        $manager->persist($figure);
        $this->addReference(self::FIGURE_REFERENCE_PREFIX.'10', $figure);

        $figure = new Figure();
        $figure
            ->setSlug('chickensalad')
            ->setName('Chicken Salad')
            ->setDescription(
                'Grabs help all riders by stabilizing their drift through the air. 
                The Chicken Salad is the opposite of a Roastbeef: push your leading hand through your legs, 
                grab your heel edge, and bone your front foot outwards. Why the name Chicken Salad? We have 
                absolutely no idea.'
            )
            ->setCreatedAt(new DateTime())
            ->setSnowboarder(
                $this->getReference(SnowboarderFixtures::SNOWBOARDER_REFERENCE_PREFIX.'2')
            )
            ->setCategory(
                $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'1')
            )
        ;
        $manager->persist($figure);
        $this->addReference(self::FIGURE_REFERENCE_PREFIX.'11', $figure);

        $figure = new Figure();
        $figure
            ->setSlug('backflip')
            ->setName('Backflip')
            ->setDescription(
                'Pick a jump that you’re completely comfortable soaring over. 
                A small backcountry kicker will also work a treat. A good crew is also key. 
                Bring some homies who will give you an echoing "Yeww!!" when you’re ready to stomp a new trick. 
                Commitment to the rotation is key when trying your first wild cat so aim for a tighter tuck. 
                A speedier rotation may cause you to land heavier on the tail of your board, but is the more 
                desirable option when compared with landing over the nose of your board. After the first few 
                adjust your pop and rotation accordingly… et voilà!'
            )
            ->setCreatedAt(new DateTime())
            ->setSnowboarder(
                $this->getReference(SnowboarderFixtures::SNOWBOARDER_REFERENCE_PREFIX.'1')
            )
            ->setCategory(
                $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'2')
            )
        ;
        $manager->persist($figure);
        $this->addReference(self::FIGURE_REFERENCE_PREFIX.'12', $figure);

        $figure = new Figure();
        $figure
            ->setSlug('frontflip')
            ->setName('Frontflip')
            ->setDescription(
                'The Frontflip is one of the easiest flips on the snowboard. Before trying 
            it out on the snow, practice the flip on a trampoline. Accelerate on a flat board. 
            To get into a good spin, push onto the tail before the jump, and then quickly shift forward 
            and push off with your front leg. Make sure your shoulders are parallel to the board. 
            Once in the air, draw up your knees and find your landing spot. Land your board flat.'
            )
            ->setCreatedAt(new DateTime())
            ->setSnowboarder(
                $this->getReference(SnowboarderFixtures::SNOWBOARDER_REFERENCE_PREFIX.'2')
            )
            ->setCategory(
                $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'2')
            )
        ;
        $manager->persist($figure);
        $this->addReference(self::FIGURE_REFERENCE_PREFIX.'13', $figure);

        $figure = new Figure();
        $figure
            ->setSlug('180')
            ->setName('180')
            ->setDescription(
                'Once you’ve got flat ollies down and you want to start on your 
            freestyle career, you’ll probably want to throw a 180. The frontside version (where you’re turning 
            your front to the landing as you enter the air, like a heelside turn) should be your first point of call. 
            Of course before you attempt this, you’ll first need to master riding switch (backwards) and you’ll 
            really have to commit to getting that board around if you want to avoid catching your toe edge mid trick.'
            )
            ->setCreatedAt(new DateTime())
            ->setSnowboarder(
                $this->getReference(SnowboarderFixtures::SNOWBOARDER_REFERENCE_PREFIX.'3')
            )
            ->setCategory(
                $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'3')
            )
        ;
        $manager->persist($figure);
        $this->addReference(self::FIGURE_REFERENCE_PREFIX.'14', $figure);

        $figure = new Figure();
        $figure
            ->setSlug('360')
            ->setName('360')
            ->setDescription(
                'A frontside 360 is when you leave the slope and rotate in the air 
            360 degrees before hitting the ground again. The "frontside" part of the jump refers to the fact 
            that you turn your chest toward the bottom of the slope first rather than your back. If you 
            snowboard with your left side in front, then you turn counterclockwise; if you snowboard in the 
            "goofy" position with your right side to the front, you turn clockwise.'
            )
            ->setCreatedAt(new DateTime())
            ->setSnowboarder(
                $this->getReference(SnowboarderFixtures::SNOWBOARDER_REFERENCE_PREFIX.'3')
            )
            ->setCategory(
                $this->getReference(CategoryFixtures::CATEGORY_REFERENCE_PREFIX.'3')
            )
        ;
        $manager->persist($figure);
        $this->addReference(self::FIGURE_REFERENCE_PREFIX.'15', $figure);

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
            SnowboarderFixtures::class,
        ];
    }
}
