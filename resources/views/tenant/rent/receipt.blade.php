
@extends('layouts.tenant')

    @section('header')

    @endsection

    @section('content')

    @push('css')

        <link href="../css/receipt.css" rel="stylesheet" type="text/css" />

    @endpush

        <div id="printThis">
            <div class="container">
            <!--   each receipt -->
            <!--   header -->
                <div class="box" ng-class="{'page-break' : $index%3 == 0}" ng-repeat="receipt in ctrl.receitps.range">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 style="color: #5867dd">Minfa Estate</h3>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-3">No.</div>
                                <div class="col-8">{{ 1000+$rent['id'] }}</div>
                                <div class=""></div>
                                <div class="col-3">Date.</div>
                                <div class="col-8">{{$rent['created_at']}}</div>
                                <div class=""></div>
                                <div class="col-3">Month. </div>
                                <div class="col-8 ">{{ \Carbon\Carbon::parse($rent['created_at'])->format('F') }}</div>
                                <div class="col-2"></div>
                            </div>
                        </div>
                    </div>
                    <!--   body -->
                    <hr>
                    <div class="row">
                        <div class="col-4">Received from :</div><div class="col-7 blank">{{ $rent->tenant->name }} {{ $rent->tenant->middlename }} {{ $rent->tenant->lastname }}</div>
                        <div class="col-4">Rental Address :</div><div class="col-7 blank">{{ \App\Models\Building::where('id', $rent->apartment->building_id)->first()->building_address }}</div>
                        <div class="col-4">Building name :</div><div class="col-7 blank">{{ \App\Models\Building::where('id', $rent->apartment->building_id)->first()->building_name }}</div>
                        <div class="col-4">Apartment no :</div><div class="col-7 blank">{{ $rent->apartment->apartment_no }}</div>
                        <div class="col-4">Payment Amount :</div><div class="col-7 blank">{{ $rent->amount }}</div>
                        <div class="col-4">Received by :</div><div class="col-7 blank">Minfa Estate</div>
                    </div>
                    <hr>
                    <div class="row">
                    </div>
                    <div class="col-lg-4 box mt-3">
                        <h6>Signature : <h6>
                        <img width=60 height=30 src="{{ asset('images/signature_prev_ui.png') }}" alt="" />

                    </div>

                </div>
                <button class="btn btn-primary mt-2 print" style="cursor: pointer; float:right" >
                    Print
                </button>
            </div>
        </div>

        @push('js')
        <script>
        $(document).ready(function() {

            $(document).on('click', '.enlarged-image', function (e) {
                var imageUrl = $(this).attr('src');
                $('.enlarged-image-container').html('<img src="' + imageUrl + '">');
                $('.enlarged-image-container').fadeIn();
            });

             // Close the enlarged image when clicked outside the image
             $('.enlarged-image-container').on('click', function() {
                $(this).fadeOut();
            });

            $(document).on('click', '.print', function(e) {

                $('.print').hide();
                $('#m_header_topbar').hide();
                var $printElement = document.getElementById("printThis");
                // var content = document.getElementById("printThis").innerHTML;
                printElement($printElement)

                enableUnprintableArea();
                });

                function enableUnprintableArea(){

                    $('.print').show();
                    $('#m_header_topbar').show();
                }
                function printElement(elem) {
                    var domClone = elem.cloneNode(true);

                    var $printSection = document.getElementById("printSection");

                    // if their is no existing print section create one
                    if (!$printSection) {
                        var $printSection = document.createElement("div");
                        $printSection.id = "printSection";
                        //document.body.appendChild($printSection);
                    }

                    $printSection.innerHTML = "";
                    $printSection.appendChild(domClone);
                    window.print();
                }
            });



        </script>
    @endpush

    @endsection




