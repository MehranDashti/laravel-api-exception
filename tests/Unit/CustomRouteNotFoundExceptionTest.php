<?php

namespace Mehrand\ApiExceptions\Tests\Unit;

use Throwable;
use Mockery\Exception;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Mehrand\ApiExceptions\Tests\BaseTestCase;
use Mehrand\ApiExceptions\Contracts\ApiExceptionAbstract;
use Mehrand\ApiExceptions\Exceptions\CustomRouteNotFoundException;

class CustomRouteNotFoundExceptionTest extends BaseTestCase
{
    private $instance;

    public function setUp(): void
    {
        parent::setUp();
        $this->instance = (new CustomRouteNotFoundException(new Exception))->render();
    }


    public function test_custom_not_found_is_instance_of_ApiException(): void
    {
        self::assertInstanceOf(JsonResponse::class, $this->instance);
    }


    public function test_can_get_correct_code_from_not_found_exception(): void
    {
        self::assertEquals(Response::HTTP_NOT_FOUND, $this->instance->getData()->code);
    }


    public function test_can_override_code_from_not_found_exception(): void
    {
        $exception = (new CustomRouteNotFoundException((new Exception('',Response::HTTP_INTERNAL_SERVER_ERROR))))->render();
        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $exception->getData()->code);
    }

    public function test_can_get_correct_message_from_not_found_exception(): void
    {
        self::assertEquals(trans('errors.route_not_found') , $this->instance->getData()->message);
    }

    public function test_can_override_message_from_not_found_exception()
    {
        $fakeText = $this->faker->sentence;
        $exception = (new CustomRouteNotFoundException((new Exception($fakeText))))->render();
        self::assertEquals($fakeText, $exception->getData()->message);
    }
}