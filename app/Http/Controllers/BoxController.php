<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Kabs;
use App\Models\Kues;
use App\Models\P_Kabkot;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoxController extends Controller
{
    //
    public function index(Request $request)
    {
        $auth = Auth::user();
        $kabs = Kabs::all();
        $data = Box::paginate(20);
        // $data->map(function ($d) {
        //     $row = P_Kabkot::where('id_sls', $d['id_sls'])->orderBy('kues')->orderBy('set')->get();
        //     $d['dok'] = $row;
        //     return $d;
        // });
        $data->append($request->all());
        return view('box.index', compact('auth', 'kabs', 'request', 'data'));
    }
    public function store(Request $request)
    {
        $auth = Auth::user();
        try {
            $data = Box::create([
                'id_kab' => $request->id_kab,
                'nama' => $request->no_box,
            ]);
            return redirect()->back()->with('success', 'Berhasil Disimpan');
        } catch (QueryException $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }
}
