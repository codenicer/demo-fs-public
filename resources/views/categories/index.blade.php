@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('categories.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Category')}}</a>
    </div>
</div>

<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Categories')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Banner')}}</th>
                    <th>{{__('Icon')}}</th>
                    <th>{{__('Featured')}}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody id="tablelist">
                @foreach($categories as $key => $category)
                    <tr id="{{$category->id}}" style="cursor: pointer;">
                        <td>{{$key+1}}</td>
                        <td>{{__($category->name)}}</td>
                        <td><img class="img-md" src="{{ asset($category->banner) }}" alt="{{__('banner')}}"></td>
                        <td><img class="img-xs" src="{{ asset($category->icon) }}" alt="{{__('icon')}}"></td>
                        <td><label class="switch">
                            <input onchange="update_featured(this)" value="{{ $category->id }}" type="checkbox" <?php if($category->featured == 1) echo "checked";?> >
                            <span class="slider round"></span></label></td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('categories.edit', encrypt($category->id))}}">{{__('Edit')}}</a></li>
                                    <li><a href="{{route('categories.priority_product', encrypt($category->id))}}">{{__('Manage Priority product')}}</a></li>
                                    <li><a href='{{route('categories.destroy', $category->id)}}' onclick="return confirm('All products that assigned in this category will also be deleted. Do you want to continue?');">{{__('Delete')}}</a></li>

                                </ul>
                            </div>
                        </td>
                        <input type="hidden" value="{{$category->id}}" id="item" name="item">

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('categories.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Featured categories updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
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

          $.post('{{ route("category_priority") }}',{_token:'{{ csrf_token() }}',value:parameters} ,function(result){

            if(result == 1){
              showAlert('success','Priority updated successfully');
            }else{
              showAlert('danger','Something went wrong');
            }
          })
        }
      })
    </script>
@endsection
