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

@endsection
