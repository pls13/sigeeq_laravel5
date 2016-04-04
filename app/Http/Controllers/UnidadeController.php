<?php

namespace App\Http\Controllers;

use App\User;
use App\Orgao;
use App\Unidade;
use Illuminate\Http\Request;

class UnidadeController extends Controller
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
        
        return view('unidades.index', [
            'unidades' => Unidade::orderBy('created_at', 'asc')->
                with('orgao','tecnico')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    protected function create()
    {
        
        $users = User::leftJoin('unidades','users.id', '=', 'unidades.tecnico_id')
                ->where('users.active',true)->whereNull('unidades.tecnico_id')
                ->lists('users.name','users.id');
        $orgaos = Orgao::where('active',true)->lists('nome','id');
        
        return view('unidades.create',array('orgaos' => $orgaos, 'users' => $users));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
          $validator = validator($request->all(), [
            'orgao_id' => 'required',
            'nome' => 'required|unique:unidades|max:150',
            'sigla' => 'required|max:6|unique:unidades',
            'rua' => 'max:150',
            'numero' => 'max:20',
            'bairro'=> 'max:50',
            'telefone'=> 'max:20',
            'nome_diretor'=> 'max:50',
            'tecnico_id' => 'unique:unidades',

        ]);

        if ($validator->fails()) {
            return redirect('unidades/create')->withErrors($validator)->withInput();
        } else {
            Unidade::create([
                'orgao_id' => $request['orgao_id'],
                'tecnico_id' => empty($request['tecnico_id'])?NULL:$request['tecnico_id'],
                'nome' => $request['nome'],
                'sigla' => $request['sigla'],
                'rua'=> $request['rua'],
                'numero'=> $request['numero'],
                'bairro'=> $request['bairro'],
                'telefone'=> $request['telefone'],
                'nome_diretor'=> $request['nome_diretor']
            ]);
            //Session::flash('message', 'Successfully created!');
            return redirect('/unidades');
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
        $unidade = Unidade::find($id);
        $users = User::leftJoin('unidades','users.id', '=', 'unidades.tecnico_id')
                ->where('users.active',true)->whereNull('unidades.tecnico_id')
                ->lists('users.name','users.id');
        if($unidade->tecnico instanceof User){
            $users[$unidade->tecnico->id] = $unidade->tecnico->name;
        }
        $orgaos = Orgao::where('active',true)->lists('nome','id');

        return view('unidades.edit', array('unidade'=>$unidade,'users' =>$users, 'orgaos' =>$orgaos  ));
        
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
            'nome' => 'required|unique:unidades,nome,'.$id.'|max:150',
            'sigla' => 'required|max:6|unique:unidades,sigla,'.$id,
            'rua' => 'max:150',
            'numero' => 'max:20',
            'bairro'=> 'max:50',
            'telefone'=> 'max:20',
            'nome_diretor'=> 'max:50',
            'tecnico_id' => 'unique:unidades,tecnico_id,'.$id
        ]);
        if ($validator->fails()) {
            return redirect('unidades/'.$id.'/edit')->withErrors($validator)->withInput();
        } else {
            $unidade = Unidade::find($id);
            $unidade->fill($input);
            $unidade->tecnico_id = empty($input['tecnico_id'])?null:$input['tecnico_id'];
            $unidade->save();
            
            return redirect('unidades');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $unidade = Unidade::find($id);
        $unidade->delete();

        // redirect
        //Session::flash('message', 'Successfully deleted!');
        return redirect('unidades');
    }

}
