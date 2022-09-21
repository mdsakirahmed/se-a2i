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
                        <form class="row mt-4" wire:submit.prevent="submit">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" readonly value="{{ auth()->user()->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" readonly value="{{ auth()->user()->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Enter your old password" wire:model="old_password">
                                </div>
                                @error('old_password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Enter a new password" wire:model="new_password">
                                </div>
                                @error('new_password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <button class="btn btn-info" type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
