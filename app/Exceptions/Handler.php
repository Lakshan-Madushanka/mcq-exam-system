<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;

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


        $this->renderable(function (
            NotFoundHttpException $exception,
            Request $request
        ) {

            if ($request->wantsJson()) {
                $message = $exception->getMessage();
                if (!empty($message)) {
                    return $this->showError(message: 'Record not found !');
                }
            }
        });

        $this->renderable(function (
            QueryException $exception,
            Request $request
        ) {
            if ($request->wantsJson()) {
                if ($exception->errorInfo[1] == 1451) {
                    return $this->showError(message: 'The Record  has associated with other records !');
                }
            }
        });
    }
}
