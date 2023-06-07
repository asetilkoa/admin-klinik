<!-- Modal -->
<div wire:ignore.self class="modal fade" id="addDtPasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Data Pasien</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form wire:submit.prevent="addDtPasien">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col">
                            <label>Nomor Registrasi</label>
                            <input class="form-control" type="text" wire:model.defer="Nomor_Reg" readonly>
                            @error('Nomor_Reg')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col">
                            <label>Nama Lengkap</label>
                            <input class="form-control" type="text" wire:model.defer="Nama_Lengkap">
                            @error('Nama_Lengkap')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="exampleFormControlSelect2">Identitas</label>
                            <select class="form-control" wire:model.defer="Jenis_Identitas">
                                <option selected></option>
                                <option>Ktp</option>
                                <option>Sim</option>
                                <option>Paspor</option>
                            </select>
                            @error('Jenis_Identitas')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col">
                            <label>Nomor Identitas</label>
                            <input class="form-control" type="text" wire:model.defer="Nomor_Identitas" value="">
                            @error('Nomor_Identitas')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Tanggal Lahir</label>
                            <input wire:model.defer="Tanggal_Lahir" type="text" class="form-control datepicker"
                                autocomplete="off" data-provide="datepicker"
                                data-date-autoclose="true" data-date-format="mm/dd/yyyy"
                                data-date-today-highlight="true" onchange="this.dispatchEvent(new InputEvent('input'))">
                            @error('Tanggal_Lahir')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col">
                            <label>Nomor Handphone</label>
                            <input class="form-control" type="text" wire:model.defer="Nomor_Hp">
                            @error('Nomor_Hp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="exampleFormControlSelect2">Golongan darah</label>
                            <select class="form-control" wire:model.defer="Golongan_Darah">
                                <option selected></option>
                                <option>A</option>
                                <option>B</option>
                                <option>O</option>
                                <OPtion>AB</OPtion>
                            </select>
                            @error('Golongan_Darah')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="exampleFormControlSelect2">Gender</label>
                            <select class="form-control" wire:model.defer="Gender">
                                <option selected></option>
                                <option>Laki-Laki</option>
                                <option>Perempuan</option>
                            </select>
                            @error('Gender')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="exampleFormControlSelect2">Agama</label>
                            <select class="form-control" wire:model.defer="Agama">
                                <option selected></option>
                                <option>Islam</option>
                                <option>Kristen</option>
                                <option>Katolik</option>
                                <option>Hindu</option>
                                <option>Budha</option>
                                <option>Khong Hu Cu</option>
                            </select>
                            @error('Agama')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="mb-3">
                            <label for="">Alamat</label>
                            <textarea class="form-control form-control-lg" id="exampleTextarea1" rows="3" wire:model.defer="Alamat"></textarea>
                            @error('Alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label for="exampleFormControlSelect2">Jaminan Kesehatan</label>
                            <select class="form-control" wire:model.defer="Jaminan_Kesehatan">
                                <option selected></option>
                                <option>Umum</option>
                                <option>BPJS</option>
                                <option>PBI</option>
                                <option>Non PBI</option>
                            </select>
                            @error('Jaminan_Kesehatan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col">
                            <label>Nomor Jamkes</label>
                            <input class="form-control" type="text" wire:model.defer="Nomor_Jamkes">
                            @error('Nomor_Jamkes')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div wire:ignore.self class="modal fade" id="editDtPasien" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Data Pasien</h5>
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
                <form wire:submit.prevent="updateDtPasien">
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col">
                                <label>Nomor Registrasi</label>
                                <input class="form-control" type="text" wire:model.defer="Nomor_Reg" readonly>
                                @error('Nomor_Reg')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label>Nama Lengkap</label>
                                <input class="form-control" type="text" wire:model.defer="Nama_Lengkap">
                                @error('Nama_Lengkap')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="exampleFormControlSelect2">Identitas</label>
                                <select class="form-control" wire:model.defer="Jenis_Identitas">
                                    <option selected></option>
                                    <option>Ktp</option>
                                    <option>Sim</option>
                                    <option>Paspor</option>
                                </select>
                                @error('Jenis_Identitas')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label>Nomor Identitas</label>
                                <input class="form-control" type="text" wire:model.defer="Nomor_Identitas">
                                @error('Nomor_Identitas')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Tanggal Lahir</label>
                                <input wire:model.defer="Tanggal_Lahir" type="text" class="form-control datepicker"
                                    autocomplete="off" data-provide="datepicker"
                                    data-date-autoclose="true" data-date-format="mm/dd/yyyy"
                                    data-date-today-highlight="true" onchange="this.dispatchEvent(new InputEvent('input'))">
                                @error('Tanggal_Lahir')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label>Nomor Handphone</label>
                                <input class="form-control" type="text" wire:model.defer="Nomor_Hp">
                                @error('Nomor_Hp')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="exampleFormControlSelect2">Golongan darah</label>
                                <select class="form-control" wire:model.defer="Golongan_Darah">
                                    <option selected></option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>O</option>
                                    <OPtion>AB</OPtion>
                                </select>
                                @error('Golongan_Darah')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="exampleFormControlSelect2">Gender</label>
                                <select class="form-control" wire:model.defer="Gender">
                                    <option selected></option>
                                    <option>Laki-Laki</option>
                                    <option>Perempuan</option>
                                </select>
                                @error('Gender')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="exampleFormControlSelect2">Agama</label>
                                <select class="form-control" wire:model.defer="Agama">
                                    <option selected></option>
                                    <option>Islam</option>
                                    <option>Kristen</option>
                                    <option>Katolik</option>
                                    <option>Hindu</option>
                                    <option>Budha</option>
                                    <option>Khong Hu Cu</option>
                                </select>
                                @error('Agama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="mb-3">
                                <label for="">Alamat</label>
                                <textarea class="form-control form-control-lg" id="exampleTextarea1" rows="3" wire:model.defer="Alamat"></textarea>
                                @error('Alamat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="exampleFormControlSelect2">Jaminan Kesehatan</label>
                                <select class="form-control" wire:model.defer="Jaminan_Kesehatan">
                                    <option selected></option>
                                    <option>Umum</option>
                                <option>BPJS</option>
                                <option>PBI</option>
                                <option>Non PBI</option>
                                </select>
                                @error('Jaminan_Kesehatan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label>Nomor Jamkes</label>
                                <input class="form-control" type="text" wire:model.defer="Nomor_Jamkes">
                                @error('Nomor_Jamkes')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeModal" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteDtPasien" tabindex="-1" role="dialog"
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
                <form wire:submit.prevent="destroyPasien">
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

<!-- show Modal -->
<div wire:ignore.self class="modal fade" id="showDtPasien" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Pasien</h5>
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
                <table class="table table-bordered no-margin">
                    <tbody>
                        <tr>
                            <th>Nomor Registrasi</th>
                            <td>
                                <input class="form-control" type="text" wire:model.defer="Nomor_Reg" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>
                                <input class="form-control" type="text" wire:model.defer="Nama_Lengkap" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Jenis Identitas</th>
                            <td>
                                <input class="form-control" type="text" wire:model.defer="Jenis_Identitas" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Nomor Identitas</th>
                            <td>
                                <input class="form-control" type="text" wire:model.defer="Nomor_Identitas" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>
                                <input class="form-control" type="text" wire:model.defer="Gender" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Golongan Darah</th>
                            <td>
                                <input class="form-control" type="text" wire:model.defer="Golongan_Darah" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>
                                <input class="form-control" type="text" wire:model.defer="Tanggal_Lahir" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>
                                <input class="form-control" type="text" wire:model.defer="Agama" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>
                                <input class="form-control" type="text" wire:model.defer="Alamat" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Nomor Handphone</th>
                            <td>
                                <input class="form-control" type="text" wire:model.defer="Nomor_Hp" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Jaminan Kesehatan</th>
                            <td>
                                <input class="form-control" type="text" wire:model.defer="Jaminan_Kesehatan" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Nomor Jaminan Kesehatan</th>
                            <td>
                                <input class="form-control" type="text" wire:model.defer="Nomor_Jamkes" readonly>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
