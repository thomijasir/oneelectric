<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        .navbar-header {
            float: left;
            padding: 15px;
            text-align: center;
            width: 100%;
        }
        .navbar-brand {float:none;}
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top hidden-xs">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>--}}

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
{{--
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Register</a></li>
                    </ul>
                </div>--}}
            </div>
        </nav>

        @yield('content')
    </div>




    <script src="{{ asset('js/chart/Chart.js') }}"></script>
    <script>
        /*var dates = <?php echo $dates; ?>;
        var counts = <?php echo $counts; ?>;

        var ctx = document.getElementById("topChart");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: '# Electric Usage',
                    data: counts,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

        var mctx = document.getElementById("midChart1");
        var myChart2 = new Chart(mctx, {
            type: 'bar',
            data: {
                labels: ["12-may207", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                    label: '# Electric Usage',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor:'rgba(255,99,132,1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });


        var mctxs = document.getElementById("midChart2");
        var myChart3 = new Chart(mctxs, {
            type: 'bar',
            data: {
                labels: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16],
                datasets: [{
                    label: '# Electric Usage',
                    data: [12, 19, 3, 5, 2, 3,14,5,12,53,2,15,12,15,15,12],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

        new Chart(document.getElementById("pieChart"), {
            type: 'pie',
            data: {
                labels: ["September", "December",],
                datasets: [{
                    label: "Performance Efficiency",
                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                    data: [2478,5267]
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Performance Efficiency Electricity'
                }
            }
        });*/
    </script>

    <script>
        var mainHost = window.location.hostname;
        var mainUrl = "http://www."+mainHost+".com";

        var finalUrl = "http://localhost:8000/jsongraphs";
        var linkNov = "http://localhost:8000/jsongraphs/2017-11";
        var linkDec = "http://localhost:8000/jsongraphs/2017-12";
        var linkCom = "http://localhost:8000/jsoncomparedate";

        // Sample Passing Data WIth Callback
        function get(url, callback) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", url, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    // defensive check
                    if (typeof callback === "function") {
                        // apply() sets the meaning of "this" in the callback
                        callback.apply(xhr);
                    }
                }
            };
            xhr.send();
        }
        // ----------------------------------------------------------------------------


        // get() completes immediately...
        get(finalUrl,
            // ...however, this callback is invoked AFTER the response arrives
            function () {
                // "this" is the XHR object here!
                var resp  = JSON.parse(this.responseText);

                // now do something with resp
                //console.log(resp[1]);

                // Draw Graph
                var ctx = document.getElementById("topChart");
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: resp[0],
                        datasets: [{
                            label: '# Electric Usage',
                            data: resp[1],
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            }
        );


        // Non Call Back FUnction
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Typical action to be performed when the document is ready:
                var reps = JSON.parse(xhttp.responseText);
                //console.log(reps[0]);
                var mctx = document.getElementById("midChart1");
                var myChart2 = new Chart(mctx, {
                    type: 'bar',
                    data: {
                        labels:reps[0],
                        datasets: [{
                            label: '# Electric Usage',
                            data: reps[1],
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor:'rgba(255,99,132,1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            }
        };
        xhttp.open("GET", linkNov, true);
        xhttp.send();

        var xhttp2 = new XMLHttpRequest();
        xhttp2.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200){
                var reps = JSON.parse(this.responseText);
                var mctxs = document.getElementById("midChart2");
                var myChart3 = new Chart(mctxs, {
                    type: 'bar',
                    data: {
                        labels: reps[0],
                        datasets: [{
                            label: '# Electric Usage',
                            data: reps[1],
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            }
        };
        xhttp2.open("GET",linkDec,true);
        xhttp2.send();


        var xhttp3 = new XMLHttpRequest();
        xhttp3.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200){
                var reps = JSON.parse(this.responseText);
                new Chart(document.getElementById("pieChart"), {
                    type: 'pie',
                    data: {
                        labels: reps[0],
                        datasets: [{
                            label: "Performance Efficiency",
                            backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                            data: reps[1]
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Performance Efficiency Electricity'
                        }
                    }
                });
            }
        };
        xhttp3.open("GET",linkCom,true);
        xhttp3.send();

    </script>
</body>
</html>
