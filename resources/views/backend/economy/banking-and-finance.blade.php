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
            <div class="card-lg">
                <div class="block-group">
                    <div class="block-60">
                        <p class="mb-md-4">
                            <span class="c-secondary fw-bold">Remittances to Bangladesh</span>,
                            Remittances to Bangladesh are money transfers (remittances) sent by the Bangladeshi diaspora to Bangladesh. 
                            According to the World Bank, Bangladesh is the 7th highest recipient of remittance in the world with almost $22.1 billion 
                            in 2021 and was the third highest recipient of remittance in South Asia. A survey on the remittance usage conducted by the 
                            Bangladesh Bureau of Statistics in 2013 showed that 32.81% and 32.82% of the remittances are used for food and non-food expenditures. 
                            18.84% of remittances were used for durable and other expenses including 17.39% utilised for the purchase of land. 
                            In regards to investment and savings, the Bangladesh Bureau of Statistics revealed that 33.45% of remittances goes to investment and 13.74% of 
                            remittances goes to savings.
                        </p>
                        <p>
                            <span class="c-primary fw-bold">Department of</span>
                            Department of Labour is a Bangladesh government regulatory agency under the Ministry of Labour and Employment responsible for regulating 
                            the labour market in Bangladesh. Goutom Kumar is the director general of the Department of Labour.[1]
                        </p>
                    </div>
                    <div class="block-40">
                        <img src="{{ asset('assets/img/finance.png') }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    @livewire('chart28')
                </div>
                <div class="col-md-6">
                    @livewire('chart29')
                </div>
                <div class="col-md-6">
                    @livewire('chart30')
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection

