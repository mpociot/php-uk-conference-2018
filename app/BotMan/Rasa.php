<?php
namespace App\BotMan;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Http\Curl;
use BotMan\BotMan\Interfaces\HttpInterface;
use BotMan\BotMan\Interfaces\MiddlewareInterface;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use Illuminate\Support\Collection;

class Rasa implements MiddlewareInterface
{
    /** @var HttpInterface */
    protected $http;

    const API_URL = 'http://127.0.0.1:5000/parse';

    /** @var bool */
    protected $listenForIntent = false;

    /** @var float */
    protected $minimumConfidence = 0.0;

    /**
     * @param HttpInterface $http
     */
    public function __construct(HttpInterface $http, $minimumConfidence)
    {
        $this->http = $http;
        $this->minimumConfidence = $minimumConfidence;
    }

    /**
     * Create a new Wit middleware instance.
     * @return $this
     */
    public static function create($minimumConfidence = 0.7)
    {
        return new static(new Curl(), $minimumConfidence);
    }

    /**
     * Restrict the middleware to only listen for API.ai actions.
     * @param  bool $listen
     * @return $this
     */
    public function listenForIntent($listen = true)
    {
        $this->listenForIntent = $listen;

        return $this;
    }

    /**
     * Perform the RASA API call and cache it for the message.
     * @param  \BotMan\BotMan\Messages\Incoming\IncomingMessage $message
     * @return stdClass
     */
    protected function getResponse(IncomingMessage $message)
    {
        $response = $this->http->post(self::API_URL, [], [
            'q' => [$message->getText()]
        ], [
            'Content-Type: application/json; charset=utf-8',
        ], true);

        $this->response = json_decode($response->getContent());

        return $this->response;
    }

    /**
     * Handle a captured message.
     *
     * @param IncomingMessage $message
     * @param callable $next
     * @param BotMan $bot
     *
     * @return mixed
     */
    public function captured(IncomingMessage $message, $next, BotMan $bot){
    	return $next($message);
    }

    /**
     * Handle an incoming message.
     *
     * @param IncomingMessage $message
     * @param callable $next
     * @param BotMan $bot
     *
     * @return mixed
     */
    public function received(IncomingMessage $message, $next, BotMan $bot){
    	$response = $this->getResponse($message);

    	$entities = $response->entities ?? [];
    	$intent = $response->intent->name ?? '';
        $confidence = $response->intent->confidence ?? 0.0;

    	$entities = Collection::make($entities)->groupBy('entity');

        $message->addExtras('apiConfidence', $confidence);
        $message->addExtras('apiIntent', $intent);
        $message->addExtras('apiEntities', $entities);

		return $next($message);
    }

    /**
     * @param IncomingMessage $message
     * @param string $pattern
     * @param bool $regexMatched Indicator if the regular expression was matched too
     * @return bool
     */
    public function matching(IncomingMessage $message, $pattern, $regexMatched){
    	$intent = $message->getExtras()['apiIntent'] ?? '';
        $entities = $message->getExtras()['apiEntities'] ?? collect();

        if ($this->listenForIntent) {
            $pattern = '/^'.$pattern.'$/i';

            return (bool) preg_match($pattern, $intent) && $entities->count() > 2;
        }

    	return $regexMatched;
    }

    /**
     * Handle a message that was successfully heard, but not processed yet.
     *
     * @param IncomingMessage $message
     * @param callable $next
     * @param BotMan $bot
     *
     * @return mixed
     */
    public function heard(IncomingMessage $message, $next, BotMan $bot){
		return $next($message);
    }

    /**
     * Handle an outgoing message payload before/after it
     * hits the message service.
     *
     * @param mixed $payload
     * @param callable $next
     * @param BotMan $bot
     *
     * @return mixed
     */
    public function sending($payload, $next, BotMan $bot){
		return $next($payload);
    }
	
}