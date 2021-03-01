@extends('layouts.app')

@section('content')
    <script src="{{ asset('frontend/js/jodit.min.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


    <script>
        tinymce.init({
            selector: '#mycontent',
            height: 500,
            setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
            },
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste imagetools"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ],
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '{{ route('blog.upload_html_pic') }}',
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                };
                input.click();
            }
        });
    </script>

    <div class="">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">{{__('Blog Information')}}</h3>
            </div>

            <!--Horizontal Form-->
            <!--===================================================-->
            <form class="form-horizontal" action="{{ route('blog.update',['id' => encrypt($edit_blog->blog_id)]) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{__('Title')}}</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="{{__('Name')}}" value="{{$edit_blog->title}}" id="title" name="title" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="banner">{{__('Slug')}}</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="Slug" value="{{$edit_blog->slug}}" id="slug" name="slug" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{__('Meta Title')}}</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="{{__('Meta Title')}}" value="{{$edit_blog->meta_title}}" id="meta_title" name="meta_title" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{__('Publish By')}}</label>
                        <div class="col-sm-10">
                            <input type="text" placeholder="{{__('Meta Publish')}}" value="{{$edit_blog->published_by}}" id="publish_by" name="publish_by" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{__('Publish At')}}</label>
                        <div class="col-sm-10">
                            <input type="date" value="{{$edit_blog->publish_at}}" placeholder="{{__('Meta Title')}}" id="publish_at" name="publish_at" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">{{__('Tags')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tags[]" value="{{$edit_blog->tags}}" id="product_tags" placeholder="Type to add a tag" data-role="tagsinput">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{__('Category')}}</label>
                        <div class="col-sm-10">
                            <select required aria-required="true"  class="form-control" name="category" id="exampleFormControlSelect1" required="required">
                                <option value="">Select Category</option>
                                <option value="press release" @if ($edit_blog->category == "press release") selected @endif>Press Release</option>
                                <option value="article" @if ($edit_blog->category == "article") selected @endif>Article</option>

                              </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">{{__('Thumbnail')}}</label>
                        <div class="col-sm-10">
                            <div id="photos">

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{__('Description')}}</label>
                        <div class="col-sm-10">
                            <textarea  name="meta_description" value="" rows="8" class="form-control">{{$edit_blog->meta_description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">{{__('Excerpt')}}</label>
                        <div class="col-sm-10">
                            <textarea name="excerpt" rows="8" class="form-control">{{$edit_blog->excerpt}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">{{__('HTML Content')}}</label>
                        <div class="col-sm-10">
                            <textarea id="mycontent" name="content" style="height: 500px;">{{$edit_blog->content}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="panel-footer text-right">
                    <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
                </div>
            </form>
            <!--===================================================-->
            <!--End Horizontal Form-->

        </div>
    </div>

    <script type="text/javascript">
      $(document).ready(function(){
        $("#photos").spartanMultiImagePicker({
          fieldName:        'photos',
          placeholderImage: {
            image : "{{ asset($edit_blog->thumbnail)}}",
            width :'200px'
          },
          maxCount:         1,
          rowHeight:        '200px',
          groupClassName:   'col-md-4 col-sm-9 col-xs-6',
          maxFileSize:      '',
          dropFileLabel : "Drop Here",
          onExtensionErr : function(index, file){
            console.log(index, file,  'extension err');
            alert('Please only input png or jpg type file')
          },
          onSizeErr : function(index, file){
            console.log(index, file,  'file size too big');
            alert('File size too big');
          }
        });
      });

    </script>
@endsection
