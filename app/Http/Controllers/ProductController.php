<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\ProductUpdateRequest;

class ProductController extends Controller
{
    public function home()
    {
        $products = Product::get();
        return view('index', compact('products'));
    }

    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        //
    }

    public function store(ProductRequest $request)
    {
        try {
			DB::beginTransaction();
			$product = new Product($request->all());
			$product->save();
			$this->uploadFile($product, $request);
			DB::commit();
			return response()->json([], 200);
		} catch (\Throwable $th) {
			DB::rollback();
			throw $th;
		}
    }

    public function show(Product $product)
    {
        return response()->json(['product' => $product], 200);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
		try {
			DB::beginTransaction();
            $product->update($request->all());
			$this->uploadFile($product, $request);
			DB::commit();
			return response()->json([], 204);
		} catch (\Throwable $th) {
			DB::rollback();
			throw $th;
		}
    }

    public function destroy(Product $product)
    {
        $product->delete();
		$this->deleteFile($product);
        return response()->json([], 204);
    }
}

