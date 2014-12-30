Info : WIP bundle not functional

AdminBundle
===========

A symfony 2 bundle that can be used in backend of your site

Usage
=======
create folder namespace hj into :

    src/Hj/

clone this repo into :

    src/Hj/

parameters file config (app/config/parameters.yml) :

    parameters:
        database_driver: pdo_mysql
        database_host: 127.0.0.1
        database_port: null
        database_name: admin_user
        database_user: root
        database_password: root
        mailer_transport: smtp
        mailer_host: 127.0.0.1
        mailer_user: null
        mailer_password: null
        locale: en
        secret: ThisTokenIsNotSoSecretChangeIt

add into your routing file (app/config/routing.yml) :

    hj_admin:
        resource: "@HjAdminBundle/Resources/config/routing.yml"

register the bundle add into : (app/config/AppKernel.php) :

    new Hj\AdminBundle\HjAdminBundle();

install assets by running :

    php app/console assets:install

To load fixtures i use DoctrineFixturesBundle : more information here :

    http://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html

When you have registered DoctrineFixturesBundle run the command to populate your database with fixtures :

    php app/console doctrine:fixtures:load

Access to your application :

    http://localhost/{projectName}/web/app.php/