<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use View;
use Validator;
use Input;
use Session;
use Redirect;

class ProductController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$products = Product::all();

		return View::make('products.index')
			->with('products', $products);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return View::make('products.create');
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
			return Redirect::to('products/create')
			->withErrors($validator)
			->withInput(Input::except('password'));
		} else {
			$product = new Product;
				$product->name = Input::get('name');
				$product->save();

				Session::flash('message', 'Successful!');
				return Redirect::to('products');
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
		$product = Product::find($id);

		return View::make('products.show')
			->with('product', $product);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$product = Product::find($id);

		return View::make('products.edit')
			->with('product', $product);
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
		$rules = array(
			'name' => 'required',
		);
		
		$validator = Validator::make(Input::all(), $rules);
		
		if ($validator->fails()) {
			return Redirect::to('products/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			$product = new Product;
				$product->name = Input::get('name');
				$product->save();

				Session::flash('message', 'Update successful!');
				return Redirect::to('products');
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
		$product = Products::find($id);
		$product->delete();

		Session::flash('message', 'Delete successful!');
		return Redirect::to('products');
	}
}
