@extends('frontend.layouts.app')

@section('content')
    <style>
        a:hover{
            color:darkblue;

        }
        .thumbnail{
            width: 100%;height:400px;
        }

        @media only screen and (max-width: 768px) {
  .thumbnail {
    width: 100%;
    height:300px !important;
  }
}
    </style>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$breadcrumb}}</li>
        </ol>
    </nav>


    <div class="row border-top">
        <div class="col-md-8">
            <br>
            <h3>{{$breadcrumb}}</h3>
            <br>
            <br>
            @foreach($blogs as $key => $blog)
                <div class="container mb-5">
                    <a href="{{route('blogs.find', ['slug' => $blog->slug])}}"><h4>{{$blog->title}}</h4></a>
                    <h6 class="text-muted">Posted By <span class="font-weight-bold">{{$blog->published_by}}</span> on
                        <span class="font-weight-bold">{{Carbon\Carbon::parse($blog->publish_at)->isoFormat('ll')}}
                        </span> </h6>
                    <img class="mb-4 thumbnail"  src="{{asset($blog->thumbnail)}}">
                    <p class="text-muted">{{$blog->excerpt}}</p>
                    <?php

                    $parts = explode(',', $blog->tags);



                        ?>
                    <p><span class="text-muted">Tags:</span>
                    @foreach($parts as $part)
                        <a href="">{{$part}}</a>,
                        @endforeach
                    </p>
                    <br>
                    <a href="{{route('blogs.find', ['slug' => $blog->slug])}}"><p>Read more <i class="fa fa-arrow-right"></i></p></a>
                </div>
                @endforeach
            <?php echo $blogs->render(); ?>

        </div>
        <div class="col-md-3 offset-md-1 border-left">
            <div class="container">
                <br>
                <h6 class="text-muted">Press Release</h6>
            <br>
            @foreach($press_releases as $key => $press_release)

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
