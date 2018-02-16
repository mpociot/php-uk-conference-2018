<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <title>BotMan - From zero to chatbot</title>

        <link rel="stylesheet" href="css/reveal.css">
        <link rel="stylesheet" href="css/theme/sky.css">

        <!-- Theme used for syntax highlighting of code -->
        <link rel="stylesheet" href="lib/css/zenburn.css">

        <!-- Printing and PDF exports -->
        <script>
        window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};

            var link = document.createElement( 'link' );
            link.rel = 'stylesheet';
            link.type = 'text/css';
            link.href = window.location.search.match( /print-pdf/gi ) ? 'css/print/pdf.css' : 'css/print/paper.css';
            document.getElementsByTagName( 'head' )[0].appendChild( link );
        </script>
    </head>
    <body>
        <div id="logo">
            <a href="https://botman.io"><img height="100" src="https://botman.io/img/logo.png"></a>
        </div>
        <div class="reveal">
            <div class="slides">
                <section class="center" data-markdown>
                    <script type="text/template">
# BotMan
### From *Zero* to *Chatbot* 🚀
                    </script>
                </section>
                <section class="center" data-markdown>
                    # About me

**Marcel Pociot**

Managing Partner at Beyond Code

@marcelpociot
                </section>
                <section class="center" data-markdown>
                # Open Source
### 😍
                </section>
                <section class="center" data-markdown>
# Open Source

30+ open source PHP packages / 920k+ downloads

Laravel TestTools Chrome extension / ~15k weekly users

Codeception TestTools Chrome extension
                </section>
<section class="center" data-background-image="img/terminator2.jpg">
<h1 style="color: white">Chatbots</h1>
</section>
<section class="center" data-transition="none">
    <h2>Definition</h2>
    <img src="img/definition.png">
</section>
<section class="center" data-transition="none">
    <h2>Chatbot</h2>
    <h3>A conversational user interface to interact with your application</h3>
</section>
<section class="center" data-transition="none">
<h2>Bots are your friends</h2>
<img src="img/forge-bot.png" style="float: left;width:50%;" />
<div style="text-align:left; float:right; width: 45%;">
    <b>Automate deployments</b>
</div>
<aside class="notes">
- We use our own Laravel Forge bot, Insurance company, National Health Service UK
</aside>
</section>
<section class="center" data-transition="none">
<h2>Bots are your friends</h2>
<img src="img/bot-freek.jpg" style="float: left;width:50%;" />
<div style="text-align:left; float:right; width: 45%;">
    <b>DevOps</b>
</div>
</section>
<section class="center" data-transition="none">
    <h2>Bots are your friends</h2>
    <img src="img/bot-techcrunch.png" style="float: left;width:50%;" />
    <div style="text-align:left; float:right; width: 45%;">
        <b>Brand marketing</b>
    </div>
</section>
<section class="center" data-transition="none">
    <h2>Bots are your friends</h2>
    <img src="img/example_tfl.png" style="float: left;width:50%;" />
    <div style="text-align:left; float:right; width: 45%;">
        <b>Self-Service</b>
    </div>
</section>
<section class="center" data-transition="none">
    <h2>Bots are your friends</h2>

    <div style="float:left; width: 45%">
        <blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr">Asking Alexa to deploy my <a href="https://twitter.com/laravelphp?ref_src=twsrc%5Etfw">@laravelphp</a> Forge sites 😎<br><br>This is 12 lines of PHP with BotMan + Laravel 🙂 <a href="https://t.co/d9knUQmvLC">pic.twitter.com/d9knUQmvLC</a></p>&mdash; Marcel Pociot (@marcelpociot) <a href="https://twitter.com/marcelpociot/status/946495185726435328?ref_src=twsrc%5Etfw">December 28, 2017</a></blockquote>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>
    <div style="text-align:left; float:right; width: 45%;">
        <b>Fun</b>
    </div>
</section>
<section class="center">
<h2>The time is right</h2>
<img src="/img/marketing/chat_apps_vs_social_networks.png" class="stretch">
</section>
<section class="center" data-markdown>
## 🎉
## Let's build our own chatbot!
</section>
<section data-background="#fff" data-background-image="img/supported_drivers.png">
<aside class="notes">
Many messengers. They all work differently.
</aside>
</section>
<section class="center">
<h3>How does all of this work?</h3>
<img src="img/chatbot-flow.png" class="stretch" />
<aside class="notes">
Many messengers. They all work differently.
</aside>
</section>
<section class="center">
<h1>Hi!</h1>
<img src="/img/botman.png" width="395" />
</section>
<section class="center">
<h1>Installation</h1>
<h2>Standalone</h2>
<pre><code data-trim data-noescape>
$ composer require botman/botman
</code></pre>
</section>
<section class="center">
<h1>Installation</h1>
<h2>BotMan Studio</h2>
<pre><code data-trim data-noescape>
$ composer global require botman/installer
$ botman new my_awesome_chatbot
</code></pre>
</section>
<section class="center">
<h2>Adding Drivers</h2>
<img src="/img/driver-list.png" />
<pre class="fragment"><code data-trim data-noescape>
$ php artisan botman:driver-install facebook
</code></pre>
</section>
<section class="center">
<h1>Configuration</h1>
<img src="img/botman-config.png" width="422" />
</section>
<section class="center">
<h2>Bot fundamentals</h2>
<ol>
    <li>Hear</li>
    <li>Process</li>
    <li>Respond</li>
</ol>
</section>
<section>
<h2>Hearing things</h2>
<pre><code data-trim data-noescape>
$botman->hears('keyword', function($bot) {
    $bot->reply('Hello my friend!');
});
$botman->hears('another keyword', 'My\Bot\Controllers@handle')

$botman->listen();
</code></pre>
<div class="fragment">
<example></example>
</div>
</section>
<section class="center">
<h2>Hearing things</h2>
<img src="img/telegram/keyword.png" />
</section>
<section class="center">
<h2>Hearing things</h2>
<img src="img/example_facebook.png" />
</section>
<section>
<h2>Hearing things</h2>
<pre><code data-trim data-noescape>
$botman->hears('tell me more', function($bot) {
    $bot->reply('Hello my friend!');
    $bot->reply('What do you want to know?');
});
</code></pre>
<example></example>
</section>
<section class="center">
<h2>Hearing things</h2>
<pre><code data-trim data-noescape>
$botman->group(['driver' => SlackDriver::class], function($botman) {
    $botman->hears('I only listen on Slack', function($bot) { });
    $botman->hears('Me too', function($bot) { });
});

$botman->group(['driver' => TelegramDriver::class], function($botman) {
    $botman->hears('And I only listen on Telegram', function($bot) { });
});
</code></pre>
</section>
<section>
<h2>Hearing things</h2>
<pre><code data-trim data-noescape>
$botman->hears('Call me {name}', function($bot, $name) {
    $bot->reply('Hello '.$name);
});
$botman->hears('I am {name} the {adjective}', function($bot, $name, $adjective) {
    $bot->reply('Hello '.$name.'. You truly are '.$adjective);
});
</code></pre>
<example></example>
</section>
<section>
<h2>Hearing things</h2>
<pre><code data-trim data-noescape>
$botman->hears('I am ([0-9]+) years old', function($bot, $age) {
    $bot->reply('Got it - your age is: '.$age);
});
</code></pre>
<example></example>
</section>
<section>
<h2>Attachments</h2>
<h4>Listen for image uploads</h4>
<pre><code data-trim data-noescape>
$botman->receivesImages(function($bot, $images) {
    //
});
</code></pre>
</section>
<section>
<h2>Attachments</h2>
<pre><code data-trim data-noescape>
$botman->receivesVideos(function($bot, $videos) {
    //
});

$botman->receivesAudio(function($bot, $audio) {
    //
});

$bot->receivesLocation(function($bot, Location $location) {
    $lat = $location->getLatitude();
    $lng = $location->getLongitude();
});
</code></pre>
</section>
<section>
<h2>Hearing things</h2>
<h4>If nothing else <strike>matters</strike> matches</h4>
<pre><code data-trim data-noescape>
$botman->fallback(function($bot) {
    $bot->reply('I have no idea what you are talking about!');
});
</code></pre>
<example></example>
</section>
<section>
<h2>Remembering things</h2>
<pre><code data-trim data-noescape>
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
</code></pre>
<example></example>
</section>
<section class="center">
<h2>Remembering things</h2>
<pre><code data-trim data-noescape>
$bot->userStorage()->save([
    'age' => $age
]);

$bot->channelStorage()->save([
    'num_users' => $num
]);

$bot->driverStorage()->save([
    'foo' => $bar
]);
</code></pre>
</section>
<section>
<h2>Driver events</h2>
<pre><code data-trim data-noescape>
// Slack
$botman->on('team_join', function($payload, $botman) {
    $botman->reply('Hello!');
});

// Facebook
$botman->on('messaging_reads', function($payload, $botman) {
    // Message was read.
});

// Telegram
$botman->on('left_chat_member', function($payload, $botman) {
    $botman->reply('Goodbye '.$payload['username']);
});
</code></pre>
</section>
<section>
<h2>Advanced Responses</h2>
<pre><code data-trim data-noescape>
$botman->hears('give me images', function($bot) {
    $image = Image::url('http://php-conference-uk.test/img/botman.png');
    $message = OutgoingMessage::create('Here is a nice image')
            ->withAttachment($image);
    $bot->reply($message);
});
</code></pre>
<example></example>
</section>
<section class="center">
<h2>Advanced Responses</h2>
<pre><code data-trim data-noescape>
$botman->hears('give me videos', function($bot) {
    $video = Video::url('http://php-conference-uk.test/video/botman.mp4');
    $message = OutgoingMessage::create()->withAttachment($video);
    $bot->reply($message);
});
</code></pre>
<example></example>
</section>
<section class="center">
<h3>Driver Specific Responses</h3>
<pre><code data-trim data-noescape>
$template = ListTemplate::create()
        ->addElement(
            Element::create('BotMan Documentation')
                ->subtitle('Take a look at the BotMan documentation')
                ->image('http://botman.io/img/logo.png')
                ->addButton(ElementButton::create('Tell Me More')
                    ->url('https://botman.io'))
        )
        ->addElement(
            Element::create('BotMan Studio')
                ->subtitle('Take a look at BotMan Studio')
                ->image('http://botman.io/img/logo.png')
                ->addButton(ElementButton::create('Visit')
                    ->url('https://botman.io'))
        );
$bot->reply($template);
</code></pre>
</section>
<section class="center">
<h3>Driver Specific Responses</h3>
<img src="/img/example_facebook_template.png" />
</section>
<section class="center">
<h3>Driver Specific Responses</h3>
<pre><code data-trim data-noescape>
$template = ButtonTemplate::create('Do you want to know more about BotMan?')
    ->addButton(
        ElementButton::create('Tell me more')
            ->type('postback')
            ->payload('tellmemore')
    )
    ->addButton(
        ElementButton::create('Show me the docs')
            ->url('http://botman.io/')
    );

$bot->reply($template);
</code></pre>
</section>
<section class="center">
<h3>Driver Specific Responses</h3>
<img src="/img/example_facebook_button_template.png" />
</section>
<section class="center">
    <h2>Let's order some Pizza!</h2>
    <cite class="fragment">👨 - I want a large capricciosa with extra cheese delivered to The Brewery</cite>
<pre class="fragment"><code data-trim data-noescape>
$botman->hears('I want a ([^\s]+) ([^\s]+) (with [^\s]+)? delivered to ([^\s]+)', function(...))
</code></pre>
</section>
<section>
<h2>Conversations</h2>
<pre><code data-trim data-noescape>
$botman->hears('I want images', function($bot) {
    $bot->ask('Which images?', function($answer, $bot) {
        $text = $answer->getText();
        $image = Image::url('http://lorempixel.com/400/200/'.$text.'/');
        
        $message = OutgoingMessage::create()
                ->withAttachment($image);
        $bot->say($message);
    });
});
</code></pre>
<example></example>
</section>
<section>
    <h2>Conversations</h2>
<pre><code data-trim data-noescape>
class PizzaConversation extends Conversation
{
    public function run()
    {
        $this->ask('What Pizza size do you want?', function($answer) {
            $this->size = $answer->getText();
        });
    }
}
</code></pre>
</section>
<section>
    <h2>Conversations</h2>
<pre><code data-trim data-noescape>
$this->ask('What Pizza size do you want?', function($answer) {
    $this->size = $answer->getText();
    $this->askTopping();
});

public function askTopping()
{
    $this->ask('What kind of topping do you want?', function($answer) {
        $this->topping = $answer->getText();
        $this->askAddress();
    });
}
</code></pre>
</section>
<section>
    <h2>Conversations</h2>
<pre><code data-trim data-noescape>
$this->ask('Where can we deliver your tasty pizza?', function($answer) {
    $this->address = $answer->getText();
    $this->say('Okay. That is all I need.');
    $this->say('Size: '.$this->size);
    $this->say('Topping: '.$this->topping);
    $this->say('Delivery address: '.$this->address);
});
</code></pre>
</section>
<section>
<h2>Conversations</h2>
<pre><code data-trim data-noescape>
$botman->hears('I want pizza', function($bot) {
    $bot->startConversation(new PizzaConversation);
});
</code></pre>
<example></example>
</section>
<section>
<h2>Questions</h2>
<pre><code data-trim data-noescape>
// Better pizza
$question = Question::create('What Pizza size do you want?');
$question->addButtons([
    Button::create('Supersize')->value('XXL'),
    Button::create('Large')->value('L')
]);
$this->ask($question, function($answer) {
    //
});
</code></pre>
<example></example>
</section>
<section class="center">
<h2>Questions</h2>
<img src="img/telegram/better_pizza.png" />
</section>
<section class="center">
<h2>Questions</h2>
<img src="img/example_facebook_buttons.png" />
</section>
<section>
<h3>Natural Language Processing</h3>
<br /><br />
<p class="fragment">Hey Calendar, schedule dinner with Nicole at 8 pm tomorrow.</p>
<pre class="fragment"><code data-trim data-noescape>
{
  "intent": "create_meeting",
  "entities": {
    "name" : "Dinner with Nicole",
    "invitees" : ["Nicole"],
    "time": "{{ strftime("%Y-%m-%d %H:%M:00", strtotime('tomorrow 8pm'))}}"
  }
}
</code></pre>
</section>
<section>
<h3>Natural Language Processing</h3>
<img src="img/nlp_services.png" height="400" />
</section>
<section>
<h3>Natural Language Processing</h3>
<img src="img/nlp_config.png" />
</section>
<section>
<h3>Natural Language Processing</h3>
<pre><code data-trim data-noescape>
$middleware = Dialogflow::create('my-dialogflow-token')->listenForAction();
$botman->middleware->received($middleware);

$botman->hears('order.pizza', function($bot) {
    $extras = $bot->getMessage()->getExtras('apiParameters');
    $bot->reply('Type: '.$extras['type']);
    $bot->reply('Size: '.$extras['size']);
    $bot->reply('Topping: '.implode($extras['topping'], ' '));
})->middleware($middleware);
</code></pre>
</section>
<section data-transition="none">
<h3>Natural Language Processing</h3>
<example></example>
</section>
<section class="center">
<h2>Originating Messages</h2>
<pre><code data-trim data-noescape>
$botman->say('This is your daily status update...', $userId);
</code></pre>
<pre class="fragment"><code data-trim data-noescape>
$botman->startConversation(
    new UserFeedbackConversation(), 
    $userId
);
</code></pre>
</section>
<section class="center">
<h2>Testing</h2>
</section>
<section class="center">
<h2>Testing</h2>
<pre><code data-trim data-noescape>
class BotManTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->bot
             ->receives('test')
             ->assertReply('hello!');
    }
}
</code></pre>
</section>
<section class="center">
<h2>Testing</h2>
<pre><code data-trim data-noescape>
$this->bot
    ->receives('Hi')

    ->assertReply('Hello')

    ->assertReplies(['Hello!', 'Nice to meet you'])

    ->assertReplyIsNot('Good bye')

    ->assertReplyNothing()

    ->assertQuestion()

    ->assertTemplate(ButtonTemplate::class);
    
</code></pre>
</section>
<section class="center">
<h2>Extending BotMan</h2>
<h3>Middleware</h3>
</section>
<section class="center">
<img src="/img/middleware.png" class="stretch" />
</section>
<section class="center">
<h2>Middleware</h2>
<pre><code data-trim data-noescape>
$logger = new LoggerMiddleware();

$botman->middleware->sending($logger);
$botman->middleware->receiving($logger);
</code></pre>
</section>
<section class="center">
<h2>Extending BotMan</h2>
<h3>Drivers</h3>
<ul>
    <li>Connect to your service</li>
    <li>Use different protocols</li>
</ul>
</section>
<section class="center">
    <h1>Demo</h1>
</section>
<section class="center">
<h2>botman.io</h2>
<h3>t.me/BotManTalkFeedbackBot</h3>
<h2 class="fragment">buildachatbot.io</h2>
</section>
        </div>
        </div>

        <script src="js/app.js"></script>
        <script src="lib/js/head.min.js"></script>
        <script src="js/reveal.js"></script>

        <script>
            // More info https://github.com/hakimel/reveal.js#configuration
            Reveal.initialize({
                controls: false,
                progress: false,

                history: true,
                margin: 0,

                center: false,
                
                width: 960,
                height: 700,

                // More info https://github.com/hakimel/reveal.js#dependencies
                dependencies: [
                    { src: 'plugin/markdown/marked.js' },
                    { src: 'plugin/markdown/markdown.js' },
                    { src: 'plugin/notes/notes.js', async: true },
                    { src: 'plugin/highlight/highlight.js', async: true, callback: function() { hljs.initHighlightingOnLoad(); } }
                ]
            });
        </script>
    </body>
</html>
