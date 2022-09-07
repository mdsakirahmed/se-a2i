@extends('layouts.backend.app')
@section('content')
<section id="about">
    <div class="content-area">
        <div class="container">
            <header>
                <div class="custom">
                    <h3>
                        {{ __('About') }}
                    </h3>
                </div>
            </header>
            <div class="hero-header">
                <div class="block-group">
                    <div class="block-60">
                    <h3>{{ __('about title 1') }}</h3>
                        <p>{{ __('about description 1') }}</p>

                        <!-- <h5 class="c-secondary fw-bold">{{ __('about title 2') }}</h5>
                        <p>{{ __('about description 1') }}</p> -->
                    </div>
                    <div class="block-40">
                        <img src="{{ asset('assets/img/about-hero-header.png') }}" />
                    </div>
                </div>
            </div>
            <div class="card-primary">
                <p>{{ __('about description 2') }}</p>
            </div>
            <div id="dataConcept">
                <header>
                    <h3>{{ __('about title 4') }}</h3>
                </header>
                <div class="block-group mt-5">
                    <div class="block">
                        <div class="desktop">
                            <img src="{{ asset('assets/img/demo1.png') }}" />
                        </div>
                        <div class="mobile">
                            <img src="{{ asset('assets/img/demo1-moblie.png') }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-5">
                @livewire('chart37')
            </div>
            <div class="col-md-12 mb-5">
                 @livewire('chart1')
            </div>

            <div class="col-md-12 mb-5">
                @livewire('chart13')
            </div>

            <div class="col-md-12 mb-5">
                 @livewire('chart18')
            </div>    
           
        </div>
    </div>
</section>
@endsection