<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetallePrestamo extends Model
{
    protected $table = 'detalle_prestamo';
    protected $fillable = ['prestamo_id', 'libro_id'];
}
