<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'nome',
        'cpf',
        'ativo',
        'user_id'
    ];

    function user()
    {
        return $this->hasOne(User::class, 'id', 'usuario_id');
    }
}
