<div>
    {{-- Modal Start--}}
    <div wire:ignore.self class="modal fade" id="chart_edit_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @if($chart)
                <div class="modal-body">
                    <b>Bangla title</b>
                    <p>{{ $chart->bn_name }}</p>
                    <b>English title</b>
                    <p>{{ $chart->en_name }}</p>
                    <hr>
                    <b>Bangla description</b>
                    <p>{!! $chart->en_description !!}</p>
                    <b>English description</b>
                    <p>{!! $chart->en_description !!}</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Update</button>
                </div>
                @else
                <p class="text-center">
                    <img src="{{ asset('assets/img/something-went-wrong.png') }}" alt="" width="320">
                </p>
                @endif
            </div>
        </div>
    </div>
    {{-- Modal End--}}

    <script>
        window.addEventListener('open_modal', event => {
            $('#chart_edit_modal').modal('show');
        });

    </script>
</div>
