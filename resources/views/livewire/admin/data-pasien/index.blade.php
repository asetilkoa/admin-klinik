<div>

    @include('livewire.admin.data-pasien.modal-form')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        Data Pasien
                        <a href="" class="btn btn-outline-primary btn-icon-text float-end mx-2" data-bs-toggle="modal"
                        data-bs-target="#addDtPasien">Add Pasien</a>
                        <input type="search" wire:model="search" class="form-control float-end" style="width: 230px" placeholder="Search Here">
                    </h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomer Rekam Medik</th>
                                <th>Nama</th>
                                <th>Jaminan Kesehatan</th>
                                <th>Action</th>
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
                                    <td>
                                        <a href="#" wire:click="editPasien({{ $pasien->id }})"
                                            data-bs-toggle="modal" data-bs-target="#editDtPasien"
                                            class="btn btn-success btn-rounded btn-icon">
                                            <i class="ti-file btn-icon-append"></i>
                                        </a>
                                        <a href="#" wire:click="deletePasien({{ $pasien->id }})"
                                            data-bs-toggle="modal" data-bs-target="#deleteDtPasien"
                                            class="btn btn-danger btn-rounded btn-icon">
                                            <i class="ti-trash btn-icon-prepend"></i>
                                        </a>
                                        <a href="#" wire:click="showPasien({{ $pasien->id }})"
                                            data-bs-toggle="modal" data-bs-target="#showDtPasien"
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
                    @if (count($pasiens))
                        {{$pasiens->links('paginationnn')}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addDtPasien').modal('hide');
            $('#editDtPasien').modal('hide');
            $('#deleteDtPasien').modal('hide');
        });
    </script>
@endpush
