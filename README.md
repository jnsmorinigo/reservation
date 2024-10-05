# API Reservation

API  Reservation.

## Technologies

- Apache 2
- Laravel 11.9
- PHP 8.2
- Composer 2.x.x
- Mysql 8.0.39

## Production

### Apache 2 and PHP 8.2  ### Apache

Install Apache 2 and PHP 8.2

```bash
sudo apt update
sudo apt install php8.2 php8.2-fpm php8.2-xml php8.2-mbstring php8.2-postgreSQL php8.2-gd php8.2-curl php8.2-zip php8.2-pgsql
apache2 libapache2-mod-fcgid curl
sudo systemctl status php8.2-fpm
sudo apt autoclean && sudo apt clean
sudo a2enmod actions fcgid alias proxy_fcgi
sudo service apache2 restart
```

Asing permissions

```bash
sudo chgrp www-data /var/www/html
sudo usermod -a -G www-data useradmin
sudo chmod -R 775 /var/www/html
sudo chmod -R g+s /var/www/html
sudo chown -R useradmin /var/www/html
```

### Composer 2.0

Install composer 2.0

```bash
cd ~
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer
composer --version

```
show:

```bash
$ Composer version 2.2.5 2022-01-21 17:25:52
```

### DataBase

#### Install

```bash
sudo apt update -y
curl -LsS https://r.mariadb.com/downloads/mariadb_repo_setup | sudo bash
sudo apt-get install mariadb-server mariadb-client -y
mariadb --version
```

show:

```bash
$ mariadb from 11.1.2-MariaDB, client 15.2 for debian-linux-gnu (x86_64) using  EditLine wrapper

```

```bash
sudo systemctl status mariadb
sudo mysql_secure_installation

RUNNING ALL PARTS OF THIS SCRIPT IS RECOMMENDED FOR ALL MariaDB
SERVERS IN PRODUCTION USE!  PLEASE READ EACH STEP CAREFULLY!
In order to log into MariaDB to secure it, we'll need the current password for the root user. If you've just installed MariaDB, and haven't set the root password yet, you should just press enter here.
Enter current password for root (enter for none):
OK, successfully used password, moving on...
Setting the root password or using the unix_socket ensures that nobody can log into the MariaDB root user without the proper authorization.
You already have your root account protected, so you can safely answer 'n'.
Switch to unix_socket authentication [Y/n] Y
Enabled successfully!
Reloading privilege tables..
... Success!
You already have your root account protected, so you can safely answer 'n'.
Change the root password? [Y/n] Y
New password: XXXXX
Re-enter new password: XXXXX
Password updated successfully!
Reloading privilege tables..
... Success!
By default, a MariaDB installation has an anonymous user, allowing anyone to log into MariaDB without having to have a user account created for them.  This is intended only for testing, and to make the installation go a bit smoother.  You should remove them before moving into a production environment.
Remove anonymous users? [Y/n] Y
... Success!
Normally, root should only be allowed to connect from 'localhost'.  This ensures that someone cannot guess at the root password from the network.
Disallow root login remotely? [Y/n] Y
... Success!
By default, MariaDB comes with a database named 'test' that anyone can access.  This is also intended only for testing, and should be removed before moving into a production environment.
Remove test database and access to it? [Y/n] Y
- Dropping test database...
... Success!
- Removing privileges on test database...
... Success!
Reloading the privilege tables will ensure that all changes made so far will take effect immediately.
Reload privilege tables now? [Y/n] Y
... Success!
Cleaning up...
All done!  If you've completed all of the above steps, your MariaDB installation should now be secure.
Thanks for using MariaDB!
```

#### Create

```bash
mariadb -u root -p
CREATE DATABASE reservation CHARACTER SET utf8 COLLATE utf8_general_ci;
```

#### Privileges

```bash
GRANT ALL PRIVILEGES ON reservation* TO reservation@'localhost' IDENTIFIED BY 'xxxZZZ';
FLUSH PRIVILEGES;
```

### Project

```bash
sudo apt update
sudo apt install git
sudo apt autoclean && sudo apt clean
cd /var/www/html/
sudo git clone https://github.com/Mapa-Carreras/backend_carreraspy.git api.reservation.com.py
sudo chown -R www-data:www-data api.reservation.com.py
cd api.reservation.com.py
cp .env.example .env
composer install --optimize-autoloader --no-dev
php artisan key:generate
```

#### Change values from .env

```
APP_URL=

DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

#### Permissions

```bash
cd /var/www/html/
sudo chown -R www-data:www-data api.reservation.com.py
cd api.reservation.com.py
sudo find ./ -type d -exec chmod 755 {} \;
sudo find ./ -type f -exec chmod 644 {} \; 
cd api.reservation.com.py
sudo chown www-data:www-data storage -R
sudo chown www-data:www-data bootstrap/cache -R
sudo chmod -R ug+rwx storage bootstrap/cache
```

#### Migration

```bash
php artisan migrate --seed
```

#### Active modules

```bash
sudo a2enmod rewrite
sudo a2enmod headers
sudo a2enmod expires
```

#### Add site

```bash
sudo a2ensite api.reservation.com.py
sudo systemctl restart apache2
```

#### Add hosts

```bash
sudo nano /etc/hosts
```

Add:

```bash
127.0.0.1   api.reservation.com.py
```

disable default conf:

```
sudo a2dissite 000-default.conf
```

#### Access web browser

http://api.reservation.com.py

## Development

### Migracion

eliminar todas las tablas y datos y volver a migrar.

```
php artisan migrate:fresh --seed
```

### Server

Run development server

```
php artisan serve
```

#### Access web browser (temporal)

To access an API http://localhost:8000/api


#### Config Database and conection

##### Change values from .env

```
APP_URL=

DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

##### Create

```bash
mariadb -u root -p
CREATE DATABASE reservation CHARACTER SET utf8 COLLATE utf8_general_ci;
```

#### Privileges

```bash
GRANT ALL PRIVILEGES ON reservation* TO reservation@'localhost' IDENTIFIED BY 'xxxZZZ';
FLUSH PRIVILEGES;
```