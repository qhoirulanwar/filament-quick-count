<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['regency_id', 'name'];

    public function district(): HasOne
    {
        return $this->hasOne(District::class, "regency_id", "id");
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }
}
