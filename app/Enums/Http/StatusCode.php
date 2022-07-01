<?php

namespace App\Enums\Http;

final class StatusCode
{
    public const SUCCESS_OK_200  = 200;
    public const SUCCESS_CREATED_201 = 201;
    public const SUCCESS_NO_CONTENT_204 = 204;
    public const SUCCESS_MULTI_STATUS_207 = 207;
    public const REDIRECTION_MULTIPLE_CHOICES_300 = 300;
    public const ERROR_BAD_REQUEST_400 = 400;
    public const ERROR_UNAUTHORIZED_401 = 401;
    public const ERROR_PAYMENT_REQUIRED_402 = 402;
    public const ERROR_FORBIDDEN_403 = 403;
    public const ERROR_NOT_FOUND_404 = 404;
    public const ERROR_INACTIVE_RECIPIENT = 406;
    public const ERROR_CONFLICT_409 = 409;
    public const ERROR_UNPROCESSABLE_422 = 422;
    public const ERROR_TOO_MANY_REQUESTS_429 = 429;
    public const SERVER_ERROR_INTERNAL_SERVER_ERROR_500 = 500;
    public const SERVER_ERROR_NOT_IMPLEMENTED_501 = 501;
    public const SERVER_ERROR_BAD_GATEWAY_502 = 502;
    public const SERVER_ERROR_SERVICE_UNAVAILABLE_503 = 503;
    public const SERVER_ERROR_GATEWAY_TIMEOUT_504 = 504;
    public const SERVER_ERROR_NETWORK_READ_TIMEOUT_ERROR_598 = 598;
}

/**
 * Based on https://en.wikipedia.org/wiki/List_of_HTTP_status_codes.
 */
