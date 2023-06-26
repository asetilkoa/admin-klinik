<div class="container">
    @include('livewire.admin.penyakit.modal-form')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        Data Penyakit
                        <a href="" class="btn btn-outline-primary btn-icon-text float-end mx-2" data-bs-toggle="modal"
                            data-bs-target="#addDtPenyakit">Add Penyakit</a>
                        <input type="search" wire:model="search" class="form-control float-end" style="width: 230px" placeholder="Search Here">
                    </h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Penyakit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = ($penyakits->currentPage() - 1) * $penyakits->perPage();
                                $aes = new \App\Utils\Aes();
                            @endphp
                            @forelse ($penyakits as $penyakit)
                                <tr>
                                    <td>
                                        {{ ++$i }}
                                    </td>
                                    <td>{{ $aes->dekripAes($penyakit->nama_penyakit) }}</td>
                                    <td>
                                        <a href="#" wire:click="deletePenyakit({{ $penyakit->id }})"
                                            data-bs-toggle="modal" data-bs-target="#deleteDtPenyakit"
                                            class="btn btn-danger btn-rounded btn-icon">
                                            <i class="ti-trash btn-icon-prepend"></i>
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
                    @if (count($penyakits))
                    {{$penyakits->links('paginationnn')}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addDtPenyakit').modal('hide');
            $('#deleteDtPenyakit').modal('hide');
        });
    </script>
@endpush
