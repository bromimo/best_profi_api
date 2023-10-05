<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'subject_id',
        'password'
    ];

    /*
    |--------------------------------------------------------------------------
    | Отношения
    |--------------------------------------------------------------------------
    */

    /** Субъект.
     * @return BelongsTo
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /** Роли.
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    /*
    |--------------------------------------------------------------------------
    | Фильтры
    |--------------------------------------------------------------------------
    */

    /** Возвращает юзера, у которого есть данный телефон.
     * @param Builder $query
     * @param         $phone
     * @return Builder
     */
    public function scopeWithPhone(Builder $query, $phone): Builder
    {
        return $query->whereHas('subject.phones', function ($query) use ($phone) {
            $query->where('phone', $phone);
        });
    }
}
