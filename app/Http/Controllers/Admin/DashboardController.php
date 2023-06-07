<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\DataPasien;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\RiwayatPenyakit;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
    //  untuk menghitung total data
        $hariini = Carbon::now()->format('Y-m-d');
        // $bulanini = Carbon::now()->format('m');
        $tahunini = Carbon::now()->format('Y');

        $totalpasien = DataPasien::count();
        $totalrm = RiwayatPenyakit::count();
        $todaypasien = DataPasien::whereDate('created_at', $hariini)->count();
        // $monthPasien = DataPasien::whereMonth('created_at', $bulanini)->count();
        $thisYearPasien = DataPasien::whereYear('created_at', $tahunini)->count();

//     menampilkan data serta membatasi hanya 5 data
        $pasiens = DataPasien::orderBy('id', 'DESC')->paginate(5);

        return view('admin.dashboard', compact('hariini', 'tahunini', 'totalpasien', 'todaypasien', 'thisYearPasien', 'pasiens', 'totalrm'));
    }
}
