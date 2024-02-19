<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cliente extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_cliente';

    public $timestamps = false;

    protected $fillable = [ 
    'razon',
    'nombre',
    'tipo_cliente',
    'direccion',
    'cp',
    'localidad',
    'provincia',
    'cuit',
    'abono',
    'nombre1',
    'nombre2',
    'nombre3',
    'nombre4',
    'nombre5',
    'nombre6',
    'nombre7',
    'nombre8',
    'nombre9',
    'nombre10',
    'contacto1',
    'contacto2',
    'contacto3',
    'contacto4',
    'contacto5',
    'contacto6',
    'contacto7',
    'contacto8',
    'contacto9',
    'contacto10',
    'cant_empleados',
    'email',
    'email2',
    'email3',
    'email4',
    'email5',
    'email6',
    'email7',
    'email8',
    'email9',
    'email10',
    'observaciones',
    'fecha_actualizacion',];


    
}