<div>
    <div class="card">
        <div class="card-header">
            {{ $name }}
        </div>
        <div class="card-body">
            <figure class="highcharts-figure">
                <div id="container"></div>
                <div id="container2"></div>
            </figure>
            <p class="text-center">
                <button type="butto" class="btn btn-secondary btn-sm m-2" wire:click="$emit('editChartInfo', '{{ $chart->id }}')">Edit</button>
            </p>
            <p>{{ $collection }}</p>
        </div>
        <div class="card-footer">
            {!! $description !!}
        </div>
    </div>
   

    <script>
       var collection = [{
           country: 'Jordan',
           sector: 'sector-1',
           value: 100,
       }, {
           country: 'Jordan',
           sector: 'sector-2',
           value: 110,
       }, {
           country: 'Maldives',
           sector: 'sector-1',
           value: 120,
       }, {
           country: 'Kuwait',
           sector: 'sector-1',
           value: 130,
       }];
      
       

       Highcharts.getJSON('/assets/json/economy_export_granular_commodity_country.json', function(data) {
        console.log(data);
            var collection1 = data;
            var collection2 = data;
            render_chart_1();
            render_chart_2();

           function render_chart_1() {
               Highcharts.chart('container', {
                   title: {
                       text: 'Commodity'
                   },
                   series: [{
                       type: 'treemap',
                       layoutAlgorithm: 'squarified',
                       colorByPoint: true,
                       data: collection1,
                       dataLabels: {
                           enabled: true,
                           format: '{point.commodity}:<br>{point.country}'
                       },
                       tooltip: {
                           useHTML: true,
                           pointFormat: "Commodity <b>{point.commodity}</b>"
                       }
                   }],
                   plotOptions: {
                       series: {
                           cursor: 'pointer',
                           point: {
                               events: {
                                   click: function() {
                                       let commodity = this.commodity;
                                       collection2 = jQuery.grep(collection, function(item, index) {
                                           return (item.commodity == commodity);
                                       });
                                       render_chart_2();
                                   }
                               }
                           }
                       }
                   },
               });
           }

           function render_chart_2() {
               Highcharts.chart('container2', {
                   title: {
                       text: 'Country'
                   },
                   series: [{
                       type: 'treemap',
                       layoutAlgorithm: 'squarified',
                       colorByPoint: true,
                       data: collection2,
                       dataLabels: {
                           enabled: true,
                           format: '{point.country}:<br>{point.commodity}'
                       },
                       tooltip: {
                           useHTML: true,
                           pointFormat: "Country <b>{point.country}</b>"
                       }
                   }],
                   plotOptions: {
                       series: {
                           cursor: 'pointer',
                           point: {
                               events: {
                                   click: function() {
                                       let country = this.country;
                                       collection1 = jQuery.grep(collection, function(item, index) {
                                           return (item.country == country);
                                       });
                                       render_chart_1();
                                   }
                               }
                           }
                       }
                   },
               });
           }
       });
   </script>

    <div class="card">
        <div class="card-header">
            {{ $name }}
        </div>
        <div class="card-body">
            <iframe width="100%" height="660px" frameborder="0" allowfullscreen="true" src="https://public.tableau.com/views/commoditywiseexport2/Dashboard1?%3Aembed=y&%3AshowVizHome=no&:device=desktop">
            </iframe>
            <p class="text-center">
                <button type="butto" class="btn btn-secondary btn-sm m-2" wire:click="$emit('editChartInfo', '{{ $chart->id }}')">Edit</button>
            </p>
        </div>
        <div class="card-footer">
            {!! $description !!}
        </div>
    </div>
</div>
