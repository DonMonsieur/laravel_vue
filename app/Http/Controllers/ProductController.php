<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $data = Product::all();

        return response()->json([
            'status_code' => 200,
            'message' => 'OK',
            'data' => $data
        ], 200);
    }

    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();

        $data = Product::create($validatedData);

        return response()->json([
            'status_code' => 201,
            'message' => 'Product Created Successfully!',
            'data' => $data
        ], 201);
    }

    public function show($id)
    {
        $data = Product::findOrFail($id);

        return response()->json([
            'status_code' => 200,
            'message' => 'OK',
            'data' => $data
        ], 200);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $data = Product::findOrFail($id);

        $validatedData = $request->validated();

        $data->update($validatedData);

        return response()->json([
            'status_code' => 200,
            'message' => 'Product Updated Successfully!',
            'data' => $data
        ], 200);
    }

    public function delete($id)
    {
        $data = Product::findOrFail($id);

        $data->delete();

        return response()->json([
            'status_code' => 200,
            'message' => 'Product Deleted!',
            'data' => $data
        ], 200);
    }
}
