theme: Fira, 3

# BotMan
### From *Zero* to *Chatbot* :rocket:

---

# About me

**Marcel Pociot**

Developer at ORT interactive

@marcelpociot

---

# Open Source
### :heart_eyes:

---

# Open Source

15 open source PHP packages / ~200k downloads

Laravel TestTools Chrome extension

Codeception TestTools Chrome extension

_Rank 5 of top German GitHub developers :sunglasses:_

---

# ORT interactive

- 20 employees
- Building web applications and mobile apps
- Specialized in Laravel development

---

![](terminator2.jpg)
# Chatbots

---

![left fit](forge-bot.png)

## Bots are your friends
- Automate deployments
- Send SaaS metrics
- Scrum/stand-up bot
- Google Analytics
- Random fun

---

![left fit](bot-freek.jpg)

## Bots are your friends
- Automate deployments
- Send SaaS metrics
- Scrum/stand-up bot
- Google Analytics
- Random fun

---

# :tada: 
## Let's build our own chatbot!

---

![fit](chatbot-flow.png)

---

![](supported_drivers.png)

---

![right 100%](botman.png)
# Hi :wave:

---

## One Bot to rule them all!

![fit](supported_drivers.png)

---

# Hearing things
### Basics

```php
$botman->hears('keyword', function($bot) {
	$bot->reply('Hello my friend!');
});

$botman->hears('another keyword', 'My\Bot\Controllers@handle')
```

---

# Hearing things
### Named parameters

```php
$botman->hears('Call me {name}', function($bot, $name) {
	$bot->reply('Hello '.$name);
});
```

---

# Hearing things
### Using regular expressions

```php
$botman->hears('I am ([0-9]+) years old', function($bot, $age) {
	$bot->reply('Got it - your age is: '.$age);
});
```

---

# Hearing things
### Specifics

```php
$botman->hears('I am on Slack', function($bot) {
	//
})->driver(SlackDriver::class);

$botman->hears('I only listen on channel X', function($bot) {
	//
})->channel('X');
```

---

# Hearing things
### Groups

```php
$botman->group(['driver' => SlackDriver::class], function($botman){
	$botman->hears('I am on Slack', function($bot) {
		//
	});

	$botman->hears('Me too!', function($bot) {
		//
	});
});
```

---
