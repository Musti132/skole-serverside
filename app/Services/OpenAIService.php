<?php
namespace App\Services;

use Orhanerday\OpenAi\OpenAi;

Class OpenAIService
{
    public $openAi;
    public bool $flagged;
    public string $message;

    public function __construct()
    {
        $this->openAi = new OpenAi(env('OPENAI_SECRET_KEY'));
    }
    

    /**
     * Send a message to the OpenAI Moderate API to check if a message is safe to send.
     * 
     * @return bool
     */
    public function moderate(string $input) {
        $moderation = $this->openAi->moderation([
            'input' => $input,
        ]);

        $mod = json_decode($moderation, true);

        $this->flagged = $mod['results'][0]['flagged'];
    }

    /**
     * Send a message to the OpenAI completion api and get a response from the Bot
     * 
     * @return string
     */

    public function complete(string $input) {
        $complete = $this->openAi->complete([
            'engine' => 'text-davinci-002',
            'prompt' => $input,
            'temperature' => 0.7,
            'max_tokens' => 256,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        ]);
            
        $aiResponse = json_decode($complete, true)['choices'][0]['text'];

        return $aiResponse;
    }

    /**
     * Return true if the message is flagged as inappropriate
     * 
     * @return bool
     */

    public function isFlagged() {
        return $this->flagged;
    }
}
?>