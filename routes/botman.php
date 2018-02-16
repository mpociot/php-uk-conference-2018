<?php
use App\Http\Controllers\BotManController;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Attachments\Video;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
// Don't use the Facade in here to support the RTM API too :)
$botman = resolve('botman');

$botman->hears('keyword', function($bot) {
    $bot->reply('Hello my friend!');
});

$botman->hears('tell me more', function($bot) {
    $bot->reply('Hello my friend!');
    $bot->reply('What do you want to know from me?');
});

$botman->hears('Call me {name}', function($bot, $name) {
    $bot->reply('Hello '.$name);
});
$botman->hears('I am {name} the {adjective}', function($bot, $name, $adjective) {
    $bot->reply('Hello '.$name.'. You truly are '.$adjective);
});

$botman->hears('I am ([0-9]+) years old', function($bot, $age) {
    $bot->reply('Got it - your age is: '.$age);
    $bot->userStorage()->save([
        'age' => $age
    ]);
});
$botman->hears('How old am i', function($bot) {
    $age = $bot->userStorage()->get('age');
    $bot->reply('You are '.$age);
});

$botman->hears('give me images', function($bot) {
    $message = OutgoingMessage::create('Here is a nice image')
    ->withAttachment(Image::url('http://php-conference-uk.test/img/logo.png'));
    $bot->reply($message);
});

$botman->hears('give me videos', function($bot) {
    $video = Video::url('http://php-conference-uk.test/video/pickle.mp4');
    $message = OutgoingMessage::create()->withAttachment($video);
    $bot->reply($message);
});

$botman->hears('I want images', function($bot) {
    $bot->ask('Which images?', function($answer, $bot) {
        $text = $answer->getText();
        $message = OutgoingMessage::create()->withAttachment(Image::url('http://php-conference-uk.test/img/lorem_'.$text.'.jpeg'));
        $bot->say($message);
    });
});	

$middleware = BotMan\BotMan\Middleware\ApiAi::create(env('API_AI_TOKEN'))->listenForAction();
$botman->middleware->received($middleware);

$botman->hears('order.pizza', function($bot) {
    $extras = collect($bot->getMessage()->getExtras('apiParameters'));
    
    $types = $extras->get('type');
    $size = $extras->get('size');
    $topping = implode($extras->get('topping', []), ', ');
    if ($topping != '') {
        if ($types != '') {
            $bot->reply('Type: '.$types);
        }
        if ($size != '') {
            $bot->reply('Size: '.$size);    
        }
        if ($topping != '') {
            $bot->reply('Topping: '.$topping);
        }
    }
    
})->middleware($middleware);

$botman->fallback(function($bot) {
    $bot->reply('I have no idea what you are talking about!');
});

$botman->hears('I want pizza', function($bot) {
    $bot->startConversation(new App\BotMan\PizzaConversation);
});

$botman->hears('Better pizza', function($bot) {
    $bot->startConversation(new App\BotMan\BetterPizzaConversation);
});