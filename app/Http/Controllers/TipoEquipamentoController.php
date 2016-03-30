<?php

namespace App\Http\Controllers;

use App\TipoEquipamento;
use Illuminate\Http\Request;

class TipoEquipamentoController extends Controller {

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
        
        return view('tipo_equipamentos.index', [
            'tipo_equipamentos' => TipoEquipamento::orderBy('created_at', 'asc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    protected function create()
    {
       return view('tipo_equipamentos.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
          $validator = validator($request->all(), [
            'nome' => 'required|unique:tipo_equipamentos|max:150',
            'active' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('tipo_equipamentos/create')->withErrors($validator)->withInput();
        } else {
            TipoEquipamento::create([
                'nome' => $request['nome'],
                'descricao' => $request['descricao'],
                'active' =>$request['active'],
            ]);
            //Session::flash('message', 'Successfully created!');
            return redirect('/tipo_equipamentos');
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
        $tipoEquipamento= TipoEquipamento::find($id);

        return view('tipo_equipamentos.edit')
            ->with('tipo_equipamento', $tipoEquipamento);
        
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
            'nome' => 'required|unique:tipo_equipamentos,nome,'.$id.'|max:150',
            'active' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('tipo_equipamentos/'.$id.'/edit')->withErrors($validator)->withInput();
        } else {
            $tipoEquipamento = TipoEquipamento::find($id);
            $tipoEquipamento->fill($input)->save();
            
            return redirect('tipo_equipamentos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $tipoEquipamento = TipoEquipamento::find($id);
        $tipoEquipamento->delete();

        // redirect
        return redirect('tipo_equipamentos');
    }

}
