@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="statistics-details d-flex align-items-center justify-content-between">
                                    <div>
                                        <p class="statistics-title">Total Pasien</p>
                                        <h3 class="rate-percentage">{{ $totalpasien }}</h3>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="statistics-title">Pasien Tahun Ini</p>
                                        <h3 class="rate-percentage">{{ $thisYearPasien }}</h3>
                                    </div>
                                    <div>
                                        <p class="statistics-title">Data Rekam Medis</p>
                                        <h3 class="rate-percentage">{{ $totalrm }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 d-flex flex-column">
                                <div class="row flex-grow">
                                    <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title card-title-dash">
                                                    Data Pasien
                                                    <a href="DataPasien" class="btn btn-outline-primary btn-icon-text float-end">Add Pasien</a>
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                {{-- <h4 class="card-title card-title-dash">
                                                    Data Pasien
                                                    <a href="DataPasien"
                                                        class="btn btn-outline-primary btn-icon-text float-end">Add
                                                        Pasien</a>
                                                </h4> --}}
                                                <table class="table table-hover ">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nomer Registrasi</th>
                                                            <th>Nama</th>
                                                            <th>Jaminan Kesehatan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php $i = ($pasiens->currentPage() - 1) * $pasiens->perPage() @endphp
                                                        @forelse ($pasiens as $pasien)
                                                            <tr>
                                                                <td>{{ ++$i }}</td>
                                                            <td>{{ $pasien->Nomor_Reg }}</td>
                                                            <td>{{ $pasien->Nama_Lengkap }}</td>
                                                            <td>{{ $pasien->Jaminan_Kesehatan }}</td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="5"
                                                                    class="text-center d-flex justify-content-center">
                                                                    Data Kosong !!
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <div class="row flex-grow">
                                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                        <div class="card bg-primary">
                                            <div class="card-body pb-0">
                                                <h4 class="card-title card-title-dash text-white mb-4">Status Summary</h4>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p class="status-summary-ight-white mb-1">Pasien Hari Ini</p>
                                                        <h2 class="text-info">{{ $todaypasien }}</h2>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="status-summary-chart-wrapper pb-4">
                                                            <canvas id="status-summary"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <h4 class="card-title card-title-dash mb-4">Jumlah Staff admin</h4>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <h2 class="text-info">0</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                                        <div class="card card-rounded">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                                            <div>
                                                                <h4 class="card-title card-title-dash">Leave Report</h4>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <canvas id="leaveReport"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
