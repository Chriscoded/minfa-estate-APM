@extends('layouts.app')


@section('content')

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

                                @error('payment_medium')
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
@endsection
