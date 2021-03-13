<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $categoryService=null;

    //
    /**
     * CategoryController constructor.
     * @param null $calegoryService
     */
    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function getCategoriesTree(){
        $tree=$this->categoryService->getCategoryTree();

        return response()->json($tree);
    }
}
