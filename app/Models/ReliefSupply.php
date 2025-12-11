<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReliefSupply extends Model {
    protected $fillable = [
        'supply_type', 'available_quantity', 'latitude', 'longitude',
        'location_name', 'description', 'status'
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function distributions(): HasMany {
        return $this->hasMany(Distribution::class);
    }
}