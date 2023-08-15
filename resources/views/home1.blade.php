@extends('layouts.appp')
@push('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic&display=swap" rel="stylesheet">
    <style>
        h4{
            color: white;
        }
        h2{
            color: white;
        }
        .chartref{
            width:16rem !important;
            height:16rem !important;
            margin:auto;
        }
        .chartev{
            width:16rem !important;
            height:16rem !important;
            margin:auto;
        }

        #myChartGender{
            width:19rem !important;
            height:19rem !important;
            margin:auto;
            margin-top: 11%;
        }
        #myChartAge{
            width:20rem !important;
            height:20rem !important;
            margin:auto;
            margin-top: 7%;

        }
        #myChartCountries{
            width:22rem !important;
            height:22rem !important;
            margin:auto;
        }

    </style>
@endpush
@section('content')

    @if(Auth::user()->type == 1 || Auth::user()->type == 3|| Auth::user()->type == 5)
        <div class="col-sm-12 col-lg-12 pb-2">
            <button id="export-report" class="btn btn-primary">تصدير</button>
        </div>
    @endif
    <div class="" id="canvas_image" style="word-wrap: normal;font-family: 'Noto Sans Arabic', sans-serif;text-align: right;letter-spacing: normal !important;">
        <div class="row">
            @if(Auth::user()->type == 2 || Auth::user()->type == 4)
                <div class="col-sm-12 col-lg-6">
                    <div class="card shadow-base bg-primary card-img-holder text-white">
                        <div class="card-body">
                            @if(Auth::user()->type == 4)
                                <h4 class=" mb-2 text-center" style="word-wrap: normal;font-family: 'Noto Sans Arabic', sans-serif;">
                                    المتأهلين
                                </h4>
                                <h2 class="mb-0 text-center">
                                    {{ $doneEv }}
                                </h2>
                            @endif
                            @if(Auth::user()->type == 2)
                                <h4 class=" mb-2 text-center" style="word-wrap: normal;font-family: 'Noto Sans Arabic', sans-serif;">
                                    متقدمين تم تقييمهم
                                </h4>
                                <h2 class="mb-0 text-center" >
                                    {{ $doneEv }}
                                </h2>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-lg-6">
                    <div class="card shadow-base bg-success card-img-holder text-white">
                        <div class="card-body">
                            @if(Auth::user()->type == 4)
                                <h4 class=" mb-2 text-center">
                                    المرشحين
                                </h4>
                                <h2 class="mb-0 text-center">
                                    {{ $needEv }}
                                </h2>
                            @endif
                            @if(Auth::user()->type == 2)
                                <h4 class=" mb-2 text-center">
                                    متقدمين بحاجة للتقييم
                                </h4>
                                <h2 class="mb-0 text-center">
                                    {{ $needEv }}
                                </h2>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @if(Auth::user()->type == 1 || Auth::user()->type == 3 || Auth::user()->type == 5)
            <div class="row">
                <div class="col-sm-12 col-lg-3">
                    <div >
                        <div class="" style=" box-shadow: 0px 2px 2px 2px #f2f2f2; background-color: white; height:11rem">
                          <br>
                            <h2 class=" text-center mb-2 " style="color: #66617a;letter-spacing: normal !important;">
                                المتقدمين
                            </h2>
                            <br>
                            <h1 class="mb-0 text-center" style="color: #66617a;">
                                {{$all}}
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-3">
                    <div >
                        <div class="" style=" box-shadow: 0px 2px 2px 2px #f2f2f2; background-color: white; height:11rem">
                           <br>
                            <h2 class=" mb-2 text-center" style="color: #66617a;">
                                المرشحين
                            </h2>
                            <br>
                            <h1 class="mb-0 text-center" style="color: #66617a;">
                                {{$accept}}                    </h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-3">
                    <div >
                        <div class="" style=" box-shadow: 0px 2px 2px 2px #f2f2f2; background-color: white; height:11rem">
                            <br>

                            <h2 class=" mb-2 text-center" style="color: #66617a;">
                                المشاركين
                            </h2>
                            <br>
                            <h1 class="mb-0 text-center" style="color: #66617a;">
                                {{ $data['FinalResult'] }}
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-3">
                    <div class="card shadow-base card-img-holder">
                        <div class="card-body">
                            <h1 style="text-align:center"></h1>
                            <canvas id="myChartAllCounts"></canvas>

                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4" style="margin-bottom:2rem">
                    <h1 style="text-align:center">جنسيات المشاركين</h1>
                    <canvas id="myChartCountries"></canvas>
                </div>

                <div class="col-sm-12 col-lg-4" style="margin-bottom:2rem">
                    <h1 style="text-align:center">جنس المشاركين</h1>
                    <canvas width="100%" id="myChartGender"></canvas>
                </div>

                <div class="col-sm-12 col-lg-4" style="margin-bottom:2rem">
                    <h1 style="text-align:center">الفئة العمرية </h1>
                    <canvas id="myChartAge"></canvas>
                </div>
            </div>
            <div class="row">
                <!-- -->
                <div class="col-sm-12 col-lg-4"></div>
                <div class="col-sm-12 col-lg-4"></div>
                <div class="col-sm-12 col-lg-4"></div>
                <div class="col-sm-12 col-lg-4"></div>
                <div class="col-sm-12 col-lg-4"><h1 style="margin:1rem 0 4rem 0;">الأعضاء ضمن لجنة التحكيم </h1></div>
                <div class="col-sm-12 col-lg-4"></div>
                <hr>
                <!-- -->
                <?php
                $temp=36;

                ?>
                @foreach($refarray as $ref)
                    <div class="col-sm-12 col-lg-4">

                        <canvas class="chartref" id="myChart{{$temp}}"></canvas>
                        <h1>{{$ref->name}}</h1>

                        <?php
                        $temp++;

                        ?>
                    </div>

                @endforeach
            </div>
            <!-- -->
            <div class="row">
                <div class="col-sm-12 col-lg-4"></div>
                <div class="col-sm-12 col-lg-4"></div>
                <div class="col-sm-12 col-lg-4"></div>
                <div class="col-sm-12 col-lg-4"></div>
                <div class="col-sm-12 col-lg-4"><h1 style="margin:5rem 0;">الأعضاء ضمن لجنة الفرز </h1></div>
                <div class="col-sm-12 col-lg-4"></div>
                <hr>
                <!-- -->
                <?php
                $te=51;

                ?>
                @foreach($evarray as $ref)
                    <div class="col-sm-12 col-lg-4">

                        <canvas class="chartev" id="myChart{{$te}}"></canvas>
                        <h1>{{$ref->name}}</h1>

                        <?php
                        $te++;

                        ?>
                    </div>

                @endforeach
            </div>
        @endif

    </div>

    <div id="editor"></div>
@endsection

@push('script')

    @if(Auth::user()->type == 1 || Auth::user()->type == 3|| Auth::user()->type == 5)
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
        <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
        <script>
            document.getElementById('export-report').addEventListener("click",function(){
                CreatePDFfromHTML();
            });

            function CreatePDFfromHTML() {
                var HTML_Width = $("#canvas_image").width();
                var HTML_Height = $("#canvas_image").height();
                var top_left_margin = 15;
                var PDF_Width = HTML_Width + (top_left_margin * 2);
                var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
                var canvas_image_width = HTML_Width;
                var canvas_image_height = HTML_Height;

                var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

                html2canvas($("#canvas_image")[0],{allowTaint:true}).then(function (canvas) {
                    canvas.getContext('2d');
                    var imgData = canvas.toDataURL("image/jpeg", 1.0);
                    var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
                    pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                    for (var i = 1; i <= totalPDFPages; i++) {
                        pdf.addPage(PDF_Width, PDF_Height);
                        pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                    }
                    pdf.save("Report.pdf");
                });
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- asdasd-->
        <script>
            <?php
            $t=51;

            ?>
            @foreach($evarray as $ref)

            var khaild = {{json_encode($data[$ref->name])}};


            const data{{$t}} = {
                labels: [
                    'بحاجة تقييم',
                    'تم التقييم',
                ],

                datasets: [{
                    label: "{{$ref->name}}",
                    data: khaild,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)'
                    ],
                    hoverOffset: 4
                }]
            };
            console.log(data{{$t}});

            const config{{$t}} = {
                type: 'doughnut',
                data: data{{$t}},
                options: {
                    plugins: {
                        legend: {
                            position: 'top',
                            align: 'center',
                            fullSize: false,
                            labels: {
                                font: {
                                    size: 16
                                },
                                padding: 10
                            },
                            maxWidth: 9999

                        }
                    }
                }




            };



            const myChart{{$t}} = new Chart(
                document.getElementById('myChart{{$t}}'),
                config{{$t}}
            );
            <?php $t++;
            ?>
            @endforeach
        </script>

        <!-- asdasd-->
        <script>
            <?php
            $tem=36;

            ?>
            @foreach($refarray as $ref)

            var khaild = {{json_encode($data[$ref->name])}};


            const data{{$tem}} = {
                labels: [
                    'بحاجة تقييم',
                    'تم التقييم',
                ],

                datasets: [{
                    label: "{{$ref->name}}",
                    data: khaild,
                    backgroundColor: [
                        'rgb(67, 45, 185)',
                        'rgb(70, 170, 70)'
                    ],
                    hoverOffset: 4
                }]
            };
            console.log(data{{$tem}});

            const config{{$tem}} = {
                type: 'doughnut',
                data: data{{$tem}},
                options: {
                    plugins: {
                        legend: {
                            position: 'top',
                            align: 'center',
                            fullSize: false,
                            labels: {
                                font: {
                                    size: 16
                                },
                                padding: 10
                            },
                            maxWidth: 9999

                        }
                    }
                }



            };



            const myChart{{$tem}} = new Chart(
                document.getElementById('myChart{{$tem}}'),
                config{{$tem}}
            );
            <?php $tem++;
            ?>
            @endforeach
        </script>

        <script>
            var countries = {!! json_encode($data['countries']) !!};


            const dataCountries = {
                labels: [
                    'المملكة العربية السعودية',
                    'سوريا',
                    'مصر',
                    'الكويت',
                    'قطر',
                    'سلطنة عمان',
                    'البحرين',
                    'الأردن',
                    'العراق',
                    'ليبيا',
                    'الجزائر',
                    'فلسطين'
                ],
                datasets: [{
                    label: 'المشاركين في برنامج شاعر الراية',
                    data: countries,
                    backgroundColor: [
                        'rgba(2, 76, 1, 1)',
                        'rgba(210, 8, 8, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255,1)',
                        'rgba(201, 203, 207,1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 255, 86, 1)',
                        'rgba(75, 255, 192, 1)',
                        'rgba(54, 255, 235, 1)',

                    ],
                    borderColor: [
                        'rgb(2, 76, 1)',
                        'rgb(210, 8, 8)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 255, 86)',
                        'rgb(75, 255, 192)',
                        'rgb(54, 255, 235)',
                    ],
                    borderWidth: 1
                }]
            };

            const configCountries = {
                type: 'doughnut',
                data: dataCountries,
                options: {
                    // scales: {
                    //   y: {
                    //     title: {
                    //       display: true,
                    //       text: ''
                    //     },
                    //     min: 0,
                    //     max: 350,
                    //     ticks: {
                    //       // forces step size to be 50 units
                    //       stepSize: 20
                    //     }
                    //   }
                    // },
                    plugins: {
                        legend: {
                            position: 'left',
                            align: 'top',
                            fullSize: false,
                            labels: {
                                font: {
                                    size: 12
                                },
                                padding: 10
                            },
                            maxWidth: 9999

                        }
                    }
                },
            };

            const myChartCountries = new Chart(
                document.getElementById('myChartCountries'),
                configCountries
            );
        </script>
        <script>
            var genderCount = {!! json_encode($data['gender']) !!};


            const dataGender = {
                labels: [
                    'ذكور',
                    'إناث',
                ],
                datasets: [{
                    label: 'الجنس',
                    data: genderCount,
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)',
                    ],
                    hoverOffset: 4
                }]
            };

            const configGender = {
                type: 'doughnut',
                data: dataGender,
                options: {
                    plugins: {
                        legend: {
                            position: 'left',
                            align: 'center',
                            fullSize: false,
                            labels: {
                                font: {
                                    size: 12
                                },
                                padding: 10
                            },
                            maxWidth: 9999

                        }
                    }
                }
            };


            const myChartGender = new Chart(
                document.getElementById('myChartGender'),
                configGender,
            );
        </script>
        <script>             var agecount = {!! json_encode($data['age']) !!};

            const dataAge = {
                labels: [


                    'اقل من 20',
                    ' أكثر من 20',
                    ' أكثر من 30',
                    ' أكثر من 40',
                    ' أكثر من 50',

                ],
                datasets: [{
                    label: ' الفئة العمرية',
                    data: agecount,
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)',
                        'rgb(2, 76, 1)',
                        'rgb(210, 8, 8)',
                        'rgb(255, 205, 86)',

                    ],
                    hoverOffset: 4
                }]
            };

            const configAge = {
                type: 'doughnut',
                data: dataAge,
                options: {

                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'left',
                            align: 'top',
                            fullSize: false,
                            labels: {
                                font: {
                                    size: 12
                                },
                                padding: 10
                            },
                            maxWidth: 9999

                        }
                    }
                }
            };


            const myCharAge = new Chart(
                document.getElementById('myChartAge'),
                configAge,
            );
        </script>

        <script>
            var FinalResult = {!! json_encode($data['FinalResult']) !!};


            const dataAllCounts = {
                labels: [
                    'المتقدمين',
                    'المرشحين',
                    'المشاركين'
                ],
                datasets: [{
                    label: 'العدد',
                    data: [{{$all}},{{$accept}},FinalResult],
                    backgroundColor: [
                        'rgba(86, 4, 89, 1)',
                        'rgba(4, 3, 92, 1)',
                        'rgba(255, 205, 86, 1)'

                    ],
                    borderColor: [
                        'rgb(86, 4, 89)',
                        'rgb(4, 3, 92)',
                        'rgb(255, 205, 86)'
                    ],
                    borderWidth: 1
                }]
            };

            const configAllCounts = {
                type: 'bar',
                data: dataAllCounts,
                options: {
                    scales: {
                        y: {
                            title: {
                                display: true,
                                text: ''
                            },
                            min: 0,
                            max: 350,
                            ticks: {
                                // forces step size to be 50 units
                                stepSize: 20
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                },
            };

            const myChartAllCounts = new Chart(
                document.getElementById('myChartAllCounts'),
                configAllCounts
            );

        </script>
        <script>

        </script>

    @endif
@endpush
