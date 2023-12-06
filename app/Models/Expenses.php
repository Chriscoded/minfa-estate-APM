<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartment_no',
        'amount',
        'description',

    ];

    public function apartment()
    {
        return $this->hasOne(Apartment::class, 'id', 'apartment_no');
    }
}
