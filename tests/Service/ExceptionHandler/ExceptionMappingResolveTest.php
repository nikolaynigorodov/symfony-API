<?php

namespace App\Tests\Service\ExceptionHandler;

use App\Service\ExceptionHandler\ExceptionMappingResolver;
use App\Tests\AbstractTestCase;
use InvalidArgumentException;
use LogicException;
use PHPUnit\Framework\TestCase;

class ExceptionMappingResolverTest extends AbstractTestCase
{

    public function testThrowsExceptionOnEmptyCode()
    {
        $this->expectException(InvalidArgumentException::class);

        new ExceptionMappingResolver(['someClass' => ['hidden' => true]]);
    }

    public function testResolvesToNullWhenNotFound(): void
    {
        $resolver = new ExceptionMappingResolver([]);

        $this->assertNull($resolver->resolve(InvalidArgumentException::class));
    }

    public function testResolvesClassItSelf(): void
    {
        $resolver = new ExceptionMappingResolver([InvalidArgumentException::class => ['code' => 400]]);
        $mapping = $resolver->resolve(InvalidArgumentException::class);

        $this->assertEquals(400, $mapping->getCode());
        $this->assertFalse($mapping->isHidden());
        $this->assertTrue($mapping->isLoggable());
    }

    public function testResolvesSubClass()
    {
        $resolver = new ExceptionMappingResolver([LogicException::class => ['code' => 500]]);
        $mapping = $resolver->resolve(InvalidArgumentException::class);

        $this->assertEquals(500, $mapping->getCode());
    }

    public function testResolvesHidden()
    {
        $resolver = new ExceptionMappingResolver([LogicException::class => ['code' => 500, 'hidden' => false]]);
        $mapping = $resolver->resolve(LogicException::class);

        $this->assertFalse($mapping->isHidden());
    }

    public function testResolvesLoggable()
    {
        $resolver = new ExceptionMappingResolver([LogicException::class => ['code' => 500, 'loggable' => true]]);
        $mapping = $resolver->resolve(LogicException::class);

        $this->assertTrue($mapping->isLoggable());
    }
}
