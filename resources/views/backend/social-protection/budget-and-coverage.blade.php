@extends('layouts.backend.app')
@section('content')
<section id="education">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    {{ __('Food Security') }}
                </h3>
            </header>
            <div class="row">
                <div class="col-md-12">
                    @livewire('chart38')
                </div>
                <div class="col-md-12">
                    @livewire('chart39')
                </div>
                <div class="col-md-12">
                    @livewire('chart40')
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

