# OCR_P06_SnowTricks

OpenClassrooms - Training Course DA PHP/Symfony - Project P06 - Symfony

My WebSite is Online and you can visit it : [APi - Site CV](https://adrien-pierrard.fr)

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/2dfd6fd308ec4f31b8539bb9c1cf6c48)](https://www.codacy.com/manual/WizBhoo/OCR_P06_SnowTricks?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=WizBhoo/OCR_P06_SnowTricks&amp;utm_campaign=Badge_Grade)

## Version 1.0.0 - Mai 2020

*   This file explains how to install and run the project.
*   IDE used : PhpStorm.
*   I use a Docker Stack as personal local development environment but you can use your own environment.
*   Both method to install the project are described bellow.

-------------------------------------------------------------------------------------------------------------------------------------

Realized by Adrien PIERRARD - [(see GitHub)](https://github.com/WizBhoo)

Supported by Antoine De Conto - OCR Mentor

Special thanks to Yann LUCAS for PR Reviews

-------------------------------------------------------------------------------------------------------------------------------------

### How to install the project with your own local environment

What you need :

*   Symfony 4.4.*
*   PHP 7.2
*   MySQL 8 - (I use PHPMyAdmin)
*   Database UML schemas are provided in a project folder named "UML_diagrams"
*   Demo data are provided through fixtures to load with Doctrine after DB creation

Follow each following steps :

*   First clone this repository from your terminal in your preferred project directory.

```
https://github.com/WizBhoo/OCR_P06_SnowTricks.git
```

*   You need to edit the ".env" file to setup Doctrine for DB connection.
*   You need also to setup inside MAILER_DSN variable for Mailer (I used symfony/google-mailer) to allow sending account validation email or use the forgotten password form to send a reset password email for user account.
*   If you prefer you can copy the ".env" file and setup your credentials in a ".env.local" file.
*   Launch your local environment.
*   From your terminal, go to the project directory and tape those command line :

```
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

*   Well done ! The project is installed so you just have to go to your localhost home page.

-------------------------------------------------------------------------------------------------------------------------------------

### How to install the project using my Docker Stack (recommended method)

*   My Docker stack provide a development environment ready to run a Symfony project.
*   Follow this link and read the README file to install it : [Docker Symfony](https://github.com/WizBhoo/docker_sf3_to_sf5)
*   Prerequisite : to have Docker and Docker-Compose installed on your machine - [Docker Install](https://docs.docker.com/install/)
*   Preferred Operating System to use it : Linux / Mac OSx

Once you have well installed my Docker Stack, follow each following steps :

*   From your terminal go to the symfony directory created by Docker.
*   Clone this repository inside.

```
https://github.com/WizBhoo/OCR_P06_SnowTricks.git
```

*   You need to edit the ".env" file to setup Doctrine for DB connection.
*   You need also to setup inside MAILER_DSN variable for Mailer (I used symfony/google-mailer) to allow sending account validation email or use the forgotten password form to send a reset password email for user account.
*   If you prefer you can copy the ".env" file and setup your credentials in a ".env.local" file.
*   From your terminal go to the Docker directory and launch Docker using those command lines :

```
make build
make start or make up
```

<blockquote>
You can also use "make help" to see what "make" command are available.
</blockquote>

*   You can access to PHPMyAdmin using [pma.localhost](http://pma.localhost) but as already mentioned, you will create the DB and load data fixtures through command lines with Doctrine (See next steps).
*   From your terminal, always in the Docker directory, tape those command lines :

```
make sh
cd symfony/
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

*   Well done ! The project is installed so you just have to go to [mon-site.localhost](http://mon-site.localhost) home page.

-------------------------------------------------------------------------------------------------------------------------------------

### What you can do on this WebSite

*   This project takes part of my training course to become a developer. Data presented are only used for demonstration.
*   You can browse the Tricks gallery.
*   If you want to post a comment or add a new Trick, you need to create an account.
*   This account needs to be validate using the link sent to your email address.
*   If you forget your password, you can retrieve it thanks to the forgotten password form.
*   Follow the link received by email to be redirected to the change password form.
*   If you create or update a Trick, you will be able to add some images or embed youtube videos link to this Trick.

-------------------------------------------------------------------------------------------------------------------------------------

### Contact

Thanks in advance for Star contribution

Any question / trouble ?

Please send me an [e-mail](mailto:apierrard.contact@gmail.com) ;-)
