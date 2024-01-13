<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'city',
        'primary_address',
        'secondary_address',
        'zip_code',
        'user_id'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
