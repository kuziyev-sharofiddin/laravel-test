<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = ['material_id', 'remainder', 'price'];
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
