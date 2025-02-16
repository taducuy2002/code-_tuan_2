<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Mail\ProductCreatedMail;
use Illuminate\Support\Facades\Mail;


class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
    
        try {
            $product = Product::create($data);
    
            // Gửi email vào queue
            Mail::to('admin@example.com')->queue(new ProductCreatedMail($product));
    
            return response()->json([
                'success' => true,
                'message' => 'Thêm dữ liệu thành công & email đã được đưa vào hàng đợi',
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Thêm dữ liệu thất bại',
                'error'   => $th->getMessage(),
            ]);
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

