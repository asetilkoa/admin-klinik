<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Input Riwayat Penyakit</h2><hr>
            <form action="{{url('admin/penyakit/create')}}" id="riwayatPenyakitForm" method="POST">
                @csrf
                {{-- Step 1 --}}
                @if ($currentStep == 1)
                <div class="step-one">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <h4 class="card-title ">1. Data Pasien</h4><hr>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Find Pasien</label>
                                        <select class="js-example-basic-single w-100" id="selectpasien">
                                            <option selected disabled>Ketik Nama Pasien</option>
                                            @foreach($pasiens as $pasien)
                                                <option value="{{ $pasien->id }}">{{$pasien->Nama_Lengkap}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button type="button" id="lihatPasien" class="btn btn-outline-primary btn-icon-text" style="width: 100%">
                                                <i class="mdi mdi-account-check m-2"></i>Pilih Pasien</a>
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-outline-success mb-2" style="width: 100%" wire:click="halamanpas">
                                                <i class="mdi mdi-account m-2"></i>Create Data Pasien</a>
                                            </button>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-outline-danger mb-2" style="width: 100%" wire:click="ResetAll">
                                                <i class="ti-reload btn-icon-prepend m-2"></i>Reset All</a>
                                            </button>
                                        </div>
                                    </div><hr>
                                    <div class="form-group">
                                        <label for="">No. Rekam Medik</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" id="no_rekam_medik" readonly>
                                        <label for="">Nama Pasien</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" id="nama_pasien" readonly>
                                        <label for="">No. Ktp</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" id="no_ktp" readonly>
                                        <label for="">Alamat</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" id="alamat" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Step 2 --}}
                @if ($currentStep ==2)
                <div class="step-two">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <h4 class="card-title ">2. Input Riwayat Penyakit</h4><hr>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nama Pasien</label>
                                        <input type="text" class="form-control mb-2 mr-sm-2" id="nama_pasien" readonly>
                                    </div>
                                    <label for="">Input Penyakit Pasien</label>
                                        <br>
                                    <div class="checkbox-inline">
                                        <div class="row">
                                            @foreach ($penyakits as $penyakit)
                                            <div class="col-sm-3">
                                                <label class="form-check-label">
                                                    <input type="checkbox" name="cbpasien[]" class="form-check-input" value="{{ $penyakit->id }}">
                                                    {{ $penyakit->nama_penyakit }}
                                                    <br>
                                                </label><br>
                                            </div><br>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="action-button d-flex justify-content-between pt-2 pb-2">

                    @if ($currentStep == 1)
                        <div></div>
                    @endif

                    @if ($currentStep == 1)
                        <button type="button" class="btn btn-success" wire:click="incraseStep()">Next</button>
                    @endif

                    @if ($currentStep == 2)
                        <button type="button" class="btn btn-warning" wire:click="decraseStep()">Back</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('refresh-page', event => {
            window.location.reload(false);
        })
    </script>
    <script>
        $(document).ready(function() {
            var ID_PASIEN = 0;

            window.initSelectPasienrop=()=>{
                $('#selectpasien').select2({
                    placeholder: 'Ketik Nama Pasien',
                    allowClear: true});
            }
            window.livewire.on('select2',()=>{
                initSelectPasienrop();
            });

            $('#lihatPasien').click(function(e){
                e.preventDefault();
                $.ajax({
                    data: {
                        'id': $('#selectpasien').val(),
                        '_token': "{{csrf_token()}}"
                    },
                    method: 'POST',
                    url: "{{url('admin/riwayatDetail')}}",
                    success: function(data){
                        $('#no_rekam_medik').val(data.pasien.Nomor_Reg);
                        $('#nama_pasien').val(data.pasien.Nama_Lengkap);
                        $('#no_ktp').val(data.pasien.Nomor_Identitas);
                        $('#alamat').val(data.pasien.Alamat);
                        $('#id_pasien').val(data.pasien.id);
                        ID_PASIEN = data.pasien.id;
                        console.log(data);
                    }
                })
            });

            $('#riwayatPenyakitForm').submit(function(e){
                e.preventDefault();
                var selectedPasien = [];
                var checkboxes = document.querySelectorAll('input[name="cbpasien[]"]:checked');
                for (var i = 0; i < checkboxes.length; i++) {
                    selectedPasien.push(checkboxes[i].value);
                }
                $.ajax({
                    data: {
                        'id_pasien': ID_PASIEN,
                        'cbpasien':selectedPasien,
                        '_token': "{{csrf_token()}}"
                    },
                    method: 'POST',
                    url: "{{url('admin/penyakit/create')}}",
                    success: function(data){
                        alertify.success(data.message);
                        setTimeout(function() {
                        location.reload();
                        }, 1000);
                    },
                    error: function(data){
                        alertify.error('Oops, something went wrong!');
                    }
                });
            })

        });
    </script>
@endpush
