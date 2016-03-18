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
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return view('equipamentos.index', [
            'equipamentos' => Equipamento::orderBy('created_at', 'asc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    protected function create()
    {
        $locais = LocalEquipamento::where('active',true)->lists('nome','id');
        $tipos = TipoEquipamento::where('active',true)->lists('nome','id');
        $unidades = Unidade::orderBy('created_at', 'asc')->lists('nome','id');
        
       return view('equipamentos.create',array('unidades' => $unidades,'locais' => $locais, 'tipos' => $tipos));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
          $validator = validator($request->all(), [
            'unidade_id' => 'required','tipo_id' => 'required','local_id' => 'required',
            'patrimonio' => 'required|max:20|unique:equipamentos',
            'active'=> 'required'
        ]);
        if ($validator->fails()) {
            return redirect('equipamentos/create')->withErrors($validator)->withInput();
        } else {
            $user = Auth::user();
            Equipamento::create([
                'unidade_id' => $request['unidade_id'],
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
