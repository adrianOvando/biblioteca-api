<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
     protected $fillable = ['fecha', 'fecha_devolucion', 'lector_id'];

    public function lector()
    {
        return $this->belongsTo(User::class, 'lector_id');
    }

    public function libros()
    {
        return $this->belongsToMany(Libro::class, 'detalle_prestamo', 'prestamo_id', 'libro_id')
                    ->withTimestamps();
    }
}
