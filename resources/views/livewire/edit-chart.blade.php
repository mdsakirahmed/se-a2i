<div>
    {{-- Modal Start--}}
    <div wire:ignore.self class="modal fade" id="chart_edit_modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
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
    
    @push('scripts')
    <script>
        window.addEventListener('open_modal', event => {

            $('#chart_edit_modal').modal('show');

            $('#bn_description').summernote({
                fontNames: ['Open Sans Regular', 'Open Sans Light', 'Open Sans Semibold', 'Open Sans Extrabold', 'Source Sans Pro', 'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Roboto'],
                fontNamesIgnoreCheck: ['Merriweather'],
                placeholder: 'Write bn description',
                tabsize: 2,
                height: 120,
                lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
                fontSizes: ['10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'],
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear', 'fontname']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['view', ['fullscreen', 'codeview', 'help']],

                ],
                callbacks: {
                    onChange: function(e) {
                        @this.set('bn_description', e);
                    }
                }
            });

            $('#en_description').summernote({
                fontNames: ['Open Sans Regular', 'Open Sans Light', 'Open Sans Semibold', 'Open Sans Extrabold', 'Source Sans Pro', 'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Roboto'],
                fontNamesIgnoreCheck: ['Merriweather'],
                placeholder: 'Write en description',
                tabsize: 2,
                height: 120,
                lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
                fontSizes: ['10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'],
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear', 'fontname']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['view', ['fullscreen', 'codeview', 'help']],

                ],
                callbacks: {
                    onChange: function(e) {
                        @this.set('en_description', e);
                    }
                }
            });
            $('#bn_datasource').summernote({
                fontNames: ['Open Sans Regular', 'Open Sans Light', 'Open Sans Semibold', 'Open Sans Extrabold', 'Source Sans Pro', 'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Roboto'],
                fontNamesIgnoreCheck: ['Merriweather'],
                placeholder: 'Write bn datasource',
                tabsize: 2,
                height: 120,
                lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
                fontSizes: ['10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'],
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear', 'fontname']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['view', ['fullscreen', 'codeview', 'help']],

                ],
                callbacks: {
                    onChange: function(e) {
                        @this.set('bn_datasource', e);
                    }
                }
            });
            $('#en_datasource').summernote({
                fontNames: ['Open Sans Regular', 'Open Sans Light', 'Open Sans Semibold', 'Open Sans Extrabold', 'Source Sans Pro', 'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Roboto'],
                fontNamesIgnoreCheck: ['Merriweather'],
                placeholder: 'Write en datasource',
                tabsize: 2,
                height: 120,
                lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
                fontSizes: ['10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'],
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear', 'fontname']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['view', ['fullscreen', 'codeview', 'help']],

                ],
                callbacks: {
                    onChange: function(e) {
                        @this.set('en_datasource', e);
                    }
                }
            });
        });
    </script>
    @endpush
    {{-- Modal End--}}
</div>