@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 20px">
    <!-- TOP -->
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Statistik</div>
                <div class="panel-body">
                    <p id="ouputdata"></p>
                    <p class="text-center"><b>Avaibale Every 3 Month</b></p>
                    <canvas id="topChart" width="100%" height="30"></canvas>
                </div>
            </div>
        </div>


    </div>

    <!-- Middle-->

    <div class="row">

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">November 2017</div>
                <div class="panel-body">
                    <canvas id="midChart1" width="100%" height="50"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">December 2017</div>
                <div class="panel-body">
                    <canvas id="midChart2" width="100%" height="50"></canvas>
                </div>
            </div>
        </div>

    </div>

    <!-- Bottom -->
    <div class="row">

        <div class="col-md-8">
           <div class="panel panel-default">
               <div class="panel-heading">Table Reader & Log</div>
               <div class="panel-body">
                   <table class="table table-bordered">
                       <thead>
                       <tr>
                           <th>No</th>
                           <th>ID</th>
                           <th>Sensor Track</th>
                           <th>Time Detected</th>
                           <th>Last Detected</th>
                       </tr>
                       </thead>
                       <tbody>
                       <?php $count = 1; ?>
                       @foreach($database as $data)
                           <tr>
                               <td>{{$count++}}</td>
                               <td>{{$data->id}}</td>
                               <td>{{$data->sensor}}</td>
                               <td>{{$data->created_at}}</td>
                               <td>{{$data->updated_at}}</td>
                           </tr>
                       @endforeach

                       </tbody>
                   </table>
               </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Performance Per month</div>
                <div class="panel-body">
                    <canvas id="pieChart" width="100%" height="100"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
