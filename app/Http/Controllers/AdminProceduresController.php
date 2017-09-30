<?php

namespace App\Http\Controllers;

use App\Procedure;
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
        return view('procedure.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('procedure/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $procedure  = Procedure::create([
                'name' => $request['name'],
            ]);
            Session::flash('status', 'Successfully created procedure!');
            return Redirect::to('procedure');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the nerd
        $procedure = Procedure::find($id);

        // show the view and pass the nerd to it
        return view('procedure.show', ['procedure' => $procedure]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the nerd
        $procedure = Procedure::find($id);

        // show the view and pass the nerd to it
        return view('procedure.edit', ['procedure' => $procedure]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('procedure/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            $procedure  = Procedure::find($id);
            $procedure->name = $request['name'];
            $procedure->save();
            Session::flash('status', 'Successful update!');
            return redirect()->route('procedure.edit', ['id' => $id]);
        }
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

        Session::flash('status', 'Successfully deleted the procedure!');
        return Redirect::to('procedure');
    }
}
