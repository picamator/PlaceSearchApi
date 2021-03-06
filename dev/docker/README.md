Docker
======

Application environment has several containers:

* web - Apache2.4 + php7.0, see [Dockerfile](app/Dockerfile)

Pre installation
----------------
Before start please be sure that was installed:

1. [Docker](https://docs.docker.com/engine/installation/)
2. [Compose](https://docs.docker.com/compose/install/)

Installation
------------
1. Set environment variable `HOST_IP` with your host machine IP, e.g. `export host_ip=192.168.0.104`
2. Run in application root `sudo docker-compose -f dev/docker/docker-compose.yml up`
3. Check containers `sudo docker-compose ps`

Containers
----------

### Web

#### SSH
SSH credentials:

1. user: `root`
2. password: `screencast`
3. ip: 0.0.0.0
4. port: 2225

To make connection by console simple run `ssh root@0.0.0.0 -p 2225`.

_Note_: if connection was refused just checkout inside container how is ssh service `service ssh status`.
In case it's not running execute `service ssh start`.

#### Bash
To open console inside `web` container please run  `sudo docker-compose -f ./dev/docker/docker-compose.yml exec web bash`

#### Apache
Please configure you `host` in you host machine:

1. Add line `place-search.dev 0.0.0.0`
2. Open `http://place-search.dev:8080` in your browser

Configuration IDE (PhpStorm)
---------------------------- 
### Remote interpreter
1. Use ssh connection to set php interpreter
2. Set "Path mappings": `host machine project root->/var/www/PlaceSearchApi`

More information is [here](https://confluence.jetbrains.com/display/PhpStorm/Working+with+Remote+PHP+Interpreters+in+PhpStorm).

### UnitTests
1. Configure UnitTest using remote interpreter. 
2. Choose "Use Composer autoload"
3. Set "Path to script": `/var/www/PlaceSearchApi/vendor/autoload.php`
4. Set "Default configuration file": `/var/www/PlaceSearchApi/dev/tests/unit/phpunit.xml.dist`

More information is [here](https://confluence.jetbrains.com/display/PhpStorm/Running+PHPUnit+tests+over+SSH+on+a+remote+server+with+PhpStorm).
