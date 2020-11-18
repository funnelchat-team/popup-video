<?php

namespace FunnelchatTeam\PopupVideo\Http\Controllers;


use App\Tutorial;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PopupvideoController extends Controller
{
    public function module_tutorial(Request $request)
    {
        $tutorial = Tutorial::where('module', $request->module)->first();
        if (!is_null($tutorial)) {
            return response()->json($tutorial);
        }
        return response()->json(-1);
    }
}
