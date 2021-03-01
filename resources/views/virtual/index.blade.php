<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <!-- NAME: 1 COLUMN -->
        <!--[if gte mso 15]>
        <xml>
            <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Greeting Card</title>
    </head>
    <body >
        <div style='padding: 10px; font-family:Arial, Helvetica, sans-serif'>
            <img style='display:block; margin: auto; padding: 10px 0' src="{{asset('frontend/images/logo/fs-logo.png')}}" alt="Demo Ecommerce">
            <div style='background-color: #FCE7E5; max-width: 600px; margin: auto;  padding: 10px'>
                <h1 style="text-align: center;">{{$content['recipient_first_name']}}, here's a greeting card from {{$content['sender_first_name']}}</h1>
                <br/>
                <h2 style="text-align: center;">{{$content['sender_first_name']}} writes:</h2>
                <h2 style="text-align: center; font-style:italic; font-weight: 300;">"{{$content['message']}}"</h2>
                <div style='text-align: center; padding: 20px 10px'>
                    <a class="mcnButton " title="Open Card" href="{{$url}}" target="_blank" style='padding: 10px 20px; background-color:rgba(0, 0, 0, 0.986);; font-weight: bolder; font-size: 20px; text-decoration: none; color: #ffffff'>Open Card</a>
                </div>
    
                <div style='padding: 20px 10px; text-align: center;'>
                  
                </div>
            </div>
        </div>
    </body>
</html>