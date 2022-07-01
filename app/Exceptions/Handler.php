<?php

namespace App\Exceptions;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Throwable;
use WebApi\Responses\WebApiError;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request  $request
     * @param Throwable $exception
     * @return Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if (App::environment('local')) {
        }
        if ($exception instanceof NotFoundHttpException
            || $exception instanceof SuspiciousOperationException
            || $exception instanceof MethodNotAllowedException) {
            return Controller::handleResponse(
                WebApiError::create(WebApiError::NOT_SUPPORTED_PATH_URL)
            );
        }

        return Controller::handleResponse(
            WebApiError::createUnhandledFromException($exception)
        );
    }
}
