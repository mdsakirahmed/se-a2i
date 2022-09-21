@extends('layouts.backend.app')
@section('content')
    <section id="education">
        <div class="content-area">
            <div class="container">
                <header>
                    <h3>
                        {{ __('Heatmap') }}
                    </h3>
                </header>
                <div class="row">
                    <iframe src="https://advanced-analytics.dghs.gov.bd/under_five_health/index.php/home/iFrame_Heatmap" frameborder='0' height="3250" width="100%" title="Heatmap"></iframe> 
                </div>
            </div>
        </div>
    </section>
@endsection