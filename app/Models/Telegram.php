<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Telegram extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['account'];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
