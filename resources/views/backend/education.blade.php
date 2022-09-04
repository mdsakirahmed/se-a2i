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
            <div class="card-lg">
                <div class="block-group">
                    <div class="block-60">
                    <h5 class="c-secondary fw-bold">{{ __('education green text') }}</h5>
                        <p class="mb-md-4">
                            {{ __('education description 1') }}
                        </p>
                        <h5 class="c-primary fw-bold">{{ __('education purple text') }}</h5>
                        <p>
                            {{ __('education description 2') }}
                        </p>
                    </div>
                    <div class="block-40">
                        <img src="{{ asset('assets/img/education.png') }}" />
                    </div>
                </div>
            </div>
            <div class="chart-area">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        @livewire('chart1')
                    </div>
                    <div class="col-md-6 mb-5">
                        @livewire('chart2')
                    </div>
               
                        <div class="col-md-12 mb-5">
                            @livewire('chart3')
                        </div>
                  
                        <div class="col-md-6 mb-5">
                            @livewire('chart4')
                        </div>
                        
                        <div class="col-md-6 mb-5">
                            @livewire('chart5')
                        </div>             
                
                        <div class="col-md-6 mb-5">
                            @livewire('chart6')
                        </div>
                        <div class="col-md-6 mb-5">
                            @livewire('chart7')
                        </div>
                    
                        <div class="col-md-6 mb-5">
                            @livewire('chart8')
                        </div>

                        <div class="col-md-6 mb-5">
                            @livewire('chart9')
                        </div>

                        <div class="col-md-6 mb-5">
                            @livewire('chart10')
                        </div>

                        <div class="col-md-6 mb-5">
                            @livewire('chart11')
                        </div>
</div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
