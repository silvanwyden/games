<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('pageTitle')</title>

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- include libraries(jQuery, bootstrap, fontawesome) -->
    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>


    <link href="/css/custom.css" rel="stylesheet">

    <link href="/css/jquery.numpad.css" rel="stylesheet">
    <script type="text/javascript" src="/js/jquery.numpad.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />




</head>
<body>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <div class="fa fa-gamepad"></div>
                </a>
            </div>

            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ Request::is( 'sudoku*') ? 'active' : '' }}">
                        <a href="/sudoku">Sudoku <span class="sr-only">(current)</span></a>
                    </li>
                    <li><a href="/">next Game will come soon</a></li>
                </ul>
            </div>

        </div>
    </nav>

    <div class="container" role="main" style="margin-top: 50px;">
        @yield('content')
    </div>

    <script type="text/javascript">
        // Initialize the numpad

        $.fn.numpad.defaults.gridTpl = '<table class="table modal-content"></table>';
        $.fn.numpad.defaults.backgroundTpl = '<div class="modal-backdrop in"></div>';
        $.fn.numpad.defaults.displayTpl = '<input type="text" class="form-control  input-lg" />';
        $.fn.numpad.defaults.cellTpl = '<td style="border: 0px;"></td>';
        $.fn.numpad.defaults.buttonNumberTpl =  '<button type="button" class="btn btn-warning btn-lg"></button>';
        $.fn.numpad.defaults.buttonFunctionTpl = '<button type="button" class="btn btn-lg" style="width: 100%;"></button>';


        $('input').numpad({
            buttonNumberTpl: '<button type="button" class="btn btn-warning btn-lg"></button>',
            onChange: function(){
                $('.done').click();
            },
        });
    </script>

</body>
</html>