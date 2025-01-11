# Kiyomi, an RC club flight manager for T.R.M.C.

Where RC planes and code meet each other.

## Description

A Laravel based application to manage flights, members, send newsletters and many more!

## Features
* Register new flights
* Register as new club member
* Authentication system with password reset
* Show flights and search flights based of name
* Flight statistics (flights each month, top 10 pilots, flight per model)
* Generate flight reports
* Show members and filter by firstname, last name, phone or role
* Add new members
* Contact members (with filters for specific member types)
* Settings page

## Tech stack
* Laravel
* Livewire
* Nwidart Modules
* Bootstrap
* MariaDB
* Redis

## Screenshots
![img.png](img.png)

![img_1.png](img_1.png)

![img_2.png](img_2.png)

## Getting Started

### Installation
1) Clone this repo and put it in you're web directory.
2) Change the web directory path to `/public`.
3) Copy `.env.example` to `.env`.
4) Create an database (MySQL or MariaDB) and put the credentials inside `.env`.
5) Change the `APP_URL` in `.env` to your domain.
6) Put in the EMAIL credentials in `.env`.

### Commands to be run
1) Generate `APP_KEY`

```
php artisan key:generate
```
2) Run composer install

```
composer install
```

## Help

If encountering any problems:

1) Make sure that `APP_DEBUG` in `.env` is set to `true` so you can see the error
2) If that is still not working, feel free to create an issue here.

## Authors

ex. [@Kelvin de Reus](https://aerobytes.nl)

## License

This project is licensed under the GNU GENERAL PUBLIC LICENSE Version 3 License. <br> See the LICENSE.md file for details

## Security
If you encounter any security issues, please mail to development@aerobytes.nl.