<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $query = Product::query();

        if ($request->has('category')) {
            $query->where('category', $request->input('category'));
        }

        $data = $query->paginate($perPage);

        $totalItems = $data->total();

        return response()->json([
            'status_code' => 200,
            'message' => 'OK',
            'data' => $data,
            'total_items' => $totalItems,
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

    public function search($name, $description)
    {
        $query = Product::query();

        if (!empty($name)) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if (!empty($description)) {
            $query->where('description', 'like', '%' . $description . '%');
        }

        $data = $query->get();

        return response()->json([
            'status_code' => 200,
            'message' => 'Search Results',
            'data' => $data
        ], 200);
    }
}
