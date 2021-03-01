@extends('layouts.app')

@section('content')

<br>

<div class="col-lg-12">
    <div class="panel">
        <!--Panel heading-->
        <div class="panel-heading">
            <h3 class="panel-title pull-left">{{ __('Manage Campaign Products') }}</h3>

            <h3 class="panel-title pull-right" style="text-decoration: underline; color: 'blue';">  
                <a  href="{{route('campaigns.priority_product', encrypt($campaignId))}}">{{__('Manage Priority product')}}</a>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
            </h3>
        </div>

        <div class="panel-body">
            <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th width="20%">{{__('Name')}}</th>
                        <th>{{__('Type')}}</th>
                        <th>{{__('Exclusive Campaigns')}}</th>
                        <th>{{__('Prices')}}</th>
                        <th></th>
                        <th>{{__('Options')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $product)
                    <tr>
                        <td>{{$product->product_id}}</td>
                        <td><a href="{{ route('product', urlencode($product->handle)) }}"
                                target="_blank">{{ __($product->title) }}</a></td>
                        <td>{{$product->type}}</td>
                        <td class="campaign-title">
                            @php
                            foreach ($product->campaign_products->where('is_active',1)->where('is_enabled') as
                            $campaign) {
                            echo '<BR />'.$campaign->title;
                            }

                            @endphp
                        </td>
                        <td>Base price: {{ number_format($product->unit_price,2) }}

                            @php
                            foreach ($product->hubs as $hub_prices) {
                            echo '<BR />'.$hub_prices->address.":".number_format($hub_prices->pivot->unit_price,2);
                            }
                            @endphp

                        </td>
                        <td><label class="switch">
                                <input onchange="updateCampaign(this)" value="{{ $product->product_id }}"
                                    type="checkbox" <?php if($product->hasCampaign($campaignId)) echo "checked";?>>
                                <span class="slider round"></span></label>
                        </td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon"
                                    data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @if ($type == 'Seller')
                                    <li><a
                                            href="{{route('products.seller.edit', encrypt($product->product_id))}}">{{__('Edit')}}</a>
                                    </li>
                                    @else
                                    <li><a
                                            href="{{route('products.admin.edit', encrypt($product->product_id))}}">{{__('Edit')}}</a>
                                    </li>
                                    @endif
                                    <li><a
                                            onclick="confirm_modal('{{route('products.destroy', $product->product_id)}}');">{{__('Delete')}}</a>
                                    </li>
                                    <li><a
                                            href="{{route('products.duplicate', $product->product_id)}}">{{__('Duplicate')}}</a>
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
</div>

@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function(){
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

        function updateCampaign(el){
            if(el.checked){
                var action = 1;
            }
            else{
                var action = 0;
            }
            $.post('{{ route('campaigns.update') }}', {_token:'{{ csrf_token() }}', campaign_id:'{{$campaignId}}', action:action,
                product_id: el.value}, function(data){
                    if(data == 1){
                        showAlert('success', 'Product Campaign has been updated successfully');
                        var trIndex = $(el).closest('tr').index() + 1;
                        var currentCamp = '{{"$campaignTitle"}}';

                        var campaignTitle = $('table > tbody > tr:nth-child('+trIndex+') > td.campaign-title').text();

                        campaignTitle = campaignTitle.replace(/ +(?= )/g,'');
                        currentCamp = currentCamp.replace('&#039;', '\'').replace(/ +(?= )/g,'');

                        // console.log(campaignTitle, decodeURI(currentCamp));
                        if(campaignTitle.includes(currentCamp)){
                            $('table > tbody > tr:nth-child('+trIndex+') > td.campaign-title').text(campaignTitle.replace(currentCamp, ''));
                        }

                        else{
                            $('table > tbody > tr:nth-child('+trIndex+') > td.campaign-title').html(campaignTitle + '<br/>' + currentCamp);
                        }

                    }
                    else{
                    showAlert('danger', 'Something went wrong');
                    var tr = $(el).closest('tr').index();
                    }
                });
            }
</script>
@endsection