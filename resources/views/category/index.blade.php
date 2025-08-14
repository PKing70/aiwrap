<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CategoryAI</title>
    <link rel="stylesheet" href="{{ asset('css/category.css') }}"> <!-- Your CSS file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container">
    <h2>CategoryAI</h2>
    <textarea id="inputText" rows="10" cols="50"></textarea>
    <button id="checkCompliance">Categorize text <span id="spinner" class="spinner" style="display:none;"></span></button>
    <div id="result"></div>
</div>

<script src="{{ asset('js/category.js') }}"></script> <!-- Your JavaScript file -->
</body>
</html>
