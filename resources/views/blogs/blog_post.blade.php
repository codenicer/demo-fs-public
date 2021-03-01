@extends('frontend.layouts.app')


@section('meta_title'){{ $find_blog->title }}@stop




@section('content')
    <style>
        a:hover{
            color:darkblue;

        }
            @media only screen and (max-width: 768px) {
  img {
      width: 100%;
  }
}
.breadcrumb-item:first-of-type::before {
    display: inline-block;
    padding-right: 0.5rem;
    padding-left: 0.5rem;
    color: #868e96;
    content: "";
}

    </style>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                @if($find_blog->category == 'press release')
                <li class="breadcrumb-item"><a href="/blogs/pressrelease">Press Release</a></li>
                @else
                <li class="breadcrumb-item"><a href="/blogs/news">Article</a></li>

                @endif

                {{-- <li class="breadcrumb-item active" aria-current="page">{{$find_blog->title}}</li> --}}
            </ol>
        </nav>


        <div class="row border-top">
            <div class="col-lg-9 col-sm-12 ">
                <br>
                <a href="{{route('blogs.find', ['slug' => $find_blog->slug])}}"><h4>{{$find_blog->title}}</h4></a>
                <h6 class="text-muted">Posted By <span class="font-weight-bold">{{$find_blog->published_by}}</span> on
                    <span class="font-weight-bold">{{Carbon\Carbon::parse($find_blog->publish_at)->isoFormat('ll')}}
                        </span> </h6>

                <br>
                <br>
                <p>{!! $find_blog->content !!}</p>
                <br>
                <hr>
                <?php

                $parts = explode(',', $find_blog->tags);



                ?>
                <p><span class="text-muted">Tags:</span>
                    @foreach($parts as $part)
                        <a href="">{{$part}}</a>,
                    @endforeach
                </p>
                <hr>
                <br>
                <div class="mb-3" style="display: flex;justify-content: space-between">
                    @if($find_blog->blog_id != $first_blog->blog_id)
                    <div><a href="/blogs/{{$previous_blog->slug}}"><i class="fa fa-arrow-left"></i> Older Post</a></div>
                        @else
                        <div></div>
                    @endif
                    @if($find_blog->blog_id != $last_blog->blog_id && $next_blog)
                    <div><a href="/blogs/{{$next_blog->slug}}">Newer Post <i class="fa fa-arrow-right"></i></a></div>
                        @endif
                </div>

            </div>
            <div class="col-md-2 offset-md-1 border-left">
                <div class="container">
                    <br>
                    <h6 class="text-muted">Press Release</h6>
                <br>
                @foreach($press_release as $key => $press_release)

                        <a href="{{route('blogs.find', ['slug' => $press_release->slug])}}"><h6>{{$press_release->title}}</h6></a>
                    <h6><span class="font-italic text-muted">{{Carbon\Carbon::parse($press_release->published_at)->isoFormat('ll')}}
                            </span></h6>
                    <br>
                    @endforeach

                    <br>
                    <h6 class="text-muted">Articles</h6>
                <br>
                @foreach($article_blogs as $key => $article_blog)

                        <a href="{{route('blogs.find', ['slug' => $article_blog->slug])}}"><h6>{{$article_blog->title}}</h6></a>
                    <h6><span class="font-italic text-muted">{{Carbon\Carbon::parse($article_blog->published_at)->isoFormat('ll')}}
                            </span></h6>
                    <br>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
@endsection
