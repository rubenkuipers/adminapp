# Laravel-Angular Adminapp
Admin App boilerplate with a laravel api and angular front-end based on bootstrap. With this starter app you can manage your clients and projects, manage your project hours and digitally generate your invoices.

![screenshot](https://github.com/kuiperr005/adminapp/blob/master/public/img/screenshot.png ""adminapp"")

- **Author:** Ruben Kuipers
- **Author website:** [http://rkmediadesign.nl](http://rkmediadesign.nl/)
- **Version:** 1.0.1

## Motivation

This project was build in favor of a learing experiment in combining laravel with angular. This project is not completely production-ready, but it can be a good starting point for anyone who wants to learn how to communicate a laravel api with angular.

## Resources

- [angular.js](http://angularjs.org)
- [laravel](http://laravel.com)
- [angular ui bootstrap](https://angular-ui.github.io/bootstrap/)
- [angular toggle switch](https://github.com/cgarvis/angular-toggle-switch)

## Installation

1. Clone the repo: `git clone https://github.com/kuiperr005/adminapp`
2. change directory: `cd adminapp/`
3. Install Laravel: `composer install --prefer-dist`
4. Change your database settings in `app/config/database.php`
5. Migrate your database: `php artisan migrate`
6. Seed your database: `php artisan db:seed`
7. View your application in your browser.

## API Reference

The REST api is accessible via `http://adminapp/api/{{resource}}`, for example, to get all of your clients you run `http://adminapp/api/clients`. To get a single client, you run `http://adminapp/api/client{{id}}`.

## Contributors

Contributions are welcome via Pull Requests on Github.

## License

Please see the [license file](https://github.com/kuiperr005/adminapp/blob/master/LICENSE.md)

