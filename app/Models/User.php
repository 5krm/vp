<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'device_id',
        'name',
        'email',
        'phone',
        'otp',
        'expires_at',
        'is_verified',
        'login_mode',
        'profile_image',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Roles and Permissons
    public static function getPermissionGroups()
    {
        $permissionGroups = Permission::select('group_name as name', \DB::raw('MIN(id) as id'))
            ->groupBy('group_name')
            ->orderBy('id', 'asc')
            ->get();

        return $permissionGroups;
    }

    public static function getPermissionsByGroupName($groupName)
    {
        $permissions = Permission::select('name', 'id')
            ->where('group_name', $groupName)
            ->get();

        return $permissions;
    }

    public static function roleHasAllPermissions($role, $permissions)
    {
        $hasAllPermissions = true;

        foreach ($permissions as $permission) {
            if (!$role->hasPermissionTo($permission->name)) {
                $hasAllPermissions = false;
                return $hasAllPermissions;
            }
        }

        return $hasAllPermissions;
    }

    public function isExpired()
    {
        return Carbon::now()->greaterThan($this->expires_at);
    }

    // Relations
    public function userPackageDetails()
    {
        return $this->hasOne(UserPackage::class, 'user_id');
    }
    
}
