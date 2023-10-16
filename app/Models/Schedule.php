<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    const DAYS_RU = [
        'воскресенье',
        'понедельник',
        'вторник',
        'среда',
        'четверг',
        'пятница',
        'суббота',
    ];

    protected $fillable = [
        'user_id',
        'day',
        'time'
    ];

    /*
    |--------------------------------------------------------------------------
    | Отношения
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Фильтры
    |--------------------------------------------------------------------------
    */

    /** Возвращает расписанию пользователя.
     * @param Builder $query
     * @param int     $user_id
     * @return Builder
     */
    public function scopeUsers(Builder $query, int $user_id): Builder
    {
        return $query->where('user_id', $user_id);
    }
}
