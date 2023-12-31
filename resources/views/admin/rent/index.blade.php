
@extends('layouts.admin')

@section('header')

@endsection

@section('content')

@push('css')

<style>

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
                            All Rent Paid
                        </h3>
                    </div>
                </div>
			</div>
			<div class="m-portlet__body">
				<table class="table table-bordered table-striped " id="table">
					<thead class>
						@if(Auth::user()->hasRole('admin'))
							<tr>
								<th></th>
                                <th>Building Name</th>
                                <th>Apartment No</th>
                                <th>Tenant Name</th>
								<th>Payment Medium</th>
                                <th>Amount</th>
                                <th>Period</th>
                                <th>Proof</th>
                                <th>Status</th>
                                <th>Expiring Date</th>
                                <th>Date paid</th>
                                <th>Actions</th>
							</tr>


						@else

						@endif
					</thead>
					<tbody>
						    @if(Auth::user()->hasRole('admin'))

								@foreach($rents as $key => $rent )
									<tr>
                                        <td> {{ $key + 1 }} </td>
                                        <td> {{ \App\Models\Building::where('id', $rent->apartment->building_id)->first()->building_name }} </td>
                                        <td> {{ $rent->apartment->apartment_no }} </td>
                                        <td>
                                            {{ \App\Models\Tenant::where('id', $rent->tenant_id)->first()->name }}
                                            {{ \App\Models\Tenant::where('id', $rent->tenant_id)->first()->middlename }}
                                            {{ \App\Models\Tenant::where('id', $rent->tenant_id)->first()->lastname }}
                                        </td>
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
											{{-- <a href="{{ url('edit-/'.$apartment->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit ">
												<i class="fa fa-edit"></i>
											</a> --}}


											<a href="{{ url('delete-payment/'.$rent->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit ">
												<i class="fa fa-trash" style="color:red"></i>
											</a>

                                            @if ( $rent->status == "unconfirmed")
                                                <a type="button" class="btn btn-success confirm-rent" data-id="{{ $rent->id }}" style="color:white">
                                                    Confirm
                                                </a>
                                            @endif
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
        });

        $(document).on('click', '.confirm-rent', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            // alert(id);
            // alert(this.id);
            swal({
                title: "Are you sure you want to confirm this payment?",
                text: "This action cannot be undone",
                // icon: "info", /* type: "info", */
                // dangerMode: true,
                buttons: ["Cancel", "Confirm"],
                showCloseButton: true
            }).then((value) => {

                // If user clicks ok, want to proceed in deleteing
                if (value == true) {
                    ///delete sent cheque if delete is clicked
                    $.ajax({
                        type: "GET",
                        url: "/rent/accept",
                        data: { id: id },
                        dataType: "text",
                        success: function (response) {
                            console.log(response);
                            var result = JSON.parse(response);
                            // alert(result.message);
                            // display successfull message
                            swal(result.message, {
                                icon: "success",
                                buttons: false,
                                timer: 3000,
                            }).then((value) => {
                                location.reload();
                            });

                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });

                }
            });

        });


    </script>
@endpush

@endsection

































