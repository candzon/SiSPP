<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Forbidden</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
        }

        .container {
            text-align: center;
            padding: 2rem;
        }

        .error-code {
            font-size: 120px;
            font-weight: bold;
            color: #dc3545;
            margin: 0;
            line-height: 1;
        }

        .message {
            font-size: 24px;
            color: #343a40;
            margin: 20px 0;
        }

        .description {
            color: #6c757d;
            margin-bottom: 30px;
        }

        .back-button {
            padding: 12px 24px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .back-button:hover {
            background: #0056b3;
        }

        .vector-container {
            margin: 30px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="vector-container">
            <svg width="200" height="200" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4Z"
                    stroke="#dc3545" stroke-width="2" />
                <path d="M12 8V13" stroke="#dc3545" stroke-width="2" stroke-linecap="round" />
                <circle cx="12" cy="16" r="1" fill="#dc3545" />
            </svg>
        </div>
        <h1 class="error-code">403</h1>
        <h2 class="message">Access Forbidden</h2>
        <p class="description">Only managers can access this page.</p>
        <a href="{{ url('/') }}" class="back-button">Back to Home</a>
    </div>
</body>

</html>
</head>