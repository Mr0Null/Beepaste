Stikked is an Open-Source PHP Pastebin, with the aim of keeping a simple and easy to use user interface.

Stikked allows you to easily share code with anyone you wish. Based on the [original Stikked](http://code.google.com/p/stikked/) with lots of bugfixes and improvements.

Here are some features:

* Easy setup
* Syntax highlighting for many languages, including live syntax highlighting with Ace Editor
* Paste replies
* Diff view between the original paste and the reply
* An API
* Search pastes
* Trending pastes
* Encrypted pastes
* Burn on reading
* Anti-Spam features
* Themes support
* Multilanguage support
* An [Android app](https://play.google.com/store/apps/details?id=org.teamblueridge.pasteitapp)
* Command line tool to upload paste to Stikked based pastebins: [Stikkit](https://github.com/benapetr/stikkit)
* Another CLI tool requiring only curl program: [pbin](https://github.com/glensc/pbin)
* And many more. View [this review](http://maketecheasier.com/run-your-own-pastebin-with-stikked/2013/01/11) 


Try it out
----------

http://beepaste.ir


Installation
------------

1. Download stikked from https://github.com/claudehohl/Stikked/tags
2. Create a user and database for Stikked
3. Copy application/config/stikked.php.dist to application/config/stikked.php
4. Edit configuration settings in application/config/stikked.php - everything is described there
5. You're done!

* The database structure will be created automatically if it doesn't exist.
* No special file permissions are needed by default. Optional: If you want to have the JavaScript- and CSS-files minified, the static/asset/ folder has to be writable.
* To ensure that pastes with an expiration set get cleaned up, define the cron key in the config and set up a cronjob, for example:
  * `*/5 * * * * curl --silent http://yoursite.com/cron/[key]`


Documentation
-------------

In the folder doc/, you will find:

* Webserver example configurations for Apache, Nginx, Lighttpd, Cherokee
* A troubleshooting guide
* How to create your own theme
* How to translate Stikked into your language
* How to contribute and improve Stikked
