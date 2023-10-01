
@extends('layouts.admin')

@section('header')
    User
@endsection

@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->

		<!-- END: Subheader -->

        <div class="m-content">
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            Edit Service
                                        </h3>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="m_user_profile_tab_1">
                                    @if(Auth::user()->hasRole('admin'))
                                        <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="/update-apartment/{{ $apartment->id }}" enctype="multipart/form-data" autocomplete="off">
                                            {{ csrf_field() }}
                                            <div class="m-portlet__body">
                                                <div class="form-group m-form__group row">
                                                    <div class="col-lg-4">
                                                        <label>Apartment No:</label>
                                                        <input type="text" name="apartment_no" class="form-control m-input @error('apartment_no') is-invalid @enderror"
                                                            readonly value="{{ $apartment->apartment_no }}" required>

                                                        @error('apartment_no')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label class="">Apartment Type:</label>
                                                        <select class="form-control m-input @error('apartment_type') is-invalid @enderror" name="apartment_type" required>
                                                            {{-- selected="{{ $building->id == $apartment->id ?? true }}" --}}
                                                            <option value="{{ $apartment->apartment_type }}" selected readonly>
                                                                {{ $apartment->apartment_type }}
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
                                                        <select class="form-control m-input @error('building') is-invalid @enderror" name="building" required>
                                                            <option value="" disabled selected hidden aria-disabled="true">
                                                                select Building
                                                            </option>
                                                            @foreach ($buildings as $building)
                                                                <option value="{{ $building->id }}" selected="{{ $building->id == $apartment->id ?? true }}" >{{ $building->building_name }}</option>
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
                                                        <input type="text" name="floor" class="form-control m-input @error('floor') is-invalid @enderror"  value="{{ $apartment->floor }}" required>
                                                        @error('floor')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label class="">Rent:</label>
                                                        <input type="text" name="rent" class="form-control m-input @error('rent') is-invalid @enderror" value="{{ $apartment->rent }}" required>
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
                                                                Edit
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

                                    @elseif(Auth::user()->hasRole('administrator'))

                                    @else
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <!--End::Section-->
                    </div>
                </div>
            </div>
            <!-- end:: Body -->

@endsection

































