<?php

namespace App\Models;

use App\Models\Product;
use App\Traits\HasUUID;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequestPriceCart extends Model
{
    use HasFactory, HasUUID;

    protected $fillable = [
        'user_id',
        'product_sku',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_sku', 'sku');
    }

    public function productVariation()
    {
        return $this->belongsTo(ProductVariation::class, 'product_sku', 'sku');
    }

    public function getProduct()
    {
        $product = $this->product()->first();
        if($product) {
            return $product;
        }
        $variant = $this->productVariation()->first();
        if($variant) {
            return $variant->product()->first();
        }
        return null;
    }

    public function getVariantValue()
    {
        $variant = $this->productVariation()->first();
        if($variant) {
            return $variant->value;
        }
        return null;
    }

    public function getProductImage()
    {
        $image = null;

        $variant = $this->productVariation()->first();
        $product = $this->product()->first();

        if ($product) {
            $featuredImage = $product->media()->where('featured_image', 1)->first();
            $backupImage = $product->media()->first();
            if ($featuredImage) {
                $image = $featuredImage->file_path;
            }
            if ($backupImage) {
                $image = $backupImage->file_path;
            }
        }

        if ($variant) {
            $image = $variant->file_path;
            if(!$variant->file_path) {
                $product = $variant->product()->first();
                $featuredImage = $product->media()->where('featured_image', 1)->first();
                if ($featuredImage) {
                    $image = $featuredImage->file_path;
                }
            }
        }


        if ($image && $image[0] !== '/') {
            $image = '/' . $image;
        }

        return $image ?? '/images/product-placeholder.png';
    }


    public static function cartNumber($authId)
    {
        return self::where('user_id', $authId)->count();
    }
}
