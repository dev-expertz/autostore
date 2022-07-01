<?php

declare(strict_types=1);

namespace WebApi\Responses;

use App\Enums\Http\StatusCode;
use App\Http\Responses\ErrorItemDTO;
use App\Http\Responses\ErrorResponseDTO;
use Illuminate\Support\Facades\App;

final class WebApiError
{
    const UNHANDLED_ERROR = 'unhandled_error';
    const NOT_SUPPORTED_PATH_URL = 'not_supported_path_url';
    const REQUEST_JSON_BODY_ISSUE = 'not_json_body';
    const REQUEST_VALIDATION_ISSUE = 'request_validation_error';
    const ARTISAN_COMMAND_ISSUE = 'command_issue';
    const OPERATION_PERMITTED_ONLY_ON_LOCAL_ENV = 'operation_permitted_only_on_local_env';

    public static function create(string $errorConst): ?ErrorResponseDTO
    {
        if ($errorConst == self::UNHANDLED_ERROR) {
            return new ErrorResponseDTO(new ErrorItemDTO($errorConst, 'Unhandled error', null, StatusCode::ERROR_BAD_REQUEST_400));
        } elseif ($errorConst == self::NOT_SUPPORTED_PATH_URL) {
            return new ErrorResponseDTO(new ErrorItemDTO($errorConst, 'Not supported endpoint', null, StatusCode::ERROR_BAD_REQUEST_400));
        } elseif ($errorConst == self::REQUEST_JSON_BODY_ISSUE) {
            return new ErrorResponseDTO(new ErrorItemDTO($errorConst, 'Body request is not json formatted', null, StatusCode::ERROR_UNPROCESSABLE_422));
        } elseif ($errorConst == self::ARTISAN_COMMAND_ISSUE) {
            return new ErrorResponseDTO(new ErrorItemDTO($errorConst, 'Invalid request for command endpoint', null, StatusCode::ERROR_UNPROCESSABLE_422));
        } elseif ($errorConst == self::OPERATION_PERMITTED_ONLY_ON_LOCAL_ENV) {
            return new ErrorResponseDTO(new ErrorItemDTO($errorConst, 'Command or endpoint call your are requesting, can be run only on local env. Your env is: '.App::environment(), null, StatusCode::ERROR_UNPROCESSABLE_422));
        }

        return null;
    }

    public static function createValidationError(string $errorMessage): ErrorResponseDTO
    {
        return new ErrorResponseDTO(new ErrorItemDTO(self::REQUEST_VALIDATION_ISSUE, $errorMessage, null, StatusCode::ERROR_UNPROCESSABLE_422));
    }

    public static function createUnhandledFromException(\Throwable $exception): ?ErrorResponseDTO
    {
        $folderDepth = 3;
        $errorData = [];
        if (! empty($exception->getFile())) {
            $file_split = explode('/', $exception->getFile());
            $errorData[] = '.../'.implode('/', array_slice($file_split, -$folderDepth, $folderDepth));
        }

        $errorData[] = $exception->getLine() ? 'line: '.$exception->getLine() : null;
        $errorData[] = $exception->getMessage() ? $exception->getMessage() : 'Unhandled exception error.';

        $errorDetails = implode(', ', $errorData);

        return new ErrorResponseDTO(new ErrorItemDTO(self::UNHANDLED_ERROR, 'Unhandled error', $errorDetails, StatusCode::SERVER_ERROR_INTERNAL_SERVER_ERROR_500));
    }
}
