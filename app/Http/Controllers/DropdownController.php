<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\State;

class DropdownController extends Controller
{
    public function fetchState(Request $request){
        $state =  State::where("country_id", $request->country_id)
                 ->get(["name", "id"]);

        return response()->json(['status' => true, 'message' => 'State fetched','data' => $state]);
    }
}
