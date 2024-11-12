# How to USE

# php.ini

dans le php.ini avoir au minimum extension=zip et extension=pdo_mysql d’activé

# environnement

dans le .env

```
APP_ENV=dev
APP_SECRET=dba24b76e0cf29ecb2ea885cd29c7c86
DATABASE_URL="mysql://USER:USERPWD@127.0.0.1:3306/DBNAME?serverVersion=mariadb-11.5.2&charset=utf8mb4"
MESSENGER_TRANSPORT_DSN=doctrine://default

```

# db setup

```
CREATE USER 'USER'@'localhost' IDENTIFIED BY 'PASSWORD';
CREATE DATABASE DBNAME;
GRANT ALL PRIVILEGES ON DBNAME.* TO 'USER'@'localhost';
flush privileges;

```

# setup

commande a faire

- composer install
- symfony console doctrine:migrations:migrate
- symfony server:start

pour la db

# How to access

[http://localhost:8000/page](http://localhost:8000/page) -> pour voir les jeux accessible avec leurs offres
[http://localhost:8000/admin](http://localhost:8000/admin) -> pour ajouté, modifier ou supprimé des jeux  et les offres