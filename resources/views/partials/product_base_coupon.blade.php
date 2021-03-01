<style>
    .dot {
          color: red;
          font-size: 20px;
          cursor: pointer;
      }

      .delete {
          cursor: pointer;
          float: right;
          display: inline-block;
          /* margin-bottom: 2em; */
          width: 14px;
          height: 14px;
          opacity: .4;
          background: url(data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJkZWxldGUtaWNvbiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9Ii0yNTIuNSAzNDggNzQuOSA3NC45IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IC0yNTIuNSAzNDggNzQuOSA3NC45OyI+PHBhdGggZD0iTS0yMTUsMzQ4Yy0yMC43LDAtMzcuNSwxNi44LTM3LjUsMzcuNWMwLDIwLjcsMTYuOCwzNy41LDM3LjUsMzcuNXMzNy41LTE2LjgsMzcuNS0zNy41Qy0xNzcuNSwzNjQuOC0xOTQuMywzNDgtMjE1LDM0OHogTS0yMTUsNDE2LjFjLTE2LjksMC0zMC42LTEzLjctMzAuNi0zMC42YzAtMTYuOSwxMy43LTMwLjYsMzAuNi0zMC42YzE2LjksMCwzMC42LDEzLjcsMzAuNiwzMC42Qy0xODQuNCw0MDIuNC0xOTguMSw0MTYuMS0yMTUsNDE2LjF6Ii8+PHBhdGggZD0iTS0yMDQuNiwzNzEuNWMtMy41LDMuNS02LjksNi45LTEwLjQsMTAuNGMtMy40LTMuNC02LjktNi45LTEwLjMtMTAuM2MtMy4xLTMuMS04LDEuNy00LjksNC45YzMuNCwzLjUsNi45LDYuOSwxMC4zLDEwLjNjLTMuNCwzLjQtNi45LDYuOS0xMC4zLDEwLjNjLTMuMSwzLjEsMS43LDgsNC45LDQuOWMzLjQtMy40LDYuOS02LjksMTAuMy0xMC4zYzMuNSwzLjUsNi45LDYuOSwxMC40LDEwLjRjMy4xLDMuMSw4LTEuNyw0LjktNC45Yy0zLjUtMy41LTYuOS02LjktMTAuNC0xMC40YzMuNS0zLjUsNi45LTYuOSwxMC40LTEwLjRDLTE5Ni42LDM3My4yLTIwMS41LDM2OC40LTIwNC42LDM3MS41eiIvPjwvc3ZnPg==) no-repeat;
          transition: opacity .15s;
          }
          .delete:hover {
          opacity: .7;
          color: red;
      }
</style>

<div class="panel-heading">
    <h3 class="panel-title">{{__('Add Your Product Base Coupon')}}</h3>
</div>
<div class="form-group">
    <label class="col-lg-3 control-label" for="coupon_code">{{__('Coupon code')}}</label>
    <div class="col-lg-9">
        <input type="text" placeholder="{{__('Coupon code')}}" id="coupon_code" name="coupon_code" class="form-control" required>
    </div>
</div>
<div class="product-choose-list">
    <div class="product-choose">
        <div class="form-group">
           <label class="col-lg-3 control-label">{{__('Category')}}</label>
           <div class="col-lg-9">
              <select class="form-control category_id demo-select2" name="category_ids[]" required>
                 <option value="">Select Category</option>
                 @foreach(\App\Category::all() as $key => $category)
                     <option value="{{$category->id}}">{{$category->name}}</option>
                 @endforeach
              </select>
           </div>
        </div>
        <div class="form-group" id="subcategory">
           <label class="col-lg-3 control-label">{{__('Sub Category')}}</label>
           <div class="col-lg-9">
              <select class="form-control subcategory_id demo-select2" name="subcategory_ids[]" required>

              </select>
           </div>
        </div>
        {{-- <div class="form-group" id="subsubcategory">
           <label class="col-lg-3 control-label">{{__('Sub Sub Category')}}</label>
           <div class="col-lg-9">
              <select class="form-control subsubcategory_id demo-select2" name="subsubcategory_ids[]" required>

              </select>
           </div>
        </div> --}}
        <div class="form-group">
            <label class="col-lg-3 control-label" for="name">{{__('Product')}}</label>
            <div class="col-lg-9">
                <select name="product_ids[]" class="form-control product_id demo-select2" required>

                </select>
            </div>
        </div>
        <hr>
    </div>
</div>
<div class="more hide">
    <div style="text-align: right; margin-bottom: 2px;">
        <span class="delete" onclick="prependNewProductChoose(this);">
        </span>
        <br>
    </div>
    <div class="product-choose">
        <div class="form-group">
           <label class="col-lg-3 control-label">{{__('Category')}}</label>
           <div class="col-lg-9">
              <select class="form-control category_id" name="category_ids[]" onchange="get_subcategories_by_category(this)">
                 <option value="">Select Category</option>
                 @foreach(\App\Category::all() as $key => $category)
                     <option value="{{$category->id}}">{{$category->name}}</option>
                 @endforeach
              </select>
           </div>
        </div>
        <div class="form-group" id="subcategory">
           <label class="col-lg-3 control-label">{{__('Subcategory')}}</label>
           <div class="col-lg-9">
              <select class="form-control subcategory_id" name="subcategory_ids[]" onchange="get_products_by_subcategory(this)">

              </select>
           </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label" for="name">{{__('Product')}}</label>
            <div class="col-lg-9">
                <select name="product_ids[]" class="form-control product_id">

                </select>
            </div>
        </div>
        <hr>
    </div>
</div>
<div class="text-right">
    <button class="btn btn-primary" type="button" name="button" onclick="appendNewProductChoose()">{{ __('Add More') }}</button>
</div>
<br>
<div class="form-group">
    <label class="col-lg-3 control-label" for="start_date">{{__('Date')}}</label>
    <div class="col-lg-9">
        <div id="demo-dp-range">
            <div class="input-daterange input-group" id="datepicker">
                <input type="text" class="form-control" name="start_date" id="start_date" required>
                <span class="input-group-addon">{{__('to')}}</span>
                <input type="text" class="form-control" name="end_date" id="end_date" required>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <label class="col-lg-3 control-label">{{__('Coupon Quantity')}}</label>
    <div class="col-lg-8">
       <input type="number" min="0" step="1" placeholder="{{__('Quantity')}}" name="coupon_quantity" class="form-control" required>
        {{-- <small class="text-muted">Leave blank for unlimited coupons</small> --}}
    </div>
 </div>

<div class="form-group">
   <label class="col-lg-3 control-label">{{__('Discount')}}</label>
   <div class="col-lg-8">
      <input type="number" min="0" step="0.01" placeholder="{{__('Discount')}}" name="discount" class="form-control" required>
   </div>
   <div class="col-lg-1">
      <select class="demo-select2" name="discount_type">
         <option value="amount">&#8369;</option>
         <option value="percent">%</option>
      </select>
   </div>
</div>


<script type="text/javascript">

    function appendNewProductChoose(){
        $('.product-choose-list').append($('.more').html());
        $('.product-choose-list').find('.product-choose').last().hide().show('slow');
        $('.product-choose-list').find('.product-choose').last().find('.category_id').select2();
        var el = $('.product-choose-list').find('.product-choose').last();
        el.find('select').each(function(){
            $(this)[0].required = true;
        });
    }

    function prependNewProductChoose(el){
        $(el).parent().next().hide('slow', function(){ $(el).parent().next().remove(); });
        $(el).parent().remove();
    }

    function get_subcategories_by_category(el){
		var category_id = $(el).val();
        $(el).closest('.product-choose').find('.subcategory_id').html(null);
		$.post('{{ route('subcategories.get_subcategories_by_category') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
		    $(el).closest('.product-choose').find('.subcategory_id').append($('<option>', {
		            value: '',
		            text: 'Select Sub Category'
		    }));
            for (var i = 0; i < data.length; i++) {
		        $(el).closest('.product-choose').find('.subcategory_id').append($('<option>', {
		            value: data[i].id,
		            text: data[i].name
		        }));
		    }
            $(el).closest('.product-choose').find('.subcategory_id').select2();
		    get_products_by_subcategory($(el).closest('.product-choose').find('.subcategory_id'));
		});
	}

    // function get_subsubcategories_by_subcategory(el){
	// 	var subcategory_id = $(el).val();
    //     console.log(subcategory_id);
    //     $(el).closest('.product-choose').find('.subsubcategory_id').html(null);
	// 	$.post('{{ route('subsubcategories.get_subsubcategories_by_subcategory') }}',{_token:'{{ csrf_token() }}', subcategory_id:subcategory_id}, function(data){
	// 	    for (var i = 0; i < data.length; i++) {
	// 	        $(el).closest('.product-choose').find('.subsubcategory_id').append($('<option>', {
	// 	            value: data[i].id,
	// 	            text: data[i].name
	// 	        }));
	// 	    }
    //         $(el).closest('.product-choose').find('.subsubcategory_id').select2();
	// 	    get_products_by_subcategory($(el).closest('.product-choose').find('.subsubcategory_id'));
	// 	});
	// }

    function get_products_by_subcategory(el){
        var subsubcategory_id = $(el).val();
        console.log(subsubcategory_id, "HAHAHAHA");
        $(el).closest('.product-choose').find('.product_id').html(null);
        $.post('{{ route('products.get_products_by_subsubcategory') }}',{_token:'{{ csrf_token() }}', subsubcategory_id:subsubcategory_id}, function(data){
            for (var i = 0; i < data.length; i++) {
                console.log(data, "LELE");
                $(el).closest('.product-choose').find('.product_id').append($('<option>', {
                    value: data[i].product_id,
                    text: data[i].title
                }));
            }
            $(el).closest('.product-choose').find('.product_id').select2();
        });
    }

    $(document).ready(function(){
        $('.demo-select2').select2();
        //get_subcategories_by_category($('.category_id'));
    });

    $('.category_id').on('change', function() {
        get_subcategories_by_category(this);
    });

    $('.subcategory_id').on('change', function() {
	    // get_products_by_subcategory(this);
        get_products_by_subcategory(this);
        // console.log("NAAAA", this);
	});

    $('.subsubcategory_id').on('change', function() {
        get_products_by_subcategory(this);
 	});


</script>
