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
                'nama' => '16' . $request->id_kab . $request->no_box,
            ]);
            return redirect()->back()->with('success', 'Berhasil Disimpan');
        } catch (QueryException $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function show($id)
    {
        $auth = Auth::user();
        $box = Box::find($id);
        $data = P_Kabkot::where('id_sls', 'like', '16' . $box->id_kab . '%')->get();
        // dd($data);
        return view('box.show', compact('auth', 'id', 'box', 'data'));
    }

    public function update(Request $request, $id)
    {
        $auth = Auth::user();
        $box = Box::find($id);
        // dd($request->all());
        try {
            foreach ($request->id_sls as $sls) {
                // dd(P_Kabkot::find($sls));
                $data = P_Kabkot::find($sls);
                $data->no_box = $box->nama;
                $data->save();
            }
            return redirect()->back()->with('success', 'Berhasil Disimpan');
        } catch (QueryException $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }

        $data = P_Kabkot::where('id_sls', 'LIKE', $box->id_kab . '%');
        // return view('box.show', compact('auth', 'id', 'box', 'data'));
    }


    public function destroy(Request $request)
    {
        // dd($request->all());
        try {
            $box = Box::find($request->id);
            $sls = P_Kabkot::where('no_box', $box->nama)->update([
                'no_box' => NULL,
            ]);
            // dd($sls);
            $data =  box::find($request->id)->delete();
            return redirect()->back()->with('success', 'Berhasil Dihapus');
        } catch (QueryException $ex) {
            return redirect()->back()->with('error', 'Gagal Dihapus');
        }
    }
}
