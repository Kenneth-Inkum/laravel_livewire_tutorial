<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Users</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                {{-- @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fa fa-check-circle mr-1"></i>{{ session('message') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span>
                                &times;
                            </span>
                        </button>
                    </div>
                @endif --}}

                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-end mb-3">
                            <button wire:click.prevent="addNew" class="btn btn-primary"><i
                                    class="fa fa-plus-circle mr-1"></i> Add New
                                User</button>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $user['name'] }}</td>
                                                <td>{{ $user['email'] }}</td>
                                                <td>
                                                    <a href="" wire:click.prevent="edit({{ $user }})"
                                                        class="fa fa-edit mr-3"></a>
                                                    <a href="" class="fa fa-trash text-danger"></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

        <!-- Modal -->
        <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog"
            aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog" role="document">
                <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateUser' : 'createUser' }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fs-5" id="exampleModalLabel">
                                @if ($showEditModal)
                                    <span>Edit User</span>
                                @else
                                    <span>Add New User</span>
                                @endif
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" wire:model.defer="state.name"
                                    class="form-control @error('name')is-invalid @enderror" id="name"
                                    aria-describedby="nameHelp" placeholder="Enter your fullname">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" wire:model.defer="state.email"
                                    class="form-control @error('email')is-invalid @enderror" id="email"
                                    aria-describedby="emailHelp" placeholder="Enter your email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                    anyone else</small>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" wire:model.defer="state.password"
                                    class="form-control @error('password')is-invalid @enderror" id="password"
                                    placeholder="Enter your password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="passwordConfirmation" class="form-label">Confirm Password</label>
                                <input type="password" wire:model.defer="state.password_confirmation"
                                    class="form-control @error('password')is-invalid @enderror"
                                    id="passwordConfirmation" placeholder="Re-enter password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-times mr-1"></i> Cancel</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
                                @if ($showEditModal)
                                    <span> Save Changes</span>
                                @else
                                    <span> Save</span>
                                @endif
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @push('js')
            <script>
                window.addEventListener('show-form', event => {
                    $('#form').modal('show');
                })

                window.addEventListener('hide-form', event => {
                    $('#form').modal('hide');
                    toastr.success(event.detail.message, 'success!');
                })
            </script>
        @endpush
    </div>
</div>
