<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OpenAIController extends Controller
{
    public function getResponse(Request $request)
    {
        $openai = app('openai');
        $model  = 'gpt-4o-mini';

        $type = $request->get('type', 'category');

        /* -- map tool function + description per task ----------------- */
        $map = [
            'category'   => ['contentCategorizer',  'Content Categorisation'],
            'transpile'  => ['codeTranspiler',      'Code Transpiler'],
            'explain'    => ['codeExplainer',       'Code Explainer'],
            'dita'       => ['htmlToDitaConverter', 'HTML to DITA Converter'],
        ];
        [$functionName, $description] = $map[$type] ?? ['genericTool', ucfirst($type)];

        /* -- build prompt on‑the‑fly ---------------------------------- */
        $getPrompt = function () use ($request, $type) {
            $instructions = $this->instructions($type);

            if ($type === 'transpile') {
                $source = $request->get('sourceLang', 'auto');
                $target = $request->get('targetLang', 'JavaScript');
                $code   = $request->get('code', '');
                $additionalContext = $request->get('additionalContext', '');
                $conversationHistory = $request->get('conversationHistory', '');
                $isClarification = $request->get('isClarification', false);

                /* replace placeholders in the instructions string */
                $instructions = str_replace(
                    ['{{SOURCE_LANG}}', '{{TARGET_LANG}}'],
                    [$source, $target],
                    $instructions
                );

                $prompt = $instructions . "\n\nOriginal Code:\n" . $code;
                
                if ($additionalContext) {
                    $prompt .= "\n\nAdditional Context:\n" . $additionalContext;
                }

                // If there's conversation history, include it
                if ($conversationHistory) {
                    $history = json_decode($conversationHistory, true);
                    if ($history && is_array($history)) {
                        $prompt .= "\n\nConversation History:\n";
                        foreach ($history as $message) {
                            $role = $message['role'] ?? 'user';
                            $content = $message['content'] ?? '';
                            $prompt .= "\n" . strtoupper($role) . ": " . $content;
                        }
                    }
                }

                return $prompt;
            }

            if ($type === 'explain') {
                $code = $request->get('code', '');
                return $instructions . "\n\nCode to explain:\n" . $code;
            }

            if ($type === 'dita') {
                $html = $request->get('html', '');
                return $instructions . "\n\nHTML Content to convert:\n" . $html;
            }

            /* default text‑based tasks */
            return $instructions . ' Categorize this text: ' . $request->get('checkText', '');
        };

        try {
            $response = $openai->generateContent(
                $model,
                $functionName,
                $description,
                $getPrompt
            );
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function instructions($type):string
    {
        $instructions = '';

        switch($type){
            case 'transpile':
                $instructions =  'You are an expert polyglot developer tasked with converting code from {{SOURCE_LANG}} to {{TARGET_LANG}} without altering behaviour.

Convert the provided code to the target language. Always provide a complete, working transpilation even if some details are unclear. Make reasonable assumptions about:
- Missing frameworks or libraries (choose the most common/standard ones)
- Unclear variable types or function signatures
- Missing imports or dependencies
- Ambiguous syntax or patterns

If you make assumptions, include brief comments in the transpiled code explaining your choices. Prioritize producing functional, runnable code over asking for clarifications.

Respond with the translated code wrapped in code blocks with the target language specified.';
                break;

            case 'explain':
                $instructions = 'You are an expert software developer and educator. Your task is to explain the provided code in simple, layman terms that anyone can understand.

Your explanation should include:
1. **What the code does** - A clear, simple description of the main purpose
2. **How it works** - Step-by-step breakdown in simple terms
3. **Key concepts** - Explain any important programming concepts used
4. **Real-world analogy** - Use a simple analogy to help understanding
5. **Potential use cases** - When this type of code might be useful

Guidelines:
- Use simple, non-technical language when possible
- Avoid jargon unless necessary, and explain any technical terms
- Break down complex operations into simple steps
- Use analogies and examples to make concepts relatable
- Keep explanations concise but comprehensive
- Focus on the "why" and "what" rather than just the "how"

Respond with a clear, well-structured explanation that would help someone with no programming background understand what the code does and why it matters.';
                break;

            case 'dita':
                $instructions = 'You are an expert in DITA (Darwin Information Typing Architecture) and XML transformation. Your task is to convert HTML content into valid DITA XML format.

DITA Requirements:
1. **Valid DITA XML Structure** - Must conform to DITA 1.3 or 2.0 specifications
2. **Proper Topic Types** - Use appropriate topic types (concept, task, reference)
3. **Semantic Markup** - Use proper DITA elements for semantic meaning
4. **Valid Attributes** - Include required and optional attributes correctly
5. **Namespace Declarations** - Include proper DITA namespaces

Conversion Guidelines:
- Convert HTML headings to appropriate DITA topic titles
- Transform HTML paragraphs to DITA <p> elements
- Convert HTML lists to DITA <ul> or <ol> elements
- Transform HTML tables to DITA <table> with proper structure
- Convert HTML links to DITA <xref> or <link> elements
- Transform HTML code blocks to DITA <codeblock> elements
- Convert HTML emphasis to DITA <b> or <i> elements
- Transform HTML images to DITA <image> elements

DITA Topic Types:
- **<concept>** - For conceptual information (what/why)
- **<task>** - For procedural information (how to)
- **<reference>** - For reference information (lookup data)

Required DITA Elements:
- Root element with proper namespace
- <title> for topic title
- <shortdesc> for brief description
- <body> for main content
- Proper closing tags

Output Format:
- Valid XML with proper DITA namespace declarations
- Well-formed XML structure
- Semantic DITA markup
- No HTML elements in output

Respond with ONLY the valid DITA XML content, properly formatted and indented.';
                break;

            case "category":
                $instructions = 'You are an assistant specializing in categorizing technical content into three unique categories: Concept, Task, or Reference. Additionally, you will assess the difficulty level of the content as Beginner, Intermediate, or Advanced. You will also identify the most relevant keywords for each piece of content, referred to as "metakeywords". Each piece of content can only belong to one category and one difficulty level, but can have multiple relevant keywords.

Categories:
Concept: This category includes theoretical or explanatory content that provides a deeper understanding of a subject, technology, or principle. It focuses on "what" and "why." Example: "What is observability and why is it important?"
Task: This category must include step-by-step instructions or procedural content aimed at helping the user perform a specific action or achieve a particular result. It focuses on "how to." Example: "How to configure a Splunk dashboard in 5 steps."
Reference: This category includes factual, reference-based content such as definitions, technical specifications, or data that users can refer to for quick information. It focuses on "information" or "data lookup." Example: "List of API endpoints for integration."

Difficulty Levels:
Beginner: The content is suitable for individuals with little to no prior knowledge or experience in the subject.
Intermediate: The content is suitable for individuals with some prior knowledge or experience, providing more detailed information and requiring a moderate level of understanding.
Advanced: The content is suitable for individuals with significant prior knowledge or experience, providing in-depth information and requiring a high level of understanding.

Metakeywords:
Metakeywords are the most meaningful words or phrases extracted from the content that represent its key ideas or focus areas. These keywords will help index, search, and categorize the content efficiently. Choose 3-5 keywords that best capture the essence of the given content.

Task:
Analyze the given text and categorize it into one of the above categories and difficulty levels. Additionally, extract the most meaningful keywords that describe the content.

Output Requirements:
- Provide the category, difficulty level, and metakeywords in a JSON format.
- Ensure that the output is concise and follows the specified template.
- The output should only contain the JSON object, with no additional commentary or context.
- IF you are not highly sure about the categorization it should be the default which is Concept

JSON Output Template:
{
    "category": "Concept" | "Task" | "Reference",
    "difficulty": "Beginner" | "Intermediate" | "Advanced",
    "metakeywords": ["Keyword1", "Keyword2", "Keyword3"]
}

Example Output:
{
    "category": "Task",
    "difficulty": "Intermediate",
    "metakeywords": ["Splunk", "dashboard", "configuration"]
}

Analyze the following text and provide the category, difficulty level, and metakeywords in the specified JSON format.

Text:
';
                break;
        }

        return $instructions;
    }
}
