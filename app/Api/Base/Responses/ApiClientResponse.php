<?php

namespace App\Api\Base\Responses;

use App\Api\Base\Responses\Messages\ErrorsMessage;
use App\Api\Base\Responses\Messages\SuccessMessage;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

trait ApiClientResponse
{
    /**
     * @param $data
     * @param string|null $message
     * @return JsonResponse
     */
    public function success($data, ?string $message = null): JsonResponse
    {
        return $this->responseJson(new SuccessMessage($data, $message), Response::HTTP_OK);
    }

    /**
     * @param array $errors
     * @return JsonResponse
     */
    public function errors(array $errors): JsonResponse
    {
        return $this->responseJson(new ErrorsMessage($errors), Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param array $errors
     * @return JsonResponse
     */
    public function permissionErrors(array $errors): JsonResponse
    {
        return $this->responseJson(new ErrorsMessage($errors), Response::HTTP_FORBIDDEN);
    }

    /**
     * @param array $errors
     * @return JsonResponse
     */
    public function notFound(array $errors): JsonResponse
    {
        return $this->responseJson(new ErrorsMessage($errors), Response::HTTP_NOT_FOUND);
    }

    /**
     * Repond a no content response.
     * 
     * @return response
     */
    public function createdResponse(array $createdData): JsonResponse
    {
        return $this->responseJson($createdData, Response::HTTP_CREATED);
    }

    /**
     * @param array $errors
     * @return JsonResponse
     */
    public function validationErrors(array $errors)
    {
        return $this->responseJson(new ErrorsMessage($errors), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @return Response
     */
    public function destroyResponse()
    {
        return response()->noContent();
    }

    public function responseJson($data, $status = 200): JsonResponse
    {
        return response()->json($data, $status);
    }

    public function serverError(): JsonResponse
    {
        return $this->responseJson([
            'message' => 'Internal server error'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
