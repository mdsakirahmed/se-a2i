@extends('layouts.backend.app')
@section('content')
<section id="education">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    {{ __('Social Protection') }}
                </h3>
            </header>
            <div class="row">
                <div class="col-md-6 mb-4">
                    @livewire('chart31')
                </div>
                <div class="col-md-6 mb-4">
                    @livewire('chart34')
                </div>
                <div class="col-md-6 mb-4">
                    @livewire('chart32')
                </div>
                <div class="col-md-6 mb-4">
                    @livewire('chart35')
                </div>
                <div class="col-md-6 mb-4">
                    @livewire('chart33')
                </div>
                <div class="col-md-6 mb-4">
                    @livewire('chart36')
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

