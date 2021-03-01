@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('popups.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Pop Up Products')}}</a>
        </div>
    </div>

    <br>

    <!-- Basic Data Tables -->
    <!--===================================================-->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Pop Ups')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('URL') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Is Active') }}</th>
                    <th>{{ __('Is Enabled') }}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach(\App\Popup::all() as $key => $popup)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{ $popup->route }}</td>
                        <td>{{ $popup->name  }}</td>
                        <td><label class="switch">
                                <input onchange="update_popup_active(this)" value="{{ $popup->id }}" type="checkbox" <?php if($popup->is_active == 1) echo "checked";?> >
                                <span class="slider round"></span></label></td>
                        <td><label class="switch">

                        <input onchange="update_popup_enabled(this)" value="{{ $popup->id }}" id="enabled{{$popup->id}}" class="uncheck" type="checkbox" <?php if($popup->is_enabled == 1) echo "checked";?> >
                        <span class="slider round"></span></label></td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('popups.edit', encrypt($popup->id))}}">{{__('Edit')}}</a></li>
                                    <li><a onclick="confirm_modal('{{route('popups.destroy', encrypt($popup->id))}}');">{{__('Delete')}}</a></li>
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
      function update_popup_enabled(el){
        if(el.checked){
          var status = 1;
        }
        else{
          var status = 0;
        }

        $.post('{{ route('popups.update_enabled') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
          if(data == 1){
            showAlert('success', 'Popup is updated');

            $('.uncheck').prop("checked", false);
            $(`#enabled${el.value}`).prop("checked", true);

          }
          else if(data == 2){
            showAlert('success', 'Popup is updated');
          }
          else if(data == 3){
            showAlert('danger', 'Popup needs to be active');
            $(`#enabled${el.value}`).prop("checked", false);

          }
          else{
            showAlert('danger', 'Something went wrong');
          }
        });
      }

      function update_popup_active(el){
        if(el.checked){
          var status = 1;
        }
        else{
          var status = 0;
        }

        $.post('{{ route('popups.update_active') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
          if(data == 1){
            showAlert('success', 'Popup is updated');
          }else if(data == 2){
            showAlert('success', 'Popup is updated');
            $(`#enabled${el.value}`).prop("checked", false);

          }
          else{
            showAlert('danger', 'Something went wrong');
          }
        });
      }
    </script>
@endsection