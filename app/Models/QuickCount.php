<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuickCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'province_id',
        'regency_id',
        'district_id',
        'village_id',
        'caleg_id',
        'tps',
        'vote',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function caleg()
    {
        return $this->belongsTo(Caleg::class);
    }
}
