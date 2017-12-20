<?php

namespace App\Http\Controllers;

use App\Events\PushNotif;
use App\Smarte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    // All Of Main Controller
    public function __construct()
    {
    }

    public function index(){

        $mainData = Smarte::select('*')
            ->orderBy('created_at','DESC')
            ->limit(10)
            ->get();

        // Date Json Array All
        $queryRaw = "SELECT DATE(created_at) date, COUNT(DISTINCT id) count FROM smarte GROUP BY DATE(created_at) LIMIT 90;";
        $query = DB::select(DB::raw($queryRaw));
        $counter = 0;
        foreach ($query as $qs){
            $date[$counter] = $qs->date;
            $count[$counter] = $qs->count;
            $counter++;
        }
        // Date JSON November
        //
        $queryRawNOV = "SELECT DATE(created_at) date, COUNT(DISTINCT id) count FROM smarte WHERE created_at LIKE '2017-11-%' GROUP BY DATE(created_at) LIMIT 30;";
        $queryNOV = DB::select(DB::raw($queryRawNOV));
        $counterNOV = 0;
        foreach ($queryNOV as $qs){
            $dateNov[$counterNOV] = $qs->date;
            $countNov[$counterNOV] = $qs->count;
            $counterNOV++;
        }

        // Date Json December
        $queryRawDEC = "SELECT DATE(created_at) date, COUNT(DISTINCT id) count FROM smarte WHERE created_at LIKE '2017-12-%' GROUP BY DATE(created_at) LIMIT 30;";
        $queryDEC = DB::select(DB::raw($queryRawDEC));
        $counterDEC = 0;
        foreach ($queryDEC as $qs){
            $dateDEC[$counterDEC] = $qs->date;
            $countDEC[$counterDEC] = $qs->count;
            $counterDEC++;
        }


        return view('home',['database' => $mainData,
            'dates'=>json_encode($date),
            'counts' => json_encode($count),
            ]);
    }

    public function json_graph(){
        $queryRaw = "SELECT DATE(created_at) date, COUNT(DISTINCT id) count FROM smarte GROUP BY DATE(created_at);";
        $query = DB::select(DB::raw($queryRaw));
        return response()->json($query);
    }

    public function json_graphs(){
        $queryRaw = "SELECT DATE(created_at) date, COUNT(DISTINCT id) count FROM smarte GROUP BY DATE(created_at);";
        $query = DB::select(DB::raw($queryRaw));
        $counter = 0;
        foreach ($query as $qs){
            $dataraw[0][$counter] = $qs->date;
            $dataraw[1][$counter] = $qs->count;
            $counter++;
        }
        return json_encode($dataraw);
    }

    public function jsonGraphDate($date){
        // Sample Date
        // 2017-12 -> December
        // 2017-11 -> november
        $queryRawDEC = "SELECT DATE(created_at) date, COUNT(DISTINCT id) count FROM smarte WHERE created_at LIKE '"."$date"."%' GROUP BY DATE(created_at) LIMIT 30;";
        $queryDEC = DB::select(DB::raw($queryRawDEC));
        $counter = 0;
        foreach ($queryDEC as $qs){
            $dataraw[0][$counter] = $qs->date;
            $dataraw[1][$counter] = $qs->count;
            $counter++;
        }
        return json_encode($dataraw);
    }

    public function jsonCompareDate(){

        $queryRaw = "SELECT DATE(created_at) date, COUNT(DISTINCT id) count FROM smarte GROUP BY MONTH(created_at);";
        $query = DB::select(DB::raw($queryRaw));
        $counter = 0;
        foreach ($query as $qs){
            $dataraw[0][$counter] = $qs->date;
            $dataraw[1][$counter] = $qs->count;
            $counter++;
        }
        return json_encode($dataraw);
    }

    public function all(){
        $logdat = Smarte::select('*')
            ->orderBy('created_at','DESC')
            ->get();

        return response()->json($logdat);
    }

    public function detected($sensor){
        //dd($sensor);
        $addnew = new Smarte;
        $addnew->sensor = $sensor;
        if(!$addnew->save()){
            echo "Failure Inserted!";
        }else{
            return redirect('push');
        }

    }
}
