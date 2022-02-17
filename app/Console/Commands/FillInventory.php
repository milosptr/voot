<?php

namespace App\Console\Commands;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Console\Command;

class FillInventory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fill:inventory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill inventory table only once when booting the app';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $products = Product::all();
      foreach($products as $product) {
        $variations = array();
        if(count($product->variations)) {
          foreach ($product->variations as $key => $item) {
            $variations[$item['sku']][$key] = $item['name'];
          }
          foreach ($variations as $key => $item) {
            $inventory = Inventory::find($key);
            $data = [ 'product_id' => $product->id, 'sku' => $key, 'name' => $product->name . ' - ' . $item.join(' / ')];
            if(!$inventory) Inventory::create($data);
            else $inventory->update($data);
          }
        } else {
          $inventory = Inventory::find($product->sku);
        }
        dd($variations);
      }
        return 0;
    }
}
