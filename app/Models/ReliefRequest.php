<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReliefRequest extends Model {
    protected $fillable = [
        'name', 'phone', 'latitude', 'longitude', 'location_name',
        'message', 'status', 'food_quantity', 'food_type', 'people_count'
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function distributions(): HasMany {
        return $this->hasMany(Distribution::class);
    }
}
