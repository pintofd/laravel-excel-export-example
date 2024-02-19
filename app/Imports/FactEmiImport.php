<?php

namespace App\Imports;

use App\Models\FacturasEmitida;
use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class FactEmiImport implements ToModel,  WithHeadingRow
{
    public $data;
    public function __construct()
    {
    $this->data = collect();
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        /* 
        Los encabezados de los archivos de compra deben cambiarce por:
        Fecha => fecha	
        Tipo de Comprobante => id_tipo	
        Punto de Venta => pto_venta	
        Nùmero => nro_comprobante	
        CUIT => cuit	
        RAZON SOCIAL => razon	
        Imp. Neto Gravado => importe	
        Imp. Neto No Gravado => Imp. Neto No Gravado	
        Imp. Op. Exentas => Imp. Op. Exentas	
        Otros Tributos => Otros Tributos	
        IVA => iva	
        Imp. Total => subtotal 
        */
        
        
        $mat = [
            1 => 1,
            2 => 1,
            3  => null,
            4  => 1,
            6  => 2,
            7  => 2,
            8  => null,
            11  => 3,
            13  => null,
            109 => 3,
            '1 - Factura A' => 1,
            '2 - Nota de Debito A' => 1,
            '3 - Nota de Credito A' => null,
            '4 - Recibo A' => 1,
            '6 - Factura B' => 2,
            '7 - Nota de Debito B' => 2,
            '8 - Nota de Credito B' => null,
            '11 - Factura C' => 3,
            '13 - Nota de Credito C' => null,
            '109 - Tique C' => 3,

        ];
        $cliente = Cliente::where('cuit',$row['cuit'])->get()->first();

        if($cliente==null){
            $cliente = Cliente::create([
                'razon' => $row['razon'],
                'tipo_cliente' => 1,
                'direccion' => 'N/A',
                'cuit' => $row['cuit']
                ]
            );
        }
        $id = $mat[$row['id_tipo']];
        //$calc = $row['name']."/".$row['city'];
        if($id){
            $model = FacturasEmitida::firstOrCreate([
                'nro_comprobante' => $row['nro_comprobante'],
                'pto_venta' => $row['pto_venta']
            ],[
                'id_cliente' => $cliente->id_cliente,
                'fecha' => Carbon::createFromFormat('d/m/Y',$row['fecha'])->toDateString()  ,
                'importe' => floatval($row['subtotal'])-floatval($row['iva']),
                'id_tipo' => $id,
                'pto_venta' => $row['pto_venta'],
                'nro_comprobante'=> $row['nro_comprobante'],
                'id_opc_pago' =>  0,
                'id_opc' => 0,
                'iva' =>  $row['iva'],
                'subtotal' => floatval($row['subtotal']),
            ]);
            $this->data->push($model);
            return $model;
        }
    }
}
