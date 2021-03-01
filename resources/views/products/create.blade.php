@extends('layouts.app')

@section('content')

<div class="row">
	<form class="form form-horizontal mar-top" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
		@csrf
		<input type="hidden" name="added_by" value="admin">
		<div class="panel">
			<div class="panel-heading">
				<h3 class="panel-title">{{__('Product Information')}}</h3>
			</div>
			<div class="panel-body">
				<div class="tab-base tab-stacked-left">
				    <!--Nav tabs-->
				    <ul class="nav nav-tabs">
				        <li class="active">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-1" aria-expanded="true" id="general">{{__('General')}}</a>
				        </li>
				        <li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-2" aria-expanded="false" id="product_images">{{__('Images')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-3" aria-expanded="false">{{__('Videos')}}</a>
				        </li>
				        <li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-4" aria-expanded="false" id="meta_tags">{{__('Meta Tags')}}</a>
				        </li>


						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-6" aria-expanded="false" id="hub_price">{{__('Hubs')}} & {{__('Price')}}</a>
				        </li>
						<li class="">
				            <a data-toggle="tab" href="#demo-stk-lft-tab-7" aria-expanded="false">{{__('Description')}}</a>
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
									<input type="text" class="form-control" name="title" id="product_title" placeholder="{{__('Product Title')}}" onchange="update_sku()" required>
								</div>
							</div>
							<div class="form-group" id="category">
								<label class="col-lg-2 control-label">{{__('Categories')}}</label>
								<div class="col-lg-10">
										<div class="category_group">
											<div class="row" id="categories">
												@foreach($categories as $category)
												<div class="form-check col-md-4">

													<label class="form-check-label" for="category_{{$category->id}}"><strong>{{$category->name}}</strong></label>
													<div class="category_sub_category  row">

														@foreach($category->subcategories as $subcategory)
															<div class="form-check col-md-12">
																<input type="checkbox" class="form-check-input" id="subcat_{{$subcategory->id}}" value="{{$subcategory->id}}" name="subcategories[{{$category->id}}][]">
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
												<option value="{{$product_type->type}}">{{$product_type->type}}</option>
										@endforeach

									</select>
								</div>
							</div>
							<div class="form-group" id="florist_production">
								<label class="col-lg-2 control-label">{{__('Flower Production')}}</label>
								<div class="col-lg-7">
									<input type="checkbox" class="form-control" name="florist_production" value="1" >

								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Unit')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="unit" id="product_unit" placeholder="Unit (e.g. KG, Pc etc)" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Slug')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="slug" id="product_slug" placeholder="Slug" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Tags')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="tags[]" id="product_tags" placeholder="Type to add a tag" data-role="tagsinput">
								</div>
							</div>
				        </div>
				        <div id="demo-stk-lft-tab-2" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Main Images')}} </label>
								<div class="col-lg-7">
									<div id="photos">

									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Flash Deal')}} <small>(290x300)</small></label>
								<div class="col-lg-7">
									<div id="flash_deal_img">

									</div>
								</div>
							</div>
				        </div>
				        <div id="demo-stk-lft-tab-3" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Video Provider')}}</label>
								<div class="col-lg-7">
									<select class="form-control demo-select2-placeholder" name="video_provider" id="video_provider">
										<option value="youtube">{{__('Youtube')}}</option>
										<option value="dailymotion">{{__('Dailymotion')}}</option>
										<option value="vimeo">{{__('Vimeo')}}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Video Link')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="video_link" placeholder="{{__('Video Link')}}">
								</div>
							</div>
				        </div>
						<div id="demo-stk-lft-tab-4" class="tab-pane fade">
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Meta Title')}}</label>
								<div class="col-lg-7">
									<input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="{{__('Meta Title')}}">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{__('Description')}}</label>
								<div class="col-lg-7">
									<textarea name="meta_description" rows="8" class="form-control" id="meta_description"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-2 control-label">{{ __('Meta Image') }}</label>
								<div class="col-lg-7">
									<div id="meta_photo">

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
										<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Base Unit price')}}" name="unit_price" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">{{__('Purchase price')}}</label>
									<div class="col-lg-7">
										<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Purchase price')}}" name="purchase_price" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">{{__('Current Stock')}}</label>
									<div class="col-lg-7">
										<input type="number" min="0" value="0" step="1" placeholder="{{__('Current Stock')}}" name="current_stock" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">{{__('Tax')}}</label>
									<div class="col-lg-7">
										<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Tax')}}" name="tax" class="form-control" required>
									</div>
									<div class="col-lg-1">
										<select class="demo-select2" name="tax_type">
											<option value="amount">$</option>
											<option value="percent">%</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-2 control-label">{{__('Discount')}}</label>
									<div class="col-lg-7">
										<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Discount')}}" name="discount" class="form-control" required>
									</div>
									<div class="col-lg-1">
										<select class="demo-select2" name="discount_type">
											<option value="amount">$</option>
											<option value="percent">%</option>
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
												<input type="checkbox" class="form-check-input" id="hub_{{$hub->hub_id}}" value="{{$hub->hub_id}}" name="hub[]">
												<label class="form-check-label" for="hub_{{$hub->hub_id}}">{{$hub->address}}</label>
											</div>
											<div class="col-lg-8 hub_price_section">

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
									<textarea class="editor" name="description"></textarea>
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
												<input type="radio" name="shipping_type" value="free" checked>
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
												<input type="radio" name="shipping_type" value="local_pickup" checked>
												<span class="slider round"></span>
											</label>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">{{__('Shipping cost')}}</label>
										<div class="col-lg-7">
											<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Shipping cost')}}" name="local_pickup_shipping_cost" class="form-control" required>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
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
												<input type="radio" name="shipping_type" value="flat_rate" checked>
												<span class="slider round"></span>
											</label>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-2 control-label">{{__('Shipping cost')}}</label>
										<div class="col-lg-7">
											<input type="number" min="0" value="0" step="0.01" placeholder="{{__('Shipping cost')}}" name="flat_shipping_cost" class="form-control" required>
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
																	<input name="campaigns[]" value="{{ $value->id }}" type="checkbox"  >
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
																	<input name="collection[]" value="{{ $value->id }}" type="checkbox"  >
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
				<button type="button" name="button" class="btn btn-info" onclick="submit_form();">{{ __('Save') }}</button>
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
				}
			}
		})

	var i = 0;
	function add_more_customer_choice_option(){
		$('#customer_choice_options').append('<div class="form-group"><div class="col-lg-2"><input type="hidden" name="choice_no[]" value="'+i+'"><input type="text" class="form-control" name="choice[]" value="" placeholder="Choice Title"></div><div class="col-lg-7"><input type="text" class="form-control" name="choice_options_'+i+'[]" placeholder="Enter choice values" data-role="tagsinput" onchange="update_sku()"></div><div class="col-lg-2"><button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="demo-psi-recycling icon-lg"></i></button></div></div>');
		i++;
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
	$('input[id^="hub_"]').each(function(){
	    $(this).on('change', function(){
            if($(this).is(':checked')){
                $(this).parent().parent().find('.hub_price_section').append('<div class="form-group hub_price"><label class="col-lg-2 control-label">Location Price</label>  <div class="col-lg-7">' +
					'<input class="form-control" placeholder="Hub Price" type="text"  name="locations['+ $(this).val()+'][unit_price]" value="'+ $('input[name=unit_price]').val() +'"></div></div><br/>');
					$(this).parent().parent().find('.hub_price_section').append('<div class="form-group campaign_price" style="display: block;"><label class="col-lg-2 control-label">Campaign Price</label>  <div class="col-lg-7">' +
					'<input class="form-control" placeholder="Campaign Price" type="text"  name="locations['+ $(this).val()+'][campaign_price]" value="'+ $('input[name=unit_price]').val() +'"></div></div>');
            }else{
                $(this).parent().parent().find('.hub_price').remove();
                $(this).parent().parent().find('.campaign_price').remove();
			}
		});
	});

	$('input[name="name"]').on('keyup', function() {
	    update_sku();
	});

	function delete_row(em){
		$(em).closest('.form-group').remove();
		update_sku();
	}

	function update_sku(){
		$.ajax({
		   type:"POST",
		   url:'{{ route('products.sku_combination') }}',
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

		if($('#product_title').val() == ''){
			showAlert('danger', 'Please enter a product title.');
			isPass = false;
			$("#general")[0].click();
			$('#product_title').focus();

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

		if($('#product_tags').val() == ''){
			showAlert('danger', 'Please enter a product tags.');
			isPass = false;
			$("#general")[0].click();
			$('#product_tags').focus();

			return;
		}

		if(isPass && $('#photos input[type=file]').length <= 1){
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
			showAlert('danger', 'Please input atleast one Hub price and one Campaign Price in Hubs & Price section');
			isPass = false;	
			$("#hub_price")[0].click();
			
		}
		
		if(isPass === true){
			$("#choice_form").submit();
		}
	}

	$(document).ready(function(){
		$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');

		$("#photos").spartanMultiImagePicker({
			fieldName:        'photos[]',
			maxCount:         10,
			rowHeight:        '200px',
			groupClassName:   'col-md-4 col-sm-4 col-xs-6',
			allowedExt: 'png|jpeg|jpg',
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

	});




</script>

@endsection
