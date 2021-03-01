<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">{{__('Home Categories')}}</h3>
    </div>

    <!--Horizontal Form-->
    <!--===================================================-->
    <form class="form-horizontal" action="{{ route('home_collections.update' , ['id' => $homeCollection->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="panel-body">
            <div class="form-group" id="category">
                <label class="col-lg-2 control-label">{{__('Collections')}}</label>
                <div class="col-lg-7">
                    <select class="form-control demo-select2-placeholder" name="collection_id" id="collection_id" required>
                        @foreach(\App\Collection::all() as $collection)
                            <option value="{{$collection->id}}" @if($homeCollection->collection_id == $collection->id) selected @endif>{{__($collection->title)}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group" id="subsubcategory">
                <label class="col-lg-2 control-label">{{__('Page Size')}}</label>
                <div class="col-lg-7">
                    <input type="number" value="{{$homeCollection->page_size}}" name="page_size" class="form-control demo-select2-placeholder">
                    </select>
                </div>
            </div>

            <div class="form-group">
              <label class="col-lg-2 control-label" for="start_date">{{__('Hubs')}}</label>
              <div class="col-lg-7">
                  @php
                    $hubs = \App\Hubs::where('is_active',1)->get();
                  @endphp
                  @foreach($hubs as $hub)
                  <div class="checkbox">
                      <label><input type="checkbox" name="hubs[]" value="{{$hub->hub_id}}" @if(in_array($hub->hub_id, $homeCollection->collection->hubs->pluck('hub_id')->toArray())) checked @endif>{{$hub->name}}</label>
                  </div>
                  @endforeach

              </div>
          </div>
        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-danger" onclick="location.reload()" type="button" required>{{__('Cancel')}}</button>
            <button class="btn btn-purple" type="submit">{{__('Save')}}</button>
        </div>
    </form>
    <!--===================================================-->
    <!--End Horizontal Form-->

</div>

<script type="text/javascript">

  $(document).ready(function(){

    get_subsubcategories_by_category();

    $('#category_id').on('change', function() {
      get_subsubcategories_by_category();
    });

    function get_subsubcategories_by_category(){
      var category_id = $('#category_id').val();
      $.post('{{ route('home_categories.get_subsubcategories_by_category') }}',{_token:'{{ csrf_token() }}', category_id:category_id}, function(data){
        $('#subsubcategory_id').html(null);
        for (var i = 0; i < data.length; i++) {
          $('#subsubcategory_id').append($('<option>', {
            value: data[i].id,
            text: data[i].name +' ('+data[i].number_of_products+' products)'
          }));
          $(".demo-select2-max-4").select2({
            maximumSelectionLength: 4
          });
          $(".demo-select2-max-4").on("select2:select", function (evt) {
            var element = evt.params.data.element;
            var $element = $(element);

            $element.detach();
            $(this).append($element);
            $(this).trigger("change");
          });
        }
      });
    }

  });
</script>
