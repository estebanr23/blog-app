<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function invalidJson($request, ValidationException $exception) {
        return response()->json([
            'message' => 'Los datos proporcionados no son validos',
            'errors' => $exception->errors(),
        ], $exception->status);
    }

    public function render($request, Throwable $exception) {
        if($exception instanceof ModelNotFoundException) {
            return response()->json([
                'resp' => false,
                'error' => 'Error, modelo no encontrado'
            ], 400);
        }

        if($exception instanceof NotFoundHttpException) {
            return response()->json([
                'resp' => false,
                'error' => 'Error, la ruta no existe'
            ], 404);
        }

        if($exception instanceof AuthenticationException) {
            return response()->json([
                'res' => false,
                'error' => 'No tiene los permisos para acceder a esta ruta'
            ], 400);
        }

        return parent::render($request, $exception);
    }
}
