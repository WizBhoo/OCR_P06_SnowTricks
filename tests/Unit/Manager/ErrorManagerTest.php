<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Tests\Unit\Manager;

use App\Manager\ErrorManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;

/**
 * Class ErrorManagerTest.
 */
class ErrorManagerTest extends TestCase
{
    /**
     * An ErrorManager Instance
     *
     * @var ErrorManager
     */
    private $errorManager;

    /**
     * Set up the ErrorManager
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->errorManager = new ErrorManager();
    }

    /**
     * Test no error messages from form.
     *
     * @return void
     */
    public function testNoErrorMessages(): void
    {
        $formMock = $this->createMock(FormInterface::class);
        $formMock
            ->expects($this->once())
            ->method('getErrors')
            ->willReturn([]);
        $formMock
            ->expects($this->once())
            ->method('all')
            ->willReturn([]);

        /** @var FormInterface $formMock */
        $this->assertEmpty($this->errorManager->getErrorMessages($formMock));
    }

    /**
     * Test no error messages from form.
     *
     * @return void
     */
    public function testFormErrorMessages(): void
    {
        $formMock = $this->createMock(FormInterface::class);
        $formErrorMock = $this->createMock(FormError::class);
        $formMock
            ->expects($this->once())
            ->method('getErrors')
            ->willReturn([$formErrorMock]);
        $formMock
            ->expects($this->once())
            ->method('isRoot')
            ->willReturn(true);
        $formMock
            ->expects($this->once())
            ->method('all')
            ->willReturn([]);

        /** @var FormInterface $formMock */
        $this->assertCount(1, $this->errorManager->getErrorMessages($formMock));
    }

    /**
     * Test no error messages from child form.
     *
     * @return void
     */
    public function testChildFormErrorMessages(): void
    {
        $formMock = $this->createMock(FormInterface::class);
        $childFormMock = $this->createMock(FormInterface::class);
        $formMock
            ->expects($this->once())
            ->method('getErrors')
            ->willReturn([]);
        $formMock
            ->expects($this->once())
            ->method('all')
            ->willReturn([$childFormMock]);

        $formErrorMock = $this->createMock(FormError::class);

        $childFormMock
            ->expects($this->once())
            ->method('getErrors')
            ->willReturn([$formErrorMock]);
        $childFormMock
            ->expects($this->once())
            ->method('all')
            ->willReturn([]);

        /** @var FormInterface $formMock */
        $this->assertCount(1, $this->errorManager->getErrorMessages($formMock));
    }
}
