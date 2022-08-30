@extends('layouts.backend.app')
@section('content')
<section id="education">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    {{ __('Budget and Coverage') }}
                </h3>
            </header>
            <div class="row">
                <div class="col-md-12">
                    @livewire('chart41')
                </div>
                <div class="col-md-12">
                    @livewire('chart42')
                </div>
                <div class="col-md-12">
                    @livewire('chart38')
                </div>
                <div class="col-md-12">
                    @livewire('chart43')
                </div>
                <div class="col-md-12">
                    @livewire('chart39')
                </div>
                <div class="col-md-12">
                    @livewire('chart40')
                </div>               
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

