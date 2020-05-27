<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Tests\Functional\Controller;

use App\Entity\Snowboarder;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class AccountControllerTest.
 */
class AccountControllerTest extends WebTestCase
{
    /**
     * A constant that represent the tested URI
     *
     * @var string
     */
    const ACTIVATION_URI = '/account-activation';

    /**
     * An EntityManager Instance
     *
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Set up the EntityManager
     *
     * @return void
     */
    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * Test activation with bad user.
     *
     * @return void
     */
    public function testActivationWrongUser(): void
    {
        self::ensureKernelShutdown();
        $client = static::createClient();

        $client->request(
            'GET',
            self::ACTIVATION_URI,
            ['username' => 'fabien']
        );
        $session = $client->getContainer()->get('session');
        $flashes = $session->getBag('flashes')->all();
        $this->assertArrayHasKey('alert', $flashes);
        $this->assertCount(1, $flashes['alert']);
        $this->assertEquals('Error, try again.', current($flashes['alert']));
        $this->assertResponseRedirects('/register');
    }

    /**
     * Test activation with good user but bad token.
     *
     * @return void
     */
    public function testActivationWrongToken(): void
    {
        self::ensureKernelShutdown();
        $client = static::createClient();

        $client->request(
            'GET',
            self::ACTIVATION_URI,
            [
                'username' => 'snowboarder1',
                'token' => 'badtoken'
            ]
        );
        $session = $client->getContainer()->get('session');
        $flashes = $session->getBag('flashes')->all();
        $this->assertArrayHasKey('alert', $flashes);
        $this->assertCount(1, $flashes['alert']);
        $this->assertEquals('Token Invalid, try again.', current($flashes['alert']));
        $this->assertResponseRedirects('/register');
    }

    /**
     * Test activation with good user and valid token.
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function testGoodAccountActivation(): void
    {
        $snowboarder = $this->entityManager
            ->getRepository(Snowboarder::class)
            ->findOneBy(['username' => 'snowboarder2'])
        ;
        $snowboarder
            ->setAccountToken('goodtoken')
            ->setAccountTokenAt(new DateTime())
            ->setAccountStatus(false)
        ;
        $this->entityManager->persist($snowboarder);
        $this->entityManager->flush();

        self::ensureKernelShutdown();
        $client = static::createClient();

        $client->request(
            'GET',
            self::ACTIVATION_URI,
            [
                'username' => 'snowboarder2',
                'token' => 'goodtoken'
            ]
        );
        $session = $client->getContainer()->get('session');
        $flashes = $session->getBag('flashes')->all();
        $this->assertArrayHasKey('success', $flashes);
        $this->assertCount(1, $flashes['success']);
        $this->assertEquals(
            'Your account has been successfully activated !',
            current($flashes['success'])
        );
        $this->assertResponseRedirects('/');
    }

    /**
     * Called after each test using entityManager to avoid memory leaks
     *
     * @return void
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }
}
