@extends('layouts.backend.app')
@section('content')
<section id="about">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    {{ __('About') }}
                </h3>
            </header>
            <div class="card-lg">
                <div class="block-group">
                    <div class="block-70">
                    <h5 class="c-primary fw-bold">{{ __('about title 1') }}</h4>
                        <p class="mb-md-4">{{ __('about description 1') }}</p>
                        <h5 class="c-secondary fw-bold">{{ __('about title 2') }}</h5>
                        <p>{{ __('about description 1') }}</p>
                    </div>
                    <div class="block-30">
                        <img src="{{ asset('assets/img/about2.png') }}" />
                    </div>
                </div>
            </div>
            <div class="card-primary">
                <p>{{ __('about title 3') }}</p>
            </div>
            <div id="dataConcept">
                <header>
                    <h3>{{ __('about title 4') }}</h3>
                </header>
                <div class="block-group mt-5">
                    <div class="block">
                        <div class="desktop">
                            <img src="{{ asset('assets/img/demo.png') }}" />
                        </div>
                        <div class="mobile">
                            <img src="{{ asset('assets/img/demo-moblie.png') }}" />
                        </div>
                    </div>
                </div>
            </div>
            @livewire('chart37')
            @livewire('chart1')
            @livewire('chart13')
            @livewire('chart18')
        </div>
    </div>
</section>
@endsection