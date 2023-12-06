
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
                            All Expenses
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
                                <th>Amount</th>
								<th>Description</th>
                                <th>Action</th>

							</tr>


						@else

						@endif
					</thead>
					<tbody>
						    @if(Auth::user()->hasRole('admin'))

								@foreach($expenses as $key => $expense )
									<tr>
                                        <td> {{ $key + 1 }} </td>
                                        <td> {{ \App\Models\Building::where('id', $expense->apartment->building_id)->first()->building_name }} </td>
                                        <td> {{ $expense->apartment->apartment_no }} </td>
										<td>
                                            {{ $expense->amount }}
                                        </td>
										<td >{{ $expense->description }}</td>

                                        <td>
											{{-- <a href="{{ url('edit-/'.$apartment->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit ">
												<i class="fa fa-edit"></i>
											</a> --}}

											<a href="{{ url('delete-expense/'.$expense->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit ">
												<i class="fa fa-trash" style="color:red"></i>
											</a>
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

































