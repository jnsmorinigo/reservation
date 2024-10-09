# Test de la prueba tecnica

## Cambiar los valores de .env

```bash
APP_TIMEZONE='America/New_York'
APP_URL=localhost:8000

DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

DEFAULT_USER='Admin'
DEFAULT_EMAIL='admin@test'
DEFAULT_PASS='admin123'

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
```

## Realizar la migracion

```bash
php artisan migrate:fresh --seed
```

## Correr en modo desarrollo

Run development server

```bash
php artisan serve
```

## Acceder al sistema con

```bash
Usuario: 'admin@test'
pass: 'admin123'
```

Obs1: En el dashboard se encuetra todos los ejercicios, ya no pude agregar en sus correspondientes lugares debido al tiempo.

Obs2: Los que tienen params son los parametros que se pueden usar para la llamada por defecto tienen esos valores que se muestran ahi pero se pueden cambiar en la ruta de la misma.


## Probar con Postman

Primeramente no logueamos 

![Login in Postman](http://localhost:8000/resources/guide-to-test/Captura-de-pantalla-de-2024-10-09-00-27-48.png)

luego usamos el access_token para configurar el authorization 
![Login in Postman](<http://localhost:8000/resources/guide-to-test/Captura> de pantalla de 2024-10-09 00-28-18.png)
