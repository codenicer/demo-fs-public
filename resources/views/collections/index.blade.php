@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('collections.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Collections')}}</a>
        </div>
    </div>

    <br>

    <!-- Basic Data Tables -->
    <!--===================================================-->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Collections')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Title')}}</th>
                    <th>{{ __('Status') }}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($flash_deals as $key => $flash_deal)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$flash_deal->title}}</td>
                        <td><label class="switch">
                                <input onchange="update_flash_deal_status(this)" value="{{ $flash_deal->id }}" type="checkbox" <?php if($flash_deal->status == 1) echo "checked";?> >
                                <span class="slider round"></span></label></td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('collections.edit_collection', encrypt($flash_deal->id))}}">{{__('Edit')}}</a></li>
                                    <li><a href="{{route('collections.edit', encrypt($flash_deal->id))}}">{{__('Manage Products')}}</a></li>
                                    <li><a href="{{route('collections.priority_product', encrypt($flash_deal->id))}}">{{__('Manage Priority product')}}</a></li>
                                    <li><a onclick="confirm_modal('{{route('collections.destroy', encrypt($flash_deal->id))}}');">{{__('Delete')}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection


@section('script')
    <script type="text/javascript">
      function update_flash_deal_status(el){
        if(el.checked){
          var status = 1;
        }
        else{
          var status = 0;
        }

        $.post('{{ route('collections.update_collection_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
          if(data == 1){
            showAlert('success', 'Collection is updated');
          }
          else{
            showAlert('danger', 'Something went wrong');
          }
        });
      }
    </script>
@endsection