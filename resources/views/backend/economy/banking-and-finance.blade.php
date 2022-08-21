@extends('layouts.backend.app')
@section('content')
<section id="education">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    {{ __('Economy') }}
                </h3>
            </header>
            <div class="row">
                <div class="col-md-6">
                    @livewire('chart28')
                </div>
                <div class="col-md-6">
                    @livewire('chart29')
                </div>
                <div class="col-md-6">
                    @livewire('chart30')
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
