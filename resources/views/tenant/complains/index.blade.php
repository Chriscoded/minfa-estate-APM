
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
                            Your complains
                        </h3>
                    </div>
                </div>
				<div class="m-portlet__head-tools">
					<ul class="m-portlet__nav">
						@if(Auth::user()->hasRole('tenant'))
							<li class="m-portlet__nav-item">
								<a href="{{ url('my-new-complain') }}" class="btn btn-primary m-btn  m-btn--custom m-btn--icon m-btn--air">
									<span>
										<i class="fa fa-wrench"></i>
										<span>New Complain</span>
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
								<th>Complain message</th>
                                <th>Complain image</th>
                                <th>Status</th>
                                <th>Date complained</th>
							</tr>


						@else

						@endif
					</thead>
					<tbody>
						    @if(Auth::user()->hasRole('tenant'))
								@foreach($complains as $key => $complain )
									<tr>
                                        <td> {{ $key + 1 }} </td>
										<td>
                                            {{ $complain->complain }}
                                        </td>
										
                                        <td class="image-cell">
											<img class="enlarged-image" src="{{ asset('storage/images/complains/' .  $complain->image) }}" alt="Complain image">
                                            <div class="enlarged-image-container"></div>
										</td>

                                        <td> {{--  {{ $complain->status }} --}}
                                            @if ($complain->status == 'settled')
                                                <div class="confirmed"> Settled </div>
                                            @endif
                                            @if ($complain->status == 'unsettled')
                                                <div class="unconfirmed"> Unsettled </div>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $complain->created_at }}
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

































