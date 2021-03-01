@extends('layouts.app')

@section('content')
<style>
    .sortable2 {cursor: not-allowed;}
    .sogreen {background-color: green;}
</style>
    <div class="tab-base">

        <!--Nav Tabs-->
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#demo-lft-tab-1" aria-expanded="true">{{ __('Home slider') }}</a>
            </li>

            <li class="">
                <a data-toggle="tab" href="#demo-lft-tab-4" aria-expanded="false">{{ __('Home categories') }}</a>
            </li>
            {{--<li class="">--}}
                {{--<a data-toggle="tab" href="#demo-lft-tab-3" aria-expanded="false">{{ __('Home banner 2') }}</a>--}}
            {{--</li>--}}
            <li class="">
                <a data-toggle="tab" href="#demo-lft-tab-5" aria-expanded="false">{{ __('Collection') }}</a>
            </li>
        </ul>

        <!--Tabs Content-->
        <div class="tab-content">
            <div id="demo-lft-tab-1" class="tab-pane fade active in">

                <div class="row">
                    <div class="col-sm-12">
                        <a onclick="add_slider()" class="btn btn-rounded btn-info pull-right">{{__('Add New Slider')}}</a>
                    </div>
                </div>

                <br>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Home slider')}}</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Photo')}}</th>
                                    <th>{{__('Published')}}</th>
                                    <th width="10%">{{__('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody id="sliderlist">
                                @foreach(\App\Slider::orderBy('published', 'DESC')->orderBy('prioritization', 'ASC')->get() as $key => $slider)
                                    @if($slider->published == 0)
                                        <tr id="slider{{$slider->id}}" class="sortable1" >
                                            <td class="text-center" style="font-size: 20px;"><i class="fa fa-not-equal" ></i>
                                            </td>
                                    @else
                                        <tr id="slider{{$slider->id}}" style="cursor: pointer;">
                                            <td class="text-center" style="font-size: 20px;"><i class="fa fa-bars"></i>
                                            </td>
                                            @endif

                                        <td><img class="img-md" src="{{ asset($slider->photo)}}" alt="Slider Image"></td>
                                        <td><label class="switch">
                                            <input onchange="update_slider_published(this)" class="kakaibangclass" value="{{ $slider->id }}" type="checkbox" <?php if($slider->published == 1) echo "checked";?> >
                                            <span class="slider round"></span></label></td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a onclick="edit_slider({{$slider->id}})">{{__('Edit')}}</a></li>
                                                    <li><a onclick="confirm_modal('{{route('sliders.destroy', $slider->id)}}');">{{__('Delete')}}</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <input type="hidden" value="{{$slider->id}}" id="item" name="item">

                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div id="demo-lft-tab-2" class="tab-pane fade">

                <div class="row">
                    <div class="col-sm-12">
                        <a onclick="add_banner_1()" class="btn btn-rounded btn-info pull-right">{{__('Add New Banner')}}</a>
                    </div>
                </div>

                <br>


            </div>
            <div id="demo-lft-tab-3" class="tab-pane fade">

                <div class="row">
                    <div class="col-sm-12">
                        <a onclick="add_banner_2()" class="btn btn-rounded btn-info pull-right">{{__('Add New Banner')}}</a>
                    </div>
                </div>

                <br>

            </div>
            <div id="demo-lft-tab-4" class="tab-pane fade">

                <div class="row">
                    <div class="col-sm-12">
                        <a onclick="add_home_category()" class="btn btn-rounded btn-info pull-right">{{__('Add New Category')}}</a>
                    </div>
                </div>

                <br>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Home Categories')}}</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Category')}}</th>
                                    <th>{{ __('Limit') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th width="10%">{{__('Options')}}</th>
                                </tr>
                            </thead>
                            <tbody id="homecategorieslist">
                                @foreach(\App\HomeCategory::orderBy('status', 'DESC')->orderBy('priority', 'ASC')->get() as $key => $home_category)
                                    <tr>
                                    @if($home_category->status == 0)
                                        <tr id="category{{$home_category->id}}" class="sortable1" >
                                            <td class="text-center" style="font-size: 20px;"><i class="fa fa-not-equal" ></i>
                                            </td>
                                    @else
                                        <tr id="category{{$home_category->id}}" style="cursor: pointer;">
                                            <td class="text-center" style="font-size: 20px;"><i class="fa fa-bars"></i>
                                            </td>
                                            @endif
                                            <td>{{$home_category->category->name}}</td>
                                            <td>{{$home_category->page_size}}</td>
                                        <td><label class="switch">
                                            <input onchange="update_home_category_status(this)" value="{{ $home_category->id }}" type="checkbox" <?php if($home_category->status == 1) echo "checked";?> >
                                            <span class="slider round"></span></label></td>
                                        <td>

                                            <div class="btn-group dropdown">
                                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a onclick="edit_home_category({{$home_category->id}})">{{__('Edit')}}</a></li>
                                                    <li><a onclick="confirm_modal('{{route('home_categories.destroy', $home_category->id)}}');">{{__('Delete')}}</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <input type="hidden" value="{{$home_category->id}}" id="item" name="item">

                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div id="demo-lft-tab-5" class="tab-pane fade">

                <div class="row">
                    <div class="col-sm-12">
                        <a onclick="add_home_collection()" class="btn btn-rounded btn-info pull-right">{{__('Add New Collection')}}</a>
                    </div>
                </div>

                <br>

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{__('Collections')}}</h3>
                    </div>

                    <!--Horizontal Form-->
                    <!--===================================================-->
                    <form class="form-horizontal" action="{{ route('top_10_settings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="panel-body">
                            <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Collection')}}</th>
                                    <th>{{__('Page Size')}}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th width="10%">{{__('Options')}}</th>
                                </tr>
                                </thead>
                                <tbody id="tablelist">
                                @foreach(\App\HomeCollection::orderBy('status', 'DESC')->orderBy('priority', 'ASC')->get() as $key => $home_collection)
                                        @if($home_collection->status == 0)
                                    <tr id="{{$home_collection->id}}" class="sortable2" >
                                        <td class="text-center" style="font-size: 20px;"><i class="fa fa-not-equal" ></i>
                                        </td>
                                        @else
                                            <tr id="{{$home_collection->id}}" style="cursor: pointer;">
                                                <td class="text-center" style="font-size: 20px;"><i class="fa fa-bars"></i>
                                                </td>
                                        @endif

                                        <td>{{$home_collection->collection->title}}</td>
                                        <td>{{$home_collection->page_size}}</td>

                                        <td><label class="switch">
                                                <input onchange="update_home_collection_status(this)" class="kakaibangclass" value="{{ $home_collection->id }}" type="checkbox" <?php if($home_collection->status == 1) echo "checked";?> >
                                                <span class="slider round"></span></label></td>
                                        <td>
                                            <div class="btn-group dropdown">
                                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a onclick="edit_home_collection({{$home_collection->id}})">{{__('Edit')}}</a></li>
                                                    <li><a onclick="confirm_modal('{{route('home_collections.delete', $home_collection->id)}}');">{{__('Delete')}}</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                        <input type="hidden" value="{{$home_collection->id}}" id="item" name="item">
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="panel-footer text-right">
                            {{--<button class="btn btn-purple" type="submit">{{__('Save')}}</button>--}}
                        </div>
                    </form>
                    <!--===================================================-->
                    <!--End Horizontal Form-->

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

<script type="text/javascript">

    function updateSettings(el, type){
        if($(el).is(':checked')){
            var value = 1;
        }
        else{
            var value = 0;
        }
        $.post('{{ route('business_settings.update.activation') }}', {_token:'{{ csrf_token() }}', type:type, value:value}, function(data){
            if(data == 1){
                showAlert('success', 'Settings updated successfully');
            }
            else{
                showAlert('danger', 'Something went wrong');
            }
        });
    }

    function add_slider(){
        $.get('{{ route('sliders.create')}}', {}, function(data){
            $('#demo-lft-tab-1').html(data);
        });
    }

    function add_banner_1(){
        $.get('{{ route('home_banners.create', 1)}}', {}, function(data){
            $('#demo-lft-tab-2').html(data);
        });
    }

    function add_banner_2(){
        $.get('{{ route('home_banners.create', 2)}}', {}, function(data){
            $('#demo-lft-tab-3').html(data);
        });
    }

    function edit_home_banner_1(id){
        var url = '{{ route("home_banners.edit", "home_banner_id") }}';
        url = url.replace('home_banner_id', id);
        $.get(url, {}, function(data){
            $('#demo-lft-tab-2').html(data);
            $('.demo-select2-placeholder').select2();
        });
    }

    function edit_home_banner_2(id){
        var url = '{{ route("home_banners.edit", "home_banner_id") }}';
        url = url.replace('home_banner_id', id);
        $.get(url, {}, function(data){
            $('#demo-lft-tab-3').html(data);
            $('.demo-select2-placeholder').select2();
        });
    }

    function add_home_category(){
        $.get('{{ route('home_categories.create')}}', {}, function(data){
            $('#demo-lft-tab-4').html(data);
            $('.demo-select2-placeholder').select2();
        });
    }

    function edit_slider(value){

      var value = value

      $.post('{{ route('sliders.edit')}}', {_token:'{{ csrf_token() }}', id:value}, function(data){
        $('#demo-lft-tab-1').html(data);
      });
    }

    function edit_home_category(id){
        var url = '{{ route("home_categories.edit", "home_category_id") }}';
        url = url.replace('home_category_id', id);
        $.get(url, {}, function(data){
            $('#demo-lft-tab-4').html(data);
            $('.demo-select2-placeholder').select2();
        });
    }

    function edit_home_collection(id){

      console.log(id);
      var url = '{{ route("home_collections.edit", "home_collections_id") }}';
      url = url.replace('home_collections_id', id);
      $.get(url, {}, function(data){
        $('#demo-lft-tab-5').html(data);
        $('.demo-select2-placeholder').select2();
      });
    }

    function add_home_collection(){
      $.get('{{ route('home_collections.create')}}', {}, function(data){
        $('#demo-lft-tab-5').html(data);
        $('.demo-select2-placeholder').select2();
      });
    }

    {{--function update_home_category_status(el){--}}
      {{--if(el.checked){--}}
        {{--var status = 1;--}}
      {{--}--}}
      {{--else{--}}
        {{--var status = 0;--}}
      {{--}--}}
      {{--$.post('{{ route('home_categories.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){--}}
        {{--if(data == 1){--}}
          {{--showAlert('success', 'Home Page Category status updated successfully');--}}

        {{--}--}}
        {{--else{--}}
          {{--showAlert('danger', 'Something went wrong');--}}
        {{--}--}}
      {{--});--}}
    {{--}--}}


    function update_banner_published(el){
        if(el.checked){
            var status = 1;
        }
        else{
            var status = 0;
        }
        $.post('{{ route('home_banners.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
            if(data == 1){
                showAlert('success', 'Banner status updated successfully');
            }
            else{
                showAlert('danger', 'Maximum 4 banners to be published');
            }
        });
    }


</script>
<script
        src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
        integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
        crossorigin="anonymous"></script>
    <script>

        var $sortable = $("#tablelist");
        $sortable.sortable({
          items: "tr:not(.sortable2)",
          stop: function(event, ui){
            var parameters = $sortable.sortable('toArray');

            $.post('{{ route("home_collections.priority") }}',{_token:'{{ csrf_token() }}',value:parameters} ,function(result){
              if(result == 1){
                showAlert('success','Priority updated successfully');
              }else{
                showAlert('danger','Something went wrong');
              }
            })
          }
        })
        $( ".sortable2" ).draggable({ disabled: true })

        function update_home_collection_status(el){
          if(el.checked){
            var status = 1;
          }
          else{
            var status = 0;
          }
          $.post('{{ route('home_collections.update_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
            if(data == 1){
              showAlert('success', 'Home Page Collection status updated successfully1');
              $( "#"+el.value ).addClass( "sortable2" ).css("cursor",'not-allowed')

              $( "#"+el.value ).draggable({ disabled: false })
              ;
              $(`#${el.value}`).closest('tr').children('td:first').html(` `);

              console.log($("#"+el.value))

            }else if(data == 2){
              showAlert('success', 'Home Page Collection status updated successfully2');
              $( "#"+el.value ).removeClass( "sortable2" ).css("cursor",'pointer')

              $( "#"+el.value ).draggable({ disabled: true })

            $(`#${el.value}`).closest('tr').children('td:first').html(`<i class="fa fa-bars"></i>`);



            }
            else{
              showAlert('danger', 'Something went wrong');
            }
          });
        }

        var $sortableSlider = $("#sliderlist");
        $sortableSlider.sortable({
          items: "tr:not(.sortable1)",
          stop: function(event, ui){
            var parameters = $sortableSlider.sortable('toArray');

            $.post('{{ route("sliders.priority") }}',{_token:'{{ csrf_token() }}',value:parameters} ,function(result){
              if(result == 1){
                showAlert('success','Priority updated successfully');
              }else{
                showAlert('danger','Something went wrong');
              }
            })
          }
        })
        $( ".sortable2" ).draggable({ disabled: true })

        function update_slider_published(el){
          if(el.checked){
            var status = 1;
          }
          else{
            var status = 0;
          }
          var url = '{{ route('sliders.update', 'slider_id') }}';
          url = url.replace('slider_id', el.value);

          $.post(url, {_token:'{{ csrf_token() }}', status:status, _method:'PATCH'}, function(data){
            if(data == 1){
              showAlert('success', 'Published sliders updated successfully');
              $( "#slider"+el.value ).addClass( "sortable1" ).css("cursor",'not-allowed')

              $( "#slider"+el.value ).draggable({ disabled: false })
              ;
              $(`#slider${el.value}`).closest('tr').children('td:first').html(` `);

             }else if(data == 2){
            showAlert('success', 'Home Page Collection status updated successfully2');
            $( "#slider"+el.value ).removeClass( "sortable1" ).css("cursor",'pointer')

            $( "#slider"+el.value ).draggable({ disabled: true })

            $(`#slider${el.value}`).closest('tr').children('td:first').html(`<i class="fa fa-bars"></i>`);



          }
            else{
              showAlert('danger', 'Something went wrong');

            }
          });
        }



        var $sortableCategory = $("#homecategorieslist");
        $sortableCategory.sortable({
          items: "tr:not(.sortable3)",
          stop: function(event, ui){
            var parameters = $sortableCategory.sortable('toArray');

            $.post('{{ route("home_categories.priority") }}',{_token:'{{ csrf_token() }}',value:parameters} ,function(result){
              console.log(result)

              if(result == 1){
                showAlert('success','Priority updated successfully');
              }else{
                showAlert('danger','Something went wrong');
              }
            })
          }
        })
        $( ".sortable" ).draggable({ disabled: true })

        function update_home_category_status(el){
          if(el.checked){
            var status = 1;
          }
          else{
            var status = 0;
          }

          $.post('{{ route("home_categories.update_status") }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
            if(data == 1){
              showAlert('success', 'Published sliders updated successfully');
              $( "#category"+el.value ).addClass( "sortable1" ).css("cursor",'not-allowed')

              $( "#category"+el.value ).draggable({ disabled: false })
              ;
              $(`#category${el.value}`).closest('tr').children('td:first').html(` `);

            }else if(data == 2){
              showAlert('success', 'Home Page Collection status updated successfully2');
              $( "#category"+el.value ).removeClass( "sortable1" ).css("cursor",'pointer')

              $( "#category"+el.value ).draggable({ disabled: true })

              $(`#category${el.value}`).closest('tr').children('td:first').html(`<i class="fa fa-bars"></i>`);



            }
            else{
              showAlert('danger', 'Something went wrong');

            }
          });
        }
    </script>

@endsection
