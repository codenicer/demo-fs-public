@extends('frontend.layouts.app')


@section('meta_title'){{$category->name}}@stop

@section('meta_description'){{$category->meta_description}}@stop

@section('meta_keywords'){{ $category->meta_title }}@stop

@section('content')

<div class="all-category-wrap py-4 gry-bg">
    <div class="mt-4">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="bg-white">
                        <div class="sub-category-menu">
                            <h3 class="category-name" >{{ __($category->name) }}</h3>
                            <ul>
                                @foreach ($result as $subcategory)
                                    @if($subcategory->id !== 42)
                                    <li>
                                        <a href="{{ route('products.subcategory', urlencode($subcategory->slug)) }}">{{__($subcategory->name)}}</a>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
