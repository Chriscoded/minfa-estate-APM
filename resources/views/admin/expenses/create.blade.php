
@extends('layouts.admin')

@section('header')
   Create Expenses
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
                                    Create Expenses
                                </h3>
                            </div>
                        </div>
                    </div>
                <!--begin::Form-->
                @if(Auth::user()->hasRole('admin'))
                    <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{{ url('/expenses/new') }}" autocomplete="off">
						{{ csrf_field() }}
                        <div class="m-portlet__body">

                            <div class="form-group m-form__group row">
                                <div class="col-lg-8 offset-2">
                                    <label class="">Apartment No:</label>
                                    <select class="form-control m-input  @error('apartment_no') is-invalid @enderror" name="apartment_no" required>
                                        <option selected disabled>
                                            Select Apartment
                                        </option>
                                        {{-- {{ dd($apartments) }} --}}
                                        @foreach ($apartments as $apartment)
                                            <option value="{{ $apartment->id }}">
                                                {{ $apartment->apartment_no }} - building {{ $apartment->building->building_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('apartment_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-lg-8 offset-2">
                                    <label>Amount</label>
                                    <input type="number" name="amount"
                                        class="form-control m-input @error('amount') is-invalid @enderror"
                                        value="{{ old('amount') }}" required>

                                        @error('amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                <div class="col-lg-8 offset-2 mt-3">
                                    <label class="">Expenses Description</label>
                                    <textarea name="description" id="description" class="form-control"  rows="10" required></textarea>

                                    @error('description')
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
                @else

				@endif
            </div>
        </div>
    </div>
            <!-- end:: Body -->

@endsection
