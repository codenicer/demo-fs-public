@extends('layouts.app')

@section('content')




    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('pages.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Page')}}</a>
        </div>
    </div>

    <br>

    <!-- Basic Data Tables -->
    <!--===================================================-->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Pages')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                <thead>

                    <tr>
                        <th>id#</th>
                        <th>{{__('Title')}}</th>
                        <th>{{ __('Slug') }}</th>
                        <th>{{ __('Published') }}</th>
                        <th width="20%">{{__('Options')}}</th>
                    </tr>

               
                </thead>
                <tbody>

                    @foreach($pages as $key=> $page)
                 
                
                    <tr >
                        
                        <td>{{$page->page_id}}</td>
                        <td>{{$page->title}}</td>
                        <td>{{$page->slug}}</td>
                        <td>
                            <label class="switch">
                                <input 
                                    value={{$page['page_id']}}
                                    onchange="updatePageStatus(this)" value="{{ $page->published }}" type="checkbox" {{ (bool)$page['published'] ? 'checked' : null}}>
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('pages.edit', encrypt($page->page_id))}}">{{__('Edit')}}</a></li>
                                    <li><a onclick="confirm_modal('{{route('pages.destroy', encrypt($page->page_id))}}');">{{__('Delete')}}</a></li>
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
      function updatePageStatus(el){
        if(el.checked){
          var status = 1;
        }
        else{
          var status = 0;
        }
        
        $.post('{{ route('pages.update_published_status') }}', {_token:'{{ csrf_token() }}', id:el.value,status:status}, function(data){
            console.log(data)
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