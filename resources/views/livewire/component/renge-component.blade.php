<div>
    @push('styles')
    <style>
        .slider {
            height: 29px;
            padding: 10px 2px;
            margin-top: 3px;
        }
        .slidecontainer_{{ $chart_id }} .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: {{ $width_percentage }}%;
            height: 29px;
            background: #83c341;
            cursor: pointer;
            z-index: 2;
            border-radius: 15px;
        }

        .slidecontainer_{{ $chart_id }} .slider::-moz-range-thumb {
            width: {{ $width_percentage }}%;
            height: 29px;
            background: #83c341;
            border-radius: 3px;
            cursor: pointer;
        }

        .slidecontainer_{{ $chart_id }} .range-label-container {
            display: flex;
            justify-content: space-between;
            background: #e2e9db;
            position: absolute;
            top: 0;
            padding: 12px;
            width: 100%;
            border-radius: 20px;
        }

        .slidecontainer_{{ $chart_id }} .range-label {
            text-align: center;
            flex: 0 0 {{ $width_percentage }}%;
            white-space: nowrap;
            font-size: 10px;
            height: 12px;
            line-height: 14px;
            color: #1b3400a !important;
            font-weight: bold;
        }
       
        .slidecontainer_{{ $chart_id }} {
            background:red;
            position: relative;
            bottom: 30px;
        }
    </style>
    @endpush
    <div class="w-100 text-center">
        <button type="button" class="btn btn-sm btn-green mb-5" id="start_btn_chart_id_{{ $chart_id }}">Start</button>
        &nbsp;
        <button type="button" class="btn btn-sm btn-danger mb-5" id="stop_btn_chart_id_{{ $chart_id }}">Stop</button>
    </div>
    <div class="slidecontainer_{{ $chart_id }}">
        <input type='range' class="slider" min='{{ $min }}' max='{{ $max }}' step='{{ $step }}' value='{{ $value }}' id="range_chart_id_{{ $chart_id }}" />
        <datalist class="range-label-container" id="tickmarks_{{ $chart_id }}">
            @foreach ($data_array as $data)
            <option class="range-label" value="{{ $data }}">{{ $data }}</option>
            @endforeach
        </datalist>
    </div>
    
    @push('scripts')
    <script>
        $(document).ready(function() {
            d3.select("#range_chart_id_{{ $chart_id }}").on('input', function() {
                window.livewire.emit("change_selected_key_and_chart_update_{{ $chart_id }}", this.value);
            });

            let myTimer;
            d3.select("#start_btn_chart_id_{{ $chart_id }}").on("click", function() {
                clearInterval(myTimer);
                myTimer = setInterval(function() {
                    let b = d3.select("#range_chart_id_{{ $chart_id }}");
                    let t = (+b.property("value") + 1) % (+b.property("max") + 1);
                    if (t == 0) {
                        t = +b.property("min");
                    }
                    b.property("value", t);
                    this.Livewire.emit("change_selected_key_and_chart_update_{{ $chart_id }}", t);
                    console.log(t);
                }, 3000);
            });

            d3.select("#stop_btn_chart_id_{{ $chart_id }}").on("click", function() {
                clearInterval(myTimer);
            });
        });

    </script>  
    @endpush
</div>