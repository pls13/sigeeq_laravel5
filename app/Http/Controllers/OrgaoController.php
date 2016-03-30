<?php

namespace App\Http\Controllers;

use App\Orgao;
use Illuminate\Http\Request;

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
          $validator = validator($request->all(), [
            'nome' => 'required|unique:orgaos|max:150',
            'sigla' => 'required|max:6|unique:orgaos',
            'active' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('orgaos/create')->withErrors($validator)->withInput();
        } else {
            Orgao::create([
                'nome' => $request['nome'],
                'sigla' => $request['sigla'],
                'active' =>$request['active'],
            ]);
            //Session::flash('message', 'Successfully created!');
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
    public function edit($id)
    {
        $orgao = Orgao::find($id);

        return view('orgaos.edit')
            ->with('orgao', $orgao);
        
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
            'nome' => 'required|unique:orgaos,nome,'.$id.'|max:150',
            'sigla' => 'required|max:6|unique:orgaos,sigla,'.$id,
            'active' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('orgaos/'.$id.'/edit')->withErrors($validator)->withInput();
        } else {
            $orgao = Orgao::find($id);
            $orgao->fill($input)->save();
            
            return redirect('orgaos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $orgao = Orgao::find($id);
        $orgao->delete();

        // redirect
        //Session::flash('message', 'Successfully deleted!');
        return redirect('orgaos');
    }

}
