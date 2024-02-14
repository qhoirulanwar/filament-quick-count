<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CalegType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function calegs(): HasMany
    {
        return $this->hasMany(Caleg::class);
    }
}
