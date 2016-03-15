<?php

namespace App\Http\Controllers;

use App\Orgao;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;

class OrgaoController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    
        /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nome' => 'required|max:150',
            'sigla' => 'required|max:6|unique:orgaos',
            'active' => 'required',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        
        return view('orgaos.index', [
            'orgaos' => Orgao::orderBy('created_at', 'asc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    protected function create()
    {
       return view('orgaos.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $validator = validator($request->all());
        if ($validator->fails()) {
            return Redirect::to('orgaos/create')->withErrors($validator);
        } else {
            Orgao::create([
                'nome' => $request['nome'],
                'sigla' => $request['sigla'],
                'active' =>$request['active'],
            ]);
            //Session::flash('message', 'Successfully created nerd!');
            return redirect('/orgaos');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
