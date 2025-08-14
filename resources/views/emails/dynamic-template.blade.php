<!DOCTYPE html>
<html>
<head>
    <title>{{ $data['subject'] ?? 'No Subject' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #dcdcdc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #2a2a2a;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .header img {
            height: 70px;
            width: 70px;
            object-fit: cover; 
        }
        .footer {
            background-color: #2a2a2a;
            color: #ffffff;
            text-align: center;
            padding: 5px 5px;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
    @php
        $emailGlobalTemplate = App\Models\GlobalEmailTemplate::firstOrFail();
    @endphp

    <div class="email-container">
        <div class="header">
            <img src="{{ asset($emailGlobalTemplate->email_header) }}" alt="Logo">
        </div>
        <div class="content">
            {!! $content !!}
        </div>
        <div class="footer">
            {!! $emailGlobalTemplate->email_footer !!}
        </div>
    </div>
</body>
</html>