<section id="education">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    {{ __('Role Permission') }}
                </h3>
            </header>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <ul class="nav nav-tabs" id="" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button wire:click="tabChange('role')"
                                    class="nav-link  @if($tab == 'role') active @endif" id="role-tab"
                                    data-bs-toggle="tab" data-bs-target="#role" type="button" role="tab"
                                    aria-controls="role" aria-selected="true">Role</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button wire:click="tabChange('permission')"
                                    class="nav-link @if($tab == 'permission') active @endif" id="profile-tab"
                                    data-bs-toggle="tab" data-bs-target="#permission" type="button" role="tab"
                                    aria-controls="permission" aria-selected="false">Permission</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="">
                            <div class="tab-pane fade @if($tab == 'role') show active @endif" id="role" role="tabpanel"
                                aria-labelledby="role-tab">
                                <div class="p-20">
                                    <div class="button-group">
                                        <button type="button" class="btn waves-effect waves-light btn-success"
                                            data-bs-toggle="modal" data-bs-target="#role-modal"
                                            wire:click="createRole">Add new role</button>
                                    </div>
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Permission</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $role)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td><span class="badge bg-success">{{ $role->name }}</span></td>
                                                <td>{{ $role->permissions->count() }}</td>
                                                <td>{{ $role->users->count() }}</td>
                                                <td>
                                                    <button type="button" class="btn waves-waves-light btn-info"
                                                        data-bs-toggle="modal" data-bs-target="#role-modal"
                                                        wire:click="selectRole({{ $role->id }})">Edit</button>
                                                    <button type="button"
                                                        class="btn waves-waves-light btn-danger text-white"
                                                        wire:click="deleteRole({{ $role->id }})"
                                                        onclick="confirm('Are you sure you want to remove ?') || event.stopImmediatePropagation()">Delete</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade @if($tab == 'permission') show active @endif" id="permission"
                                role="tabpanel" aria-labelledby="permission-tab">
                                <div class="p-20">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Roles</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($permissions as $permission)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td><span class="badge bg-success">{{ $permission->name }}</span></td>
                                                <td>
                                                    @foreach ($permission->roles as $role)
                                                    <span
                                                        class="badge @if($loop->odd) bg-info @else bg-dark @endif btn m-1">
                                                        {{ $role->name }} ({{ $role->users->count() }})
                                                    </span>
                                                    @endforeach
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
        </div>
    </div>
        <!-- role modal -->
        <div wire:ignore.self id="role-modal" class="modal" tabindex="-1" aria-labelledby="role-and-permission" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="role-and-permission">Role and permission</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="submitRole">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Enter role here" wire:model="role_name">
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="submit">Save</button>
                                </div>
                            </div>
                            @error('role_name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </form>
                        @if($selected_role)
                        @foreach ($permissions as $permission)
                        <label class="badge bg-success btn m-1" for="permission_no_{{ $permission->id }}">
                            <input type="checkbox" class="form-check-input" id="permission_no_{{ $permission->id }}" value="{{ $permission->id }}" wire:model="selected_permissions.{{ $permission->id }}" wire:click="checkPermission('{{ $permission->name }}')"> {{ $loop->iteration }}) {{ $permission->name }}
                        </label>
                        @endforeach
                        @error("'selected_permissions.*")
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        @endif
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