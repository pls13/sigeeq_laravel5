<?php

namespace App\Http\Controllers;

use App\LocalEquipamento;
use Illuminate\Http\Request;

class LocalEquipamentoController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        
        return view('local_equipamentos.index', [
            'local_equipamentos' => LocalEquipamento::orderBy('created_at', 'asc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    protected function create()
    {
       return view('local_equipamentos.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
          $validator = validator($request->all(), [
            'nome' => 'required|unique:local_equipamentos|max:150',
            'active' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('local_equipamentos/create')->withErrors($validator)->withInput();
        } else {
            LocalEquipamento::create([
                'nome' => $request['nome'],
                'descricao' => $request['descricao'],
                'active' =>$request['active'],
            ]);
            //Session::flash('message', 'Successfully created!');
            return redirect('/local_equipamentos');
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
    public function edit($id)
    {
        $localEquipamento= LocalEquipamento::find($id);

        return view('local_equipamentos.edit')
            ->with('local_equipamento', $localEquipamento);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request) {
        
        $input = $request->all();
        $validator = validator($input , [
            'nome' => 'required|unique:local_equipamentos,nome,'.$id.'|max:150',
            'active' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('local_equipamentos/'.$id.'/edit')->withErrors($validator)->withInput();
        } else {
            $localEquipamento = LocalEquipamento::find($id);
            $localEquipamento->fill($input)->save();
            
            return redirect('local_equipamentos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $localEquipamento = LocalEquipamento::find($id);
        $localEquipamento->delete();

        // redirect
        return redirect('local_equipamentos');
    }

}
