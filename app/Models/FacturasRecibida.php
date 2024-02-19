<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturasRecibida extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_factura_recibida';

    protected $fillable = [ 
        'id_cliente',
        'fecha',
        'importe',
        'id_tipo', //tipo de factura 1:A, 2:B, 3:C
        'id_opc', // 1:Transferencia, 2:Efectivo, 3:Cheque
        'pto_venta',
        'nro_comprobante', 
        'iva', // monto de IVA (se calcuoa en el moento)
        'subtotal',
        'pagado',
        'observaciones', 
        'fr'
        ];

        public $timestamps = false;

       /*  //relacion de uno a muchos inversa
    public function cliente(){
        return $this->belongsTo(Cliente::class,'id_cliente','id_cliente');
    }

    public function tipoIva(){
        $tipo=[1=>'A',2=>'B',3=>'C'];
        return $this->id_tipo?$tipo[$this->id_tipo]:null;
    }

    public function porcIva(){
        return  $this->importe>0?round($this->iva/($this->importe)*100,1):null;
    }

    public function opcPago(){
        $opc=['Sin movimientos', 'Transferencia', 'Cheque', 'Efectivo'];
        return $this->id_opc?$opc[$this->id_opc]:'Sin movimientos';
    }

    public function saldot(){
        $mcajas = Cajaf::where('id_tipo_factura',2)->where('id_factura',$this->id_factura_recibida)->get();
        $saldo = 0;
        foreach ($mcajas as $key => $mcaja) {
            $saldo += $mcaja->pagado + $mcaja->retenciones() ;
        }
        $saldo = ($this->importe+$this->iva) - $saldo;

        return $saldo;
    }

    public function movcajaf(){
        return $this->hasMany(Cajaf::class,'id_factura','id_factura_recibida')
                ->where('id_tipo_factura',2)->orderBy('fecha_ingreso', 'desc');
    } */


}
