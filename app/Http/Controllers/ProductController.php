<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $images = $request->file('images');

        if ($images !== null) {
            $data = Product::create($validatedData);

            $imageUrls = [];

            foreach ($images as $image) {
                $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $imagePath = 'images/' . $imageName;

                $productImage = new ProductImage(['image_path' => $imagePath]);
                $data->images()->save($productImage);

                $imageUrls[] = $imagePath;
            }

            return response()->json([
                'status_code' => 201,
                'message' => 'Product Created Successfully!',
                'data' => $data,
                'imageUrls' => $imageUrls
            ], 201);
        } else {
            return response()->json([
                'status_code' => 400,
                'message' => 'No images were uploaded.',
            ], 400);
        }
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        $images = $product->images;

        return response()->json([
            'status_code' => 200,
            'message' => 'OK',
            'data' => [
                'product' => $product,
                'images' => $images,
            ],
        ], 200);
    }


    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validated();

        $product->update($validatedData);

        if ($request->hasFile('images')) {
            $newImages = $request->file('images');

            foreach ($product->images as $existingImage) {
                $imagePath = public_path($existingImage->image_path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $existingImage->delete();
            }
            foreach ($newImages as $newImage) {
                $imagePath = $newImage->storeAs('public/images', $newImage->getClientOriginalName());
                $product->images()->create(['image_path' => $imagePath]);
            }
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Product and associated images updated successfully!',
            'data' => $product
        ], 200);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        $images = $product->images;

        $product->delete();

        foreach ($images as $image) {
            $imagePath = public_path($image->image_path);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $image->delete();
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'Product and associated images deleted successfully!',
            'data' => $product
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
