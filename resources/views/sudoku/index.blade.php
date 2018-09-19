@extends('layouts.app')

@section('content')

    <h1>Sudoku</h1>

    <form action="/sudoku" method="POST" class="form-horizontal" id="myform">
        {{ csrf_field() }}

        <div id="game">


            <div class="row" style="margin-left: 0px; margin-bottom: 10px;">
                <div>
                    <div class="btn-group" role="group" aria-label="first">

                        <a href="/sudoku" class="btn btn-primary">New</a>

                        <div class="btn-group" role="group">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="selection">{{ $level or "Easy" }}</span>&nbsp;&nbsp;<span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                @foreach ($levels as $level)
                                    <li><a href="?level={{ $level }}">{{ $level }}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <button type="submit" class="btn btn-primary">Solved <span class="glyphicon glyphicon-question-sign"></span></button>

                    </div>
                </div>
            </div>

            @foreach ($sudoku as $temp)
                @foreach ($temp as $temp2)
                    <div class="cell"><input style="
                        @if ($loop->iteration ==3 || $loop->iteration ==6)
                            border-right-color: black;
                         @endif

                         @if ($loop->parent->iteration ==3 || $loop->parent->iteration ==6)
                            border-bottom-color: black;
                        @endif
                             " name="cell[{{ $loop->parent->index }}{{ $loop->index }}]" type="text" maxlength="1" value=
                        @if ($temp2 > 0)
                            "{{ $temp2 }}" disabled
                         @else
                             ""
                         @endif
                             />
                    </div>
                @endforeach
            @endforeach

        </div>

    </form>

@endsection