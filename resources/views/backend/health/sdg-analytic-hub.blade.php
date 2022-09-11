@extends('layouts.backend.app')
@section('content')
    <section id="education">
        <div class="content-area">
            <div class="container">
                <header>
                    <h3>
                        {{ __('SDG Analytic Hub') }}
                    </h3>
                </header>
                <div class="tabs">
                    <div class="row mx-0">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Heatmap</button>
                            </li>
                            <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Extrapolation</button>
                            </li>
                            <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Correlation and Association</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                <div class="">
                                    <iframe src="http://advanced-analytics.dghs.gov.bd/under_five_health/index.php/home/iFrame_Heatmap" frameborder='0' height="3250" width="100%" title="Heatmap"></iframe> 
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                <div class="">
                                    <iframe src="http://advanced-analytics.dghs.gov.bd/under_five_health/index.php/home/iFrame_Extrapolation" frameborder='0' height="2400" width="100%" title="Extrapolation"></iframe> 
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                                <div class="">
                                    <iframe src="http://advanced-analytics.dghs.gov.bd/under_five_health/index.php/home/iFrame_Correlation_Association" frameborder='0' height="1600" width="100%" title=" Correlation & Association "></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  @endsection