@extends('layouts.app')

@section('content')

<div class="col-sm-12">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Campaign Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('campaigns.update_campaign', encrypt($campaign->campaign_schedule_id)) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">{{__('Title')}}</label>
                    <div class="col-sm-9">
                        <input type="text" placeholder="{{__('Title')}}" id="name" name="title" class="form-control" value="{{$campaign->title}}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="start_date">{{__('Date')}}</label>
                    <div class="col-sm-9">
                        <div id="demo-dp-range">
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" class="form-control" value="{{date('Y-m-d', strtotime($campaign->start_date))}}" name="start_date">
                                <span class="input-group-addon">{{__('to')}}</span>
                                <input type="text" class="form-control" value="{{date('Y-m-d', strtotime($campaign->end_date))}}" name="end_date">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="col-sm-3 control-label" for="products">{{__('Page Size')}}</label>
                    <div class="col-sm-9">
                        <input type="number" value="{{$campaign->page_size}}" name="page_size" required class="form-control demo-select2-placeholder">

                    </div>
                </div>
                <br>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){

            $('#demo-dp-range .input-daterange').datepicker({
                startDate: '-0d',
                todayBtn: "linked",
                autoclose: true,
                todayHighlight: true
        	});

            $('#products').on('change', function(){
                var product_ids = $('#products').val();
                if(product_ids.length > 0){
                    $.post('{{ route('flash_deals.product_discount') }}', {_token:'{{ csrf_token() }}', product_ids:product_ids}, function(data){
                        $('#discount_table').html(data);
                        $('.demo-select2').select2();
                    });
                }
                else{
                    $('#discount_table').html(null);
                }
            });
        });
        
    </script>
@endsection
