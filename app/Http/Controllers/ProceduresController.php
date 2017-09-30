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
		$procedures = Procedure::with('items')->get();

		foreach ($procedures as $procdeure_key => $procedure) {

			$data = [
				'title' => $procedure->name
			];

			foreach ($procedure->items as $item_key => $item) {
				$data['items'][] = [
					'name' => $item->label,
					'var' => $item->name,
					'type' => $item->type,
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
}