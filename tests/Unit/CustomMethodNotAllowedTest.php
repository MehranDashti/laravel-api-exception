<?php

namespace Mehrand\ApiExceptions\Tests\Unit;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Mehrand\ApiExceptions\Tests\BaseTestCase;
use Mehrand\ApiExceptions\Exceptions\CustomMethodNotAllowed;

class CustomMethodNotAllowedTest extends BaseTestCase
{
    private $instance;

    public function setUp(): void
    {
        parent::setUp();
        $this->instance = (new CustomMethodNotAllowed(new Exception))->render();
    }


    public function test_custom_method_not_allowed_is_instance_of_ApiException(): void
    {
        self::assertInstanceOf(JsonResponse::class, $this->instance);
    }


    public function test_can_get_correct_code_from_method_not_allowed_exception(): void
    {
        self::assertEquals(Response::HTTP_METHOD_NOT_ALLOWED, $this->instance->getData()->code);
    }


    public function test_can_override_code_from_method_not_allowed_exception(): void
    {
        $exception = (new CustomMethodNotAllowed((new Exception('',Response::HTTP_INTERNAL_SERVER_ERROR))))->render();
        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $exception->getData()->code);
    }

    public function test_can_get_correct_message_from_method_not_allowed_exception(): void
    {
        self::assertEquals(trans('errors.method_not_allowed') , $this->instance->getData()->message);
    }

    public function test_can_override_message_from_method_not_allowed_exception()
    {
        $fakeText = $this->faker->sentence;
        $exception = (new CustomMethodNotAllowed((new Exception($fakeText))))->render();
        self::assertEquals($fakeText, $exception->getData()->message);
    }
}
