{{-- show data --}}
<div wire:ignore.self class="modal fade" id="showdtRM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rekam Medis Pasien</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div wire:loading>
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
            @if (isset($penyakit))
                @php
                    $aes = new \App\Utils\Aes();
                @endphp
                @foreach ($penyakit as $item)
                    <ul class="list-group">
                        <li class="list-group-item">{{ $aes->dekripAes($item->nama_penyakit) }}</li>
                    </ul>
                @endforeach
            @endif
        </div>
    </div>
</div>

<!-- delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteDtRM" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Data Pasien</h5>
                <button type="button" class="close" wire:click="closeModal" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div wire:loading>
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="destroyRM">
                    <div class="modal-body">
                        <h4>Anda yakin ingin menghapus data ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModal" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
