<div class="container">
    @include('livewire.admin.user.modal-form')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        Data User
                        <a href="" class="btn btn-outline-primary btn-icon-text float-end mx-2" data-bs-toggle="modal"
                        data-bs-target="#addDtUser">Add User</a>
                    </h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role == '0')
                                            <label class="badge badge-info">User</label>
                                        @elseif ($user->role == '1')
                                            <label class="badge badge-success">Admin</label>
                                        @else
                                            <label class="badge badge-dange">Kosong</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" wire:click="editUser({{ $user->id }})"
                                            data-bs-toggle="modal" data-bs-target="#editUser"
                                            class="btn btn-success btn-rounded btn-icon">
                                            <i class="ti-file btn-icon-append"></i>
                                        </a>
                                        <a href="#" wire:click="deleteUser({{ $user->id }})"
                                            data-bs-toggle="modal" data-bs-target="#destroyUser"
                                            class="btn btn-danger btn-rounded btn-icon">
                                            <i class="ti-eraser btn-icon-prepend"></i>
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
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addDtUser').modal('hide');
            $('#editUser').modal('hide');
            $('#destroyUser').modal('hide');
        });
    </script>
@endpush
