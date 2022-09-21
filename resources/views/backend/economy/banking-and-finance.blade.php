@extends('layouts.backend.app')
@section('content')
<section id="overviewOftheEconomy">
    <div class="content-area">
        <div class="container">
            <header>
                <div class="custom">
                    <h3>
                    {{ __('Banking and Finance') }}
                    </h3>
                </div>
            </header>
            <div class="hero-header">
                <div class="block-group">
                    <div class="block-60">
                        <h3>
                        {{ __('banking finance green text') }}
                        </h3>
                        <p>
                        {{ __('banking finance description 1') }}
                        </p>
                    </div>
                    <div class="block-40">
                        <img src="{{ asset('assets/img/finance.png') }}" />
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-5">
                    @livewire('chart28')
                </div>
                <div class="col-md-6 mb-5">
                    @livewire('chart29')
                </div>
                <div class="col-md-6 mb-5">
                    @livewire('chart30')
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

