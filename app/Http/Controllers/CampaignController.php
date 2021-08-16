<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use DateTime;


/**
 * @group CAMPAÑA
 * APIs para Campaña
 */
class CampaignController extends Controller
{
    /**
     * Retornar todas las campañas
     *
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
            
            $campaign = Campaign::create($request);

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
     * Anula una campaña
     *
     * Anula una campaña
     *
     * @urlParam  id required El ID de la campaña es requerido
     *
     * @response {
     *    "resp": "Campaña Anulada"
     * }
     */

    public function delete($id)
    {
        try {
            $campaign = Campaign::find($id)->get();
            $campaign->delete();
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Ocurrio un error en el servidor',
                'desc' => $e,
            ], 500);
        }
        return response()->json([
            'data' => 'Campaña eliminada exitosamente '.$id,
            
        ], 200, []);
    }


    /**
     * Actualiza una Campaña
     *
     *      
     * @response {
     *    "resp": "Campaña creada"
     * }
     */
    
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $envio = null;

        try {
            $campaign = Campaign::find($id)->get();
            $campaign = Campaign::createOrUpdate($id,$request);

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
            'resp' => 'Campaña actualizada',
        ], 200, []);

    }


        
}