>
> Disclaimer: **DO NOT USE THIS PACKE BEFORE A VERSION 1.0.0 IS PUBLISHED**.
>

# Xzit Giggle (XG)

Welcome to Xzit Giggle [XG] — yet another webhosting tool. XG is not a webhosting tool for everyone. It comes with a small footprint and just basic set of features. 
And it requires a little manual work and server knowledge. 

XG is only the right choice for you, when you know what you are doing. It's more or less for native server admins with a few users, who want to giv them a few options to 
self-care their domains / webhosting.

## Features

* Superusers can
  * create, edit and delete users (and their domains)
  * create other super users
  * change some system settings
* Users can self manage their
  * domains (by adding them to the system, not by registering them)
  * subdomains
  * PHP-Version per domain
  * Databases
* Users can
  * view log files for every domain
  * login via ssh (ed25519 keys only)
* Xzit Giggle comes with
  * simple design (Bootstrap 5.3)
  * a CLI Tool
  * simple installer for fronted
  * as Open Source Software

### Supported Software

You an use any software on your server, because XG is designed to be a small sidekick for your users. At the same time is limited to managing the following software

#### Webserver

Xzit Giggle allows you to deal with nginx. Wile that, you can use nginx for additional domains, which are not managed by XG. Because XG will one take care of known domains. 
Unknown domains stay untouched.

#### PHP

Xzit Giggle support PHP Fpm in the following version: 8.4, 8.3, 8.2, 8.1, 8.0 and 7.4. You can use any of them for any domain. And you can add more versions, if you like as 
long there a PHP Fpm packages for your distribution and work with pools in <code>/etc/php/</code>.

#### Database

Xzit Giggle is limited to manage MySQL-Databases. Its works best with MariaDB 10.4 and above.


## Installation

### Setup the server

Make sure you have a server with nginx and PHP8.3-fpm and working MySQL-Server running. If not:

```bash
sudo apt install nginx php8.3-fpm mariadb-server
```

### Setup Xzit Giggle

Now install Xzit Giggle:

```bash
sudo sh -c "$(curl -fsSL https://raw.githubusercontent.com/basteyy/xzit-giggle/install.sh)"
```

Navigate in your browser to the chown IP and everything click through the installer. After that, you should be able to login with the credentials you have set.

### Setup the CLI Cronjob

As root, run the following command:

```bash
sudo crontab -e
```

Add the following line:

```bash
*/5 * * * * /usr/bin/php8.3 /var/www/virtual/xg/giggle server:sync
```