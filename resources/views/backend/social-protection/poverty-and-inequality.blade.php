@extends('layouts.backend.app')
@section('content')
<section id="education">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    {{ __('Poverty and Inequality') }}
                </h3>
            </header>
            <div class="row">
                <div class="col-md-12 mb-5">
                    @livewire('chart44')
                </div>
                <div class="col-md-12 mb-5">
                    @livewire('chart45')
                </div>
                <div class="col-md-12 mb-5">
                    @livewire('chart46')
                </div>
                <div class="col-md-12 mb-5">
                    @livewire('chart47')
                </div>
                <div class="col-md-12 mb-5">
                    @livewire('chart48')
                </div>                  
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

