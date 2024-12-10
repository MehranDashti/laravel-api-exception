<?php

namespace Mehrand\ApiExceptions\Tests\Unit;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\QueryException;
use Mehrand\ApiExceptions\Tests\BaseTestCase;
use Mehrand\ApiExceptions\Exceptions\CustomQueryException;

class CustomQueryExceptionTest extends BaseTestCase
{
    private $instance;

    public function setUp(): void
    {
        parent::setUp();
        $this->instance = (new CustomQueryException(
            new QueryException('SQL ERROR', ['name' => $this->faker->name], new Exception('asd', 500))
        ))->render();
    }

    public function test_custom_query_exception_is_instance_of_ApiException(): void
    {
        self::assertInstanceOf(JsonResponse::class, $this->instance);
    }


    public function test_can_get_correct_code_from_query_exception(): void
    {
        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $this->instance->getData()->code);
    }

    public function test_can_get_correct_message_from_query_exception_when_debug_mode_is_enabled(): void
    {
        config(['app.debug' => true]);
        $instance = (new CustomQueryException(
            new QueryException('SQL ERROR', ['name' => $this->faker->name], new Exception('', 500))
        ))->render();

        self::assertTrue(Str::contains($instance->getData()->message, 'SQL ERROR'));
    }

    public function test_can_get_correct_message_from_query_exception_when_debug_mode_is_disabled(): void
    {
        config(['app.debug' => false]);
        $instance = (new CustomQueryException(
            new QueryException('SQL ERROR', ['name' => $this->faker->name], new Exception('asd', 500))
        ))->render();

        self::assertEquals(trans('errors.default'), $instance->getData()->message);
    }

    public function test_can_override_message_from_query_exception()
    {
        config(['app.debug' => true]);
        $fakeText = $this->faker->sentence;
        $exception = (new CustomQueryException((new Exception($fakeText))))->render();

        self::assertEquals($fakeText, $exception->getData()->message);
    }
}
