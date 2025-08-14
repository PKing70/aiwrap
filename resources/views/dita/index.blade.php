<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTML to DITA Transformer</title>
    <link rel="stylesheet" href="{{ asset('css/dita.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
</head>
<body>
<div class="container">
    <h2>HTML to DITA Transformer</h2>
    <p class="subtitle">Convert HTML content to valid DITA XML format</p>

    <div class="input-section">
        <label for="inputHtml">Paste your HTML content</label>
        <textarea id="inputHtml" rows="12" placeholder="Paste your HTML content here..."></textarea>
    </div>

    <div class="options-section">
        <label for="topicType">DITA Topic Type:</label>
        <select id="topicType">
            <option value="concept">Concept (What/Why)</option>
            <option value="task">Task (How to)</option>
            <option value="reference">Reference (Lookup data)</option>
        </select>
    </div>

    <button id="btnTransform">
        Transform to DITA
        <span id="spinner" class="spinner" style="display:none;"></span>
    </button>

    <div class="result-section" style="display:none;">
        <h3 class="result-title">DITA XML Output</h3>
        <div class="output-controls">
            <button id="btnCopy" class="copy-btn">Copy XML</button>
            <button id="btnDownload" class="download-btn">Download .dita</button>
        </div>
        <pre id="result" class="xml-output"></pre>
    </div>
</div>

<script src="{{ asset('js/dita.js') }}"></script>
</body>
</html> 