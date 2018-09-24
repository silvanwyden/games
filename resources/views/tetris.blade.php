@extends('layouts.app')

@section('pageTitle', 'Tetris')
@section('content')

    <h1>Tetris</h1>

    <!-- The stylesheet should go in the <head>, or be included in your CSS -->
    <link rel="stylesheet" href="/js/blockrain/blockrain.css">


    <div class="game" style="width: 330px; height:500px; margin: auto;"></div>

    <!-- jQuery and Blockrain.js -->
    <script src="/js/blockrain/blockrain.jquery.libs.js"></script>
    <script src="/js/blockrain/blockrain.jquery.src.js"></script>
    <script src="/js/blockrain/blockrain.jquery.themes.js"></script>
    <script>
        $('.game').blockrain( {
            blockWidth: 10,
            theme: 'gameboy',
        });
    </script>
    
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

    <script>


        $(document).on("pagecreate", function(){
            $(".game").on("tap",function(){
                var e = jQuery.Event("keydown");
                e.keyCode = 38;
                $(".game").trigger(e);
            });
        });

        $(document).on("pagecreate", function(){
            $(".game").on("swipeleft",function(){
                var e = jQuery.Event("keydown");
                e.keyCode = 37;
                $(".game").trigger(e);
            });
        });

        $(document).on("pagecreate", function(){
            $(".game").on("swiperight",function(){
                var e = jQuery.Event("keydown");
                e.keyCode = 39;
                $(".game").trigger(e);
            });
        });

    </script>

@endsection
