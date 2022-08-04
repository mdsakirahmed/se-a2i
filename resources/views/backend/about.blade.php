@extends('layouts.backend.app')
@section('content')
<section id="about">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    {{ __('About') }}
                </h3>
            </header>
            <div class="card-lg">
                <div class="block-group">
                    <div class="block-70">
                        <p class="mb-md-4">
                            <span class="c-primary fw-bold">The National Socioeconomic Dashboard</span>
                            is a policy-making critical tool that serves as a nexus between
                            policymakers and practitioners. It leverages government datasets to work as decision-making action items
                            that can be time-sensitive as well as demand driven through modular and intuitive visualizations.
                            The project is born of a goal to make official data on Bangladesh more accessible and easy-to-digest—to
                            make their insights seamlessly integrate into important policy conversations.
                        </p>
                        <p>
                            <span class="c-secondary fw-bold">Bangladesh</span>
                            is advancing in Sustainable Development Goals (SDGs). The aim of the Socioeconomic Dashboard is
                            to accelerate the growth of SDGs by assisting in policy implicating decision making. The dashboard will
                            serve the stakeholders in all sectors identified by experts that have a demand-driven approach to it.
                        </p>
                    </div>
                    <div class="block-30">
                        <img src="{{ asset('assets/img/about.png') }}" />
                    </div>
                </div>
            </div>
            <div class="card-primary">
                <p>
                    The poverty rate of Bangladesh fell by 1.3% points to 20.5% in FY-2019 which was estimated in FY-2018
                    as 21.8% (Source: Bangladesh Bureau of Statistics, 2019).
                </p>
            </div>
            <div id="dataConcept">
                <header>
                    <h3>
                        Data and Policy Making Concept
                    </h3>
                </header>
                <div class="block-group mt-5">
                    <div class="block">
                        <div class="desktop">
                            <img src="{{ asset('assets/img/demo.png') }}" />
                        </div>
                        <div class="mobile">
                            <img src="{{ asset('assets/img/demo-moblie.png') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection