<?php

namespace App\Api\V1\Category;

use App\Api\Base\Controller\ApiController;
use App\Api\Base\Request\GlobalSearchRequest;
use App\Api\Base\Responses\PaginationResponse;
use App\Api\V1\Category\Resource\CategoryAdminResource;
use App\Api\V1\Category\DTO\CategoryPaginationFilterDTO;
use App\Api\V1\Category\DTO\CategoryDTO;
use App\Api\V1\Category\Requests\CategoryStoreRequest;
use App\Api\V1\Category\Requests\CategoryUpdateRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class ApiCategoryController extends ApiController
{
    use PaginationResponse;
    /**
     * Display a listing of the resource.
     *
     * @group Admin endpoints
     * 
     * @response status=200 scenario="Success"{
     *    "data": {
     *       "email": "example@gmail.com",
     *       "name": "example",
     *       "surname": "example"
     *    } 
     * }
     * @response status=401 scenario="Unauthorized"{
     *    "message": "Unauthenticated." 
     * }
     * @authenticated
     */
    public function index(GlobalSearchRequest $request, CategoryService $categorySevice): JsonResponse
    {
        return $this->success(
            $this->paginationData(
                $categorySevice->paginate(
                    new CategoryPaginationFilterDTO(
                        $request->search
                    )
                ),
                CategoryAdminResource::class
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @group Admin endpoints
     * 
     * @bodyParam name Name of category. Example: Watches
     * @bodyParam parent_id Numeric value of parent if exists. Example: 1
     * 
     * @response status=200 scenario="Success"{
     *    "data": {
     *       "id": 10,
     *       "name": "Watches",
     *       "admin_id": 2,
     *       "parent_id": 3,
     *       "slug": "watches-1",
     *       "created_at": "2022-07-06T18:04:55.000000Z",
     *       "updated_at": "2022-07-06T18:04:55.000000Z"
     *    } 
     * }
     * @response status=401 scenario="Unauthorized"{
     *    "message": "Unauthenticated." 
     * }
     * @response status=403 scenario="Forbidden"{
     *    "message": "Invalid scope(s) provided." 
     * }
     * @response status=500 scenario="Internal Error"{
     *    "message": "Internal server error." 
     * }
     * @authenticated
     */
    public function store(CategoryStoreRequest $categoryStoreRequest, CategoryService $categoryService)
    {
        try {
            return $this->createdResponse(
                $categoryService->store(
                    new CategoryDTO(
                        $categoryStoreRequest->name,
                        $categoryStoreRequest->user(),
                        $categoryStoreRequest->parent_id
                    )
                )
            );
        } catch(Exception $e) {
            return $this->serverError();
        }
    }

    /**
     * Display the specified resource.
     *
     * @group Admin endpoints
     * 
     * @response status=200 scenario="Success"{
     *    "data": {
     *       "email": "example@gmail.com",
     *       "name": "example",
     *       "surname": "example"
     *    } 
     * }
     * @response status=401 scenario="Unauthorized"{
     *    "message": "Unauthenticated." 
     * }
     * @authenticated
     */
    public function show($id)
    {
        return 1;
    }

    /**
     * Update the specified resource in storage.
     *
     * @group Admin endpoints
     * 
     * @response status=200 scenario="Success"{
     *    "data": {
     *       "email": "example@gmail.com",
     *       "name": "example",
     *       "surname": "example"
     *    } 
     * }
     * @response status=401 scenario="Unauthorized"{
     *    "message": "Unauthenticated." 
     * }
     * @authenticated
     */
    public function update(
        CategoryUpdateRequest $categoryUpdateRequest,
        int $id,
        CategoryService $categoryService
    ) {
        try {
            return $categoryService->update(
                new CategoryDTO(
                    $categoryUpdateRequest->name,
                    $categoryUpdateRequest->user(),
                    $categoryUpdateRequest->parent_id,
                    $id
                )
            );
        } catch(NotFoundResourceException $e) {
            return $this->notFound(
                $categoryService->getNotFoundError()
            );
        } catch (AccessDeniedException $e) {
            return $this->permissionErrors(
                $categoryService->getAccessDeniedErrors()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
