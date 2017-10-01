<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Procedure;
use App\ProcedureFormula;

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
    public function calculate(Request $request)
    {
        $inputs = $request->input();
        $dynamicNames = [];

        if (!$procedure = Procedure::with('items', 'formulas')->find($inputs['procedure_id'])) {
            return response()->json([]);
        }

        foreach ($procedure->items as $key => $item) {
            $dynamicNames[$item->name] = array_key_exists($item->name, $inputs) ? $inputs[$item->name] : 0;
        }

        $sumCategory = [];

        foreach ($procedure->formulas as $keyFormula => $formula) {
            $dynamicFormula = $formula->formula;
            if (!isset($sumCategory[$formula->category]['cost'])) {
                $sumCategory[$formula->category]['cost'] = 0;
            }
            
            foreach ($dynamicNames as $key => $value) {
                $dynamicFormula = str_replace($key, $value, $dynamicFormula);
            }

            $itemSum = eval('return '.$dynamicFormula.';');

            $sumCategory[$formula->category] = [
                'name' => $formula->name,
                'cost' => $itemSum
            ];
        }

        $response = [];

        foreach ($sumCategory as $keySumCategory => $sum) {
            $response['costs'][] = array_merge(ProcedureFormula::getCategoryDetails($keySumCategory), [
                'costs' => $sum
            ]);
        }
        return response()->json($response);
    }
}
