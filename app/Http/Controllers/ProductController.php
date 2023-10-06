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
        $page = $request->query('page');
        $perPage = $request->query('perPage');
        $sortBy = $request->query('sortBy', 'id');
        $sortDirection = $request->query('sortDirection', 'asc');
        $sortCategory = $request->query('sortCategory');
        $search = $request->query('search', '');

        $productList = Product::getProductsData($perPage, $page, $sortBy, $sortDirection, $sortCategory, $search);

        $meta = [
            'pagination' => [
                'total' => $productList->total(),
                'count' => $productList->count(),
                'per_page' => $productList->perPage(),
                'current_page' => $productList->currentPage(),
                'total_pages' => $productList->lastPage(),
                'links' => [
                    'next' => $productList->nextPageUrl(),
                ],
            ],
        ];

        return response()->json([
            'status_code' => 200,
            'message' => 'OK',
            'data' => $productList->items(),
            'meta' => $meta,
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

    public function getCategory()
    {
        $categories = Product::distinct()->pluck('category')->toArray();
        $categoryObjects = [];

        foreach ($categories as $index => $category) {
            $categoryObjects[] = [
                'id' => $index + 1,
                'name' => $category,
            ];
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'OK',
            'data' => $categoryObjects,
        ], 200);
    }
}
