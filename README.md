# Laravel starter

This is a blank [Laravel](https://laravel.com) project that will connect to any prismic.io repository. It uses the prismic.io PHP development kit, and provides a few helpers to integrate with a Laravel website.

## Getting started

### Launch the starter project

*(Assuming you've [installed Laravel](https://laravel.com/docs/5.5/installation))*

Fork this repository, then clone your fork, and run this in your newly created directory:

``` bash
composer install
```

Next you need to make a copy of the `.env.example` file and rename it to `.env` inside your project root.

Run the following command to generate your app key:

```
php artisan key:generate
```

Then start your server:

```
php artisan serve
```

Your Laravel starter project is now up and running! 

### Configure the starter project

Edit the `config/prismic.php` prismic configuration file to get the application connected to the correct repository:

```
'url' => 'https://your-repo-name.prismic.io/api/v2',
```

You may have to restart your server.

### Create your routes and pages

When the project is first launched and viewed, it will by default display a help page. Here you will find some documentation to help you get started with your Laravel project.

It includes an example that shows how to create a route and query a document of the custom type "page". It then shows how to integrate the content into the Laravel templates. 

Check it out to get a better understanding of how you would create your own routes and templates for your project. You can also explore our documentation to learn more about how to [query the API](https://prismic.io/docs/php/query-the-api/how-to-query-the-api) and how to integrate content fields like [Rich Text](https://prismic.io/docs/php/templating/rich-text), [Images](https://prismic.io/docs/php/templating/image), and more.

## Deploying your Laravel application

Once you've created your website, an easy way to deploy your Laravel application is to use [Heroku](http://www.heroku.com). Just follow these few simple steps once you have successfully [signed up](https://id.heroku.com/signup/www-header) and [installed the Heroku toolbelt](https://toolbelt.heroku.com/):

Create a new Heroku application

```
$ heroku create
```

Initialize a new Git repository:

```
$ git init
$ heroku git:remote -a your-heroku-app-name
```

Commit your code to the Git repository if you haven't already:

```
$ git add .
$ git commit -am "make it better"
```

Set a Laravel encryption key:

```
$ heroku config:set APP_KEY=$(php artisan --no-ansi key:generate --show)
```

Push to Heroku:

```
$ git push heroku master
```

You can now browse your application online:

```
$ heroku open
```

You can read more about launching your project with Heroku here in their [Laravel & Heroku guide](https://devcenter.heroku.com/articles/getting-started-with-laravel).

## Learn more about prismic.io

If you are looking for more resources to learn more about prismic.io, you can find out [how to get started with prismic.io](https://prismic.io/quickstart#?lang=php) and learn more by exploring [our full documentation](https://prismic.io/docs/php/getting-started/with-the-php-starter-kit).

### Understand the PHP development kit

You'll find more information about how to use the development kit included in this starter project, by reading its README file and exploring its project files on GitHub [prismic/php-kit](https://github.com/prismicio/php-kit).

## Licence

This software is licensed under the Apache 2 license, quoted below.

Copyright 2018 Prismic.io (https://prismic.io).

Licensed under the Apache License, Version 2.0 (the "License"); you may not use this project except in compliance with the License. You may obtain a copy of the License at http://www.apache.org/licenses/LICENSE-2.0.

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
