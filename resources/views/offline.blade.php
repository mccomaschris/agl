<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#04954A">
    <title>Offline — AGLWV</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: #04954A;
            color: white;
            min-height: 100dvh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            text-align: center;
        }
        svg { margin-bottom: 1.5rem; opacity: 0.9; }
        h1 { font-size: 1.5rem; font-weight: 600; margin-bottom: 0.5rem; }
        p { font-size: 1rem; opacity: 0.85; margin-bottom: 2rem; }
        a {
            display: inline-block;
            background: white;
            color: #04954A;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="none" viewBox="0 0 24 24" stroke="white">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636a9 9 0 010 12.728M5.636 5.636a9 9 0 000 12.728M12 13a1 1 0 100-2 1 1 0 000 2zm0 0v3m-3.536-6.464a5 5 0 017.072 0" />
    </svg>
    <h1>You're offline</h1>
    <p>Check your connection and try again.</p>
    <a href="/">Try again</a>
</body>
</html>
