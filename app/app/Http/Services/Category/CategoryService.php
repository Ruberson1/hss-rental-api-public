<?php

namespace App\Http\Services\Category;

use App\Http\Interfaces\Repositories\Car\ICarRepository;
use App\Http\Interfaces\Repositories\Category\ICategoryRepository;
use App\Http\Interfaces\Services\Category\ICategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryService implements ICategoryService
{
    public function __construct(
        private readonly ICategoryRepository $categoryRepository
    )
    {
    }
    public function getAll(Request $request): JsonResponse
    {
        return $this->categoryRepository->getAll($request);
    }

    public function getById(Request $request): JsonResponse
    {
        return $this->categoryRepository->getById($request);
    }
}
