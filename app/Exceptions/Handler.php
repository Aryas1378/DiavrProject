<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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

    public function render($request, Throwable $e)
    {
        if ($e instanceof ValidationException) {
            return response()->json([
                'data' => $e->errors()
            ]);
        }

        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'data' => "route not found",
            ], 404);
        }


        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'data' => "id " . json_encode($e->getIds()) . " of " . $e->getModel() . " model not found",
            ], 404);
        }

        return response()->json([
            'message' => $e->getMessage(),
        ], 400);
    }

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
}
