<?php

namespace App\Models;

use Exception;
use OpenAI;
use OpenAI\Responses\Chat\CreateResponse;

class OpenAiWrap
{
    private OpenAI\Client $client;

    public function __construct(string $apiKey)
    {
        $this->client = OpenAI::client($apiKey);
    }

    /* update chat() so it only sends the field when present */
    public function chat(
        $model,
        $messages,
        $temperature,
        $maxTokens,
        $functions = null,
        $functionCall = 'auto'
    ): CreateResponse {

        $param = [
            'model'       => $model,
            'messages'    => $messages,
            'temperature' => $temperature,
            'max_tokens'  => $maxTokens,
        ];

        if ($functions !== null) {
            $param['functions']     = $functions;
            $param['function_call'] = $functionCall;
        }

        return $this->client->chat()->create($param);
    }



    public function generateContent(
        string  $model,
        string  $functionName,
        string  $description,
        callable $getPrompt,
        array   $schema = null,
        float   $temperature = 0.7,
        int     $maxTokens   = 8000
    ): ?array {

        $promptData = $this->generatePrompt($functionName, $description, $getPrompt, $schema);
        $promptConversation = [['role' => 'user', 'content' => $promptData['prompt']]];

        try {
            $response = $this->chat(
                $model,
                $promptConversation,
                $temperature,
                $maxTokens,
                $promptData['functions'] ?? null,
                'auto'
            );

            $raw = $this->parseResponse($response)[0] ?? '';

            // Try to extract JSON; if it fails, just return the raw string
            $json = $this->extractJsonFromString($raw);
            return $json ?? ['result' => trim($raw)];

        } catch (Exception $e) {
            return [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ];
        }
    }


    /* --------------- OpenAiWrap.php ---------------- */

    /* replace this whole generatePrompt() method */
    protected function generatePrompt(
        string    $functionName,
        string    $description,
        callable  $getPrompt,
        ?array    $schema = null
    ): array {
        $prompt = $getPrompt();
        $functions = null;            // default: no function‑calling

        /* if caller supplied a NON‑empty schema, attach it */
        if ($schema !== null && !empty($schema)) {
            $functions = [[
                'name'        => $functionName,
                'description' => $description,
                'parameters'  => $schema,     // must be an OBJECT, not []
            ]];
        }

        return [
            'prompt'    => $prompt,
            'functions' => $functions    // may be null
        ];
    }


    protected function generateFunctionData(string $functionName, string $description, array  $schema): array
    {
        return [
            [
                "name" => $functionName,
                "description" => $description,
                "parameters" => $schema
            ]
        ];
    }

    protected function replacePlaceHolders(string $prompt, array $context): string
    {
        // Replace placeholders in the prompt with context data
        foreach ($context as $key => $value) {
            $prompt = str_replace("{{" . $key . "}}", $value, $prompt);
        }
        return $prompt;
    }

    private function parseResponse(CreateResponse $response): ?array
    {
        $output = [];
        foreach ($response->toArray()['choices'] as $choice) {
            $output[] = $choice['message']['content'] ?? '';
        }
        return $output;
    }

    private function defaultSchema(): array
    {
        return [
            // Define the default schema here
        ];
    }

    function extractJsonFromString($string) {
        // strip common code‑fence wrappers
        $string = preg_replace('/^```[a-zA-Z0-9]*\s*|\s*```$/', '', trim($string));

        $regex = '/\{(?:[^{}]|(?R))*\}/';
        if (preg_match($regex, $string, $matches)) {
            $json = json_decode($matches[0], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $json;
            }
        }
        return null;
    }


}
