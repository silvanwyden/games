@extends('layouts.app')

@section('content')

    <h1>Sudoku</h1>

    <div id="game">

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



@endsection
