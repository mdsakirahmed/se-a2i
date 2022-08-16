<div>
    {{-- Modal Start--}}
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <div wire:ignore.self class="modal fade" id="chart_edit_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @if($chart)
                <div class="modal-body">
                    <b>Bangla title</b>
                    <input type="text" class="form-control" wire:model="bn_name">
                    <p>{{ $bn_name }}</p>
                    <b>English title</b>
                    <input type="text" class="form-control" wire:model="en_name">
                    <p>{{ $en_name }}</p>
                    <hr>
                    <b>Bangla description</b>
                    <div wire:ignore>
                        {{-- <textarea wire:model.defer="bn_description" id="bn_description"></textarea> --}}
                        {{-- <div id="bn_description">{!! $bn_description !!}</div> --}}
                        <textarea type="text" input="bn_description" id="bn_description" class="form-control summernote" wire:model="bn_description">{{ $bn_description }}</textarea>
                    </div>
                    <p>{!! $bn_description !!}</p>
                    <b>English description</b>
                    <div wire:ignore>
                        <div id="en_description">{!! $en_description !!}</div>
                    </div>
                    <p>{!! $en_description !!}</p>
                    <div wire:ignore>
                        <div id="bn_datasource">{!! $bn_datasource !!}</div>
                    </div>
                    <p>{!! $bn_datasource !!}</p>
                    <div wire:ignore>
                        <div id="en_datasource">{!! $en_datasource !!}</div>
                    </div>
                    <p>{!! $en_datasource !!}</p>

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
            // Set summernote value
            // $('#bn_description').summernote('editor.pasteHTML', "{!! $chart->bn_description ?? 'Not Set' !!}");
            // var HTMLstring = "<div><p>Hello, world</p><p>{!! $bn_description ?? 'Not Set' !!}</p></div>";
            // $('#bn_description').summernote('pasteHTML', HTMLstring);

            // $('#bn_description').html("existingValue");


            // $('#bn_description').summernote({
            //     placeholder: 'Bangla description',
            //     tabsize: 2,
            //     height: 120,
            //     callbacks: {
            //         onChange: function(e) {
            //             @this.set('bn_description', e);
            //         }
            //     }
            // });

            window.contentfulExtension.init(function (extension) {
            extension.window.startAutoResizer()

            var existingValue = extension.field.getValue();
            $('#bn_description').html(existingValue);

            $('#bn_description').summernote({
                height: 300, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: true,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough']],
                    ['fontsize', ['fontsize']],
                    ['insert',['picture', 'link']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph', 'style']],
                    ['height', ['height']],
                    ['code',['codeview']]
                ],
            callbacks: {
            onInit: function() {
                console.log('Summernote is launched');
            },
            onChange: function(contents, $editable) {
                var markupStr = $(this).summernote('code');
                extension.field.setValue(markupStr);

            },
            onBlur: function() {
                var markupStr = $(this).summernote('code');
                extension.field.setValue(markupStr);
            }
            }
            });

            });

            $('#en_description').summernote({
                placeholder: 'English description',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(e) {
                        @this.set('en_description', e);
                    }
                }
            });
            $('#bn_datasource').summernote({
                placeholder: 'Bangla description',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(e) {
                        @this.set('bn_datasource', e);
                    }
                }
            });
            $('#en_datasource').summernote({
                placeholder: 'English description',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onChange: function(e) {
                        @this.set('en_datasource', e);
                    }
                }
            });
        });
    </script>
</div>