@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <a href="{{ route('blog.create')}}" class="btn btn-rounded btn-info pull-right">{{__('Add New Blog Post')}}</a>
        </div>
    </div>

    <br>

    <!-- Basic Data Tables -->
    <!--===================================================-->
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{__('Blogs')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Title')}}</th>
                    <th>{{ __('slug') }}</th>
                    <th>{{ __('meta title') }}</th>
                    <th>{{ __('meta description') }}</th>
                    <th>{{ __('tags') }}</th>
                    <th width="10%">{{__('Options')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($blogs as $key => $blog)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$blog->title}}</td>
                        <td>{{$blog->slug}}</td>
                        <td>{{$blog->meta_title}}</td>
                        <td>{{$blog->meta_description}}</td>
                        <td>{{$blog->tags}}</td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('blog.edit', encrypt($blog->blog_id))}}">{{__('Edit')}}</a></li>
                                    <li><a onclick="confirm_modal('{{route('blog.delete', encrypt($blog->blog_id))}}');">{{__('Delete')}}</a></li>
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
@endsection