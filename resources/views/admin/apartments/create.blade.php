
@extends('layouts.admin')

@section('header')
    Add Tenant
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
                                    Create Apartment
                                </h3>
                            </div>
                        </div>
                    </div>
                <!--begin::Form-->
                @if(Auth::user()->hasRole('admin'))
                    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{{ url('/new-apartment') }}" autocomplete="off">
						{{ csrf_field() }}
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                <div class="col-lg-4">
                                    <label>Apartment No:</label>
                                    <input type="text" name="apartment_no" class="form-control m-input @error('apartment_no') is-invalid @enderror" value="{{ old('apartment_no') }}" required>

                                    @error('apartment_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Apartment Type:</label>
                                    <select class="form-control m-input  @error('apartment_type') is-invalid @enderror" name="apartment_type" required>
                                        <option hidden>
                                            Select Apartment Type
                                        </option>
                                        <option value="studio">
                                            studio
                                        </option>
                                        <option value="1 bedroom">
                                            1 bedroom
                                        </option>
                                        <option value="2 bedroom">
                                            2 bedroom
                                        </option>
                                        <option value="3 bedroom">
                                            3 bedroom
                                        </option>
                                        <option value="4 bedroom">
                                            4 bedroom
                                        </option>
                                    </select>
                                    @error('apartment_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Building:</label>
                                    <select class="form-control m-input @error('building') is-invalid @enderror" name="building" >
                                        <option value="" disabled selected hidden aria-disabled="true">
                                            select Building
                                        </option>
                                        @foreach ($buildings as $building)
                                            <option value="{{ $building->id }}">{{ $building->building_name }}</option>
                                        @endforeach
                                    </select>

                                    @error('building')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group m-form__group row">

                                <div class="col-lg-4">
                                    <label class="">Floor:</label>
                                    <input type="text" name="floor"  @error('floor') is-invalid @enderror
                                        class="form-control m-input"  value="{{ old('floor') }}" required>

                                    @error('floor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-4">
                                    <label class="">Rent:</label>
                                    <input type="text" name="rent"
                                        class="form-control m-input @error('rent') is-invalid @enderror"
                                        value="{{ old('rent') }}" required>
                                    @error('rent')
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
                            @if ( session()->has('type') )
                            {{-- {{ Session::get('success') }}
                            {{ Session::get('type') }}
                            {{ Session::get('title') }} --}}
                            @endif
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
