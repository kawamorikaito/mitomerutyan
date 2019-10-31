<?php

namespace App\Http\Controllers;

use App\Calendar;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class calendarController extends Controller
{
    public function index () {
        $days = Calendar::select('day', 'hanamaru', 'task1', 'task2','task3')->get();

        $targetYear = date("Y");
        $targetMonth = date("m");
        $targetDay = date("d");
        $lastDate = date('d', mktime(0, 0, 0, date('m') + 1, 0, date('Y')));

        $targetDate = date('w',strtotime("first day of this month")) + 1;
        $weekCount = 1;
        
        for ($count = 1; $count < $targetDate; $count++){
            $dummyCalendar[] = $count;
        }

        for ($date = 1; $date <= $lastDate; $date++) {
            $hanamaru = "none";
            $task1 = NULL;
            $task2 = NULL;
            $task3 = NULL;
            foreach ($days as $targetNowDay) {
                if( $date == $targetNowDay['day'] ){
                    $hanamaru = $targetNowDay['hanamaru'];
                    $task1 = $targetNowDay['task1'];
                    $task2 = $targetNowDay['task2'];
                    $task3 = $targetNowDay['task3'];
                    //if ( $targetNowDay['task2'] != NULL) {
                    //    $task2 = $targetNowDay['task2'];
                    //}
                    break;
                }
                else {
                    $hanamaru = "none";
                    $task1 = NULL;
                    $task2 = NULL;
                    $task3 = NULL;
                }
            }
            
            $calendar[] = array('year'      => $targetYear,
                                'month'     => $targetMonth,
                                'day'       => $targetDay,
                                'nowDate'   => $date, 
                                'weekCount' => $weekCount, 
                                'Date'      => $targetDate, 
                                'hanamaru'  => $hanamaru,
                                'task1'     => $task1, 
                                'task2'     => $task2, 
                                'task3'     => $task3, );
            
            $targetDate++;
            if ($targetDate > 7) {
                $targetDate = 1;
                $weekCount++;
            }

            
        }
        $selectDate = $calendar[$calendar[1]['day'] - 1];
        return view('calendar',compact('calendar', 'dummyCalendar', 'selectDate'));
    }

    public function daydata (Request $request) {

        $days = Calendar::select('day', 'hanamaru', 'task1', 'task2', 'task3')->get();

        $targetYear = date("Y");
        $targetMonth = date("m");
        $lastDate = date('d', mktime(0, 0, 0, date('m') + 1, 0, date('Y')));
        
        $targetDate = date('w',strtotime("first day of this month")) + 1;
        $weekCount = 1;
        
        for ($count = 1; $count < $targetDate; $count++){
            $dummyCalendar[] = $count;
        }
       

        for ($date = 1; $date <= $lastDate; $date++) {
            $hanamaru = "none";
            $task1 = NULL;
            $task2 = NULL;
            $task3 = NULL;
            foreach ($days as $targetNowDay) {
                if( $date == $targetNowDay['day'] ){
                    $hanamaru = $targetNowDay['hanamaru'];
                    $task1 = $targetNowDay['task1'];
                    $task2 = $targetNowDay['task2'];
                    $task3 = $targetNowDay['task3'];
                    //if ( $targetNowDay['task2'] != NULL) {
                    //    $task2 = $targetNowDay['task2'];
                    //}
                    break;
                }
                else {
                    $hanamaru = "none";
                    $task1 = NULL;
                    $task2 = NULL;
                    $task3 = NULL;
                }
            }

            $calendar[] = array('year'      => $targetYear,
                                'month'     => $targetMonth,
                                'day'       => $request->day,
                                'nowDate'   => $date,
                                'weekCount' => $weekCount, 
                                'Date'      => $targetDate, 
                                'hanamaru'  => $hanamaru,
                                'task1'     => $task1, 
                                'task2'     => $task2, 
                                'task3'     => $task3, 
                            );
            
            $targetDate++;
            if ($targetDate > 7) {
                $targetDate = 1;
                $weekCount++;
            }
            
            
             
        }
        $selectDate = $calendar[$request->day - 1];
        return view('calendar',compact('calendar', 'dummyCalendar', 'selectDate'));
    }

    public function regist (Request $request){
        echo $request;
        $validator = $request->validate([
            'task1' => 'max:15',
        ],
        [
            'task1.max' => '10文字までだよ！',
        ]
        );

        $registData = new Calendar;
        $registData->year  = $request->year;
        $registData->month  = $request->month;
        $registData->day  = $request->day;
        $registData->task1 = $request->task1;
        $registData->task2 = $request->task2;
        $registData->task3 = $request->task3;
        $registData->task1achievement = NULL;
        $registData->task2achievement = NULL;
        $registData->task3achievement = NULL;
        $registData->hanamaru = "blank";
        $registData->save();

        return redirect('/');
    }

    public function update (Request $request){
        echo $request;
        $validator = $request->validate([
            'task1' => 'max:15',
        ],
        [
            'task1.max' => '10文字までだよ！',
        ]
        );

        $sum = $request->task1achievement + $request->task2achievement + $request->task3achievement;
        if ($sum == 300 ) {
            $hanamaru = "red";
        }
        elseif ($sum > 200 ) {
            $hanamaru = "orange";
        }
        elseif ($sum > 100 ) {
            $hanamaru = "blue";
        }
        else {
            $hanamaru = "purple";
        }

        DB::table('calendars')
        ->where('day', $request->day)
        ->update(['task1achievement' => $request->task1achievement,
                  'task2achievement' => $request->task2achievement,
                  'task3achievement' => $request->task3achievement,
                  'hanamaru'         => $hanamaru]);
       

        
        return redirect('/');
    }

}
