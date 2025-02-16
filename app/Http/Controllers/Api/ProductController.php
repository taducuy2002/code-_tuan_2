<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Dotenv\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    public function store(Request $request)
    {
        try {
            Product::query()->create($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Thêm dữ liệu thành công',
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Thêm dữ liệu thất bại',
                'error'   => $th->getMessage(),
            ], 500);
        }
    }
    

    

    public function show($id)
    {
        $product = Product::find($id);
        return $product ? response()->json($product) : response()->json(['message' => 'Not Found'], 404);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $product->update($request->all());
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}

