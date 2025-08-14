<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AI Wrap - Laravel AI Tools</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <style>
            body {
                font-family: 'Figtree', sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                margin: 0;
                padding: 20px;
            }
            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 40px 20px;
            }
            .header {
                text-align: center;
                margin-bottom: 60px;
                color: white;
            }
            .header h1 {
                font-size: 3rem;
                margin-bottom: 10px;
                font-weight: 600;
            }
            .header p {
                font-size: 1.2rem;
                opacity: 0.9;
            }
            .tools-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 30px;
                margin-top: 40px;
            }
            .tool-card {
                background: white;
                border-radius: 15px;
                padding: 30px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                text-decoration: none;
                color: inherit;
                display: block;
            }
            .tool-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            }
            .tool-icon {
                width: 60px;
                height: 60px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 20px;
            }
            .tool-icon svg {
                width: 30px;
                height: 30px;
                color: white;
            }
            .tool-card h3 {
                font-size: 1.5rem;
                margin-bottom: 15px;
                color: #333;
            }
            .tool-card p {
                color: #666;
                line-height: 1.6;
                margin-bottom: 20px;
            }
            .tool-link {
                color: #667eea;
                font-weight: 600;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 5px;
            }
            .tool-link:hover {
                text-decoration: underline;
            }
            @media (max-width: 768px) {
                .header h1 {
                    font-size: 2rem;
                }
                .tools-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>AI Wrap</h1>
                <p>Laravel-powered AI tools for developers</p>
            </div>

            <div class="tools-grid">
                <a href="/transpiler" class="tool-card">
                    <div class="tool-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <h3>Code Transpiler</h3>
                    <p>Convert code between different programming languages while maintaining functionality. Supports multiple languages including PHP, JavaScript, Python, Java, C#, TypeScript, Ruby, and Go.</p>
                    <span class="tool-link">
                        Try Transpiler
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </a>

                <a href="/explainer" class="tool-card">
                    <div class="tool-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3>Code Explainer</h3>
                    <p>Get simple, plain-English explanations of code snippets. Perfect for understanding complex code, learning new concepts, or explaining code to non-technical stakeholders.</p>
                    <span class="tool-link">
                        Try Explainer
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </a>

                <a href="/dita" class="tool-card">
                    <div class="tool-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3>HTML to DITA</h3>
                    <p>Convert HTML content to valid DITA XML format. Perfect for technical documentation, content management systems, and structured authoring workflows.</p>
                    <span class="tool-link">
                        Try DITA Transformer
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </a>

                <a href="/category" class="tool-card">
                    <div class="tool-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <h3>Content Categorizer</h3>
                    <p>Automatically categorize technical content into Concept, Task, or Reference categories with difficulty levels and keyword extraction for better content organization.</p>
                    <span class="tool-link">
                        Try Categorizer
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </body>
</html>
