
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
                                            Edit Building
                                        </h3>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="m_user_profile_tab_1">
                                    @if(Auth::user()->hasRole('admin'))
                                        <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="/update-building/{{ $building->id }}" enctype="multipart/form-data" autocomplete="off">
                                            {{ csrf_field() }}
                                            <div class="m-portlet__body">
                                                <div class="form-group m-form__group row">
                                                    <div class="col-lg-4">
                                                        <label>Building Name</label>
                                                        <input type="text" name="building_name"
                                                            class="form-control m-input @error('building_name') is-invalid @enderror"
                                                            value="{{ $building->building_name }}" required>

                                                        @error('building_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                    </div>

                                                    <div class="col-lg-4">
                                                        <label class="">Building Address:</label>
                                                        <input type="text" name="building_address"
                                                            class="form-control m-input @error('building_address') is-invalid @enderror"
                                                            value="{{ $building->building_address }}" required>

                                                        @error('building_address')
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
                                            </div
                                        </form>

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

































