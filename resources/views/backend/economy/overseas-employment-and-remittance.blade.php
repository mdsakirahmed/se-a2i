@extends('layouts.backend.app')
@section('content')
<section id="overviewOftheEconomy">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    {{ __('Overseas Employment and Remittance') }}
                </h3>
            </header>
            <div class="card-lg">
                <div class="block-group">
                    <div class="block-60">
                        <p class="mb-md-4">
                            <span class="c-secondary fw-bold">{{ __('remittance green text') }}</span>,
                            {{ __('remittance description 1') }}
                        </p>
                        <p>
                            <span class="c-primary fw-bold">{{ __('remittance purple text') }}</span>
                            {{ __('remittance description 2') }}
                        </p>
                    </div>
                    <div class="block-40">
                        <img src="{{ asset('assets/img/employement.png') }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-5">
                    @livewire('chart16')
                </div>
                <div class="col-md-12 mb-5">
                    @livewire('chart17')
                </div>
                <div class="col-md-12 mb-5">
                    @livewire('chart18')
                </div>
                <div class="col-md-12 mb-5">
                    @livewire('chart19')
                </div>
                <div class="col-md-12 mb-5">
                    @livewire('chart20')
                </div>
                <div class="col-md-12 mb-5">
                    @livewire('chart21')
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

