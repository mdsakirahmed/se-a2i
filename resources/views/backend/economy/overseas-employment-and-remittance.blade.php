@extends('layouts.backend.app')
@section('content')
<section id="overviewOftheEconomy">
    <div class="content-area">
        <div class="container">
            <header>
                <div class="custom">
                    <h3>
                    {{ __('Overseas Employment and Remittance') }}
                    </h3>
                </div>
            </header>
            <div class="hero-header">
                <div class="block-group">
                    <div class="block-60">
                        <h3>
                            {{ __('remittance green text') }}
                        </h3>
                        <p>
                            {{ __('remittance description 1') }}
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

