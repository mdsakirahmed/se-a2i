@extends('layouts.backend.app')
@section('content')
<section id="overviewOftheEconomy">
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
                            <span class="c-secondary fw-bold">The Economy of Bangladesh</span>,
                            is characterised as a developing market economy. It is the 41st largest in the world in nominal terms or at current prices, 
                            and 30th largest by purchasing power parity, international dollars at current prices. It is classified among the Next Eleven 
                            emerging market middle income economies and a frontier market. In the first quarter of 2019, 
                            Bangladesh's was the world's seventh fastest-growing economy with a real GDP or GDP at constant prices annual growth rate of 8.3%. 
                            Dhaka and Chattogram are the principal financial centres of the country, 
                            being home to the Dhaka Stock Exchange and the Chattogram Stock Exchange. 
                            The financial sector of Bangladesh is the second largest in the Indian subcontinent. 
                            Bangladesh is one of the fastest growing economies in the world and South Asia.
                        </p>
                        <p>
                            <span class="c-primary fw-bold">Bangladesh</span>
                            is strategically important for the economies of Nepal and Bhutan, 
                            as Bangladeshi seaports provide maritime access for these landlocked regions and countries.
                            China also views Bangladesh as a potential gateway for its landlocked southwest, 
                            including Tibet, Sichuan and Yunnan.
                        </p>
                    </div>
                    <div class="block-40">
                        <img src="{{ asset('assets/img/economy.png') }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @livewire('chart12')
                </div>
                <div class="col-md-12">
                    @livewire('chart13')
                </div>
                <div class="col-md-12">
                    @livewire('chart14')
                </div>
                <div class="col-md-12">
                    @livewire('chart15')
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
