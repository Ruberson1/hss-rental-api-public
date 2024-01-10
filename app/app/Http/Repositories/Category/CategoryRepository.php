<?php

namespace App\Http\Repositories\Category;

use App\Http\Interfaces\Repositories\Category\ICategoryRepository;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryRepository implements ICategoryRepository
{

    public function getAll(Request $request): JsonResponse
    {
        $cars = Category::all();

        return response()->json($cars);
    }

    public function getById(Request $request): JsonResponse
    {
        $categoryId = $request->id;
        try {
            $category = Category::findOrFail($categoryId);
            return response()->json($category);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Categoria não encontrada'], 404);
        }
    }
}
