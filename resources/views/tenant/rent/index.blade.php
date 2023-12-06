
@extends('layouts.tenant')

@section('header')

@endsection

@section('content')

@push('css')

    <link href="../css/receipt.css" rel="stylesheet" type="text/css" />

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

                                        @if ($rent->created_at == "confirmed")
                                            <td>
                                                {{-- <button class="btn btn-primary"> Print</button> --}}
                                                <a class="btn btn-primary viewDetails"
                                                    href="{{ route('receipt', $rent->id) }}"
                                                    style="cursor: pointer" data-reference="{{ $rent->id }}" id="viewInvoiceDetailsBtn"
                                                    onclick="preventReload(event)">
                                                Receipt
                                                </a>
                                            </td>

                                            @else
                                            <td>No receipt until its confirmed</td>
                                        @endif
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
{{-- @foreach ($rents as $key => $rent)
    <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade"
        id="viewReceiptModal_{{ $rent->id }}" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close align-items-right" id="invoice_modal_close_btn"
                    style="justify-content: right;display: flex;"data-dismiss="modal" data-bs-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="modal-body" id="printThis">


                </div>
            </div>
        </div>
    </div>

@endforeach --}}

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
            // var content = document.getElementById("printThis").innerHTML;
            printElement($printElement)
            // Create an iframe
            // var iframe = document.createElement('iframe');
            // iframe.style.display = 'none';
            // document.body.appendChild(iframe);

            // // Write the content into the iframe
            // iframe.contentDocument.write('<html><head><title>Receipt</title></head><body>');
            // iframe.contentDocument.write(content);
            // iframe.contentDocument.write('</body></html>');
            // iframe.contentDocument.close(); // Close the document opened with document.write

            // // Print the iframe content
            // iframe.contentWindow.print();

            // // Remove the iframe from the DOM
            // document.body.removeChild(iframe);

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

































