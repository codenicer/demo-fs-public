@extends('frontend.layouts.app')


@section('meta_title'){{ $page['meta_title'] }}@stop

@section('meta_description'){{ $page['meta_description'] }}@stop

@section('meta')
    <meta itemprop="name" content="{{  $page['meta_title']  }}">
    <meta itemprop="description" content="{{ $page['meta_decription']}}">
@endsection

@section('content')

    <section class="gry-bg py-4">
        <div class="container">
            <div class="row">
                <div class="col bg-white py-2">
                    <div class="px-lg-4 py-lg-2 p-md-1 p-1 border-bottom">
                        <h2 class='font-weight-light'>{{$page['title']}}</h2>
                    </div>
                    <div class='p-lg-4 p-md-1 px-1 py-2'>
                        {!!html_entity_decode($page['content'])!!}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
