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
       Highcharts.getJSON('/assets/json/economy_export_granular_commodity_country.json', function(collection) {
        console.log(collection);
            var collection1 = collection;
            var collection2 = collection;
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
                        //    format: '{point.commodity}:<br>{point.country}'
                           format: ''
                       },
                       tooltip: {
                           useHTML: true,
                        //    pointFormat: "Commodity <b>{point.commodity}</b>"
                           pointFormat: ""
                       }
                   }],
                   plotOptions: {
                       series: {
                           cursor: 'pointer',
                           point: {
                               events: {
                                   click: function() {
                                       if($(this).attr('data-click') != 1){
                                            $(this).attr('data-click', 1);
                                            let commodity = this.commodity;
                                            collection2 = jQuery.grep(collection, function(item, index) {
                                                return (item.commodity == commodity);
                                            });
                                       }else{
                                        $(this).attr('data-click', 0)
                                        collection2 = collection;
                                       }
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
                        //    format: '{point.country}:<br>{point.commodity}'
                           format: ''
                       },
                       tooltip: {
                           useHTML: true,
                        //    pointFormat: "Country <b>{point.commodity}</b>"
                           pointFormat: ""
                       }
                   }],
                   plotOptions: {
                       series: {
                           cursor: 'pointer',
                           point: {
                               events: {
                                   click: function() {
                                        if($(this).attr('data-click') != 1){
                                            $(this).attr('data-click', 1);
                                            let country = this.country;
                                            collection2 = jQuery.grep(collection, function(item, index) {
                                                return (item.country == country);
                                            });
                                       }else{
                                        $(this).attr('data-click', 0)
                                        collection1 = collection;
                                       }
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
