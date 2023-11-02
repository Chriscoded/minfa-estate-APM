@extends('layouts.tenant')

@section('header')
Pay Rent
@endsection

{{-- @section('content')

@push('css')
    <style>
        .card{
            border-radius: 1.5rem;
        }
    </style>
@endpush

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pay Manually') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('pay_manually') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="payment_medium" class="col-md-4 col-form-label text-md-right">{{ __('Payment Medium') }}</label>

                            <div class="col-md-6">
                                <select class="form-control m-input  @error('payment_medium') is-invalid @enderror" name="payment_medium" required>
                                    <option selected disabled>
                                        Select Payment Medium
                                    </option>

                                    <option value="online">Online </option>
                                    <option value="bank">Bank </option>
                                    <option value="transfer">Transfer</option>
                                </select>

                                @error('payment_medium')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <input type="number" name="amount" class="form-control m-input @error('amount') is-invalid @enderror"  value="{{ old('amount') }}" required>

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="period" class="col-md-4 col-form-label text-md-right">{{ __('Period') }}</label>

                            <div class="col-md-6">
                                <select class="form-control m-input  @error('period') is-invalid @enderror" name="period" required>
                                    <option selected disabled>
                                        Select Period
                                    </option>

                                    <option value="1"> 1 Year </option>
                                    <option value="2"> 2 Years </option>
                                    <option value="3">3 Years</option>
                                    <option value="4">4 Years</option>
                                    <option value="5">5 Years</option>
                                </select>

                                @error('payment_medium')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="proof" class="col-md-4 col-form-label text-md-right">{{ __('Proof of Payment') }}</label>

                            <div class="col-md-6">
                                <input type="file" name="proof" class="form-control" id="proof" >
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}


{{-- /////////////////////////////////////////////////////////////// --}}

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
                                    Pay new rent
                                </h3>
                            </div>
                        </div>
                    </div>
                <!--begin::Form-->
                @if(Auth::user()->hasRole('tenant'))
                    <form class=" m-portlet__head m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" method="POST" action="{{ route('pay_manually') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="m-portlet__body">
                            {{-- <div class="form-group m-form__group row"> --}}
                                <div class="col-lg-8 offset-2 mt-3">
                                    <label for="payment_medium" >Payment Medium</label>
                                    <select class="form-control m-input  @error('payment_medium') is-invalid @enderror" name="payment_medium" required>
                                        <option selected disabled>
                                            Select Payment Medium
                                        </option>

                                        <option value="online">Online </option>
                                        <option value="bank">Bank </option>
                                        <option value="transfer">Transfer</option>
                                    </select>

                                    @error('payment_medium')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="col-lg-8 offset-2 mt-3">
                                    <label class="">Period:</label>
                                    <select class="form-control m-input  @error('period') is-invalid @enderror" name="period" id="period" required>
                                        <option selected disabled>
                                            Select Period
                                        </option>

                                        <option value="1"> 1 Year </option>
                                        <option value="2"> 2 Years </option>
                                        <option value="3">3 Years</option>
                                        <option value="4">4 Years</option>
                                        <option value="5">5 Years</option>
                                    </select>
                                    @error('period')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-8 offset-2 mt-3">
                                    <label class="">Amount:</label>
                                    <input type="number" name="amount" id="amount" readonly class="form-control m-input @error('amount') is-invalid @enderror"  value="{{ old('amount') }}" required>

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>

                            {{-- </div> --}}
                            {{-- <div class="form-group m-form__group row"> --}}
                                <div class="col-lg-8 offset-2 mt-3">
                                    <label class="">Proof of payment:</label>
                                    <input type="file" name="proof" class="form-control" id="proof" >


                                    @error('proof')
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
        @push('js')
            <script>
                $('#period').change(function() {
                    var period = $('#period').val();

                    $.ajax({
                        type: "GET",
                        url: "/rent/amount",
                        data: { period: period },
                        dataType: "text",
                        success: function (response) {
                            console.log(response);
                            var result = JSON.parse(response);
                            console.log(result.amount);
                            $('#amount').val(result.amount);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(JSON.stringify(jqXHR));
                            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                        }
                    });

                });
            </script>
        @endpush
@endsection
