<?php

namespace App\Http\Controllers;

use Auth;
use App\Equipamento;
use App\TipoEquipamento;
use App\LocalEquipamento;
use App\Unidade;
use Illuminate\Http\Request;

class EquipamentoController extends Controller
{
 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('adminMW');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $equipamentos = $unidade = '';
        if (Auth::user()->profile->name == 'Admin'){
            $equipamentos = Equipamento::orderBy('created_at', 'asc')->get();
             $unidade = 'GERAL';
        }  elseif(Auth::user()->unidade instanceof Unidade){
            $equipamentos = Equipamento::where('unidade_id', '=', Auth::user()->unidade->id)
            ->get();
            $unidade = Auth::user()->unidade->nome;
        }
        return view('equipamentos.index', ['equipamentos' => $equipamentos, 'unidade'=> $unidade]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    protected function create()
    {
        $comboUnidade = ['id'=>'equipamento-unidade_id', 'class' => 'form-control'];
        if (Auth::user()->profile->name == 'Admin'){
            $comboUnidade['placeholder'] = 'Selecione';
            $arrOutput['unidades'] = Unidade::orderBy('created_at', 'asc')->lists('nome','id');
        }elseif(Auth::user()->unidade instanceof Unidade){
            $arrOutput['unidades'] = [Auth::user()->unidade->id => Auth::user()->unidade->nome];
        }
        $arrOutput['locais'] = LocalEquipamento::where('active',true)->lists('nome','id');
        $arrOutput['tipos'] = TipoEquipamento::where('active',true)->lists('nome','id');
        $arrOutput['property_combo'] = $comboUnidade;
       return view('equipamentos.create',$arrOutput);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $user = Auth::user();
        $valido = FALSE;
        $unidadeId = NULL;
        if ($user->profile->name == 'Admin'){
            $arrValidator['unidade_id'] = 'required';
            $valido = TRUE;
            $unidadeId = $request['unidade_id'];
        }elseif($user->unidade instanceof Unidade){
            $valido = TRUE;
            $unidadeId = $user->unidade->id;
        }
        $arrValidator = ['tipo_id' => 'required',
                        'local_id' => 'required',
                        'patrimonio' => 'required|max:20|unique:equipamentos',
                        'active'=> 'required'];
        $validator = validator($request->all(), $arrValidator);
        if(!$valido){
            $validator->after(function($validator) {
                $validator->errors()->add('patrimonio', 'Usuário sem permissão');
            });
        }
        if ($validator->fails()) {
            return redirect('equipamentos/create')->withErrors($validator)->withInput();
        } else {
            
            Equipamento::create([
                'unidade_id' => $unidadeId,
                'tipo_id' => $request['tipo_id'],
                'local_id' => $request['local_id'],
                'last_user_id' => $user->id,
                'patrimonio' => $request['patrimonio'],
                'observacao'=> $request['observacao'],
                'active'=> $request['active'],
            ]);
            //Session::flash('message', 'Successfully created!');
            return redirect('/equipamentos');
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
        $equipamento = Equipamento::find($id);
        $locais = LocalEquipamento::where('active',true)->lists('nome','id');
        $tipos = TipoEquipamento::where('active',true)->lists('nome','id');
        $unidades = Unidade::orderBy('created_at','asc')->lists('nome','id');

        return view('equipamentos.edit', array('equipamento'=>$equipamento,
            'locais' =>$locais, 'tipos' =>$tipos, 'unidades' =>$unidades));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request) {
        $input = $request->all();
        $validator = validator($input, [
            'unidade_id' => 'required','tipo_id' => 'required','local_id' => 'required',
            'patrimonio' => 'required|max:20|unique:equipamentos,patrimonio,'.$id,
            'active'=> 'required'
        ]);
        if ($validator->fails()) {
            return redirect('equipamentos/'.$id.'/edit')->withErrors($validator)->withInput();
        } else {
            $user = Auth::user();
            $equipamento = Equipamento::find($id);
            $equipamento->fill($input);
            $equipamento->last_user_id = $user->id;
            $equipamento->save();
            
            return redirect('equipamentos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $equipamento = Equipamento::find($id);
        $equipamento->delete();

        // redirect
        //Session::flash('message', 'Successfully deleted !');
        return redirect('equipamentos');
    }

}
