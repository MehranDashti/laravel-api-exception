<?php

namespace Mehrand\ApiExceptions\Tests;

use Faker\Factory;
use ReflectionClass;
use App\Exceptions\Handler;
use Illuminate\Http\Request;
use Tests\CreatesApplication;
use Illuminate\Container\Container;
use Illuminate\Foundation\Testing\TestCase;
use Mehrand\ApiResponse\Responses\FailureResponse;

abstract class BaseTestCase extends TestCase
{
    use CreatesApplication;

    /**
     * @var Request|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $request;

    /**
     * @var Handler
     */
    protected $handler;

    /**
     * @var \ReflectionMethod
     */
    protected $method;

    /**
     * @var ReflectionClass
     */
    protected $class;

    /**
     * @var string $excepted
     */
    protected $expected;

    /**
     * @var \Faker\Generator
     */
    protected $faker;

    public function setUp(): void
    {
        parent::setUp();
        $this->request = $this->createMock(Request::class);
        $this->handler = new Handler($this->createMock(Container::class));
        $this->class = new ReflectionClass(Handler::class);
        $this->method = $this->class->getMethod('render');
        $this->method->setAccessible(true);
        $this->expected = FailureResponse::class;

        $this->faker = Factory::create();
    }
}
