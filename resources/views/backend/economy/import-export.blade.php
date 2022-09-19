@extends('layouts.backend.app')
@section('content')
<section id="overviewOftheEconomy">
    <div class="content-area">
        <div class="container">
            <header>
                <div class="custom">
                    <h3>
                    {{ __('Import and Export') }}
                    </h3>
                </div>
            </header>
            <div class="hero-header">
                <div class="block-group">
                    <div class="block-60">
                        <h3>
                        {{ __('import export green text') }}
                        </h3>
                        <p>
                        {{ __('import export description 1') }}
                        </p>
                    </div>
                    <div class="block-40">
                        <img src="{{ asset('assets/img/import-export.png') }}" />
                    </div>
                </div>
            </div>
           
            <div class="row">
                <div class="col-md-12 mb-5">
                    @livewire('chart22')
                </div>
                <div class="col-md-12 mb-5">
                    @livewire('chart23')
                </div>
                <div class="col-md-12 mb-5">
                    @livewire('chart24')
                </div>
                <div class="col-md-12 mb-5">
                    @livewire('chart25')
                </div>
                <div class="col-md-12 mb-5">
                    @livewire('chart26')
                </div>
                <div class="col-md-12 mb-5">
                    @livewire('chart27')
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

