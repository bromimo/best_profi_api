<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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

    /*
    |--------------------------------------------------------------------------
    | Поля
    |--------------------------------------------------------------------------
    */

    public function getIsUserAttribute(): bool
    {
        return (bool) $this->user;
    }

    /*
    |--------------------------------------------------------------------------
    | Отношения
    |--------------------------------------------------------------------------
    */

    /** Телефоны субъекта.
     * @return HasMany
     */
    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }

    /** Инстаграм субъекта
     * @return HasOne
     */
    public function instagram(): HasOne
    {
        return $this->hasOne(Instagram::class);
    }

    /** Телеграм субъекта.
     * @return HasOne
     */
    public function telegram(): HasOne
    {
        return $this->hasOne(Telegram::class);
    }

    /** Пользователь.
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Фильтры
    |--------------------------------------------------------------------------
    */

    /** Субъекты, являющиеся пользователями.
     * @param Builder $query
     * @return Builder
     */
    public function scopeOnlyUsers(Builder $query): Builder
    {
        return $query->whereHas('user');
    }

    /** Субъекты, не являющиеся пользователями.
     * @param Builder $query
     * @return Builder
     */
    public function scopeNotUsers(Builder $query): Builder
    {
        return $query->whereDoesntHave('user');
    }
}
