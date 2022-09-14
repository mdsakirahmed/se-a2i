<div>
    {{-- Modal Start--}}
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <div wire:ignore.self class="modal fade" id="chart_edit_modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                @if($chart)
                <div class="modal-body">
                    <b>Bangla title</b>
                    <input type="text" class="form-control" wire:model="bn_name">
                    <b>English title</b>
                    <input type="text" class="form-control" wire:model="en_name">
                    <hr>
                    <b>Bangla description</b>
                    <div class="mb-3" wire:ignore>
                        <div id="bn_description">{!! $bn_description !!}</div>
                    </div>
                    <b>English description</b>
                    <div class="mb-3" wire:ignore>
                        <div id="en_description">{!! $en_description !!}</div>
                    </div>
                    <b>Bangla data source</b>
                    <div class="mb-3" wire:ignore>
                        <div id="bn_datasource">{!! $bn_datasource !!}</div>
                    </div>
                    <b>English data source</b>
                    <div class="mb-3" wire:ignore>
                        <div id="en_datasource">{!! $en_datasource !!}</div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onClick="window.location.reload();">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="update">Update</button>
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

            $('#bn_description').summernote({
                placeholder: 'Bangla description',
                height: 120,
                callbacks: {
                    onChange: function(e) {
                        @this.set('bn_description', e);
                    }
                }
            });

            $('#en_description').summernote({
                placeholder: 'English description',
                height: 120,
                callbacks: {
                    onChange: function(e) {
                        @this.set('en_description', e);
                    }
                }
            });
            $('#bn_datasource').summernote({
                placeholder: 'Bangla datasource',
                height: 120,
                callbacks: {
                    onChange: function(e) {
                        @this.set('bn_datasource', e);
                    }
                }
            });
            $('#en_datasource').summernote({
                placeholder: 'English datasource',
                height: 120,
                callbacks: {
                    onChange: function(e) {
                        @this.set('en_datasource', e);
                    }
                }
            });
        });
    </script>
</div>