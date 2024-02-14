<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    use HasFactory;

    protected $fillable = ['province_id', 'name'];

    public function villages()
    {
        // return $this->hasManyThrough(
        //     Village::class,
        //     District::class,
        //     "regency_id", // FK on wallets table
        //     "district_id", // FK on virtual_accounts table
        //     // "name",
        //     // "name",
        //     "id", // РК on customers table
        //     "id" // РК on wallets table
        // );
        return $this->hasManyThrough(Village::class, District::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
