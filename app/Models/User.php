<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Cache;
use NotificationChannels\WebPush\HasPushSubscriptions;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasPushSubscriptions;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'nomor_hp',
        'photo',
        'password',
        'role',
        'status',
        'permissions',
    ];

    protected static function booted()
    {
        static::saved(function ($user) {
            static::clearCache($user);
        });

        static::deleted(function ($user) {
            static::clearCache($user);
        });
    }

    protected static function clearCache($user)
    {
        Cache::forget('stats_total_admin');
        Cache::forget('stats_total_mentee');
        Cache::forget('chart_admin_growth');
        Cache::forget('chart_mentee_growth');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'permissions' => 'array',
    ];

    public function kursus_sebagai_mentor()
    {
        return $this->hasMany(Kursus::class, 'mentor_id', 'id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'user_id', 'id');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'user_id', 'id');
    }

    public function kursus()
    {
        return $this->belongsToMany(Kursus::class, 'pendaftaran', 'user_id', 'kursus_id')
            ->withTimestamps()
            ->withPivot(['status', 'pembayaran_id']);
    }

    public function progres_materi()
    {
        return $this->hasMany(ProgresMateri::class, 'user_id', 'id');
    }

    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class, 'user_id', 'id');
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'user_id', 'id');
    }

    /**
     * Check if user has a specific permission.
     * Superadmin always returns true (can access everything).
     *
     * @param  string  $permission
     */
    public function hasPermission($permission): bool
    {
        // Superadmin can access everything
        if ($this->role === 'superadmin') {
            return true;
        }

        // Get permissions
        $permissions = $this->getPermissionsArray();

        return in_array($permission, $permissions);
    }

    /**
     * Check if user has ANY of the given permissions.
     */
    public function hasAnyPermission(array $permissions): bool
    {
        // Superadmin can access everything
        if ($this->role === 'superadmin') {
            return true;
        }

        // Get user permissions
        $userPermissions = $this->getPermissionsArray();

        // Check if there's any intersection
        return ! empty(array_intersect($permissions, $userPermissions));
    }

    /**
     * Get all permissions as array.
     */
    public function getPermissionsArray(): array
    {
        return is_array($this->permissions) ? $this->permissions : [];
    }

    /**
     * Scope for filtering admins and superadmins.
     */
    public function scopeAdmins($query)
    {
        return $query->whereIn('role', ['superadmin', 'admin']);
    }
}
