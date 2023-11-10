
@extends('layouts.tenant')

@section('header')

@endsection

@section('content')

@push('css')

<style>
    .blank{
    border-bottom : thin solid black;
    }
    .box{
    border : thin solid black;
    padding : 5px;
    }
    @media print {
        .page-break {page-break-before: always;}
    }
    div {
    font-size : 12px;
    }
</style>

@endpush
<div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
		<!-- END: Subheader -->

	<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Rent Paid
                        </h3>
                    </div>
                </div>
				<div class="m-portlet__head-tools">
					<ul class="m-portlet__nav">
						@if(Auth::user()->hasRole('tenant'))
							<li class="m-portlet__nav-item">
								<a href="{{ url('my-new-rent') }}" class="btn btn-primary m-btn  m-btn--custom m-btn--icon m-btn--air">
									<span>
										<i class="fa fa-wrench"></i>
										<span>New Payments</span>
									</span>
								</a>
							</li>
						    <li class="m-portlet__nav-item"></li>
                        @endif
					</ul>
				</div>
			</div>
			<div class="m-portlet__body">
				<table class="table table-bordered table-striped " id="table">
					<thead class>
						@if(Auth::user()->hasRole('tenant'))
							<tr>
								<th></th>
								<th>Payment Medium</th>
                                <th>Amount</th>
                                <th>Period</th>
                                <th>Proof</th>
                                <th>Status</th>
                                <th>Expiring Date</th>
                                <th>Date paid</th>
                                <th>Receipt</th>
							</tr>


						@else

						@endif
					</thead>
					<tbody>
						    @if(Auth::user()->hasRole('tenant'))
								@foreach($rents as $key => $rent )
									<tr>
                                        <td> {{ $key + 1 }} </td>
										<td>
                                            {{ $rent->payment_medium }}
                                        </td>
										<td >{{ $rent->amount }}</td>

                                        <td>{{ $rent->period }} Year(s)</td>

                                        <td class="image-cell">
											<img class="enlarged-image" src="{{ asset('storage/images/payment_proof/' .  $rent->proof) }}" alt="Payment Proof">
                                            <div class="enlarged-image-container"></div>
										</td>

                                        <td> {{--  {{ $rent->status }} --}}
                                            @if ($rent->status == 'confirmed')
                                                <div class="confirmed"> Confirmed </div>
                                            @endif
                                            @if ($rent->status == 'unconfirmed')
                                                <div class="unconfirmed"> Unconfirmed </div>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $rent->expire_date }}
                                        </td>

                                        <td>
                                            {{ $rent->created_at }}
                                        </td>

                                        <td>
                                            {{-- <button class="btn btn-primary"> Print</button> --}}
                                            <button class="btn btn-primary viewDetails"
                                                data-target="#viewReceiptModal_{{ $rent->id }}" data-toggle="modal"
                                                style="cursor: pointer" data-reference="{{ $rent->id }}" id="viewInvoiceDetailsBtn"
                                                onclick="preventReload(event)">
                                               Receipt
                                            </button>
                                        </td>


									</tr>

								@endforeach

                            @endif
						</tbody>
				</table>
			</div>
		</div>
	</div>

    </div>
</div>
<!-- end:: Body -->

{{-- {{ dd($rents) }} --}}
@foreach ($rents as $key => $rent)
    <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade"
        id="viewReceiptModal_{{ $rent->id }}" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="printThis">
                <button type="button" class="close align-items-right" id="invoice_modal_close_btn"
                    style="justify-content: right;display: flex;"data-dismiss="modal" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="modal-body" id="printThis">

                    <div ng-app="rentReceipt" ng-controller="rentController as ctrl">
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
                                            <div class="col-lg-3">No.</div>
                                            <div class="col-lg-8">{{ 1000+$key }}</div>
                                            <div class=""></div>
                                            <div class="col-lg-3">Date.</div>
                                            <div class="col-lg-8">{{$rent->created_at}}</div>
                                            <div class=""></div>
                                            <div class="col-lg-3">Month. </div>
                                            <div class="col-lg-8 ">{{ \Carbon\Carbon::parse($rent->created_at)->format('F') }}</div>
                                            <div class="col-lg-2"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--   body -->
                                <hr>
                                <div class="row">
                                    <div class="col-lg-4">Received from :</div><div class="col-lg-7 blank">{{ $rent->tenant->name }} {{ $rent->tenant->middlename }} {{ $rent->tenant->lastname }}</div>
                                    <div class="col-lg-4">Rental Address :</div><div class="col-lg-7 blank">{{ \App\Models\Building::where('id', $rent->apartment->building_id)->first()->building_address }}</div>
                                    <div class="col-lg-4">Building name :</div><div class="col-lg-7 blank">{{ \App\Models\Building::where('id', $rent->apartment->building_id)->first()->building_name }}</div>
                                    <div class="col-lg-4">Apartment no :</div><div class="col-lg-7 blank">{{ $rent->apartment->apartment_no }}</div>
                                    <div class="col-lg-4">Payment Amount :</div><div class="col-lg-7 blank">{{ $rent->amount }}</div>
                                    <div class="col-lg-4">Received by :</div><div class="col-lg-7 blank">Minfa Estate</div>
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
                </div>
            </div>
        </div>
    </div>

@endforeach

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
            // $('#download-pdf').hide();
            // $('.print-btnn').hide();
            // // $('#send-btn').hide();
            // $('.delete-btn').hide();
            $('.print').hide();
            var $printElement = document.getElementById("printThis");
            printElement($printElement);
            enableUnprintableArea();
            });

            function enableUnprintableArea(){
                // $('#download-pdf').show();
                // $('.print-btnn').show();
                // //$('#send-btn').show();
                // $('.delete-btn').show();

                $('.print').show();
            }
            function printElement(elem) {
                var domClone = elem.cloneNode(true);

                var $printSection = document.getElementById("printSection");

                // if their is no existing print section create one
                if (!$printSection) {
                    var $printSection = document.createElement("div");
                    $printSection.id = "printSection";
                    document.body.appendChild($printSection);
                }

                $printSection.innerHTML = "";
                $printSection.appendChild(domClone);
                window.print();
            }
        });



    </script>
@endpush

@endsection

































