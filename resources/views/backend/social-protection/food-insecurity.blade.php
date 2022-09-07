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
                <div class="col-md-12 mb-5">
                    @livewire('chart37')
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

