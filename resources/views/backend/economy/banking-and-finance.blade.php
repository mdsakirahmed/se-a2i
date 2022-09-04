@extends('layouts.backend.app')
@section('content')
<section id="education">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    {{ __('Banking and Finance') }}
                </h3>
            </header>
            <div class="card-lg">
                <div class="block-group">
                    <div class="block-60">
                        <p class="mb-md-4">
                            <span class="c-secondary fw-bold">{{ __('banking finance green text') }}</span>,
                            {{ __('banking finance description 1') }}
                        </p>
                        <p>
                            <span class="c-primary fw-bold">{{ __('banking finance purple text') }}</span>
                            {{ __('banking finance description 2') }}
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

