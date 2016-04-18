<?php

namespace App\Http\Controllers;

use Auth;
use App\Equipamento;
use App\EStatus;
use App\StatusEquipamento;
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
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $equipamentos = $unidade = '';
        if (Auth::user()->profile->name == 'Admin'){
            $equipamentos = Equipamento::orderBy('created_at', 'asc')
            ->with('lastUser', 'local', 'tipo', 'unidade','status')->get();
             $unidade = 'GERAL';
        }  elseif(Auth::user()->unidade instanceof Unidade){
            $equipamentos = Equipamento::where('unidade_id', '=', Auth::user()->unidade->id)
            ->with('lastUser', 'local', 'tipo', 'unidade','status')
            ->orderBy('created_at', 'asc')->get();
            $unidade = Auth::user()->unidade->nome;
        }
        $e_status = EStatus::where('id','>',0)->where('active',TRUE)->orderBy('id')->get();


        return view('equipamentos.index', ['equipamentos' => $equipamentos, 'unidade'=> $unidade, 'e_status' =>$e_status]);
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
        $arrOutput['e_status'] = EStatus::where('id','>',0)->where('active',TRUE)->lists('nome','id');
        $arrOutput['locais'] = LocalEquipamento::where('active',TRUE)->lists('nome','id');
        $arrOutput['tipos'] = TipoEquipamento::where('active',TRUE)->lists('nome','id');
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
                        'status'=> 'required', 
                        'status_descricao'=> 'required'];
        $validator = validator($request->all(), $arrValidator);
        if(!$valido){
            $validator->after(function($validator) {
                $validator->errors()->add('patrimonio', 'Usuário sem permissão');
            });
        }
        if ($validator->fails()) {
            return redirect('equipamentos/create')->withErrors($validator)->withInput();
        } else {
            
            $insertID = Equipamento::create([
                'unidade_id' => $unidadeId,
                'tipo_id' => $request['tipo_id'],
                'local_id' => $request['local_id'],
                'last_user_id' => $user->id,
                'patrimonio' => $request['patrimonio'],
                'observacao'=> $request['observacao'],
            ])->id;
            StatusEquipamento::create([
                'equipamento_id' => $insertID,
                'user_id' => $user->id,
                'status_id' => $request['status'],
                'descricao' => $request['status_descricao']
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
        $locais = LocalEquipamento::where('active',TRUE)->lists('nome','id');
        $tipos = TipoEquipamento::where('active',TRUE)->lists('nome','id');
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
        $equipamento->patrimonio = $equipamento->patrimonio." #E";
        $equipamento->save();
        $equipamento->delete();

        // redirect
        //Session::flash('message', 'Successfully deleted !');
        return redirect('equipamentos');
    }
    
    
    public function storeStatus($id, Request $request) {
        $user = Auth::user();
        $valido = FALSE;
        $input = $request->all();
        $sts = $input['status']; 
        $sts = $input['descricao']; 
        $arrValidator = ['status' => 'required','descricao' => 'required',];
        $validator = validator($input, $arrValidator);
        if ($validator->fails()) {
            return redirect('equipamentos')->withErrors($validator)->withInput();
        } else {
            $sts = StatusEquipamento::findOrFail($id);
            $sts->status_id = $request['status']; 
            $sts->descricao = $request['descricao']; 
            $sts->user_id = $user->id;
            $sts->save();
            
            \Session::flash('flash_success', 'Status editado com sucesso');
            return redirect('/equipamentos');
        }
    }

}
