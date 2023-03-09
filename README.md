
# SyndiqDiali

- Laravel 9
- Livewire 2
- Bootstrap 4

SyndiqDiali is an application which role is to manage real estate properties syndicates.
The main idea behind a syndicate in real estate properties is to have a small organisation
of people who are living in that property and their main goal is to manage the shared
space in the property, like cleaning up the stairs, fixing broken things like lamps, elevator
and so on.

For that reason residents have to pay an amount of money yearly to have a fund that will
let them manage these things.

A syndicate should have a president and a vide president and both of them should be
residents of the property.



## Requirements

- PHP ^8.0 

## Installation


Install Composer:
```bash
composer install
```

Install Nodejs:
```bash
npm install
```

Run Laravel Mix:
```bash
npm run dev
```


## Setting
 find ".env.example" file in project's root then rename that to ".env". open it and Set following settings:

 Database Information:
 ```bash
DB_DATABASE=syndiqdiali
DB_USERNAME=root
DB_PASSWORD=
```

Email Config:

```bash
MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```
Note: You Can Use https://mailtrap.io/ to Create Fake Config For Testing


After setting Database information You Can import "syndiqdiali.sql" in downloaded folder Or Run:
```bash
 php artisan migrate:fresh --seed
```

## Run
```bash
php artisan key:generate
```

```bash
 php artisan serve
```

Username: admin@gmail.com
Password: admin
