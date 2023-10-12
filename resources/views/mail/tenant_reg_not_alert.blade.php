@extends('layouts.email_template')

@section('content')
    <h1>{{ $subject = "Tenant Registration Notification Mail" }}</h1>

    <p> Hi, <strong> {{ $name }} </strong></p>
    {{-- <img src="{{ asset('images/logo.png') }}" alt="Company Logo" width="100"> --}}
    <p>
        You have been admitted as a tenant at Minfa Estate,
        Please follow the link to create account so that you can be able to monitor
        your account and all transaction.
    </p>

    <a href="{{ url('/tenant/create-account/'.$email) }}"
        class="btn btn-primary btn-lg text-white btn-link mb-2" target="_blank"
        style="text-decoration: none">
        FULLY JOIN MINFA
    </a>

    <p>If you have any trouble clicking the button above, please copy and paste the
        URL below into your web browser.</p>

    <p
        style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
        {{ url("/tenant/create-account/".$email) }}
    </p>

    <p
        style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
        Regards,<br>
        Minfa
    </p>
@endsection
