@extends('layouts.backend.app')
@section('content')
<section id="education">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    {{ __('Education') }}
                </h3>
            </header>
            <div class="card-lg">
                <div class="block-group">
                    <div class="block-60">
                        <p class="mb-md-4">
                            <span class="c-secondary fw-bold">In Bangladesh</span>,
                            all citizens must undertake ten years of compulsory education which consists of five years at primary 
                            school level and five years at high school level. Primary and secondary education is financed by the 
                            state and free of charge in public schools.
                        </p>
                        <p>
                            <span class="c-primary fw-bold">The Human Rights</span>
                            Measurement Initiative (HRMI) finds that Bangladesh is fulfilling only 82.5% of what it 
                            should be fulfillingfor the right to education based on the country's level of income.[8] HRMI breaks down 
                            the right to education by looking at the rights to both primary education and secondary education. While 
                            taking into consideration Bangladesh's income level, the nation is achieving 88.7% of what should be possible 
                            based on its resources (income) for primary education but only 76.3% for secondary education. 
                            Again the budgetary allocation is too meagre that the following source reiterates,
                            Out of the total budget of Tk 678,064 crore for FY23, the allocation for the education 
                            sector is Tk 81,449 crore or 12 percent of the total, compared to 11.9 percent in FY22. 
                            In terms of GDP ratio, it is 1.83 percent, lower than the outgoing fiscal year's allocation. 
                            This is one of the lowest in the world far below the recommended minimum of 4-6 percent of GDP and 20 percent 
                            of the national budget.
                        </p>
                    </div>
                    <div class="block-40">
                        <img src="{{ asset('assets/img/education.png') }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    @livewire('chart1')
                </div>
                <div class="col-md-6">
                    @livewire('chart2')
                </div>
                <div class="col-md-12">
                    @livewire('chart3')
                </div>
                <div class="col-md-6">
                    @livewire('chart4')
                </div>
                <div class="col-md-6">
                    @livewire('chart5')
                </div>
                <div class="col-md-6">
                    @livewire('chart6')
                </div>
                <div class="col-md-6">
                    @livewire('chart7')
                </div>
                <div class="col-md-6">
                    @livewire('chart8')
                </div>
                <div class="col-md-6">
                    @livewire('chart9')
                </div>
                <div class="col-md-6">
                    @livewire('chart10')
                </div>
                <div class="col-md-6">
                    @livewire('chart11')
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
