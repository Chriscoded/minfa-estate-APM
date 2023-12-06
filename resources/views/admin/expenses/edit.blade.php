
@extends('layouts.admin')

@section('header')
    Edit Tenant
@stop

@section('content')
	<div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
		<!-- END: Subheader -->
			<div class="m-content">
				<!--begin::Portlet-->
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    Edit Tenant
                                </h3>
                            </div>
                        </div>
                    </div>
                <!--begin::Form-->
                @if(Auth::user()->hasRole('admin'))
                    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="/update-tenant/{{ $tenant->id }}" autocomplete="off">
						{{ csrf_field() }}
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                <div class="col-lg-4">
                                    <label>First Name:</label>
                                    <input type="text" name="name" class="form-control m-input @error('name') is-invalid @enderror" value="{{ $tenant->name }}" required>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Middle Name:</label>
                                    <input type="text" name="middlename" class="form-control m-input @error('middlename') is-invalid @enderror" value="{{ $tenant->middlename }}" required>

                                     @error('middlename')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Last Name:</label>
                                    <input type="text" name="lastname" class="form-control m-input  @error('lastname') is-invalid @enderror" value="{{ $tenant->lastname }}" required>
                                    @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <div class="col-lg-4">
                                        <label class="">Apartment No:</label>
                                        <select class="form-control m-input  @error('apartment_no') is-invalid @enderror" name="apartment_no" required>
                                            <option selected value=null >
                                                None
                                            </option>

                                            @if ($tenant->apartment_no != null)
                                                <option selected value="{{ $tenant->apartment_no }}" >
                                                    {{ $tenant->apartment_no }}
                                                </option>
                                            @endif

                                            {{-- {{ dd($apartments) }} --}}

                                            @foreach ($apartments as $apartment)
                                                <option value="{{ $apartment->apartment_no }}" >{{ $apartment->apartment_no }}</option>
                                            @endforeach
                                        </select>

                                        @error('apartment_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                <div class="col-lg-4">
                                    <label class="">Email:</label>
                                    <input type="email" name="email" class="form-control m-input @error('email') is-invalid @enderror"  value="{{ $tenant->email }}" required>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Phone:</label>
                                    <input type="phone" name="phone" class="form-control m-input @error('phone') is-invalid @enderror" value="{{ $tenant->phone }}" required>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                            </div>
                        </div>
                        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions--solid">
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-8">
                                        <button type="submit" class="btn btn-primary">
                                            Submit
                                        </button>
                                        <button type="reset" class="btn btn-secondary">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Portlet-->
                <!--End::Section-->
            </div>
        </div>
    </div>
					@else

					@endif

					<!--End::Section-->
                    </div>
                </div>
            </div>
            <!-- end:: Body -->

@endsection
