<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publicacion extends Model
{
    use SoftDeletes;

    protected $table = 'publicaciones';

    protected $fillable = [
        'user_id', 'categoria_id', 'titulo', 'descripcion',
        'imagen', 'ofrece', 'busca', 'estado',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function mensajes(): HasMany
    {
        return $this->hasMany(Mensaje::class);
    }
}
