<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use DateTime;


/**
 * @group Guia de remision
 * APIs para Guia de remision de transporte
 */
class CampaignController extends Controller
{
    /**
     * Retornar todas las guias 
     *
     * Retorna todas las guias sin ningun filtro adicional
     *
     *
     * @response {
     *      "data" : [
     *          {
     *      "id_guia_remision": 1,
     *       "tipoDoc": 1,
     *       "serie": "T001",
     *      "correlativo": 1,
     *       "observacion": "observacion xd",
     *      "fechaEmision": "2020-12-11 00:40:01",
     *      "id_emp": 1,
     *      "id_cli": 1,
     *      "id_envio": 4,
     *      "observaciones": null,
     *      "solcli_id": null,
     *      "est_reg": "",
     *      "est_env": "A",
     *      "cliente": {
     *          "id_cli": 1,
     *           "razsoc_cli": "LA PRUEBA CLEITNE SAC",
     *          "numdoc_cli": 9842255555,
     *           "ema_cli": "prueba@cliente.com",
     *          "id_tipdoc": 1,
     *           "est_reg": "A",
     *          "tipo_documento": {},
     *           "contactos": {},
     *          "direcciones": {},
     *           "proyectos": {},
     *          "ordenes_compras": {}
     *      },
     *   "guia_remision_det": [
     *          {
     *               "id_guia_remision_det": 1,
     *              "id_guia_remision": 1,
     *               "codigo": "PROD1",
     *              "descripcion": "PRODUCTO 1",
     *               "unidad": "ZZ",
     *               "cantidad": 2,
     *               "codProdSunat": "P001",
     *               "id_prod": null,
     *               "est_reg": "A",
     *               "producto": null
     *          }
     *      ],
     *       "envio": {
     *          "id_envio": 4,
     *           "codTraslado": 1,
     *           "desTraslado": "VENTA",
     *           "indTransbordo": 0,
     *           "pesoTotal": 10,
     *          "undPesoTotal": "KGM",
     *           "numBultos": 2,
     *          "modTraslado": 1,
     *           "fecTraslado": "2019-09-14 23:21:12",
     *          "numContenedor": "XD-2232",
     *           "codPuerto": 123,
     *          "id_transportista": 1,
     *           "ubigueoLlegada": 4255565,
     *          "direccionLlegada": "Calle los alamos de la molina 3125555",
     *           "ubigueoSalida": 415855,
     *          "direccionSalida": "Via evitamiento KM 42",
     *           "est_reg": "A",
     *           "transportista": {
     *               "id_transportista": 1,
     *               "TipoDoc": 1,
     *               "NumDoc": 72585555865,
     *               "RznSocial": "Mega centro SAC",
     *               "Placa": "vi-412",
     *               "ChoferTipoDoc": 2,
     *               "ChoferDoc": 78528582588,
     *               "est_reg": "A"
     *           }
     *       },
     *       "solicitud_cotizacion_cliente": {}
     *  }
     *          
     *      ],
     *      "size":0
     * }
     */
    public function index()
    {
        try {
            $campaign = Campaign::with(['planMedios', 'cliente'])->get();
            $data = [];
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Ocurrio un error en el servidor',
                'desc' => $e,
            ], 500);
        }
        return response()->json([
            'data' => $campaign,
            
        ], 200, []);
    }

    /**
     * Retornar una campaña
     *
     * Retorna una campaña por medio de su Id
     *
     * @urlParam  id required El ID de la campaña es requerido
     *
     *
     *          
     *      ],
     *          }
     */
    public function show($id)
    {
        try {
            $campaign = Campaign::find($id)->with(['planMedios', 'cliente'])->get();
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Ocurrio un error en el servidor',
                'desc' => $e,
            ], 500);
        }
        return response()->json([
            'data' => $campaign,
            
        ], 200, []);
    }

    /**
     * Crear Campaña
     *
     * Crea una campaña
     *      
     * @response {
     *    "resp": "Campaña creada"
     * }
     */
    
    public function create(Request $request)
    {
        DB::beginTransaction();
        $envio = null;

        try {
            
            $guiaRemision = GuiaRemision::create($request);

            DB::commit();
            //all good
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'ocurrio un error en el servidor',
                'desc' => $e,
            ], 500);
        }
        return response()->json([
            'resp' => 'Campaña creada',
        ], 200, []);

    }

    
    /**
     * Anular guia de remision
     *
     * Anula una guia de remision solo en nuestro sistema solo deve hacerse antes de ser enviada a la SUNAT sino GG
     *
     * @urlParam  id required El ID de la guia es requeridp
     *
     * @response {
     *    "resp": "Guia de remision Anulada"
     * }
     */

  
        
}