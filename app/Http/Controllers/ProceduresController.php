<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Procedure;
use App\ProcedureFormula;

include_once "EvalHelperFunctions.php";

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
                'procedure_id' => $procedure->id,
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
            'procedure_id' => $procedure->id,
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
        $totalMin = $totalMax = 0;

        if (!$procedure = Procedure::with('items', 'formulas')->find($inputs['procedure_id'])) {
            return response()->json([]);
        }

        foreach ($procedure->items as $key => $item) {
            $dynamicNames[$item->name] = array_key_exists($item->name, $inputs) ? intval($inputs[$item->name]) : 0;
        }


        foreach ($procedure->formulas as $keyFormula => $formula) {
            $dynamicFormula = $formula->formula;
            
            foreach ($dynamicNames as $key => $value) {
                $dynamicFormula = str_replace($key, $value, $dynamicFormula);
            }

            preg_match('/[\d\.]+(\|[\d\.]+)+/', $dynamicFormula, $matches);
            if(count($matches) > 0) {
                //Values Variants
                $subFormulas = [];
                $valuesVariants = $matches[0];
                $values = explode("|", $valuesVariants);
                foreach ($values as $value) {
                    $subFormulas[] = str_replace($valuesVariants, $value, $dynamicFormula);
                }
            } else {
                //Formula Variants
                $subFormulas = explode("|", $dynamicFormula);
            }
            $results = [];
            foreach ($subFormulas as $subFormula) {
                try {
                    if(strpos($subFormula, "return ") > -1)
                        $results[] = eval($subFormula);
                    else
                        $results[] = eval('return '.$subFormula.';');
                } catch (\Exception $e) {
                    return response()->json([
                        'error' => true,
                        'message' => $e->getMessage()
                    ]);
                }
            }
            $sumCategory[$formula->category]['costs'][] = [
            	'name' => $formula->name,
            	'cost' => max($results),
                'cost_min' => min($results),
                'cost_max' => max($results)
            ];

            $totalMin += min($results);
            $totalMax += max($results);

        }

        $response = [];

        foreach ($sumCategory as $keySumCategory => $sum) {
            $response['costs'][] = array_merge(ProcedureFormula::getCategoryDetails($keySumCategory), $sum);
            $response['total'] = $totalMax;
            $response['total_min'] = $totalMin;
            $response['total_max'] = $totalMax;

        }
        return response()->json($response);
    }
}
