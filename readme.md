Requirements
------------

- Nette Shop example requires PHP 8.1

[![Travis CI](https://app.travis-ci.com/calvera/nette-shop.svg?branch=main)](https://app.travis-ci.com/github/calvera/nette-shop)
[![Coverage Status](https://coveralls.io/repos/github/calvera/nette-shop/badge.svg?branch=main)](https://coveralls.io/github/calvera/nette-shop?branch=main)

Database Setup
--------------

Run `docker-compose up -d` to start the database

Or use `docker-compose.override.yml` to setup your own database etc.

Web Server Setup
----------------

The simplest way to get started is to start the built-in PHP server in the root directory of your project:

	php -S localhost:8000 -t www

Then visit `http://localhost:8000` in your browser to see the welcome page.

For Apache or Nginx, setup a virtual host to point to the `www/` directory of the project and you
should be ready to go.

**It is CRITICAL that whole `app/`, `config/`, `log/` and `temp/` directories are not accessible directly
via a web browser. See [security warning](https://nette.org/security-warning).**
