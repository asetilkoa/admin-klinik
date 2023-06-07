{{-- show data --}}
<div wire:ignore.self class="modal fade" id="showdtRM" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rekam Medis Pasien</h5>
                <button type="button" class="close" data-bs-dismiss="modal"
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
            @if(isset($penyakit))
                @foreach($penyakit as $item)
                    <ul class="list-group">
                        <li class="list-group-item">{{ $item->nama_penyakit }}</li>
                    </ul>
                @endforeach
           @endif
        </div>
    </div>
</div>
