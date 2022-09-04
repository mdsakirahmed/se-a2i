@extends('layouts.backend.app')
@section('content')
<section id="overviewOftheEconomy">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    {{ __('Overview of the Economy') }}
                </h3>
            </header>
            <div class="card-lg">
                <div class="block-group">
                    <div class="block-60">
                        <p class="mb-md-4">
                            <span class="c-secondary fw-bold">{{ __('overview of the economy green text') }}</span>,
                            {{ __('overview of the economy description 1') }}
                        </p>
                        <p>
                            <span class="c-primary fw-bold">{{ __('overview of the economy purple text') }}</span>
                            {{ __('overview of the economy description 2') }}
                        </p>
                    </div>
                    <div class="block-40">
                        <img src="{{ asset('assets/img/economy2.png') }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-4">
                    @livewire('chart12')
                </div>
                <div class="col-md-12 mb-4">
                    @livewire('chart13')
                </div>
                <div class="col-md-12 mb-4">
                    @livewire('chart14')
                </div>
                <div class="col-md-12 mb-4">
                    @livewire('chart15')
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
