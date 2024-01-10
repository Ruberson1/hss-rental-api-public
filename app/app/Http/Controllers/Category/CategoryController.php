<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Services\Auth\IRegisterUserService;
use App\Http\Interfaces\Services\Car\ICarService;
use App\Http\Interfaces\Services\Category\ICategoryService;
use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{

    public function __construct(
        private readonly ICategoryService $categoryService
    ){$this->middleware('auth:api');}


    public function getAll(Request $request): JsonResponse
    {
        return $this->categoryService->getAll($request);
    }

    public function getById(Request $request): JsonResponse
    {
        return $this->categoryService->getById($request);
    }

}
