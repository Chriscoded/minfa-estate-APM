
@extends('layouts.admin')

@section('header')

@endsection

@section('content')

  <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
		<!-- END: Subheader -->

		<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Buildings
                        </h3>
                    </div>
                </div>
				<div class="m-portlet__head-tools">
					<ul class="m-portlet__nav">
						@if(Auth::user()->hasRole('admin'))
							<li class="m-portlet__nav-item">
								<a href="{{ url('new-building') }}" class="btn btn-primary m-btn  m-btn--custom m-btn--icon m-btn--air">
									<span>
										<i class="fa fa-wrench"></i>
										<span>New Building</span>
									</span>
								</a>
							</li>
						@elseif(Auth::user()->hasRole('administrator'))
							<li class="m-portlet__nav-item">
								<a href="{{ url('new-service') }}" class="btn btn-primary m-btn  m-btn--custom m-btn--icon m-btn--air">
									<span>
										<i class="la la-user"></i>
										<span>New Service</span>
									</span>
								</a>
							</li>
						@elseif(Auth::user()->hasRole('owner'))
							<li class="m-portlet__nav-item">
								<a href="{{ url('new-service') }}" class="btn btn-primary m-btn  m-btn--custom m-btn--icon m-btn--air">
									<span>
										<i class="la la-user"></i>
										<span>New Service</span>
									</span>
								</a>
							</li>
						@else

						@endif
						<li class="m-portlet__nav-item"></li>
					</ul>
				</div>
			</div>
			<div class="m-portlet__body">
				<table class="table table-bordered table-striped " id="table">
					<thead class>
						@if(Auth::user()->hasRole('admin'))
							<tr>
								<th></th>
								<th>Building Name</th>
                                <th>Building address</th>
                                <th>Actions</th>
							</tr>


						@else

						@endif
					</thead>
					<tbody>
						    @if(Auth::user()->hasRole('admin'))
								@foreach($buildings as $key => $building )
									<tr>
                                        <td> {{ $key + 1 }} </td>
										<td>
                                            {{ $building->building_name }}
                                        </td>
										<td>{{ $building->building_address }}</td>

                                        <td>
											<a href="{{ url('edit-building/'.$building->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit ">
												<i class="fa fa-edit"></i>
											</a>
											<a href="{{ url('delete-building/'.$building->id) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit ">
												<i class="fa fa-trash"></i>
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

@endsection

































