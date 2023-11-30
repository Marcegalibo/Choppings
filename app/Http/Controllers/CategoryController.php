<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function home() {
        $categories = Category::all();
        foreach ($categories as $category) {
            $category->get();
            //dd($categories->toArray());
        }
        return view('categories.home', compact('categories'));
    }
    public function index()
    {
        $category = Category::with('products')->get();
        $categories = Category::with(['products' => function($product){
            return $product->take(5);

        }])->get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $category = new Category($request->all());
        $category->save();
        return response()->json([], 200);
    }
    public function getAll()
	{
		$categories = Category::query();
		return DataTables::of($categories)->toJson();
	}

    public function show(Category $category)
    {
        return response()->json(['category' => $category], 200);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Category $category)
    {
        $category->delete();
		return response()->json([], 204);
    }
}

