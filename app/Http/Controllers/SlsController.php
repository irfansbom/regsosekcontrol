<?php

namespace App\Http\Controllers;

use App\Models\Kabs;
use App\Models\Sls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SlsController extends Controller
{
    //

    public function index(Request $request)
    {
        $auth = Auth::user();
        $kabs = Kabs::all();
        $data = Sls::paginate(20);
        $data->append($request->all());
        return view('sls.index', compact('auth', 'kabs', 'data', 'request'));
    }
}
