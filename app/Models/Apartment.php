<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;


    public function tenant()
    {
        return $this->hasOne(Tenant::class, 'id', 'tenant_id');

    }

    public function building()
    {
        return $this->hasOne(Building::class, 'id', 'building_id');
    }

}
