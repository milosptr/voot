<?php

namespace App\Models;

use App\Models\Asset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    CONST OIL = 75;
    CONST SMURSPREY = 77;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';
    protected $fillable = ['name', 'description', 'slug', 'parent_id', 'order', 'available', 'name_en'];

    public function image()
    {
      return $this->hasOne('App\Models\Asset', 'category_id')->orderBy('id', 'DESC');
    }

    public function products()
    {
      return $this->belongsToMany('App\Models\Product', 'product_categories', 'category_id', 'product_id');
    }

    public function parentCategory()
    {
      return Category::where('id', $this->parent_id)->first();
    }

    public function subcategory()
    {
      return Category::where('parent_id', $this->id)->get();
    }

    public static function formatWithSubcategories()
    {
      $category = Category::where('parent_id', 0)->where('available', 1)->orderBy('order', 'ASC')->get();
      foreach($category as $cat) {
        $cat->children = $cat->subcategory();
        $cat->total_products = count($cat->products);
        $cat->featured_image = $cat->image;
        foreach($cat->children as $subcat) {
          $subcat->children = $subcat->subcategory();
          $subcat->total_products = count($subcat->products);
          $subcat->featured_image = $subcat->image;
          foreach($subcat->children as $subsubcat) {
            $subsubcat->total_products = count($subsubcat->products);
            $subsubcat->featured_image = $subsubcat->image;
          }
        }
      }
      return $category;
    }

    public static function tree()
    {
      $allCategories = Category::orderBy('order', 'ASC')->where('available', 1)->get();
      $rootCategories = $allCategories->where('parent_id', 0);
      self::formatTree($rootCategories, $allCategories);

      return $rootCategories;
    }

    public static function formatTree($categories, $allCategories)
    {
      foreach($categories as $category) {
        $category->children = $allCategories->where('parent_id', $category->id)->values();
        if($category->children->isNotEmpty()) {
          self::formatTree($category->children, $allCategories);
        }
      }
    }

    public function getTranslatedNameAttribute()
    {
      $locale = app()->getLocale();
      if(isset($locale) && $locale === 'en')
        return $this->name_en;
      return $this->name;
    }
}
