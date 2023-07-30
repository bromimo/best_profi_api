<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name'
    ];

    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }

    public function instagram(): HasOne
    {
        return $this->hasOne(Instagram::class);
    }

    public function telegram(): HasOne
    {
        return $this->hasOne(Telegram::class);
    }
}
