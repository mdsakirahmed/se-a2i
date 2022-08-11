<div>
    <div class="card">
        <div class="card-header">
            {{ $name }}
            <div>
                    <button type="button" class="btn btn-trans-icon" wire:click="$emit('editChartInfo', '{{ $chart_id }}')"><i class="bx bx-edit-alt"></i> Edit</button>
                </div>
        </div>
       <div class="card-body">
        <figure class="highcharts-figure">
            <div id="chart_id_{{ $chart->id }}"> </div>
        </figure>
       </div>
        <div class="card-footer">
            {!! $description !!}
        </div>
       </div>
        <script>

                        // Prepare random data
// var data = [
//     ['DE.SH', 728],
//     ['DE.BE', 710],
//     ['DE.MV', 963],
//     ['DE.HB', 541],
//     ['DE.HH', 622],
//     ['DE.RP', 866],
//     ['DE.SL', 398],
//     ['DE.BY', 785],
//     ['DE.SN', 223],
//     ['DE.ST', 605],
//     ['DE.NW', 237],
//     ['DE.BW', 157],
//     ['DE.HE', 134],
//     ['DE.NI', 136],
//     ['DE.TH', 704],
//     ['DE.', 361]
// ];

// Highcharts.getJSON('https://cdn.jsdelivr.net/gh/highcharts/highcharts@v7.0.0/samples/data/germany.geo.json', function (geojson) {

//     console.log(geojson);

//     // Initialize the chart
//     Highcharts.mapChart("chart_id_{{ $chart->id }}", {
//         chart: {
//             map: geojson
//         },

//         title: {
//             text: 'GeoJSON in Highmaps'
//         },

//         accessibility: {
//             typeDescription: 'Map of Germany.'
//         },

//         mapNavigation: {
//             enabled: true,
//             buttonOptions: {
//                 verticalAlign: 'bottom'
//             }
//         },

//         colorAxis: {
//             tickPixelInterval: 100
//         },

//         series: [{
//             data: data,
//             keys: ['code_hasc', 'value'],
//             joinBy: 'code_hasc',
//             name: 'Random data',
//             states: {
//                 hover: {
//                     color: '#a4edba'
//                 }
//             },
//             dataLabels: {
//                 enabled: true,
//                 format: '{point.properties.postal}'
//             }
//         }]
//     });
// });

            Highcharts.chart("chart_id_{{ $chart->id }}", {!! collect($chart_data_set) !!});

            console.log({!! collect($chart_data_set) !!});





        </script>



    {{-- i frame --}}
    <div class="card">
        <div class="card-header">
            {{ $name }}
        </div>
        <div class="card-body container-iframe">
            <iframe class="esponsive-iframe" width="100%" height="660px" frameborder="0" allowfullscreen="true" src="https://public.tableau.com/views/FoodInsecurityIndex/Dashboard1?%3Aembed=y&%3AshowVizHome=no&:device=desktop">
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
