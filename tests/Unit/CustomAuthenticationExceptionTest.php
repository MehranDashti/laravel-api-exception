<?php

namespace Mehrand\ApiExceptions\Tests\Unit;

use Mockery\Exception;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Mehrand\ApiExceptions\Tests\BaseTestCase;
use Mehrand\ApiExceptions\Exceptions\CustomAuthenticationException;

class CustomAuthenticationExceptionTest extends BaseTestCase
{

    private $instance;

    public function setUp(): void
    {
        parent::setUp();
        $this->instance = (new CustomAuthenticationException(new Exception))->render();
    }


    public function test_custom_authentication_is_instance_of_ApiException(): void
    {
        self::assertInstanceOf(JsonResponse::class, $this->instance);
    }


    public function test_can_get_correct_code_from_authentication_exception(): void
    {
        self::assertEquals(Response::HTTP_FORBIDDEN, $this->instance->getData()->code);
    }


    public function test_can_override_code_from_authentication_exception(): void
    {
        $exception = (new CustomAuthenticationException((new Exception('',Response::HTTP_NOT_FOUND))))->render();
        self::assertEquals(Response::HTTP_NOT_FOUND, $exception->getData()->code);
    }

    public function test_can_get_correct_message_from_authentication_exception(): void
    {
        self::assertEquals(trans('errors.unauthenticated') , $this->instance->getData()->message);
    }

    public function test_can_override_message_from_authentication_exception()
    {
        $fakeText = $this->faker->sentence;
        $exception = (new CustomAuthenticationException((new Exception($fakeText))))->render();
        self::assertEquals($fakeText, $exception->getData()->message);
    }
}
