@extends('layouts.backend.app')
@section('content')
<section id="education">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    {{ __('Economy') }}
                </h3>
            </header>
            <div class="row">
                <div class="col-md-12">
                    @livewire('chart22')
                </div>
                <div class="col-md-12">
                    @livewire('chart23')
                </div>
                <div class="col-md-12">
                    @livewire('chart24')
                </div>
                <div class="col-md-12">
                    @livewire('chart25')
                </div>
                <div class="col-md-12">
                    @livewire('chart26')
                </div>
                <div class="col-md-12">
                    @livewire('chart27')
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

