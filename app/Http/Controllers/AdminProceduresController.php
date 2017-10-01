<?php
namespace App\Http\Controllers;

use App\Procedure;
use App\ProcedureItem;
use App\ProcedureFormula;
use App\Http\Requests\StoreProcedure as StoreProcedureRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminProceduresController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procedures = Procedure::all();
        return view('procedure.index', ['procedures' => $procedures]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$formulas = [
        	ProcedureFormula::FORMULA_LAWYER => 'Адвокат',
        	ProcedureFormula::FORMULA_NOTAR => 'Нотар',
        	ProcedureFormula::FORMULA_KATASTAR => 'Катастар',
        ];
        return view('procedure.create', compact('formulas'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProcedureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProcedureRequest $request)
    {
        $procedure  = Procedure::create([
            'name' => $request['name'],
        ]);

        $this->insertItems($request, $procedure);
        
        Session::flash('status', 'Процедурата е успешно зачувана.');
        return Redirect::to('admin/procedure');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $procedure = Procedure::find($id);
        $formulas = [
        	ProcedureFormula::FORMULA_LAWYER => 'Адвокат',
        	ProcedureFormula::FORMULA_NOTAR => 'Нотар',
        	ProcedureFormula::FORMULA_KATASTAR => 'Катастар',
        ];
        return view('procedure.edit', compact('formulas', 'procedure'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreProcedureRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProcedureRequest $request, $id)
    {
        $procedure = Procedure::find($id);
        foreach ($procedure->items as $item) {
        	$item->delete();
        }
        foreach ($procedure->formulas as $formula) {
        	$formula->delete();
        }
        $this->insertItems($request, $procedure);
        Session::flash('status', 'Процедурата е успешно зачувана.');
        return Redirect::to('admin/procedure');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $procedure = Procedure::find($id);
        $procedure->delete();
        Session::flash('status', 'Процедурата е успешно избришана.');
        return Redirect::to('admin/procedure');
    }

    /**
     * Returns all procedure items and formulas
     * @param  Request $request [description]
     * @return JSON           
     */
    public function getProcedureItems(Request $request)
    {
        $procedure = Procedure::find($request->id);
        $items = $procedure->items;
        $formulas = $procedure->formulas;
    	return compact('items', 'formulas');
    }

    /**
     * Handles the saving of procedure items and formulas
     * @param  StoreProcedureRequest $request   
     * @param  Procedure                $procedure 
     */
    private function insertItems(StoreProcedureRequest $request, $procedure)
    {
    	for ($i = 0; $i < count($request['item-name']); $i++) {
            $options = [
                'placeholder' => $request['value'][$i]
            ];
            if ($request['type'][$i] == ProcedureItem::ITEM_SELECT) {
                $selectOptions = explode("\r\n", $request['options'][$i]);
                foreach ($selectOptions as $key => $value) {
                    $option = explode(',', $value);
                    $options['options'][$option[0]] = $option[1];
                }
            }
            $procedureItem = ProcedureItem::create([
                'procedure_id' => $procedure->id,
                'label' => $request['label'][$i],
                'name' => $request['item-name'][$i],
                'type' => $request['type'][$i],
                'options' => $options,
                'comments' => $request['comments'][$i],
                'is_mandatory' => isset($request['mandatory'][$i]) ? $request['mandatory'][$i] : 0,
            ]);
        }

    	for($i = 0; $i < count($request['formula-name']); $i ++) {
    		$procedureFormula = ProcedureFormula::create([
                'procedure_id' => $procedure->id,
                'name' => $request['formula-name'][$i],
                'category' => $request['category'][$i],
                'formula' => $request['formula'][$i],
            ]);
    	}
	}
}
