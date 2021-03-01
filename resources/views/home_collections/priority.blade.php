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
                    <th>{{ __('Status') }}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
                </thead>
                <tbody id="tablelist">
                @foreach(\App\HomeCollection::orderBy('status', 'DESC')->orderBy('priority', 'ASC')->get() as $key => $home_collection)
                    @if($home_collection->status == 0)
                        <tr id="{{$home_collection->id}}" class="sortable2">
                    @else
                        <tr id="{{$home_collection->id}}" >
                            @endif
                            <td>{{$key+1}}
                            </td>
                            <td>{{$home_collection->collection->title}}</td>

                            <td><label class="switch">
                                    <input onchange="update_home_collection_status(this)" value="{{ $home_collection->id }}" type="checkbox" <?php if($home_collection->status == 1) echo "checked";?> >
                                    <span class="slider round"></span></label></td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{__('Actions')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
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
</script>