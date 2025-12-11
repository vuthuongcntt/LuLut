<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Distribution extends Model {
    protected $fillable = [
        'relief_request_id', 'relief_supply_id',
        'quantity_distributed', 'distributed_at', 'notes'
    ];

    protected $casts = [
        'distributed_at' => 'datetime',
    ];

    public function reliefRequest(): BelongsTo {
        return $this->belongsTo(ReliefRequest::class);
    }

    public function reliefSupply(): BelongsTo {
        return $this->belongsTo(ReliefSupply::class);
    }
}