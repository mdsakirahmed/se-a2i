@extends('layouts.backend.app')
@section('content')
<section id="overviewOftheEconomy">
    <div class="content-area">
        <div class="container">
            <header>
                <div class="custom">
                    <h3>
                        {{ __('Overview of the Economy') }}
                    </h3>
                </div>
            </header>
            <div class="hero-header">
                <div class="block-group">
                    <div class="block-60">
                        <h3>
                          {{ __('overview of the economy green text') }}</h3>
                        <p>
                        {{ __('overview of the economy description 1') }}
                        </p>
                    </div>
                    <div class="block-40">
                        <img src="{{ asset('assets/img/economy2.png') }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-5">
                    @livewire('chart12')
                </div>
                <div class="col-md-12 mb-5">
                    @livewire('chart13')
                </div>
                <div class="col-md-12 mb-5">
                    @livewire('chart14')
                </div>
                <div class="col-md-12 mb-5">
                    @livewire('chart15')
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
