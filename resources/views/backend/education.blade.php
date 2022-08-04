@extends('layouts.backend.app')
@section('content')
<section id="education">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    {{ __('Education') }}
                </h3>
            </header>
            <div class="row">
                <div class="col-md-6">
                    @livewire('chart1')
                </div>
                <div class="col-md-6">
                    @livewire('chart2')
                </div>
                <div class="col-md-12">
                    @livewire('chart3')
                </div>
                <div class="col-md-6">
                    @livewire('chart4')
                </div>
                <div class="col-md-6">
                    @livewire('chart5')
                </div>
                <div class="col-md-6">
                    @livewire('chart6')
                </div>
                <div class="col-md-6">
                    @livewire('chart7')
                </div>
                <div class="col-md-6">
                    @livewire('chart8')
                </div>
                <div class="col-md-6">
                    @livewire('chart9')
                </div>
                <div class="col-md-6">
                    @livewire('chart10')
                </div>
                <div class="col-md-6">
                    @livewire('chart11')
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
