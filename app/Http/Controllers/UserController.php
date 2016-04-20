<?php

namespace App\Http\Controllers;

use App\User;
use App\UserProfile;
use App\Unidade;
use Illuminate\Http\Request;

class UserController extends Controller
{
     public function __construct() {
        $this->middleware('auth');
        $this->middleware('adminMW');
    }
    
    
    public function index() {
        $users = User::orderBy('created_at', 'ASC')->with('profile','unidade')->get();
        return view('users.index', ['users' =>$users ]);
    }
    
  /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    protected function create()
    {
        $profiles = UserProfile::orderBy('name','ASC')->lists('name','id');
        $unidades = Unidade::whereNull( 'tecnico_id')->orderBy('nome','ASC')->lists('nome','id');
        return view('users.create',['profiles' => $profiles, 'unidades' => $unidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
          $validator = validator($request->all(), [
            'name' => 'required|max:150',
            'username' => 'regex:/(^[A-Za-z0-9]+$)+/|required|max:10|unique:users',
            'email' => 'required|max:150|unique:users',
            'profile_id' => 'required',
            'active'=> 'required',
        ]);
        if (!$validator->fails() && $request['unidade_id'] != '') {
            $existe = Unidade::where('id','=',$request['unidade_id'])->whereNotNull('tecnico_id')->exists();
            if($existe){
                $validator->after(function($validator) {
                    $validator->errors()->add('unidade_id', 'A unidade já está vinculada a outro usuário');
                });
            }
        }

        if ($validator->fails()) {
            return redirect('users/create')->withErrors($validator)->withInput();
        } else {
           $insertID = User::create([
                'name' => $request['name'],
                'username' => $request['username'],
                'email' => $request['email'],
                'profile_id' => $request['profile_id'],
                'active'=> $request['active'],
                'password' => bcrypt($request['username'].'-sigeeq'),
            ])->id;
           if($request['unidade_id'] != ''){
                $unidade = Unidade::find($request['unidade_id']);
                if($unidade instanceof Unidade){
                    $unidade->tecnico_id = $insertID;
                    $unidade->save();
                }
           }
            //Session::flash('message', 'Successfully created!');
            return redirect('/users');
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
        $user = User::find($id);
        $unidade_id = '';
        if($user->unidade instanceof Unidade){
            $unidade_id = $user->unidade->id;
        }
        $profiles = UserProfile::orderBy('name','ASC')->lists('name','id');
        $unidades = Unidade::whereNull( 'tecnico_id')->orWhere('tecnico_id','=',$user->id)->orderBy('nome','ASC')->lists('nome','id');
        return view('users.edit', array('user'=>$user,'profiles' =>$profiles, 'unidades'=> $unidades,'unidade_id'=>$unidade_id));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request) {
        $input = $request->all();
        if(intval($id) !== 1){
            $validator = validator($input, [
                'name' => 'required|max:150',
                'username' => 'regex:/(^[A-Za-z0-9]+$)+/|required|max:10|unique:users,username,'.$id,
                'email' => 'required|max:150|unique:users,email,'.$id,
                'profile_id' => 'required',
                'active'=> 'required',
            ]);
        }else{
            $validator = validator($input, [
            'name' => 'required|max:150',
            'email' => 'required|max:150|unique:users,email,'.$id,
            ]);
        }
        
        if (!$validator->fails()){
            if($input['unidade_id'] != ''){
                $existe = Unidade::where('id','=',$input['unidade_id'])->where('tecnico_id','<>',$id)->whereNotNull('tecnico_id')->exists();
                if($existe){
                    $validator->after(function($validator) {
                        $validator->errors()->add('unidade_id', 'A unidade está vinculada a outro usuário');
                    });
                }
            }else{
                $input['unidade_id'] = NULL;
            }
        }
        
        if ($validator->fails()) {
            return redirect('users/'.$id.'/edit')->withErrors($validator)->withInput();
        } else {
            
            $user = User::findOrFail($id);
            if(intval($id) !== 1){
                $user->fill($input);
            }else{
                $user->name = $input['name'];
                $user->email = $input['email'];
            }
            $user->save();
            $mudouUnidade = FALSE;
            if($user->unidade instanceof Unidade){
                if($input['unidade_id'] != $user->unidade->id){
                    $mudouUnidade = TRUE;
                    $unidade = $user->unidade;
                    $unidade->tecnico_id = NULL;
                    $unidade->save();
                }
           }elseif($input['unidade_id'] != ''){
               $mudouUnidade = TRUE;
           }
           if($mudouUnidade){
                $unidadeNova = Unidade::find($input['unidade_id']);
                if($unidadeNova instanceof Unidade){
                    $unidadeNova->tecnico_id = $id;
                    $unidadeNova->save();
                }
           }
           
            
            
            return redirect('users');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        if(intval($id) !== 1){
            $user = User::findOrFail($id);
            $user->usename = $user->usename." #E";
            $user->email = $user->email." #E";
            $unidade = $user->unidade;
            $user->save();
            if($unidade  instanceof Unidade){
                $unidade->tecnico_id = NULL;
                $unidade->save();
            }
            $user->delete();
        }
        // redirect
        //Session::flash('message', 'Successfully deleted!');
        return redirect('users');
    }
    
}
