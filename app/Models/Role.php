<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    const ROLE_BOT           = 'бот';
    const ROLE_ADMIN         = 'администратор';
    const ROLE_NAILMASTER    = 'ногтевой мастер';
    const ROLE_LASHMAKER     = 'лэшмейкер';
    const ROLE_BROWMAKER     = 'бровист';
    const ROLE_COSMETOLOGIST = 'косметолог';
    const ROLE_INTERN        = 'стажер';
    const ROLE_STUDENT       = 'ученица';

    const ROLES = [
        self::ROLE_BOT,
        self::ROLE_ADMIN,
        self::ROLE_NAILMASTER,
        self::ROLE_LASHMAKER,
        self::ROLE_BROWMAKER,
        self::ROLE_COSMETOLOGIST,
        self::ROLE_INTERN,
        self::ROLE_STUDENT
    ];

    /*
    |--------------------------------------------------------------------------
    | Отношения
    |--------------------------------------------------------------------------
    */

    /** Пользователи.
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
