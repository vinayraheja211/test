<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\{Country,State,User};
Use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class UserController extends Controller
{
    public function index($id=''){
        $countries = Country::all();
        // dd($user->toArray());
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

    public function update(Request $request,$id){
        $countries = Country::all();
        $user = User::find($id);
        return view('update-user',compact('countries','user'));
    }

    public function insert(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $request->id, 
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
    
        $user = $request->id ? User::findOrFail($request->id) : new User();
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid('file_') . '.' . $extension;
            $path = $file->storeAs('uploads', $filename, 'public');
    
            if ($user->image && file_exists(public_path('storage/uploads/' . $user->image))) {
                unlink(public_path('storage/uploads/' . $user->image));
            }
        } else {
            $filename = $user->image ?? null;
        }
    
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
    
        $user->fill($data);
        $user->save();
    
        return redirect('/')->with('success', $request->id ? 'User data updated successfully' : 'User data inserted successfully');
    }
    

    public function delete(Request $request,$id){
        $user = User::find($id);

        if(!$user){
            return redirect('/')->with('error','User not found');
        }

        $user->delete();

        return redirect('/')->with('success','User delete successfully');
    }

    public function exportUsers(){
        return Excel::download(new UsersExport, 'users.csv');
    }
    
}
