<?php

namespace SafeThrow\Facades;

use Exception;
use Illuminate\Http\Request;
use SafeThrow\Exceptions\Defaults\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler {
    public static function whenSafeThrowException(HttpException $exception, Request $request): JsonResponse {
        return self::generateResponse($exception);
    }

    private static function generateResponse(HttpException $exception): JsonResponse {
        $status_code = $exception->getStatusCode();
        $error_response = ['message' => $exception->getMessage()];

        if ($exception->getErrors()) {
            $error_response['errors'] = $exception->getErrors();
        }

        // Adicionando informações do caminho até o erro caso o debug esteja ativado
        if (config('app.debug')) {
            $error_response = self::addTrackData($error_response, $exception);
        }

        return response()->json(
            data: $error_response,
            status: $status_code,
            headers: ['Access-Control-Allow-Origin' => '*']
        );
    }

    /**
     * Adiciona o caminho até a exceção
     */
    private static function addTrackData(array $data, Exception $exception): array {
        $data['exception'] = basename(str_replace('\\', '/', get_class($exception)));
        $data['file'] = $exception->getFile();
        $data['line'] = $exception->getLine();
        $data['trace'] = $exception->getTrace();

        return $data;
    }
}