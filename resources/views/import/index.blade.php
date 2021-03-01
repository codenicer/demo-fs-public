@extends('layouts.app')


@section('content')
<style>
    .text-normal {
        color: rgba(0, 0, 0, 0.986); !important;
        font-size: 4rem;
        font-weight: bold;
        text-shadow: -1px 0 #383675, 0 -1px #383675, 1.5px 0 #383675, 0 1.5px #383675 !important;
    }

    .bulk-panel {
        border: 1px solid #383675;
    }

    #btn-upload {
        background-color: rgba(0, 0, 0, 0.986);;
    }

    .logs-text {
        transition: all 2s ease-in-out;
    }

    .text-error {
        color: red !important;
    }

    .no-changes {
        color: black !important;
    }

    .positive-text {
        color: green !important;

    }

    #logs {
        max-height: 500px;
        overflow-y: scroll;
    }

    .lds-ring {
        display: flex;
        margin: auto;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .lds-ring div {
        box-sizing: border-box;
        display: block;
        position: absolute;
        width: 64px;
        height: 64px;
        margin: 8px;
        border: 8px solid rgba(0, 0, 0, 0.986);;
        border-radius: 50%;
        animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        border-color: rgba(0, 0, 0, 0.986); transparent transparent transparent;
    }

    .lds-ring div:nth-child(1) {
        animation-delay: -0.45s;
    }

    .lds-ring div:nth-child(2) {
        animation-delay: -0.3s;
    }

    .lds-ring div:nth-child(3) {
        animation-delay: -0.15s;
    }

    @keyframes lds-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
<meta name="csrf-token" content="csrf_token()">
<div>
    <h1 class="text-center text-normal">Bulk Upload</h1>
    {{-- <div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Select a file to import</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form id="bulk_form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" id="token" />
    <div class="form-group">
        <label for="file">CSV file to upload</label>
        <input type="file" name="file" id="file" class="form-control" style="width: 50%;">
        <div class="HelpText error">{{$errors->first('file')}}</div>
    </div>

    <div class="form-group">
        <button class="btn btn-primary" type="button" id="btn-upload">
            <i class="fa fa-upload"></i> Upload
        </button>
    </div>
    </form>
</div>
<!-- /.box-body -->
</div>

<div class="box-footer">
    <h3 class="text-center">LOADING...</h3>
</div>
</div> --}}
<form>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Type</label>
        <select class="form-control" id="import-type">
            <option value="">Select type</option>
            <option value="product-pricing">Product Pricing</option>
            <option value="product-addon">Product Addons</option>
            <option value="product-disable">Product Disable</option>
            <option value="collection">Collections</option>
        </select>
    </div>
    <div class="form-group">
        <label for="file">CSV file to upload</label>
        <input type="file" name="file" id="file" class="form-control">
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="button" id="btn-upload">
            <i class="fa fa-upload"></i> Upload
        </button>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Report</label>
        <div class="panel panel-default bulk-panel">
            <div class="panel-body" id="logs">
                <h5 class="log-text">Generated report will show here after CSV file has been imported...</h5>
            </div>
        </div>
    </div>
</form>
</div>

<script>
    $('#btn-upload').click(function(e) {
    e.preventDefault();

    if($("#import-type").val() == ""){
        return alert("Please select import file.");
    }

    if ($('#file').get(0).files.length === 0) {
        return alert("File is empty.");
    }


    $("#logs").html('<div class="lds-ring">' +
                     '<div></div>' +
                     '<div></div>' +
                     '<div></div>' +
                     '<div></div>' +
                     '</div>');
    var formData = new FormData($("#bulk-form")[0]);
    var file_data = $('input[type="file"]')[0].files; // for multiple files
    let importType = $("#import-type").val();
    let routeUrl = "";
    let pivotId;
    let pivotSubId;

    for(var i = 0;i<file_data.length;i++){
        console.log(file_data[0],"KWEK");
        formData.append("file", file_data[0]);
    }

    //product
    //product-addon
    //collection
    console.log(importType);
    switch (importType) {
        case "product-pricing":
        routeUrl = "{{route('import-product-pricing')}}";
        pivotId = 'product_id';
        pivotSubId = 'hub_id';
        break;

        case "product-addon":
        routeUrl = "{{route('import-product-addon')}}";
        pivotId = 'product_id';
        pivotSubId = 'addon_product_id';
        break;

        case "collection":
        routeUrl = "{{route('import-collection-hub')}}";
        pivotId = 'collection_id';
        pivotSubId = 'hub_id';
        break;

        case "product-disable":
        routeUrl = "{{route('import-product-disable')}}";
        pivotId = 'product_id';
        pivotSubId = 'hub_id';
        break;

        default:
            break;
    }
    $.ajax({
      url: routeUrl,
      data: formData,
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
      type: 'POST',
      cache: false,
      contentType: false,
      processData: false,
      success: function(data){

        let logsHtml = '<h4 class="logs-text">Inserted Addon</h4>' +
                       '<div class="inserted-report">' +
                       '</div>' +
                       '<h4 class="logs-text">Updated Addon</h4>' +
                       '<div class="updated-report">' +
                       '</div>' +
                       '<h4 class="logs-text">No Changes</h4>' +
                       '<div class="nochanges-report">' +
                       '</div>' +
                       '<h4 class="logs-text">Error / Issues</h4>' +
                       '<div class="negative-report">' +
                       '</div>';

     $("#logs").html(logsHtml).hide().show('slow');
        
        let firstLabel = pivotId == "product_id" ? "Product Id" : "Collection Id";
        let secondLabel = pivotSubId == "addon_product_id" ? "Addon Product Id" : "Hub Id";

        let responseData = {
            pivotId: pivotId,
            pivotSubId: pivotSubId,
            firstLabel: firstLabel,
            secondLabel: secondLabel
        }

        if(importType == "product-pricing"){
            showReportProductPricing(data, responseData);
        }
        else{
            showReport(data, responseData);
        }
      }
    }).done(function(resp) {
    //   console.log("DONEEEEE");
    });
  });

  function showReport(data, responseData){
    let insertedHtml = "";
        let updatedHtml = "";
        let nochangesHtml = "";
        let negativeHtml = "";

        if(data['inserted_report'].length >= 1){
            for (let i = 0; i < data['inserted_report'].length; i++) {
                 insertedHtml += '<h6 class="positive-text">' + responseData.firstLabel + ' - ' + data['inserted_report'][i][responseData.pivotId]  + '</h6>' +
                                 '<h6 class="positive-text">' + responseData.secondLabel + ' ' + data['inserted_report'][i][responseData.pivotSubId]  + '</h6>' +
                                 '<h6 class="positive-text">Changes - ' + data['inserted_report'][i]['changes']  + '</h6>' +
                                 '<hr/>';
            }
        }
        else{
            insertedHtml = '<h5 class="positive-text">None</h5> <hr/>';
        }

        if(data['updated_report'].length >= 1){
            for (let i = 0; i < data['updated_report'].length; i++) {
                  updatedHtml += '<h6 class="positive-text">' + responseData.firstLabel + ' - ' + data['updated_report'][i][responseData.pivotId]    + '</h6>' +
                                 '<h6 class="positive-text">' + responseData.secondLabel + ' ' + data['updated_report'][i][responseData.pivotSubId]  + '</h6>' +
                                 '<h6 class="positive-text">Changes - ' + data['updated_report'][i]['changes']  + '</h6>' +
                                 '<hr/>';
            }
        }
        else{
            updatedHtml = '<h5 class="positive-text">None</h5> <hr/>';
        }

        if(data['nochanges_report'].length >= 1){
            for (let i = 0; i < data['nochanges_report'].length; i++) {
                nochangesHtml += '<h6 class="no-changes">' + responseData.firstLabel + ' ' + data['nochanges_report'][i][responseData.pivotId]  + '</h6>' +
                                 '<h6 class="no-changes">' + responseData.secondLabel + ' ' + data['nochanges_report'][i][responseData.pivotSubId]  + '</h6>' +
                                 '<h6 class="no-changes">Changes - ' + data['nochanges_report'][i]['changes']  + '</h6>' +
                                 '<hr/>';
            }
        }
        else{
            nochangesHtml = '<h5 class="logs-text">None</h5> <hr/>';
        }

        if(data['negative_report'].length >= 1){
            for (let i = 0; i < data['negative_report'].length; i++) {
                 negativeHtml += '<h6 class="text-error">' + responseData.firstLabel + ' ' + data['negative_report'][i][responseData.pivotId]  + '</h6>' +
                                 '<h6 class="text-error">' + responseData.secondLabel + ' ' + data['negative_report'][i][responseData.pivotId]  + '</h6>' +
                                 '<h6 class="text-error">Changes - ' + data['negative_report'][i]['changes']  + '</h6>' +
                                 '<hr/>';
            }
        }
        else{
            negativeHtml = '<h5 class="logs-text">None</h5> <hr/>';
        }
    
        $('.inserted-report').html(insertedHtml);
        $('.updated-report').html(updatedHtml);
        $('.nochanges-report').html(nochangesHtml);
        $('.negative-report').html(negativeHtml);
  }

  function showReportProductPricing(data, responseData){
    let insertedHtml = "";
        let updatedHtml = "";
        let nochangesHtml = "";
        let negativeHtml = "";

        if(data['inserted_report'].length >= 1){
            for (let i = 0; i < data['inserted_report'].length; i++) {
                 insertedHtml += '<h6 class="positive-text">' + responseData.firstLabel + ' - ' + data['inserted_report'][i][responseData.pivotId]  + '</h6>' +
                                 '<h6 class="positive-text"> Title - ' + data['inserted_report'][i]['title']  + '</h6>' +
                                 '<h6 class="positive-text">' + responseData.secondLabel + ' ' + data['inserted_report'][i][responseData.pivotSubId]  + '</h6>' +
                                 '<h6 class="positive-text">Changes - ' + data['inserted_report'][i]['changes']  + '</h6>' +
                                 '<hr/>';
            }
        }
        else{
            insertedHtml = '<h5 class="positive-text">None</h5> <hr/>';
        }

        if(data['updated_report'].length >= 1){
            for (let i = 0; i < data['updated_report'].length; i++) {
                  updatedHtml += '<h6 class="positive-text">' + responseData.firstLabel + ' - ' + data['updated_report'][i][responseData.pivotId]    + '</h6>' +
                                 '<h6 class="positive-text"> Title - ' + data['updated_report'][i]['title']  + '</h6>' +
                                 '<h6 class="positive-text">' + responseData.secondLabel + ' ' + data['updated_report'][i][responseData.pivotSubId]  + '</h6>' +
                                 '<h6 class="positive-text">Changes - ' + data['updated_report'][i]['changes']  + '</h6>' +
                                 '<hr/>';
            }
        }
        else{
            updatedHtml = '<h5 class="positive-text">None</h5> <hr/>';
        }

        if(data['nochanges_report'].length >= 1){
            for (let i = 0; i < data['nochanges_report'].length; i++) {
                nochangesHtml += '<h6 class="no-changes">' + responseData.firstLabel + ' ' + data['nochanges_report'][i][responseData.pivotId]  + '</h6>' +
                                 '<h6 class="no-changes"> Title - ' + data['nochanges_report'][i]['title']  + '</h6>' +
                                 '<h6 class="no-changes">' + responseData.secondLabel + ' ' + data['nochanges_report'][i][responseData.pivotSubId]  + '</h6>' +
                                 '<h6 class="no-changes">Changes - ' + data['nochanges_report'][i]['changes']  + '</h6>' +
                                 '<hr/>';
            }
        }
        else{
            nochangesHtml = '<h5 class="logs-text">None</h5> <hr/>';
        }

        if(data['negative_report'].length >= 1){
            for (let i = 0; i < data['negative_report'].length; i++) {
                 negativeHtml += '<h6 class="text-error">' + responseData.firstLabel + ' ' + data['negative_report'][i][responseData.pivotId]  + '</h6>' +
                                 '<h6 class="text-error"> Title - ' + data['negative_report'][i]['title']  + '</h6>' +
                                 '<h6 class="text-error">' + responseData.secondLabel + ' ' + data['negative_report'][i][responseData.pivotId]  + '</h6>' +
                                 '<h6 class="text-error">Changes - ' + data['negative_report'][i]['changes']  + '</h6>' +
                                 '<hr/>';
            }
        }
        else{
            negativeHtml = '<h5 class="logs-text">None</h5> <hr/>';
        }
    
        $('.inserted-report').html(insertedHtml);
        $('.updated-report').html(updatedHtml);
        $('.nochanges-report').html(nochangesHtml);
        $('.negative-report').html(negativeHtml);
  }

</script>
</body>

</html>

@endsection