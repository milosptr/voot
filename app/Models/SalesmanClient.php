<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesmanClient extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = ['salesman_id', 'client_id'];


    public function salesman()
    {
        return $this->belongsTo(User::class, 'id', 'salesman_id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'id', 'client_id');
    }
}
