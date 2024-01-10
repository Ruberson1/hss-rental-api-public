<?php

namespace App\Http\Interfaces\Services\Category;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface ICategoryService
{
    public function getAll(Request $request): JsonResponse;

    public function getById(Request $request): JsonResponse;
}
