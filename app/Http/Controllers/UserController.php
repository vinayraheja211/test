<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\{Country,State,User};
Use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $countries = Country::all();
        return view('Welcome',compact('countries'));
    }

    public function allUsers(){
        $users = User::select('users.*','countries.name as country','states.name as state')
                 ->join('countries','users.country_id','=','countries.id')
                 ->join('states','users.state_id','=','states.id')
                 ->get(); 
                //  dd($users->toArray());
        return view('all-users',compact('users'));
    }

    public function insert(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email', 
            'phone' => 'required|string',
            'countrty' => 'required',
            'state' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            // 'file' => '' 
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // dd($request->all());
        $file = $request->file('file');
        $extension = $file->getClientoriginalExtension();
        $filename = uniqid('file_') . '.' . $extension;
        $path = $file->storeAs('uploads', $filename, 'public');
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'country_id' => $request->countrty,
            'state_id' => $request->state,
            'city' => $request->city,
            'image' => $filename
        ];

        $user = User::create($data);
        return redirect('/')->with('success','user Data insert successfully');
    }

    public function delete(Request $request,$id){
        $user = User::find($id);

        if(!$user){
            return redirect('/')->with('error','User not found');
        }

        $user->delete();

        return redirect('/')->with('success','User delete successfully');
    }
    
}
