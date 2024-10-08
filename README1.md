# API Digitalizacion.

Sistema Digitalizacion.

# Technologies

-   Apache 2
-   Laravel 9.19
-   PHP 8.1
-   Composer 2.0.x

# Production

## Apache 2 and PHP 8.1 

Install Apache 2 and PHP 8.1 

```
sudo apt update
sudo apt install php8.1 php8.1-fpm php8.1-xml php8.1-mbstring php8.1-postgreSQL php8.1-gd php8.1-curl php8.1-zip php8.1-pgsql
apache2 libapache2-mod-fcgid curl
sudo systemctl status php8.1-fpm
sudo apt autoclean && sudo apt clean
sudo a2enmod actions fcgid alias proxy_fcgi
sudo service apache2 restart
```

Asignar permisos

```
sudo chgrp www-data /var/www/html
sudo usermod -a -G www-data useradmin
sudo chmod -R 775 /var/www/html
sudo chmod -R g+s /var/www/html
sudo chown -R useradmin /var/www/html
```

Comprobacion

```
cd /var/www
ls -l
```
See:

> total 4
> drwxrwsr-x 2 useradmin www-data 4096 mar 20 02:51 html

## Composer 2.0

Install composer 2.0

```
cd ~
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer
composer --version

```

See:

> Composer version 2.5.4 2023-02-15 13:10:06

## DataBase

### PostgreSQL

#### Installl

```
sudo apt update
sudo apt install postgresql
```

#### Create Database

```
sudo su
su postgres
psql
CREATE DATABASE digitalizacion;
```

#### Create Types
```
sudo su
su postgres
psql
CREATE TYPE estadoscliente AS ENUM ('activo', 'eliminado', 'bloqueado');
CREATE TYPE estadosdocumentostipos AS ENUM ('activo', 'eliminado');
CREATE TYPE estadosusuario AS ENUM ('activo', 'eliminado', 'bloqueado');
CREATE TYPE estadosscanner AS ENUM ('activo', 'inactivo', 'eliminado', 'en uso');
CREATE TYPE acccionesauditoria AS ENUM ('listar', 'eliminar', 'actualizar', 'insertar', 'loguear', 'desloguear', 'bloquear', 'activar', 'error');
CREATE TYPE estadosucursal AS ENUM ('activo', 'eliminado', 'bloqueado');
CREATE TYPE estadopersona AS ENUM ('activo', 'inactivo');
CREATE TYPE estadocabecera AS ENUM ('activo', 'inactivo');
CREATE TYPE estadoingreso AS ENUM ('activo', 'finalizado', 'anulado');
CREATE TYPE tipoarchivo AS ENUM ('carpeta', 'pdf');
CREATE TYPE estadoarchivo AS ENUM ('digitalizado', 'optimizado', 'conformado', 'desechado');
CREATE TYPE estadodetallecaja AS ENUM ('activo', 'anulado', 'eliminado');
CREATE TYPE tipousuarios AS ENUM ('interno', 'externo');
CREATE TYPE estadofirma AS ENUM ('procesando', 'finalizado');
```

#### Privileges

```
```

## Project

```
sudo apt update
sudo apt install git
sudo apt autoclean && sudo apt clean
cd /var/www/html/
git clone http://192.168.3.7/jnsmorinigo/digitalizacion_back.git
sudo chown -R useradmin:www-data digitalizacion_back
cd digitalizacion_back
cp .env.example .env
composer install
php artisan config:cache
php artisan cache:forget spatie.permission.cache
php artisan key:generate
```

### Change values from .env

```
APP_URL=

DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

CORREO_ADMINISTRACION = ''

ADMIN_NAME = ''
ADMIN_EMAIL = ''
ADMIN_PASSWORD = ''
ADMIN_ALIAS = ''
ADMIN_CEDULA = ''

ITEMS_POR_PARGINA =10

MEDIA_DISK=''
QUEUE_CONNECTION=''
QUEUE_CONVERSIONS_BY_DEFAULT=''
IMAGE_DRIVER=''
FFMPEG_PATH=''
FFPROBE_PATH=''
ENABLE_MEDIA_LIBRARY_VAPOR_UPLOADS=''
MEDIA_PREFIX=''

#Configuraciones necesarias para el servidor de archivos
SFTP_HOST= '192.168.3.32'
SFTP_USERNAME = 'digitalizacion'
SFTP_PASSWORD = 'Big2022.py'
SFTP_PRIVATE_KEY = 'V7jXc/kmqiAjMYcR7KuyjNWEMp6BhacCoJQ3LT/cQKs'
SFTP_HOST_FINGERPRINT = ''
SFTP_PASSPHRASE = ''
SFTP_PORT= '22'
SFTP_ROOT='/var/bigbox/digitalizacion/'

```

### Permissions

#### Permisos proyecto

```
cd /var/www/html/
sudo chown -R useradmin:www-data digitalizacion_back
cd digitalizacion_back
sudo chown useradmin:www-data storage -R
sudo chown useradmin:www-data bootstrap/cache -R
sudo chmod -R ug+rwx storage bootstrap/cache

```
#### Permisos servidor de archivos

```
cd /var
sudo mkdir bigbox
cd /bigbox
sudo mkdir digitalizacion
sudo chown -R digitalizacion:www-data digitalizacion
sudo chmod -R 766 digitalizacion

```


### Migration

```
php artisan migrate --seed
```

### Active modules

```
sudo a2enmod rewrite
sudo a2enmod headers
sudo a2enmod expires

sudo systemctl restart apache2
```

### Add site

creamos el archivo

```
sudo nano /etc/apache2/sites-available/apidigitalizacion.bigbox.com.py.conf
```
Luego agregamos

```
<VirtualHost *:80>
    TimeOut 300
    ServerAdmin jnsmorinigo@gmail.com
    DocumentRoot "/var/www/html/digitalizacion_back/public"
    ServerName apidigitalizacion.bigbox.com.py

    <Directory /var/www/html/digitalizacion_back/public>
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>

    <Directory "/usr/lib/cgi-bin"> ErrorLog /var/log/apache2/digitalizacion_back.log
        AllowOverride None
        Options +ExecCGI -MultiViews +SymLinksIfOwnerMatch
        Order allow,deny
        Allow from all LogLevel warn
    </Directory>
    LoadModule deflate_module modules/mod_deflate.so
    LoadModule headers_module modules/mod_headers.so
    LoadModule filter_module modules/mod_filter.so
    <IfModule mod_deflate.c>
        # Activamos la compresion.
        SetOutputFilter DEFLATE

        # Indicamos los tipos de contenido a comprimir.
        AddOutputFilterByType DEFLATE text/plain
        AddOutputFilterByType DEFLATE text/html
        AddOutputFilterByType DEFLATE text/xml
        AddOutputFilterByType DEFLATE text/gml
        AddOutputFilterByType DEFLATE text/css
        AddOutputFilterByType DEFLATE application/json
        AddOutputFilterByType DEFLATE application/xml
        AddOutputFilterByType DEFLATE application/xhtml+xml
        AddOutputFilterByType DEFLATE application/rss+xml
        AddOutputFilterByType DEFLATE application/javascript
        AddOutputFilterByType DEFLATE application/x-javascript

        # Indicamos las extensiones de los ficheros a comprimir.
        <files *.html>
            SetOutputFilter DEFLATE
        </files>
        <files *.xml>
            SetOutputFilter DEFLATE
        </files>
        <files *.gml>
            SetOutputFilter DEFLATE
        </files>
        <files *.json>
            SetOutputFilter DEFLATE
        </files>
        <files *.js>
            SetOutputFilter DEFLATE
        </files>
        <files *.css>
            SetOutputFilter DEFLATE
        </files>
#        DeflateCompressionLevel 9
        # No se comprimen para navegadores antiguos.
        #BrowserMatch ^Mozilla/4 gzip-only-text/html
        #BrowserMatch ^Mozilla/4.0[678] no-gzip
        #BrowserMatch \bMSIE !no-gzip !gzip-only-text/html
    </IfModule>
    <FilesMatch \.php$>
        SetHandler "proxy:unix:/var/run/php/php8.1-fpm.sock|fcgi://localhost/"
    </FilesMatch>
    ErrorLog "/var/log/apache2/digitalizacion_back.error.log"
    CustomLog "/var/log/apache2/digitalizacion_back.access.log" common
</VirtualHost>
```


Una vez hecho esto levantamos el sitio

```
sudo a2ensite apidigitalizacion.bigbox.com.py.conf
sudo systemctl reload apache2
```

### Add hosts

```
sudo nano /etc/hosts
```

```
127.0.0.1   apidigitalizacion.bigbox.com.py
```
#### No hace falta en el local

```
sudo a2dissite 000-default.conf
```

## Access web browser

http://apidigitalizacion.bigbox.com.py/

## Migracion

eliminar todas las tablas y datos y volver a migrar.

```
php artisan migrate:fresh --seed
```

## Configuraciones de tareas programadas

Hacemos:

```
crontab -e
```

Y luego agregamos las siguientes entradas

### Tarea programada para cambio de estados de archivos colgados

```
*/10 6-19 * * 1-6 cd /var/www/html/digitalizacion_back && php artisan demonio:CambiarEstadoArchivo >> /dev/null 2>&1
```

### Tarea programada para borrar imagenes de archivos conformados

```
0 6 * * 1-6 cd /var/www/html/digitalizacion_back && php artisan demonio:BorrarImagenes >> /dev/null 2>&1
```

### Tarea programada para firmar documentos
```
* 5-20 * * * cd /var/www/html/digitalizacion_back && php artisan demonio:FirmarDocumento >> /dev/null 2>&1
```

# Development
## Server

Run development server

```
php artisan serve
```

### Access web browser (temporal)

To access http://localhost:8000/

### Add new module

Command for add new module

```
php artisan make:model [module_name] -mfscR --api

```
### Create command

```
php artisan make:command [foo] --command=demonio:[foo]
```

### Instalar AutoFirma
Descargar última versión de: https://estaticos.redsara.es/comunes/autofirma/1/6/5/AutoFirma_Linux.zip
Mover el archivo dentro de la carpeta temporal_autofirma
IMPORTANTE: SOLO FUNCIONA CON OPENJDK 8

```
sudo apt install openjdk-8-jre
sudo apt install libnss3-tools
mkdir temporal_autofirma
cd temporal_autofirma
unzip AutoFirma_Linux.zip
sudo dpkg -i *.deb
cd ..
rm -rf temporal_autofirma
```