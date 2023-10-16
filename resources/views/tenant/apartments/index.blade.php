
@extends('layouts.tenant')

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
                            Available apartments
                        </h3>
                    </div>
                </div>
				
			</div>
			<div class="m-portlet__body">
				<table class="table table-bordered table-striped " id="table">
					<thead class>
						@if(Auth::user()->hasRole('tenant'))
                        <tr>
                            <th>Apartment No</th>
                            <th>Apartment Type</th>
                            <th>Rent</th>
                            <th>Building</th>
                            <th>Floor</th>
                        </tr>

						@else

						@endif
					</thead>
					<tbody>
						@if(Auth::user()->hasRole('tenant'))
                            @foreach($apartments as $apartment)
                                <tr> 
                                    <td>{{ $apartment->apartment_no }}</td>
                                    <td>{{ $apartment->apartment_type }}</td>
                                    <td>{{ $apartment->rent }}</td>
                                    <td>{{ $apartment->building->building_name }}</td>
                                    <td>{{ $apartment->floor }}</td>
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

































