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
                    @livewire('chart16')
                </div>
                <div class="col-md-12">
                    @livewire('chart17')
                </div>
                <div class="col-md-12">
                    @livewire('chart18')
                </div>
                <div class="col-md-12">
                    @livewire('chart19')
                </div>
                <div class="col-md-12">
                    @livewire('chart20')
                </div>
                <div class="col-md-12">
                    @livewire('chart21')
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

