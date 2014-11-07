rBruteForce
===========

CakePHP 3 Plugin for Protection Against BruteForce Attacks

# CakePHP rBruteForce Plugin

With rBruteForce you could protect your CakePHP applications from Brute Force attacks.

## Requirements

* CakePHP 3.0.0 or greater.
* PHP 5.4.16 or greater.

## Installation

* Create the database tables.

```sql
CREATE TABLE IF NOT EXISTS `rbruteforcelogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `rbruteforces` (
  `ip` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `expire` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`expire`),
  KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

* Copy the plugin to your `/plugins` folder

* Load the plugin
```php
Plugin::load('RBruteForce', ['bootstrap' => false, 'routes' => true]);
```

## Reporting Issues

If you have a problem with rBruteForce please report [here](https://github.com/rrd108/rBruteForce/issues)

# Documentation

rBruteForce bans IP-s on unsuccessful login or any other method.

## Usage

As this plugin is a component you should add it to your `Controller`'s $components array.

```php
class UsersController extends AppController {
	
	public $components = ['RBruteForce.RBruteForce'];
```

Let's see an example for the `UsersController` `login` method with rBruteForce

```php
public function login() {
	if ($this->request->is('post')) {
		$this->RBruteForce->check();		//if it is here - banned out user (IP) would not able to login even with correct username/password
		$user = $this->Auth->identify();
		if ($user) {
			$this->Auth->setUser($user);
			return $this->redirect($this->Auth->redirectUrl());
		}
		$this->Flash->error(__('Invalid username or password, try again'));
	}
}
```
That is all! :)

## Options

You could use options to alter the default behaviour.

```php
$options = [
	'maxAttempts' => 4,			//max failed attempts before banning
	'expire' => '3 minutes',	//expiration time
	'dataLog' => false,			//log the user submitted data
	'attemptLog' => 'beforeBan',//all|beforeBan
	'checkUrl' => true,			//check url or not
	'cleanupAttempts' => 1000	//delete all old entries from attempts database if there are more rows that this
	];
$this->RBruteForce->check($options);
```

You do not have to include options where default value is good for you. For example.

```php
$this->RBruteForce->check(
		[
		'maxAttempts' => 3,
		'attemptLog' => 'all'
		]
	);
```


### maxAttempts

Users will banned after this many unsuccessful attempts. Normally 3-5 should be enough.

### expire

The ban will exists for this time. This should be something like:

* 20 seconds
* 5 minutes
* 1 hour
* 2 days
* 3 weeks
* 1 month

### dataLog

If this option is set to `true` the user submitted data will be saved to the plugin's database.
You could analize this data any time you want.

### attemptLog

There are two valid values; `all` and `beforeBan`

If you choose `all` than all attempts will be logged into the plugins database.
If you choose `beforeBan` only attempts before banning will be logged.

### checkUrl

Shoud the plugin include the url into the brute force check or not.

If set to `false` and somebody try to login at `/users/login` and than at `/admin/users/login`
the plugin will count as they would be the same url.
If set to `true` the plugin will se thw two above as different attempts.

### cleanupAttempts

When you suffer a brute force attack you could have thousands of log entries in the database
in a few minutes.
If you want to limit how much data should be stored you could use this option. Normally you should
not worry about this till you have less than a million record.

## How does it work?

When a user (or an automated attack) send some data to login (or any other) function cakePHP will
call your controller's method. In this method you should have

```php
$this->RBruteForce->check();
```
This method calls the plugin and it will log every attempts. It checks the plugin database for the
clients IP address.
If there are more entries there within the given expiration the plugin bans the request, logs the
attempt and redirect the user to the failed login page. Automated attacks will see this as a successful
login.

On every failed attempt the plugin delays the rendering of the page with an extra 1 second. So after 3
attempts the rendering will be delayed with 3 seconds. This slows down automated attacks, and just a little
inconvinience for real users.

If an IP address is banned and you `check` *before* user authentication the plugin will not let the user
get in even with valid username and password. 

To remove the ban before expire you should browse to `/r_brute_force/rbruteforces` and delete the ban manually.
Alternatively you just wait till the ban expires.

Submitted data entries available at `/r_brute_force/rbruteforcelogs`.

## Warning

This is not a firewall! If you use this plugin you are still open to brute force attacks. Slow attacks
involving proxies are really hard to detect. If you want protection agains them you should write your own
protection methods, like limiting user accounts after a few attempts, or asking for extra login data
like security question, or whitelist IP-s from where admins could log in, or other ideas.
In the same time you could ban top attempt sources on your server firewall. This information is available
at `/r_brute_force/rbruteforces`. Be careful to not to ban out proxies used by legitim users.
