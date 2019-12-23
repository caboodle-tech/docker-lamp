# LAMP stack built with Docker Compose

This repo is a modified version of [sprintcube's](https://github.com/sprintcube) [docker-compose-lamp repo](https://github.com/sprintcube/docker-compose-lamp). It has been slimed down slightly and configured for development work at Caboodle Tech Inc.

This is a basic LAMP stack environment built using Docker Compose. It consists of the following:

* PHP 7.3.13
   * GD with WebP support enabled
   * ImageMagick enabled
* Apache 2.4.x
* MySQL 8.0.18
* phpMyAdmin

## Installation

Clone this repository on your local computer and run the `docker-compose up -d` command:

```shell
git clone https://github.com/caboodle-tech/docker-lamp.git
cd docker-lamp/
git fetch --all
cp sample.env .env
docker-compose build --no-cache --pull
docker-compose up -d
```

Your LAMP stack is now ready! You can access it via `http://localhost`.

## Configuration

This package comes with default configuration options. You can modify them by creating your own `.env` file in your root directory.

### Configuration Variables

There are following configuration variables available and you can customize them by overwriting in your own `.env` file.

_**DOCUMENT_ROOT**_

It is a document root for Apache server. The default value for this is `./www`. All your sites will go here and will be synced automatically.

_**MYSQL_DATA_DIR**_

This is MySQL data directory. The default value for this is `./data/mysql`. All your MySQL data files will be stored here.

_**VHOSTS_DIR**_

This is for virtual hosts. The default value for this is `./config/vhosts`. You can place your virtual hosts conf files here.

> Make sure you add an entry to your system's `hosts` file for each virtual host.

_**APACHE_LOG_DIR**_

This will be used to store Apache logs. The default value for this is `./logs/apache2`.

_**MYSQL_LOG_DIR**_

This will be used to store Apache logs. The default value for this is `./logs/mysql`.

## Web Server

Apache is configured to run on port 80. So, you can access it via `http://localhost`.

#### Apache Modules

By default following modules are enabled.

* rewrite
* headers

> If you want to enable more modules, just update `./bin/webserver/Dockerfile`.
> You have to rebuild the docker image by running `docker-compose build` and restart the docker containers.

#### Connect via SSH

You can connect to web server using `docker-compose exec` command to perform various operation on it. Use below command to login to container via ssh.

```shell
docker-compose exec webserver bash
```

## Database

The configuration variables for the MySQL database can be customized by overwriting them in your `.env` file.

**NOTE:** The original repo this docker image came from &mdash; [sprintcube's docker-compose-lamp repo](https://github.com/sprintcube/docker-compose-lamp) &mdash; allowed switching databases and versions. This functionality was removed to reduce the image size. If you would like to try this out please visit their repo.

## PHP

The installed version of PHP is 7.3.x

#### Extensions

By default following extensions are installed.

* curl
* gd
* iconv
* intl
* json
* mbstring
* mcrypt
* mysqli
* webp
* xml
* xmlrpc
* zip

> If you want to install more extension, just update `./bin/webserver/Dockerfile`.
> You have to rebuild the docker image by running `docker-compose build` and restart the docker containers.

## phpMyAdmin

phpMyAdmin is configured to run on port 8080. Use following default credentials.

http://localhost:8080/  
username: root  
password: lamp

**NOTE:** On the first run of your local copy you should login to phpMyAdmin as root and complete the installation of the PMA tables. There will be a prompt in a message box on the bottom of the dashboard. Click this and follow the steps.
