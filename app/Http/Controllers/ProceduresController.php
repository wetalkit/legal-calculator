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
                    'comment' => $item->comments,
                ];
            }

            $response['services'][] = $data;
        }

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage
     *
     * @return Response
     */
    public function store()
    {
        //
    }

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
                'comment' => $item->comments,
            ];
        }

        return response()->json($data);
    }
}
