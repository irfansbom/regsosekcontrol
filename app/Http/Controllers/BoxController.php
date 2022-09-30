<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Kabs;
use App\Models\Kues;
use App\Models\P_Kabkot;
use Barryvdh\DomPDF\Facade\Pdf;
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

        if ($auth->kd_wilayah == '00') {
            $kab = "";
            if ($request->kab_filter) {
                $kab = $request->kab_filter;
            }
            $kabs = Kabs::all();
        } else {
            $kab = $auth->kd_wilayah;
            $kabs = Kabs::where('id_kab', $auth->kd_wilayah)->get();
        }

        $data = Box::where('kd_kab', "LIKE", "%" . $kab . "%")
            ->where('nama', "LIKE", "%" . $request->box_filter . "%")
            ->paginate(20);
        $data->append($request->all());
        return view('box.index', compact('auth', 'kabs', 'request', 'data'));
    }

    public function store(Request $request)
    {
        $auth = Auth::user();
        try {
            $data = Box::create([
                'kd_kab' => $request->id_kab,
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
        return view('box.show', compact('auth', 'id', 'box', 'data'));
    }

    public function update(Request $request, $id)
    {
        $box = Box::find($id);
        $reset = P_Kabkot::where('no_box', $box->id)
            ->update(['no_box' => null]);
        try {
            if ($request->id_sls) {
                foreach ($request->id_sls as $sls) {
                    $data = P_Kabkot::find($sls);
                    $data->no_box = $box->id;
                    $data->save();
                }
            }
            return redirect()->back()->with('success', 'Berhasil Disimpan');
        } catch (QueryException $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }


    public function destroy(Request $request)
    {
        try {
            $box = Box::find($request->id);
            $sls = P_Kabkot::where('no_box', $box->id)->update([
                'no_box' => NULL,
            ]);
            $data =  box::find($request->id)->delete();
            return redirect()->back()->with('success', 'Berhasil Dihapus');
        } catch (QueryException $ex) {
            return redirect()->back()->with('error', 'Gagal Dihapus');
        }
    }


    public function printbox($id)
    {
        $box = Box::find($id);
        $data = P_Kabkot::where('no_box', $id)
            ->select('id_sls')
            ->groupBy('id_sls')->get();
        $data->map(function ($d) use ($id) {
            $row = P_Kabkot::where('id_sls', $d['id_sls'])
                ->where('no_box', $id)->orderBy('kues')->orderBy('set')->get();
            $d['dok'] = $row;
            return $d;
        });
        // return view('box.print', compact('id', 'data', 'box'));
        $pdf = Pdf::loadView('box.print', compact('id', 'data', 'box'));
        return $pdf->stream();
    }
}
