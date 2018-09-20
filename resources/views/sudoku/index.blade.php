@extends('layouts.app')

@section('pageTitle', 'Sudoku')
@section('content')

    <h1>Sudoku</h1>

    <form action="/sudoku" method="POST" class="form-horizontal" id="myform">
        {{ csrf_field() }}

        <div id="game">


            <div class="row" style="margin-left: 0px; margin-bottom: 10px; margin-right: 0px; text-align: center;">
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


                        <a class="btn btn-primary" onclick="getMessage()">Solved <span class="glyphicon glyphicon-question-sign"></span></a>

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
                             " name="cell[{{ $loop->parent->index }}][{{ $loop->index }}]" type="text" maxlength="1" value=
                        @if ($temp2 > 0)
                            "{{ $temp2 }}" readonly class="readonly"
                         @else
                            "" class="editable"
                         @endif
                             />
                    </div>
                @endforeach
            @endforeach

        </div>


	<!-- Modal for messages -->
	<div id="modal-msg" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLongTitle">Sudoku</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	      </div>
	      <div class="modal-body" style="text-align: center;">
		<i class="fa fa-spinner fa-spin" id="spinner-icon" style="font-size:24px;"></i>
	      </div>
	      <div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

    </form>


    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        function getMessage(){

            $.ajax({
                type:'POST',
                url:'/sudoku-solve',
                data: $('form').serialize(),
                success:function(data){
                    $(".modal-body").html(data.msg);
                },
                error:function(data){
                    $(".modal-body").html("Error: Please fill out ALL the fields!");
                }
            });
        }


        $body = $("body");
        $(document).on({
            ajaxStart: function() { 
		$(".modal-body").html('<i class="fa fa-spinner fa-spin" id="spinner-icon" style="font-size:24px;"></i>');
		 $("#modal-msg").modal();    
		},
        });

    </script>


    <script type="text/javascript">
        // Initialize the numpad

        $.fn.numpad.defaults.gridTpl = '<table class="table modal-content"></table>';
        $.fn.numpad.defaults.backgroundTpl = '<div class="modal-backdrop in"></div>';
        $.fn.numpad.defaults.displayTpl = '<input type="text" class="form-control  input-lg" />';
        $.fn.numpad.defaults.cellTpl = '<td style="border: 0px;"></td>';
        $.fn.numpad.defaults.buttonNumberTpl =  '<button type="button" class="btn btn-warning btn-lg"></button>';
        $.fn.numpad.defaults.buttonFunctionTpl = '<button type="button" class="btn btn-lg" style="width: 100%;"></button>';


        $('.editable').numpad({
            buttonNumberTpl: '<button type="button" class="btn btn-warning btn-lg"></button>',
            onChange: function(){
                $('.done').click();
            },
        });
    </script>

@endsection
