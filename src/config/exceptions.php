<?php

/**
 * @codeCoverageIgnore
 */

use Illuminate\Database\QueryException;
use \Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use Mehrand\ApiExceptions\Exceptions\CustomQueryException;
use Mehrand\ApiExceptions\Exceptions\CustomMethodNotAllowed;
use \Mehrand\ApiExceptions\Exceptions\CustomDefaultException;
use \Mehrand\ApiExceptions\Exceptions\CustomValidationException;
use \Mehrand\ApiExceptions\Exceptions\CustomNotFoundHttpException;
use \Mehrand\ApiExceptions\Exceptions\CustomUnauthorizedException;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use \Mehrand\ApiExceptions\Exceptions\CustomModelNotFoundException;
use \Mehrand\ApiExceptions\Exceptions\CustomAuthenticationException;
use \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

return [
    'list' => [
        QueryException::class                   => CustomQueryException::class,
        RuntimeException::class                 => CustomDefaultException::class,
        Exception::class                        => CustomDefaultException::class,
        ValidationException::class              => CustomValidationException::class,
        NotFoundHttpException::class            => CustomNotFoundHttpException::class,
        ModelNotFoundException::class           => CustomModelNotFoundException::class,
        AuthenticationException::class          => CustomAuthenticationException::class,
        UnauthorizedHttpException::class        => CustomUnauthorizedException::class,
        MethodNotAllowedHttpException::class    => CustomMethodNotAllowed::class
    ],
];
