@extends('layouts.tenant')

@section('header')
Pay Rent
@endsection




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
                                    Report a complain
                                </h3>
                            </div>
                        </div>
                    </div>
                <!--begin::Form-->
                @if(Auth::user()->hasRole('tenant'))
                    <form class=" m-portlet__head m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{{ route('report_complain') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="m-portlet__body">
                            {{-- <div class="form-group m-form__group row"> --}}
                                
                            {{-- <div class="form-group m-form__group row"> --}}
                                <div class="col-lg-8 offset-2 mt-3">
                                    <label class="">Complain image if their is any</label>
                                    <input type="file" name="image" class="form-control" id="image" >

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-8 offset-2 mt-3">
                                    <label class="">Complain text</label>
                                    <textarea name="complain" id="complain" class="form-control"  rows="10" required></textarea>

                                    @error('complain')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            {{-- </div> --}}

                            <div class="col-lg-8 offset-2 mt-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                {{-- <button type="reset" class="btn btn-secondary">
                                    Cancel
                                </button> --}}
                            </div>
                        </div>
                        {{-- <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                            <div class="m-form__actions m-form__actions--solid">
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary">
                                            Submit
                                        </button>
                                        <button type="reset" class="btn btn-secondary">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
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
