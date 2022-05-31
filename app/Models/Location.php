<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
      'name', 'address', 'city', 'zip', 'state', 'country', 'phone', 'email'
    ];

    public function fullAddress()
    {
      return $this->address . ', ' . $this->zip . ', ' . $this->city . ', ' . $this->country;
    }
}
