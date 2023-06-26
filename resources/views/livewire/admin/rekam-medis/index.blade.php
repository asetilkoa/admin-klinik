<div>
    @include('livewire.admin.rekam-medis.modal-form')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        Laporan Rekam Medis
                        <input type="search" wire:model="search" class="form-control float-end" style="width: 230px" placeholder="Search Here">
                    </h4>
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomer Rekam Medis</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = ($riwayatPenyakit->currentPage() - 1) * $riwayatPenyakit->perPage();
                                $aes = new \App\Utils\Aes();
                            @endphp
                            @forelse ($riwayatPenyakit as $riwayat)
                                <tr>
                                    <td>
                                        {{ ++$i }}
                                    </td>
                                    <td>
                                        {{$aes->dekripAes($riwayat->Nomor_Reg)}}
                                    </td>
                                    <td>
                                        {{$aes->dekripAes($riwayat->Nama_Lengkap)}}
                                    </td>
                                    <td>
                                        <a href="#" wire:click="deleteRm({{ $riwayat->id }})"
                                            data-bs-toggle="modal" data-bs-target="#deleteDtRM"
                                            class="btn btn-danger btn-rounded btn-icon">
                                            <i class="ti-trash btn-icon-prepend"></i>
                                        </a>
                                        <a href="#" wire:click="showRM({{$riwayat->id}})"
                                            data-bs-toggle="modal" data-bs-target="#showdtRM"
                                            class="btn btn-info btn-rounded btn-icon">
                                            <i class="ti-new-window btn-icon-prepend"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center d-flex justify-content-center">
                                        Data Kosong !!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if (count($riwayatPenyakit))
                        {{$riwayatPenyakit->links('paginationnn')}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
