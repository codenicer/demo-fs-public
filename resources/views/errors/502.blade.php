<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>502 error</title>
</head>

<style>
body {
    padding: 0;
    margin: 0;
    overflow: hidden;
    color: rgba(0,0,0,.8);
    font-family: sans-serif;
}

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border: 1px solid black;
    height: 100vh;
    width: 100vw;
    background: #fefefe;
    text-align: center;
}

.title {
    font-size: 6rem;
    color: #F69E8D;
}

.sub-title {
    font-size: 1.5rem;
    margin-bottom: 15px;
}

</style>
<body onload='redirect()'>
    <div class='container'>
        <h1 class='title'><strong>502</strong></h1>
        <span class='sub-title'>Opps! It's not you, it's us! Please wait until we redirect you</span>
        <span>If you are not automatically redirected. <a  href="https://belle-petals.myshopify.com">Click here to continue</a> </span>
    </div>
</body>

<script>
    function redirect(){
        setTimeout(function(){
            location.replace("https://belle-petals.myshopify.com");
        }, 3000)
    }
</script>
</html>