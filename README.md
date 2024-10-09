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

rutas de ejemplo:

POST: http://localhost:8000/api/login

con body:

```json
{
    "email": "admin@test",
    "password": "admin123"
}
```

retorno:

```json
{
    "access_token": "2|zuM0BN9OyGyvl86RzheT43tJdpLTvmor0quzy9iTb5818ff0",
    "token_type": "Bearer"
}
```

se usa el access_token y token_type  para configurar el authorization

luego se puede llamar tambien a las rutas de la API

GET: http://localhost:8000/api/employees/time-blocks?start_time=09:00:00 2024-10-02&end_time=17:00:00 2024-10-08

retorna:

```json
[
    {
        "employee_id": 1,
        "employee_timezone": "Asia/Bangkok",
        "name": "Jordy",
        "available_blocks": [
            {
                "id": 7,
                "employee_id": 1,
                "work_date": "2024-10-02",
                "start_time": "2024-10-09 00:00:00",
                "end_time": "2024-10-09 01:00:00",
                "is_reserved": 0
            },...
        ],
        "reserved_blocks": [
            {
                "id": 12,
                "employee_id": 1,
                "work_date": "2024-10-02",
                "start_time": "2024-10-09 07:00:00",
                "end_time": "2024-10-09 08:00:00",
                "is_reserved": 1
            },...
        ]
    },
    {
        "employee_id": 2,
        "employee_timezone": "America/Porto_Velho",
        "name": "Levi",
        "available_blocks": [
            {
                "id": 403,
                "employee_id": 2,
                "work_date": "2024-10-02",
                "start_time": "2024-10-08 13:00:00",
                "end_time": "2024-10-08 14:00:00",
                "is_reserved": 0
            },...
        ],
        "reserved_blocks": [
            {
                "id": 405,
                "employee_id": 2,
                "work_date": "2024-10-02",
                "start_time": "2024-10-08 15:00:00",
                "end_time": "2024-10-08 16:00:00",
                "is_reserved": 1
            },... 
        ]
    },
    {
        "employee_id": 3,
        "employee_timezone": "America/Panama",
        "name": "Reese",
        "available_blocks": [
            {
                "id": 799,
                "employee_id": 3,
                "work_date": "2024-10-02",
                "start_time": "2024-10-08 12:00:00",
                "end_time": "2024-10-08 13:00:00",
                "is_reserved": 0
            },...
        ],
        "reserved_blocks": [
            {
                "id": 802,
                "employee_id": 3,
                "work_date": "2024-10-02",
                "start_time": "2024-10-08 17:00:00",
                "end_time": "2024-10-08 18:00:00",
                "is_reserved": 1
            },...
        ]
    }
]
```

GET: http://localhost:8000/api/employees/check-availability?date_time=09:00:00 2024-10-02

retorna:

```json
[
    {
        "id": 1,
        "user_id": 2,
        "lastname": "Littel",
        "specialty": "Psychiatry",
        "timezone": "Asia/Bangkok",
        "country": "Paraguay",
        "block_duration": 60,
        "lunch_break_start": "16:00:00",
        "lunch_break_end": "17:00:00"
    },
    {
        "id": 2,
        "user_id": 3,
        "lastname": "Block",
        "specialty": "Psychiatry",
        "timezone": "America/Porto_Velho",
        "country": "United Kingdom",
        "block_duration": 60,
        "lunch_break_start": "16:00:00",
        "lunch_break_end": "17:00:00"
    },
    {
        "id": 3,
        "user_id": 4,
        "lastname": "Johnson",
        "specialty": "Dermatology",
        "timezone": "America/Panama",
        "country": "Bouvet Island (Bouvetoya)",
        "block_duration": 60,
        "lunch_break_start": "16:00:00",
        "lunch_break_end": "17:00:00"
    }
]
```

GET: http://localhost:8000/api/employees/check-availability?date_time=09:00:00 2024-11-01


retorna:

```json
{
    "message": "Schedule email sent successfully"
}
```
