<section id="education">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    {{ __('User Management') }}
                </h3>
            </header>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="mt-4">
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn waves-effect waves-light btn-success" data-bs-toggle="modal" data-bs-target="#user-modal" wire:click="createUser">Add new role</button>
                            </div>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <button type="button" class="btn waves-waves-light btn-info" data-bs-toggle="modal" data-bs-target="#user-modal" wire:click="selectUser({{ $user->id }})">Edit</button>
                                            <button type="button" class="btn waves-waves-light btn-danger text-white" wire:click="deleteUser({{ $user->id }})" onclick="confirm('Are you sure you want to remove ?') || event.stopImmediatePropagation()">Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- role modal -->
    <div wire:ignore.self id="user-modal" class="modal" tabindex="-1" aria-labelledby="role-and-permission" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="role-and-permission">User Information</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="submitUser">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Enter user name here" wire:model="name">
                        </div>
                        @error('name')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Enter user email here" wire:model="email">
                        </div>
                        @error('email')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Enter user password here" wire:model="password">
                        </div>
                        @error('password')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                        @enderror
                        <button class="btn btn-info" type="submit">Save</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info waves-effect text-white" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.role modal -->
</section>
