<!-- resources/views/mail/company_email.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        /* Add your custom styles here */
        body {
            font-family: Arial, sans-serif;
            background: #5867dd !important;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            max-width: 150px;
            width: auto !important;
        }
        .content {
            padding: 20px;
            /* border-top: 1px solid #ddd; */
            border-bottom: 1px solid #ddd;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Minfa
        </div>
        <div class="content">
            @yield('content')
        </div>
        <div class="footer">
            © {{ date('Y') }} Minfa. All rights reserved.
        </div>
    </div>
</body>
</html>
