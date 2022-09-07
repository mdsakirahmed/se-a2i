@extends('layouts.backend.app')
@section('content')
    <section id="education">
        <div class="content-area">
            <div class="container">
                <header>
                    <h3>
                        {{ __('Causes of Death') }}
                    </h3>
                </header>
                <div class="row">
                    <iframe src="http://advanced-analytics.dghs.gov.bd/under_five_health/index.php/home/iFrmae_Causes_of_death" frameborder='0' height="2400" width="100%" title="Causes of Death"></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection