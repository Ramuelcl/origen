<?php

namespace App\Models\backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perfil extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'perfiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'edad', 'profesion', 'biografia', 'website'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'edad' => 'integer',
    ];

    // public function user()
    // {
    //     return $this->hasOne(\App\Models\User::class);
    // }

    // relacion 1:1 iversa
    public function user()
    {
        // $user = User::find( $this->user_id);
        // return $user;

        // otra opcion
        // return $this->belongsTo('App\Models\User', 'foreign_key', 'local_key');

        // la que más se utiliza
        return $this->belongsTo(\App\Models\User::class);
    }
}
