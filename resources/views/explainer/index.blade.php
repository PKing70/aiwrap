<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Explainer AI</title>
    <link rel="stylesheet" href="{{ asset('css/explainer.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
</head>
<body>
<div class="container">
    <h2>Code Explainer AI</h2>
    <p class="subtitle">Get simple explanations of code in plain English</p>

    <div class="input-section">
        <label for="inputCode">Paste your code snippet</label>
        <textarea id="inputCode" rows="12" placeholder="Paste your code here..."></textarea>
    </div>

    <button id="btnExplain">
        Explain Code
        <span id="spinner" class="spinner" style="display:none;"></span>
    </button>

    <div class="result-section" style="display:none;">
        <h3 class="result-title">Code Explanation</h3>
        <div id="result" class="explanation-content"></div>
    </div>
</div>

<script src="{{ asset('js/explainer.js') }}"></script>
</body>
</html> 