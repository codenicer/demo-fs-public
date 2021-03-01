@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('campaigns.create')}}"
            class="btn btn-rounded btn-info pull-right">{{__('Add New Campaign Deal')}}</a>
    </div>
</div>

<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Exclusive Deals | Campaigns')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Title')}}</th>
                    <th>{{ __('Start Date') }}</th>
                    <th>{{ __('End Date') }}</th>
                    <th>{{ __('Is Enabled') }}</th>
                    <th>{{ __('Is Active') }}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($campaigns as $key => $campaign)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$campaign->title}}</td>
                    <td>{{ date('m-d-Y', strtotime($campaign->start_date)) }}</td>
                    <td>{{ date('m-d-Y', strtotime($campaign->end_date)) }}</td>
                    <td><label class="switch">
                            <input onchange="update_campaign_enable(this)" value="{{ $campaign->campaign_schedule_id }}" type="checkbox"
                                <?php if($campaign->is_enabled == 1) echo "checked";?>>
                            <span class="slider round"></span></label>
                    </td>
                    <td><label class="switch">
                            <input onchange="update_campaign_active(this)" value="{{ $campaign->campaign_schedule_id }}" type="checkbox"
                                <?php if($campaign->is_active == 1) echo "checked";?>>
                            <span class="slider round"></span></label>
                    </td>
                    <td>
                        <div class="btn-group dropdown">
                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown"
                                type="button">
                                {{__('Actions')}} <i class="dropdown-caret"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a
                                        href="{{route('campaigns.products', encrypt($campaign->campaign_schedule_id))}}">{{__('Manage Products')}}</a>
                                </li>
                                <li>
                                  <a
                                      href="{{route('campaigns.priority_product', encrypt($campaign->campaign_schedule_id))}}">{{__('Manage Priority product')}}</a>
                              </li>
                                <li>
                                    <a href="{{route('campaigns.edit', encrypt($campaign->campaign_schedule_id))}}">{{__('Edit')}}</a>
                                </li>
                                <li>
                                    <a
                                        onclick="confirm_modal('{{route('campaigns.destroy', encrypt($campaign->campaign_schedule_id))}}');">{{__('Delete')}}</a>
                                </li>
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
    function update_campaign_enable(el){
        if(el.checked){
          var status = 1;
        }
        else{
          var status = 0;
        }
        $.post('{{ route('campaigns.update_enable') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
          if(data == 1){
            location.reload();
          }
          else{
            showAlert('danger', 'Something went wrong');
          }
        });
      }

      function update_campaign_active(el){
        if(el.checked){
          var status = 1;
        }
        else{
          var status = 0;
        }
        $.post('{{ route('campaigns.update_active') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
          if(data == 1){
            location.reload();
          }
          else{
            showAlert('danger', 'Something went wrong');
          }
        });
      }
</script>
@endsection