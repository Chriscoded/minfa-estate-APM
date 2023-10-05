<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    public function building()
    {
        /**
         * Get all of the comments for the Apartment
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        // public function comments(): HasMany
        // {
            return $this->hasOne(Building::class, 'id', 'building_id');
           // }
        // return hasMany(\App\Models\Building::class);
    }
    public function tenant()
    {
        return $this->hasOne(Tenant::class, 'id', 'tenant_id');

    }
}
