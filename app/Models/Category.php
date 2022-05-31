<?php

namespace App\Models;

use App\Models\Asset;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    CONST SMURSPREY = 77;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';
    protected $fillable = ['name', 'description', 'slug', 'parent_id', 'order', 'available'];

    public function image()
    {
      return $this->hasOne('App\Models\Asset', 'category_id')->orderBy('id', 'DESC');
    }

    public function products()
    {
      return $this->belongsToMany('App\Models\Product', 'product_categories', 'category_id', 'product_id');
    }

    public function subcategory()
    {
      return Category::where('parent_id', $this->id)->get();
    }

    public static function tree()
    {
      $allCategories = Category::get();
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
}
