<?php

namespace App\Models;

use App\Models\ProductIcon;
use App\Models\SettingsIcon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    protected $fillable = ['name', 'slug', 'description', 'sku', 'barcode', 'price', 'quantity', 'available', 'product_table', 'english_name', 'english_description'];
    protected $table = 'products';

    public $cast = [
      'product_table' => 'json',
    ];

    public function categories()
    {
      return $this->belongsToMany('App\Models\Category', 'product_categories', 'product_id', 'category_id');
    }

    public function primaryCategories()
    {
      return $this->belongsToMany('App\Models\Category', 'product_categories', 'product_id', 'category_id')->take(1);
    }

    public function tags()
    {
      return $this->belongsToMany('App\Models\Tag', 'product_tags', 'product_id', 'tag_id');
    }

    public function information()
    {
      return $this->hasMany('App\Models\ProductInformation');
    }

    public function documents()
    {
      return $this->hasMany('App\Models\Document');
    }

    public function variations()
    {
      return $this->hasMany('App\Models\ProductVariation');
    }

    public function icons()
    {
      return $this->belongsToMany(SettingsIcon::class, 'product_icons', 'product_id', 'settings_icons_id')->withPivot('id');
    }

    public function media() {
      return $this->belongsToMany('App\Models\Asset', 'product_assets', 'product_id', 'asset_id')->withPivot('id');
    }


    public function getTranslatedNameAttribute()
    {
      $locale = app()->getLocale();
      if(isset($locale) && $locale === 'en')
        return $this->english_name;
      return $this->name;
    }

    public function getFeaturedImageAttribute()
    {
      return $this->media()->where('featured_image', 1)->orderBy('id', 'DESC')->get()->last();
    }

    public function getRelatedProducts()
    {
      return $this->relatedProducts();
    }

    public function getProductUrlAttribute()
    {
      $category = $this->primaryCategories->first();
      if(isset($category) && isset($this->slug))
        return '/' . $category->slug . '/' . $this->slug;
      return '#';
    }

    public function getSubcategoryAttribute()
    {
      return $this->categories()->get()->last();
    }

    public function getfilteredVariationsAttribute()
    {
      $variations = [];
      foreach($this->variations()->get()->toArray() as $v) {
        if (ProductVariation::getVariantColor($v)) {
            $v['color'] = ProductVariation::getVariantColor($v);
            $values = explode('/', strtolower($v['value']));
            $value = array_filter($values, function($i) use($v) { return $i !== $v['color']['original']; });
            $v['value'] =  join('/', $value);
        }
        array_push($variations, $v);
      }

      return $variations;
    }

    public function scopeRelatedProducts(Builder $query, $count = 4, $inRandomOrder = true)
    {
      $query = $query->withAnyTags($this->tags()->pluck('name'))->where('id', '<>', $this->id);
      if($inRandomOrder)
        $query->inRandomOrder();


        if(empty($query->first())) {
          $query = $this->categories->last()->products->where('id', '<>', $this->id);
        }

        return $query->take($count);
    }

    public function scopeWithAnyTags(Builder $query, $tags)
    {
      $tagsId = Tag::whereIn('name', $tags)->pluck('id');

      return $query->whereHas('tags', function(Builder $q) use($tagsId) {
        $q->whereIn('tags.id', $tagsId);
      });
    }
}
