<?php

namespace App\Http\Controllers;

use App\Models\Kabs;
use App\Models\P_Koseka;
use App\Models\Sls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class P_KosekaController extends Controller
{
    //

    public function index(Request $request)
    {
        $auth = Auth::user();
        $kabs = Kabs::all();
        $data = P_Koseka::join('sls', 'sls.id_sls', 'p_koseka.id_sls')->paginate(20);

        $data->append($request->all());
        return view('p_koseka.index', compact('auth', 'kabs', 'data', 'request'));
    }
}
