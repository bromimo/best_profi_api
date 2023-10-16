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
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

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

    /** Расписание.
     * @return HasMany
     */
    public function schedule(): HasMany
    {
        return $this->hasMany(Schedule::class);
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

    /** Биндим 'me' в маршрут 'users'.
     * @param mixed       $value
     * @param string|null $field
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function resolveRouteBinding($value, $field = null)
    {
        if ($value === 'me') {
            if (auth()->check()) {
                return auth()->user();
            }

            throw new UnauthorizedHttpException('Unauthorized.');
        }

        return $this->findOrFail($value);
    }
}
