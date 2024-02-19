<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class FacturasEmitida extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_factura_emitida';

    protected $fillable = [ 
        'id_cliente',
        'fecha',
        'importe',
        'id_tipo', //tipo de factura 1:A, 2:B, 3:C
        'id_opc_pago', // 0
        'id_opc', // 0
        'nro_comprobante', 
        'iva', // monto de IVA (se calcuoa en el moento)
        'saldo', //importe + iva
        'observaciones', 
        'fr'
        ];

    public $timestamps = false;

    /* //relacion de uno a muchos inversa
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
        return $this->id_opc_pago?$opc[$this->id_opc_pago]:'Sin movimientos';
    }

    public function opc(){
        $opc=['Sin movimientos', 'Pago Total', 'Pago Parcial'];
        return $this->id_opc?$opc[$this->id_opc]:'Sin movimientos';
    }

    public function saldot( $ret=null){
        $mcajas = Cajaf::where('id_tipo_factura',1)->where('id_factura',$this->id_factura_emitida)
                    ->get();
        $saldo = [0,0];
        foreach ($mcajas as $key => $mcaja) {
            $saldo[0] += $mcaja->cobrado + $mcaja->retenciones() ;
            $saldo[1] += $mcaja->retenciones();
        }

       
        $saldo[0] = ( $this->importet() + $this->ivat() ) - $saldo[0];

        return $ret?$saldo:round($saldo[0],2);
    }

    public function importet(){
        $notas = NotaCredito::where('id_factura',$this->id_factura_emitida)->get();
        $tnotas = 0;
        foreach ($notas as $key => $notac) {
            $tnotas += $notac->importe;
        }
        return $this->importe - $tnotas;
    }

    public function ivat(){
        $notas = NotaCredito::where('id_factura',$this->id_factura_emitida)->get();
        $tnotas = 0;
        foreach ($notas as $key => $notac) {
            $tnotas += $notac->importe;

        }

        $valor = $this->iva - $this->iva*$tnotas/$this->importe;
        return $valor;
    }

    public function movcajaf(){
        return $this->hasMany(Cajaf::class,'id_factura','id_factura_emitida')
        ->where('id_tipo_factura',1)->orderBy('fecha_ingreso', 'desc');
    }

    
    public function notacreditos(){
        return $this->hasMany(NotaCredito::class,'id_factura','id_factura_emitida');
    } */


}
