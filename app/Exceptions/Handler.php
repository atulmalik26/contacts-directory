<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
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

    public function render($request, Throwable $exception)
    {
        $data = [
            'message' => method_exists($exception, 'getMessage') ? $exception->getMessage() : 'Server Error',
        ];

        $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;

        // Append app version
        $appVersion = App::version();
        $data['app_version'] = $appVersion;

        // Add stack trace information for local environment
        if (App::environment('local')) {
            $data['stack_trace'] = $exception->getTraceAsString();
        }

        return response()->json($data, $statusCode);
    }
}
