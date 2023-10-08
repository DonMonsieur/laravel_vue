<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public static function getProductsData($perPage, $page, $sortBy = 'id', $sortDirection = 'asc', $sortCategory, $search)
    {
        $query = self::select([
            'id',
            'name',
            'category',
            'description',
        ])->orderBy($sortBy, $sortDirection);

        if ($sortCategory && $sortCategory !== "All categories") {
            $query->where('category', $sortCategory);
        }

        if ($search != '') {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%" . $search . "%")
                    ->orWhere('description', 'like', "%" . $search . "%");
            });
        }

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    public static function countProducts()
    {
        $query = self::select('id');

        return $query->count();
    }
}
