@extends('layouts.app')

@section('content')

<div class="col-sm-12">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{_('Page Information')}}</h3>
        </div>
        <!--Horizontal Form-->
        <!--===================================================-->

        <form class="form-horizontal" data-toggle="validator" action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="panel-body " style="marin-bottom:2rem!">

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Title').':'}}</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="{{__('Title')}}" id="name" name="title" class="form-control" required>
                    </div>
                    <label class="col-sm-2 control-label" for="slug">{{__('Slug').':'}}</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="{{__('Slug')}}" id="slug" name="slug" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="meta_title">{{__('Meta Title').':'}}</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="{{__('Meta Title')}}" id="meta_title" name="meta_title" class="form-control" required>
                    </div>
                    <label class="col-sm-2 control-label" for="meta_decription">{{__('Meta Description').':'}}</label>
                    <div class="col-sm-4">
                        <textarea type="text" placeholder="{{__('Meta Description')}}" id="meta_decription" name="meta_description" class="form-control" required></textarea>

                    </div>
                </div>
                <div class="form-group">
                    <label style="margin-right : 2rem" class="col-sm-2 control-label" for="published">{{__('Published unpon saved').':'}}</label>
                    <label class="switch col-sm-6">
                        <input id="published" name="published" type="checkbox" >
                        <span class="slider round"></span>
                    </label>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="content">{{__('Page HTML Content').':'}}</label>
                    <div class="col-sm-10">
                        <textarea id="editor" class="editor" name="content" required  ></textarea>

                    </div>
                </div>
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" onclick="checkContent()" type="button">{{__('Save')}}</button>

            </div>
        </form>

        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

@endsection
<script>
   function checkContent(){
      
        const editor = document.querySelector('#editor').value;
        const title =  document.querySelector('#name').value;
        const slug =  document.querySelector('#slug').value;
        const meta_title = document.querySelector("#meta_title").value;
        const meta_decription = document.querySelector("#meta_decription").value;

        if(editor && title && slug && meta_title && meta_decription){
            document.querySelector("form").submit()
        }else{
            alert("Please fill all page information.")
        }
   }
   //add a testing comment here for pushing
</script>
