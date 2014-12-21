<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\AdminBundle\Tests\Unit\Entity;

use Hj\AdminBundle\Entity\User;

/**
 * Class UserTest
 * @package Hj\AdminBundle\Tests\Unit\Entity
 *
 * @covers \Hj\AdminBundle\Entity\User
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var User
     */
    private $sut;

    public function setUp()
    {
        $this->sut = new User();
    }

    public function testShouldGetAndSetTheId()
    {
        $this->sut->setId(1);
        $this->assertSame(1, $this->sut->getId());
    }

    public function testShouldGetAndSetTheLabel()
    {
        $this->sut->setLabel('foo');
        $this->assertSame('foo', $this->sut->getLabel());
    }
}