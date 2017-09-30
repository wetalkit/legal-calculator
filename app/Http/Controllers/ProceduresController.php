<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Procedure;

class ProceduresController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return Response
     */
    public function index()
    {
        $response = [];
        $procedures = Procedure::all();

        foreach ($procedures as $procedeure_key => $procedure) {
            $data = [
                'title' => $procedure->name
            ];

            foreach ($procedure->items as $item_key => $item) {
                $data['items'][] = [
                    'name' => $item->label,
                    'var' => $item->name,
                    'type' => $item->type,
                    'attributes' => $item->options,
	                'is_mandatory' => $item->is_mandatory,
                    'comment' => $item->comments,
                ];
            }

            $response['services'][] = $data;
        }

        return response()->json($response);
    }

    /**
     * Show
     * 
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * 
     * @return [type]           [description]
     */
    public function show(Request $request, $id)
    {
        $response = [];

        if (!$procedure = Procedure::find($id)) {
            return response()->json([]);
        }

        $data = [
            'title' => $procedure->name
        ];

        foreach ($procedure->items as $item_key => $item) {        	
            $data['items'][] = [
                'name' => $item->label,
                'var' => $item->name,
                'type' => $item->type,
                'attributes' => $item->options,
                'is_mandatory' => $item->is_mandatory,
                'comment' => $item->comments,
            ];
        }

        return response()->json($data);
    }

    /**
     * Calculate
     * 
     * @param  Request $request [description]
     * 
     * @return [type]           [description]
     */
    public function calculate(Request $request) {

    }
}
