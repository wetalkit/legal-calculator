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
     * @return json
     */
    public function show(Request $request, $id)
    {
        $response = [];

        if (!$procedure = Procedure::find($id)) {
            return response()->json([
                'error' => true,
                'message' => 'Procedure not found.'
            ]);
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
     * @return json
     */
    public function calculate(Request $request)
    {
        $inputs = $request->input();
        $dynamicNames = [];
        $sumCategory = [];
        $total = 0;

        if (!$procedure = Procedure::with('items', 'formulas')->find($inputs['procedure_id'])) {
            return response()->json([]);
        }

        foreach ($procedure->items as $key => $item) {
            $dynamicNames[$item->name] = array_key_exists($item->name, $inputs) ? $inputs[$item->name] : 0;
        }

        foreach ($procedure->formulas as $keyFormula => $formula) {
            $dynamicFormula = $formula->formula;
            if (!isset($sumCategory[$formula->category]['cost'])) {
                $sumCategory[$formula->category]['cost'] = 0;
            }
            
            foreach ($dynamicNames as $key => $value) {
                $dynamicFormula = str_replace($key, $value, $dynamicFormula);
            }

            try {
                $itemSum = eval('return '.$dynamicFormula.';');
            } catch (\Exception $e) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessage()
                ]);
            }

            $sumCategory[$formula->category] = [
                'name' => $formula->name,
                'cost' => $sumCategory[$formula->category]['cost'] + $itemSum
            ];

            $total += $itemSum;
        }

        $response = [];

        foreach ($sumCategory as $keySumCategory => $sum) {
            $response['costs'][] = array_merge(ProcedureFormula::getCategoryDetails($keySumCategory), [
                'costs' => $sum
            ]);
            $response['total'] = $total;
        }
        return response()->json($response);
    }
}
