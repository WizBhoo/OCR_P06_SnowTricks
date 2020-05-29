<?php

/**
 * (c) Adrien PIERRARD
 */

namespace App\Tests\Unit\Entity;

use App\Entity\Category;
use App\Entity\Figure;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

/**
 * Class CategoryTest.
 */
class CategoryTest extends TestCase
{
    /**
     * A constant that represent a category name
     *
     * @var string
     */
    const CATEGORY_NAME = 'toto';

    /**
     * Test Category entity getters and setters.
     *
     * @return void
     */
    public function testGetterSetter(): void
    {
        $category = new Category();

        $this->assertInstanceOf(Category::class, $category);
        $this->assertEquals(null, $category->getId());
        $this->assertEquals(null, $category->getName());
        $this->assertInstanceOf(Collection::class, $category->getFigures());

        $category->setName(self::CATEGORY_NAME);
        $this->assertEquals(self::CATEGORY_NAME, $category->getName());

        $figure = new Figure();
        $category->addFigure($figure);
        $this->assertCount(1, $category->getFigures());

        $category->removeFigure($figure);
        $this->assertCount(0, $category->getFigures());
    }
}
