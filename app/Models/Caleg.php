<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caleg extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'caleg_type_id'];

    public function calegType()
    {
        return $this->belongsTo(CalegType::class);
    }
}
