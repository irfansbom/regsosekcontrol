<?php

namespace App\Http\Controllers;

use App\Models\Desas;
use App\Models\Kabs;
use App\Models\Kecs;
use App\Models\Sls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $auth = Auth::user();
        // dd($auth->can('user_list'));
        return view('home', compact('request', 'auth'));
    }

    public function getkec(Request $request)
    {
        $res = Kecs::where('id_kab', $request->id_kab)->get();
        if ($res) {
            return response()->json([
                'kec' => $res,
                'status' => 'berhasil',
            ]);
        } else {
            return response()->json([
                'kec' => ['nama_kab' => 'tidak ada'],
                'status' => 'berhasil',
            ]);
        }
    }

    public function getdesa(Request $request)
    {
        $res = Desas::where('id_kab', $request->id_kab)
            ->where('id_kec', $request->id_kec)->get();
        if ($res) {
            return response()->json([
                'desa' => $res,
                'status' => 'berhasil',
            ]);
        } else {
            return response()->json([
                'desa' => ['nama_kec' => 'tidak ada'],
                'status' => 'berhasil',
            ]);
        }
    }
    public function getsls(Request $request)
    {
        $res = Sls::where('kd_kab', $request->id_kab)
            ->where('kd_kec', $request->id_kec)
            ->where('kd_desa', $request->id_desa)
            ->get();
        if ($res) {
            return response()->json([
                'sls' => $res,
                'status' => 'berhasil',
            ]);
        } else {
            return response()->json([
                'sls' => ['nama_desa' => 'tidak ada'],
                'status' => 'berhasil',
            ]);
        }
    }
}
