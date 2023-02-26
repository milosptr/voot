<?php
namespace App\Traits;

trait DeliveryMethodsTrait {
  public static function get() {
    return [
      [ 'id' => 'VM', 'name'=> 'Flytjandi' ],
      [ 'id' => 'HOP', 'name'=> 'Hópsnes (Suðurnes)' ],
      [ 'id' => 'SS', 'name'=> 'Sent með sölumanni' ],
      [ 'id' => 'PO', 'name'=> 'Póstur' ],
    ];
  }
}
