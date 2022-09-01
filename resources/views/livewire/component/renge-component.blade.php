<div>
    {{-- <h1>Livewire component</h1> --}}
    <div>
        <style>
            .slidecontainer_{{ $chart_id }} .slider::-webkit-slider-thumb {
                -webkit-appearance: none;
                appearance: none;
                width: {{ $width_percentage }}%;
                height: 12px;
                background: #80CE0C;
                cursor: pointer;
                z-index: 2;
            }
    
            .slidecontainer_{{ $chart_id }} .slider::-moz-range-thumb {
                width: {{ $width_percentage }}%;
                height: 12px;
                background: #80CE0C;
                border-radius: 3px;
                cursor: pointer;
            }
    
            .slidecontainer_{{ $chart_id }} .range-label-container {
                display: flex;
                justify-content: space-between;
                background: #d3d3d3;
                position: absolute;
                top: 0;
                width: 100%;
            }
    
            .slidecontainer_{{ $chart_id }} .range-label {
                text-align: center;
                flex: 0 0 {{ $width_percentage }}%;
                white-space: nowrap;
                font-size: 10px;
                height: 12px;
                line-height: 14px;
                color: #000 !important;
                font-weight: bold;
            }
           
            .slidecontainer_{{ $chart_id }} {
                background:red;
                position: relative;
            }
    
        </style>
        <div class="slidecontainer_{{ $chart_id }}">
            <input type='range' class="slider" min='{{ $min }}' max='{{ $max }}' step='{{ $step }}' value='{{ $value }}' id="range_chart_id_{{ $chart_id }}" />
            <datalist class="range-label-container" id="tickmarks_{{ $chart_id }}">
                @foreach ($data_array as $data)
                <option class="range-label" value="{{ $data }}">{{ $data }}</option>
                @endforeach
            </datalist>
        </div>
        <div>
            <button type="button" class="btn btn-sm btn-success" id="start_btn_chart_id_{{ $chart_id }}">start</button>
            <button type="button" class="btn btn-sm btn-warning" id="stop_btn_chart_id_{{ $chart_id }}">stop</button>
        </div>
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
    
    </div>
    
</div>
