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

        $puzzle = new \Puzzle();
        $puzzle->setCellSize(3);
        $puzzle->generatePuzzle(15);
        $sudoku = $puzzle->getPuzzle();
        //$puzzle->solve();
       // $solution = $puzzle->getSolution();



        return view('sudoku.index', [
            'name' => 'testname',
            'sudoku' => $sudoku,
        ]);

    }


}
