<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountRequest extends Model
{
    use HasFactory;

    public $timestamp = true;
    protected $fillable = [
      'name',
      'email',
      'phone',
      'ssn',
      'company',
      'company_ssn',
      'simi',
      'finished',
    ];
}
