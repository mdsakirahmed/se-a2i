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
                    @livewire('chart12')
                </div>
                <div class="col-md-12">
                    @livewire('chart13')
                </div>
                <div class="col-md-12">
                    @livewire('chart14')
                </div>
                <div class="col-md-12">
                    @livewire('chart15')
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
