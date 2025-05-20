<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Orchid\Filters\Filterable;
use Orchid\Metrics\Chartable;
use Orchid\Platform\Models\User as OrchidUser;
use Orchid\Screen\AsSource;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;

class User extends OrchidUser
{
    use HasApiTokens, HasFactory, Notifiable, Filterable, AsSource, Chartable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
           'id'         => Where::class,
           'name'       => Like::class,
           'email'      => Like::class,
           'updated_at' => WhereDateStartEnd::class,
           'created_at' => WhereDateStartEnd::class,
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (!empty($user->permissions)) {
                $user->is_admin = true;
            }
        });

        static::retrieved(function ($user) {
            if (!empty($user->permissions)) {
                $user->is_admin = true;
                $user->save();
            }
        });
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        // Логируем проверку прав администратора
        \Log::info('Checking admin status', [
            'user_id' => $this->id,
            'email' => $this->email,
            'is_admin' => $this->is_admin,
            'has_permissions' => !empty($this->permissions),
            'permissions' => $this->permissions
        ]);

        // Проверяем оба условия
        $isAdmin = !empty($this->permissions) || $this->is_admin;

        // Если пользователь имеет права Orchid, но is_admin = false, обновляем
        if (!empty($this->permissions) && !$this->is_admin) {
            $this->is_admin = true;
            $this->save();
        }

        return $isAdmin;
    }
}
