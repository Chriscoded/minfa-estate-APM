
@extends('layouts.tenant')

@section('header')

@endsection

@section('content')

@push('css')

<style>
    .image-cell {
        width: 100px; /* Set a fixed width for the td */
        height: 100px; /* Set a fixed height for the td */
        padding: 10px; /* Add some padding inside the td */
    }

    .image-cell img {
        width: 100%; /* Make the image fill the td width */
        height: auto; /* Maintain aspect ratio */
        display: block; /* Remove any extra space below the image */
    }

    .enlarged-image-container {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
    }

    .enlarged-image-container img {
        max-width: 90%;
        max-height: 90%;
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
                                <th>Date paid</th>
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

                                        <td>{{ $rent->period }}</td>

                                        <td class="image-cell">
											<img class="enlarged-image" src="{{ asset('storage/images/payment_proof/' .  $rent->proof) }}" alt="Payment Proof">
                                            <div class="enlarged-image-container"></div>
										</td>

                                        <td>
                                            {{ $rent->created_at }}
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



    </script>
@endpush

@endsection

































