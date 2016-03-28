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
    }
    
    
    public function index() {
        $users = User::orderBy('created_at', 'ASC')->get();
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
        return view('users.create',array('profiles' => $profiles));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
          $validator = validator($request->all(), [
            'name' => 'required|max:150',
            'username' => 'required|max:10|unique:users',
            'email' => 'required|max:150|unique:users',
            'profile_id' => 'required',
            'active'=> 'required',
        ]);

        if ($validator->fails()) {
            return redirect('users/create')->withErrors($validator)->withInput();
        } else {
            User::create([
                'name' => $request['name'],
                'username' => $request['username'],
                'email' => $request['email'],
                'profile_id' => $request['profile_id'],
                'active'=> $request['active'],
                'password' => bcrypt($request['username'].'-sigeeq'),
            ]);
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
        $profiles = UserProfile::orderBy('name','ASC')->lists('name','id');
        return view('users.edit', array('user'=>$user,'profiles' =>$profiles));
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
            'name' => 'required|max:150',
            'username' => 'required|max:10|unique:users,username,'.$id,
            'email' => 'required|max:150|unique:users,email,'.$id,
            'profile_id' => 'required',
            'active'=> 'required',
        ]);
        if ($validator->fails()) {
            return redirect('users/'.$id.'/edit')->withErrors($validator)->withInput();
        } else {
            $user = User::findOrFail($id);
            $user->fill($input);
            $user->save();
            
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
        $user = User::find($id);
        $user->delete();
        // redirect
        //Session::flash('message', 'Successfully deleted!');
        return redirect('users');
    }
    

}
