@extends('layouts.app')

@section('content')
{{-- {{dd($product,$categories, $product_types,$hubs, $collections, $campaigns,$tags)}} --}}
<div class="row">
	<form class="form form-horizontal mar-top" action="{{route('products.update', $product->product_id)}}" method="POST" enctype="multipart/form-data" id="choice_form">
		<input name="_method" type="hidden" value="POST">
		<input type="hidden" name="id" value="{{ $product->product_id }}">
		@php
			$cProduct = \App\Product::find($product->product_id);
		@endphp
		@csrf
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">{{__('Product Information')}}</h3>
			</div>
			<div class="panel-body">
				<div class="tab-base tab-stacked-left">
				    <!--Nav tabs-->
				    <ul class="nav nav-tabs">
						<li class="active">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-1" aria-expanded="true" id="genneral" >{{__('General')}}</a>
				        </li>
				        <li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-2" aria-expanded="false" id="product_images">{{__('Images')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-3" aria-expanded="false">{{__('Videos')}}</a>
						</li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-4" aria-expanded="false" id="html_body_nav">{{__('Html Body')}}</a>
				        </li>
				        <li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-5" aria-expanded="false" id="meta_tags">{{__('Meta Tags')}}</a>
						</li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-7" aria-expanded="false">{{__('Meta Description')}}</a>
				        </li>

						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-6" aria-expanded="false" id="hub_price">{{__('Price')}}</a>
				        </li>
					
						{{-- <li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-8" aria-expanded="false">Display Settings</a>
				        </li> --}}
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-9" aria-expanded="false">{{__('Shipping Info')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-10" aria-expanded="false">{{__('PDF Specification')}}</a>
				        </li>

						<li class="">
							<a data-toggle="tab" href="#demo-stk-lft-tab-11" aria-expanded="false">{{__('Collection')}}</a>
						</li>
						<li class="">
							<a data-toggle="tab" href="#demo-stk-lft-tab-12" aria-expanded="false">{{__('Campaign Exclusives')}}</a>
						</li>
				    </ul>

				    <!--Tabs Content-->
				    <div class="tab-content">
				        <div id="demo-stk-lft-tab-1" class="tab-pane fade active in">
							<div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Product Title')}}</label>
	                            <div class="col-lg-7">
	                                <input type="text" class="form-control" name="title" id="product_title" placeholder="{{__('Product Title')}}" value="{{$product->title}}" required>
	                            </div>
	                        </div>
							<div class="form-group" id="category">
								<label class="col-lg-2 control-label">{{__('Categories')}}</label>
								<div class="col-lg-10">
									<div class="category_group">
										<div class="row" id="categories">
											@php
												$pSubcats = $cProduct->subcategories;
											@endphp
											@foreach($categories as $category)
												<div class="form-check col-md-4">

													<label class="form-check-label" for="category_{{$category->id}}"><strong>{{$category->name}}</strong></label>
													<div class="category_sub_category  row">

														@foreach($category->subcategories as $subcategory)
															<div class="form-check col-md-12">
																<input type="checkbox" class="form-check-input" id="subcat_{{$subcategory->id}}" value="{{$subcategory->id}}" name="subcategories[{{$category->id}}][]"  {{$pSubcats->contains('id',$subcategory->id) ? 'checked':''}}>
																<label class="form-check-label" for="subcategory_{{$subcategory->id}}">{{$subcategory->name}}</label>
															</div>
														@endforeach
													</div>
												</div>
											@endforeach

										</div>

									</div>
								</div>
							</div>

							<div class="form-group" id="product_type_id">
								<label class="col-lg-2 control-label">{{__('Type')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="type" id="type" required>
										@foreach($product_types as $product_type)
											<option value="{{$product_type->type}}" {{$product_type->type==$product->type ? 'selected':''}}>{{$product_type->type}}</option>
										@endforeach

									</select>
								</div>
							</div>
							<div class="form-group" id="florist_production">
								<label class="col-lg-2 control-label">{{__('Flower Production')}}</label>
								<div class="col-lg-7">
									<input type="checkbox" class="form-control" name="florist_production" value="1" {{$product->florist_production ? 'checked':''}} >

								</div>
							</div>
	                        <div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Unit')}}</label>
	                            <div class="col-lg-7">
	                                <input type="text" class="form-control" name="unit" id="product_unit" placeholder="Unit (e.g. KG, Pc etc)" value="{{$product->unit}}" required>
	                            </div>
							</div>
							<div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Slug')}}</label>
	                            <div class="col-lg-7">
	                                <input type="text" class="form-control" name="slug" id="product_slug" placeholder="Slug" value="{{$product->slug}}" required>
	                            </div>
	                        </div>
	                        <div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Tags')}}</label>
	                            <div class="col-lg-7">
	                                <input type="text" class="form-control" name="tags[]" id="tags" value="{{ $product->tags }}" placeholder="Type to add a tag" data-role="tagsinput">
	                            </div>
	                        </div>
				        </div>
				        <div id="demo-stk-lft-tab-2" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Main Images')}}</label>
								<div class="col-lg-7">
									<div id="photos">
										@if(is_array(json_decode($product->photos)))
											@foreach (json_decode($product->photos) as $key => $photo)
												<div class="col-md-4 col-sm-4 col-xs-6  main-image">
													<div class="img-upload-preview">
														<img src="{{ asset($photo) }}" alt="" class="img-responsive">
														<input type="hidden" id="previous_photos" name="previous_photos[]" value="{{ $photo }}">
														<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
													</div>
												</div>
											@endforeach
										@endif
									</div>
								</div>
							</div>
						<input type="hidden" name="isNewImage" id="isNewImage" value="false">
						<input type="hidden" name="previous_thumbnail_img" value="{{ $product->thumbnail_img }}">
						<input type="hidden" name="previous_featured_img" value="{{ $product->featured_img }}">
						<div class="form-group">
							<label class="col-lg-2 control-label">{{__('Flash Deal')}} <small>(290x300)</small></label>
							<div class="col-lg-7">
								<div id="flash_deal_img">
									@if ($product->flash_deal_img != null)
										<div class="col-md-4 col-sm-4 col-xs-6">
											<div class="img-upload-preview">
												<img src="{{ asset($product->flash_deal_img) }}" alt="" class="img-responsive">
												<input type="hidden" name="previous_flash_deal_img" value="{{ $product->flash_deal_img }}">
												<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
											</div>
										</div>
									@endif
								</div>
							</div>
						</div>
				        </div>
				        <div id="demo-stk-lft-tab-3" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Video Provider')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="video_provider" id="video_provider">
										<option value="youtube" <?php if($product->video_provider == 'youtube') echo "selected";?> >{{__('Youtube')}}</option>
										<option value="dailymotion" <?php if($product->video_provider == 'dailymotion') echo "selected";?> >{{__('Dailymotion')}}</option>
										<option value="vimeo" <?php if($product->video_provider == 'vimeo') echo "selected";?> >{{__('Vimeo')}}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Video Link')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="video_link" value="{{ $product->video_link }}" placeholder="Video Link">
								</div>
							</div>
						</div>
						<div id="demo-stk-lft-tab-4" class="tab-pane fade">
							<div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Html Body')}}</label>
	                            <div class="col-lg-9">
	                                <textarea class="editor" name="html_body" id="html_body" >{{$product->html_body}}</textarea>
	                            </div>
	                        </div>
				        </div>
						<div id="demo-stk-lft-tab-5" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Meta Title')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ $product->meta_title }}" placeholder="{{__('Meta Title')}}">
								</div>
							</div>
							{{-- <div class="form-group">
								<label class="col-lg-2 control-label">{{__('Description')}}</label>
								<div class="col-lg-7">
									<textarea name="meta_description" rows="8" class="form-control" id="meta_description">{{ $product->meta_description }}</textarea>
								</div>
							</div> --}}
							<div class="form-group">
								<label class="col-lg-2 control-label">{{ __('Meta Image') }}</label>
								<div class="col-lg-7">
									<div id="meta_photo">
										@if ($product->meta_img != null)
											<div class="col-md-4 col-sm-4 col-xs-6">
												<div class="img-upload-preview">
													<img src="{{ asset($product->meta_img) }}" alt="" class="img-responsive">
													<input type="hidden" name="previous_meta_img" value="{{ $product->meta_img }}">
													<button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
												</div>
											</div>
										@endif
									</div>
								</div>
							</div>
				        </div>

						<div id="demo-stk-lft-tab-6" class="tab-pane fade">
							<div class="col-md-2">
								<div class="panel-heading">
									<h3 class="panel-title">{{__('Base Price')}}</h3>
								</div>
							</div>
							<div class="col-md-10">
								<div class="form-group">
									<label class="col-lg-2 control-label">{{__('Base Unit price')}}</label>
									<div class="col-lg-7">
										<input type="number" min="0"  step="0.01" placeholder="{{__('Base Unit price')}}" value="{{$product->unit_price ? $product->unit_price : 0}}" name="unit_price" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">{{__('Purchase price')}}</label>
									<div class="col-lg-7">
										<input type="number" min="0" step="0.01" placeholder="{{__('Purchase price')}}" value="{{$product->purchase_price ? $product->purchase_price: 0}}" name="purchase_price" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">{{__('Current Stock')}}</label>
									<div class="col-lg-7">
										<input type="number" min="0" step="1" placeholder="{{__('Current Stock')}}" value="{{$product->current_stock ? $product->current_stock: 0}}" name="current_stock" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">{{__('Tax')}}</label>
									<div class="col-lg-7">
										<input type="number" min="0" value="{{$product->tax}}" step="0.01" placeholder="{{__('Tax')}}" name="tax" class="form-control" required>
									</div>
									<div class="col-lg-1">
										<select class="demo-select2" name="tax_type">
											<option value="amount" {{$product->tax_type=='amount'?' selected ':''}}>$</option>
											<option value="percent" {{$product->tax_type=='percent'?' selected ':''}}>%</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">{{__('Discount')}}</label>
									<div class="col-lg-7">
										<input type="number" min="0" value="{{$product->discount}}" step="0.01" placeholder="{{__('Discount')}}" name="discount" class="form-control" required>
									</div>
									<div class="col-lg-1">
										<select class="demo-select2" name="discount_type">
											<option value="amount" {{$product->discount_type=='amount'?' selected ':''}}>$</option>
											<option value="percent"  {{$product->discount_type=='percent'?' selected ':''}}>>%</option>
										</select>
									</div>
								</div>
								<br>
								<div class="sku_combination" id="sku_combination">

								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<div class="panel-heading">
										<h3 class="panel-title">{{__('Hubs')}}</h3>
									</div>
								</div>
								<div class="col-md-10" id="hubs_price">


									@foreach($hubs as $hub)

										<div class="form-group">
											<div class="col-lg-12">
												<div class="col-lg-4">
													<input type="checkbox" class="form-check-input" id="hub_{{$hub->hub_id}}" value="{{$hub->hub_id}}" name="hub[]"  {{ $cProduct->hubs->contains('hub_id',$hub->hub_id) ? 'checked':''}} >
													<label class="form-check-label" for="hub_{{$hub->hub_id}}">{{$hub->address}}</label>
												</div>
												<div class="col-lg-8 hub_price_section">
													@if ($cProduct->hubs->contains('hub_id',$hub->hub_id))
													<div class="form-group hub_price">
														<label class="col-lg-2 control-label">Location Price</label>
														<div class="col-lg-7">
															<input class="form-control" placeholder="Hub Price" type="text"  name="locations[{{$hub->hub_id}}][unit_price]" value="{{$cProduct->hubs->contains('hub_id',$hub->hub_id) ? $cProduct->hubs()->find($hub->hub_id)->pivot->unit_price:0}}">
														</div>
													</div>
													<div class="form-group hub_price">
														<label class="col-lg-2 control-label">Campaign Price</label>
														<div class="col-lg-7">
															<input class="form-control" placeholder="Campaign Price" type="text"  name="locations[{{$hub->hub_id}}][campaign_price]" value="{{$cProduct->hubs->contains('hub_id',$hub->hub_id) ? $cProduct->hubs()->find($hub->hub_id)->pivot->campaign_price:0}}">
														</div>
													</div>
													@endif
												</div>
											</div>
										</div>

									@endforeach

								</div>
							</div>
						</div>
						<div id="demo-stk-lft-tab-7" class="tab-pane fade">
							<div class="form-group">
	                            <label class="col-lg-2 control-label">{{__('Description')}}</label>
	                            <div class="col-lg-9">
	                                <textarea class="editor" name="description">{{$product->meta_description}}</textarea>
	                            </div>
	                        </div>
				        </div>
						{{-- <div id="demo-stk-lft-tab-8" class="tab-pane fade">

				        </div> --}}
						<div id="demo-stk-lft-tab-9" class="tab-pane fade">
							<div class="row bord-btm">
								<div class="col-md-2">
									<div class="panel-heading">
										<h3 class="panel-title">{{__('Free Shipping')}}</h3>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group">
										<label class="col-lg-2 control-label">{{__('Status')}}</label>
										<div class="col-lg-7">
											<label class="switch" style="margin-top:5px;">
												<input type="radio" name="shipping_type" value="free" @if($product->shipping_type == 'free') checked @endif>
												<span class="slider round"></span>
											</label>
										</div>
									</div>
								</div>
							</div>

							<div class="row bord-btm">
								<div class="col-md-2">
									<div class="panel-heading">
										<h3 class="panel-title">{{__('Local Pickup')}}</h3>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group">
										<label class="col-lg-2 control-label">{{__('Status')}}</label>
										<div class="col-lg-7">
											<label class="switch" style="margin-top:5px;">
												<input type="radio" name="shipping_type" value="local_pickup" @if($product->shipping_type == 'local_pickup') checked @endif>
												<span class="slider round"></span>
											</label>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">{{__('Shipping cost')}}</label>
										<div class="col-lg-7">
											<input type="number" min="0" step="0.01" placeholder="{{__('Shipping cost')}}" name="local_pickup_shipping_cost" class="form-control" value="{{ $product->shipping_cost }}" required>
										</div>
									</div>
								</div>
							</div>

							<div class="row bord-btm">
								<div class="col-md-2">
									<div class="panel-heading">
										<h3 class="panel-title">{{__('Flat Rate')}}</h3>
									</div>
								</div>
								<div class="col-md-10">
									<div class="form-group">
										<label class="col-lg-2 control-label">{{__('Status')}}</label>
										<div class="col-lg-7">
											<label class="switch" style="margin-top:5px;">
												<input type="radio" name="shipping_type" value="flat_rate" @if($product->shipping_type == 'flat_rate') checked @endif>
												<span class="slider round"></span>
											</label>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">{{__('Shipping cost')}}</label>
										<div class="col-lg-7">
											<input type="number" min="0" step="0.01" placeholder="{{__('Shipping cost')}}" name="flat_shipping_cost" class="form-control" value="{{ $product->shipping_cost }}" required>
										</div>
									</div>
								</div>
							</div>

				        </div>
						<div id="demo-stk-lft-tab-10" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('PDF Specification')}}</label>
								<div class="col-lg-7">
									<input type="file" class="form-control" placeholder="{{__('PDF')}}" name="pdf" accept="application/pdf">
								</div>
							</div>
				        </div>
						<div id="demo-stk-lft-tab-11" class="tab-pane fade">
							<div class="form-group">
								<div class="col-lg-7">
									<div class="col-lg-12">
										<div class="panel">
											<!--Panel heading-->
											<div class="panel-heading">
												<h3 class="panel-title">{{ __('Collections') }}</h3>
											</div>
											<div class="panel-body">
												<table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
													<thead>
													<tr>
														<th>#</th>
														<th width="20%">{{__('Title')}}</th>
														<th>{{__('Status')}}</th>
													</tr>
													</thead>
													<tbody>
													@foreach($collections as $key => $value)
														<tr>
															<td>{{$key+1}}</td>
															<td>{{ __($value->title) }}</td>
															<td><label class="switch">
																	<input onchange="updateCollection(this, {{$value->id}})" value="{{ $product->product_id }}" type="checkbox" 
																	<?php if($product->hasCollection($value->id)) echo "checked";?>

																	>
																	<span class="slider round"></span></label>
															</td>
														</tr>
													@endforeach
													</tbody>
												</table>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="demo-stk-lft-tab-12" class="tab-pane fade">
							<div class="form-group">
								<div class="col-lg-7">
									<div class="col-lg-12">
										<div class="panel">
											<!--Panel heading-->
											<div class="panel-heading">
												<h3 class="panel-title">{{ __('Campaigns') }}</h3>
											</div>
											<div class="panel-body">
												<table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
													<thead>
													<tr>
														<th>#</th>
														<th width="20%">{{__('Title')}}</th>
														<th>{{__('Start Date')}}</th>
														<th>{{__('End Date')}}</th>
														<th>{{__('Status')}}</th>
													</tr>
													</thead>
													<tbody>
													@foreach($campaigns as $key => $value)
														<tr>
															<td>{{$key+1}}</td>
															<td>{{ __($value->title) }}</td>
															<td>{{ __($value->start_date) }}</td>
															<td>{{ __($value->end_date) }}</td>
															<td><label class="switch">
																	<input onchange="updateCampaign(this, {{$value->campaign_schedule_id}})" value="{{ $product->product_id }}" type="checkbox"  
																		<?php if($product->hasCampaign($value->campaign_schedule_id)) echo "checked";?>
																	>
																	<span class="slider round"></span></label>
															</td>
														</tr>
													@endforeach
													</tbody>
												</table>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
				    </div>
				</div>
			</div>
			<div class="panel-footer text-right">
				<button type="button" name="button" class="btn btn-purple" onclick="submit_form();">{{ __('Save') }}</button>
			</div>
		</div>
	</form>
</div>

@endsection

@section('script')
	<script
		src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
		integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
		crossorigin="anonymous"></script>

<script type="text/javascript">
	var $sortable = $('#photos');
	$sortable.sortable({
		stop: function(event, ui){
			var parameters = $sortable.sortable('toArray');
			var firstChild = $("#photos").children(":first");
			if(firstChild.hasClass('bago')){
				// console.log(firstChild.find('a.spartan_remove_row').length);
				// return;
				$("#isNewImage").val('true');
			}else{
				$("#isNewImage").val('false');
			}
		}
	})

	var i = $('input[name="choice_no[]"').last().val();
	if(isNaN(i)){
		i =0;
	}

	function add_more_customer_choice_option(){
		i++;
		$('#customer_choice_options').append('<div class="form-group"><div class="col-lg-2"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="" placeholder="Choice Title"></div><div class="col-lg-7"><input type="text" class="form-control" name="choice_options_'+i+'[]" placeholder="Enter choice values" data-role="tagsinput" onchange="update_sku()"></div><div class="col-lg-2"><button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button></div></div>');
		$("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
	}

	$('input[name="colors_active"]').on('change', function() {
	    if(!$('input[name="colors_active"]').is(':checked')){
			$('#colors').prop('disabled', true);
		}
		else{
			$('#colors').prop('disabled', false);
		}
		update_sku();
	});

	$('#colors').on('change', function() {
	    update_sku();
	});

	$('input[name="unit_price"]').on('keyup', function() {
	    update_sku();
	});

	function delete_row(em){
		$(em).closest('.form-group').remove();
		update_sku();
	}

	function update_sku(){
		$.ajax({
		   type:"POST",
		   url:'{{ route('products.sku_combination_edit') }}',
		   data:$('#choice_form').serialize(),
		   success: function(data){
			   $('#sku_combination').html(data);
		   }
	   });
	}

	//Validation
	function submit_form(){
		let categories = {!! $categories !!};
		let isPass = true;

		
		
		if($('#html_body').val() == ''){
			showAlert('danger', 'Please enter a product html body');
			isPass = false;
			$("#html_body_nav")[0].click();
			$('#html_body').focus();

			return;
		}


		if($('#product_title').val() == ''){
			showAlert('danger', 'Please enter a product title.');
			isPass = false;
			$("#general")[0].click();
			$('#product_title').focus();

			return;
		}

		if($('#product_unit').val() == ''){
			showAlert('danger', 'Please enter a product unit.');
			isPass = false;
			$("#general")[0].click();
			$('#product_unit').focus();

			return;
		}

		if($('#product_slug').val() == ''){
			showAlert('danger', 'Please enter a product slug.');
			isPass = false;
			$("#general")[0].click();
			$('#product_slug').focus();

			return;
		}

		if($('#product_handle').val() == ''){
			showAlert('danger', 'Please enter a product handle.');
			isPass = false;
			$("#general")[0].click();
			$('#product_handle').focus();

			return;
		}

		if($('#tags').val() == ''){
			showAlert('danger', 'Please enter a product tags.');
			isPass = false;
			$("#general")[0].click();
			$('#tags').focus();

			return;
		}

		if(isPass && !$('#categories').find('input:checked').length){
			showAlert('danger', 'Please check at least one category.');
			isPass = false;
			$("#general")[0].click();

			// $(window).scrollTop($('#categories').offset().top - 15);

			$("html, body").delay(0).animate({
				scrollTop: $('#categories').offset().top - 15
			}, 500);
		}

		if(isPass && ($('#photos input[type=file]').length + $("#previous_photos").length) <= 1){
			showAlert('danger', 'Please upload atleast one main image.');
			isPass = false;
			$("#product_images")[0].click();
			return;
		}

		if($('#meta_title').val() == ''){
			showAlert('danger', 'Please enter a meta title.');
			isPass = false;
			$("#meta_tags")[0].click();
			$('#meta_title').focus();

			return;
		}

		if($('#meta_description').val() == ''){
			showAlert('danger', 'Please enter a meta description.');
			isPass = false;
			$("#meta_tags")[0].click();
			$('#meta_description').focus();

			return;
		}

		if(isPass && !$('#hubs_price').find('input:checked').length){
			showAlert('danger', 'Please input atleast one Hub price in Hubs & Price section');
			isPass = false;
			$("#hub_price")[0].click();

		}


		if(isPass === true){
			$("#choice_form").submit();
		}
	}

    $('input[id^="hub_"]').each(function(){
        $(this).on('change', function(){
            if($(this).is(':checked')){
                $(this).parent().parent().find('.hub_price_section').append('<div class="form-group hub_price"><label class="col-lg-2 control-label">Location Price</label>  <div class="col-lg-7">' +
					'<input class="form-control" placeholder="Hub Price" type="text"  name="locations['+ $(this).val()+'][unit_price]" value="'+ $('input[name=unit_price]').val() +'"></div></div>');
				$(this).parent().parent().find('.hub_price_section').append('<div class="form-group campaign_price" style="display: block;"><label class="col-lg-2 control-label">Campaign Price</label>  <div class="col-lg-7">' +
				'<input class="form-control" placeholder="Campaign Price" type="text"  name="locations['+ $(this).val()+'][campaign_price]" value="'+ $('input[name=unit_price]').val() +'"></div></div>');
 
            }else{
                $(this).parent().parent().find('.hub_price').remove();
                $(this).parent().parent().find('.campaign_price').remove();
            }
        });
	});
	

	function updateCampaign(el, campaignId){
            if(el.checked){
                var action = 1;
            }
            else{
                var action = 0;
            }
            $.post('{{ route('campaigns.update') }}', {_token:'{{ csrf_token() }}', campaign_id:campaignId, action:action,
                product_id: el.value}, function(data){
                    if(data == 1){
                        showAlert('success', 'Product Campaign has been updated successfully');
                    }
                    else{
                    showAlert('danger', 'Something went wrong');
                    }
                });
	}
	
	function updateCollection(el, collectionId){
            if(el.checked){
                var action = 1;
            }
            else{
                var action = 0;
            }
            $.post('{{ route('collections.update_status') }}', {_token:'{{ csrf_token() }}', collection_id:collectionId, status:action,
                id: el.value}, function(data){
                    if(data == 1){
                        showAlert('success', 'Product Campaign has been updated successfully');
                    }
                    else{
                    showAlert('danger', 'Something went wrong');
                    }
                });
    }

	$(document).ready(function(){
		$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
//	    get_subcategories_by_category();
		$("#photos").spartanMultiImagePicker({
			fieldName:        'photos[]',
			maxCount:         10,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6 main-image bago',
			allowedExt: 'png|jpeg|jpg',
			maxFileSize:      '',
			dropFileLabel : "Drop Here",
			onRenderedPreview : function(index){
			console.log($('input[name ="photos[]"]')[0]);
		},
			onExtensionErr : function(index, file){
				console.log(index, file,  'extension err');
				alert('Please only input PNG and JPG type file')
			},
			onSizeErr : function(index, file){
				console.log(index, file,  'file size too big');
				alert('File size too big');
			}
		});
		$("#thumbnail_img").spartanMultiImagePicker({
			fieldName:        'thumbnail_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
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
		$("#featured_img").spartanMultiImagePicker({
			fieldName:        'featured_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
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
		$("#flash_deal_img").spartanMultiImagePicker({
			fieldName:        'flash_deal_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
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
		$("#meta_photo").spartanMultiImagePicker({
			fieldName:        'meta_img',
			maxCount:         1,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
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

		update_sku();

		$('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
        });
	});



</script>

@endsection
