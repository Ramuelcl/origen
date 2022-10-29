<?php

namespace App\Models\posts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imagen extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'imagenes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'user_id', 'url'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
    ];

    public function marcadorables()
    {
        return $this->morphToMany(\App\Models\backend\Marcador::class, 'marcadorableable');
    }

    public function categoriables()
    {
        return $this->morphToMany(\App\Models\backend\Categoria::class, 'categoriableable');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
