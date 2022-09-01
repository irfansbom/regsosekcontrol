<?php

namespace App\Http\Controllers;

use App\Models\Kabs;
use App\Models\Kues;
use App\Models\P_Kabkot;
use App\Models\Sls;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class P_KabkotController extends Controller
{
    //
    public function index(Request $request)
    {
        $auth = Auth::user();
        $kabs = Kabs::all();
        $kues = Kues::all();
        $data = P_Kabkot::select('id_sls')->groupBy('id_sls')->paginate(10);
        $data->map(function ($d) {
            $row = P_Kabkot::where('id_sls', $d['id_sls'])->orderBy('kues')->orderBy('set')->get();
            $d['dok'] = $row;
            return $d;
        });
        $data->append($request->all());
        return view('p_kabkot.index', compact('auth', 'kabs', 'kues', 'request', 'data'));
    }

    public function store(Request $request)
    {
        $auth = Auth::user();
        try {
            $data = P_Kabkot::create([
                'id_sls' => $request->id_sls,
                'kues' => $request->kues,
                'set' => $request->set,
            ]);
            return redirect()->back()->with('success', 'Berhasil Disimpan');
        } catch (QueryException $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }


    public function destroy(Request $request)
    {
        // dd($request->all());
        try {
            $data =  P_Kabkot::where('id', $request->id)->delete();
            return redirect()->back()->with('success', 'Berhasil Dihapus');
        } catch (QueryException $ex) {
            return redirect()->back()->with('error', 'Gagal Dihapus');
        }
    }
}
