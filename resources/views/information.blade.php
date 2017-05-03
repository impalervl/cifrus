<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <title>Cifrus</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Restaurant</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li id="li1"><a id ='get-profit' href="#">Прибыль</a></li>
                <li id="li2"><a id = 'get-meals' href="#">Популярные блюда</a></li>
                <li id="li3"><a id = 'get-orders' href="#">Поcледние заказы</a></li>
                <li id="li4"><a id = 'get-officiants' href="#">Лучший официант</a></li>
                <li id="li5"><a id = 'get-all' href="#">Вся информация</a></li>
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container-fluid">
    <div class="col-md-2 table-responsive" id="profit">

    </div>
    <div class="col-md-3 table-responsive" id="meals">

    </div>
    <div class="col-md-3 table-responsive" id="orders">

    </div>
    <div class="col-md-3 table-responsive" id="officiants">

    </div>



</div>

<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
</script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>