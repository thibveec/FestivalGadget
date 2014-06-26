<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Backend - Festival Gadget</title>

    @include('admin._partials.assets')
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <h1><a class="brand" href="http://localhost:8080/FestivalGadget/Festival-backend/public/site/index.html#/">FestivalGadget</a></h1>
        </div>
            <div class="col-sm-6 nav">
            @include('admin._partials.header')
        </div>
        <div class="col-sm-6">


        @yield('main')
            </div>
    </div>


</div>
</body>
</html>