@extends('layouts.backend.app')
@section('content')
    <section id="education">
        <div class="content-area">
            <div class="container">
                <header>
                    <h3>
                        {{ __('Child Mortality') }}
                    </h3>
                </header>
                <div class="row">
                    <iframe src="https://advanced-analytics.dghs.gov.bd/under_five_health/index.php/home/iFrame_Child_Mortality" height="2650" frameborder='0' width="100%" title="Child Mortality"></iframe>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection