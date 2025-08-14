<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Transpiler AI</title>
    <link rel="stylesheet" href="{{ asset('css/transpiler.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
</head>
<body>
<div class="container">
    <h2>Code Transpiler AI</h2>

    <label for="inputCode">Paste your code snippet</label>
    <textarea id="inputCode" rows="12"></textarea>

    <div class="lang-select">
        <label for="sourceLang">Source&nbsp;language</label>
        <select id="sourceLang">
            <option value="auto" selected>Auto‑detect</option>
            <option>PHP</option>
            <option>JavaScript</option>
            <option>Python</option>
            <option>Java</option>
            <option>C#</option>
            <option>TypeScript</option>
            <option>Ruby</option>
            <option>Go</option>
        </select>

        <label for="targetLang">Target&nbsp;language</label>
        <select id="targetLang">
            <option>Python</option>
            <option selected>JavaScript</option>
            <option>PHP</option>
            <option>Java</option>
            <option>C#</option>
            <option>TypeScript</option>
            <option>Ruby</option>
            <option>Go</option>
        </select>
    </div>

    <div class="context-section">
        <label for="additionalContext">Additional Context (Optional)</label>
        <textarea id="additionalContext" rows="6" placeholder="Include references to any libraries, frameworks, or context that might help with transpilation. The AI may ask a follow-up question here. Type your answer in the box."></textarea>
    </div>

    <button id="btnTranspile">
        Transpile&nbsp;code
        <span id="spinner" class="spinner" style="display:none;"></span>
    </button>

    <h3 class="result-title" style="display:none;">Transpiled Output</h3>
    <pre id="result"></pre>
</div>

<script src="{{ asset('js/transpiler.js') }}"></script>
</body>
</html>
