<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
//
use App\Models\backend\UserSetting;
use App\Models\backend\Perfil;
use Spatie\Permission\Models\Role;
// Spatie
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    // Spatie
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['name', 'email', 'password', 'is_active'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['profile_photo_url'];

    public function userSetting()
    {
        return $this->hasOne(UserSetting::class);
    }

    public function scopeActive($query)
    {
        $query->where('is_active', 1);
    }

    // relacion 1:1
    public function perfil()
    {
        // $perfil = Perfil::where('user_id', $this->id)->first();
        // return $perfil;

        // otra opcion
        // return $this->hasOne('App\Models\Backend\Perfil', 'foreign_key', 'local_key');

        // la que más se utiliza
        return $this->hasOne(Perfil::class); //, 'foreign_key', 'local_key'
    }
    // relacion 1:n
    // public function Roles()
    // {
    //     return $this->belongsToMany('Role', 'assigned_roles'); //, 'foreign_key', 'local_key'
    // }
}
