<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 - Page Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #f4f4f4;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        .container {
            max-width: 600px;
            padding: 2rem;
        }

        h1 {
            font-size: 8rem;
            color: #ff4c60;
            margin-bottom: 1rem;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        p {
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        a {
            text-decoration: none;
            color: #fff;
            background-color: #ff4c60;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #e84350;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <h2>Page Not Found</h2>
        <p>Sorry, the page you’re looking for doesn’t exist or has been moved.</p>
        <a href="/">Go to Homepage</a>
    </div>
</body>
</html>
