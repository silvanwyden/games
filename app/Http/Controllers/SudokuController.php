<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SudokuRepository;
use DateTime;
use DateInterval;
use App\Session;
use Log;
use Illuminate\Http\Response;
use PhpParser\Node\Expr\Array_;


class SudokuController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $sudoku;

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function __construct(SudokuRepository $sudoku)
    {

        $this->sudoku = $sudoku;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {


        //handle level
        if ($request->level)
            $request->session()->put('level', $request->level);
        else
            if ($request->session()->get('level') == '')
                $request->session()->put('level', 'normal');

        $level = $request->session()->get('level');
        $levels = Array('very easy', 'easy', 'normal', 'difficult', 'very difficult');

        //default value
        $cell_count = 41;

        //63-82 very easy
        if ($level == 'very easy')
            $cell_count = 80;
            //$cell_count = 63;

        //47-62 easy
        if ($level == 'easy')
            $cell_count = 47;

        //33-46 normal
        if ($level == 'normal')
            $cell_count = 30;

        //17-32 difficult
        if ($level == 'difficult')
            $cell_count = 20;

        //0-16 very difficult
        if ($level == 'very difficult')
            $cell_count = 10;

        $puzzle = new \Puzzle();
        $puzzle->setCellSize(3);
        $puzzle->generatePuzzle($cell_count);
        if (!$puzzle->isSolvable())
		$puzzle->generatePuzzle($cell_count);
        $sudoku = $puzzle->getPuzzle();

        return view('sudoku.index', [
            'name' => 'testname',
            'sudoku' => $sudoku,
            'levels' => $levels,
            'level' => $level,
        ]);

    }


    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function solve(Request $request) {


	//sleep(1);
        //Log::info($request);

        $puzzle = new \Puzzle();
        $puzzle->setSolution($request->cell);
        $puzzle->solve();

        $msg = '<i class="glyphicon glyphicon-thumbs-down"  style="font-size:40px;"></i><br><br> I\'m sorry, but your solution is wrong. Please try again!';
        if ($puzzle->isSolved())
            $msg = '<i class="glyphicon glyphicon-thumbs-up"  style="font-size:40px;"></i><br><br> Congratulation! Sudoku is solved!';

            return response()->json(array('msg'=> $msg), 200);
    }


}
