<div>
    {{-- Modal Start--}}
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <div class="modal fade" id="chart_edit_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="summernote"></div>
                @if($chart)


                <div class="modal-header">
                    <h5 class="modal-title">{{ $chart->bn_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
