<?php

namespace App\Exceptions;

use Symfony\Component\Debug\Exception\FlattenException;
use Illuminate\Http\JsonResponse;

class CustomHandler extends Handler
{
    public function report(\Exception $exception)
    {
        parent::report($exception);
    }

    private function title($class)
    {
        $parts = explode('\\', $class);
        return array_pop($parts);
    }

    /*
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function renderJSON($request, \Exception $rawException): JsonResponse
    {
        $e = FlattenException::create($rawException);
        switch ($this->title($e->getClass())) {
            case "ModelNotFoundException":
                $e->setStatusCode(404);
                $e->setMessage("404 Not found");
                break;
        }
        if (env('APP_DEBUG')) {
            $errors = [
                'message' => (!empty($e->getMessage())) ? $e->getMessage() : $this->title($e->getClass()),
                'exception' => $e->getClass(),
                'status' => $e->getStatusCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => collect($e->getTrace())->map(function ($trace) {
                    unset($trace['args']);
                    return $trace;
                })->all(),
            ];
            if ($this->title($e->getClass()) == 'BackOfficeHttpException') {
                $errors['response'] = $rawException->getResponse();
                $errors['HEADER'] = $rawException->getHeaders();
            }
        } else {
            $errors = [
                'message' => (!empty($e->getMessage())) ? $e->getMessage() : $this->title($e->getClass()),
                'status' => $e->getStatusCode(),
            ];
            if ($this->title($e->getClass()) == 'BackOfficeHttpException') {
                $errors['response'] = $rawException->getResponse();
                $errors['HEADER'] = $rawException->getHeaders();
            }

        }
        $errors_log = [
            'message' => (!empty($e->getMessage())) ? $e->getMessage() : $this->title($e->getClass()),
            'status' => $e->getStatusCode(),
        ];
        if ($this->title($e->getClass()) == 'BackOfficeHttpException') {
            $errors_log['response'] = $rawException->getResponse();
            $errors_log['HEADER'] = $rawException->getHeaders();
        }
        return new JsonResponse($errors, $e->getStatusCode());
    }

    public function render($request, \Exception $exception)
    {
        if ($request->header("accept") == "application/json")
            return $this->renderJSON($request, $exception);
        else
            return parent::render($request, $exception);
    }
}