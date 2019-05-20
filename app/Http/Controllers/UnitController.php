<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use View;
use Validator;
use Input;
use Session;
use Redirect;

class UnitController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$units = Unit::all();

		return View::make('units.index')
			->with('units', $units);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return View::make('units.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$rules = array(
			'name' => 'required', 
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('units/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			$unit = new Unit;
			$unit->name = Input::get('name');
			$unit->save();

			Session::flash('message', 'Successful!');
			return Redirect::to('units');    
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Unit $unit)
	{
		return View::make('units.show')
			->with('unit', $unit);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Unit  $unit
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Unit $unit)
	{
		return View::make('units.edit')		
			->with('unit', $unit);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Unit  $unit
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Unit $unit)
	{
			$rules = array(
			'name' => 'required', 
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::to('units/' . $unit->id . '/edit')
			->withErrors($validator)
			->withInput(Input::except('password'));
		} else {
			$unit->name = Input::get('name');
			$unit->save();

			Session::flash('message', 'Update successful!');
			return Redirect::to('units');    
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Unit  $unit
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Unit $unit)
	{
		$unit->delete();
		Session::flash('message', 'Delete successful!');
		return Redirect::to('units');
	}
}
