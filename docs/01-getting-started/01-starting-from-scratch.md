# Getting started

Prismic makes it easy to get started on a new Laravel project by providing a specific Laravel starter project.

## Create a content repository

A content repository is where you can define, edit, and publish your website content.

[**Create a new repository**](https://prismic.io/dashboard/new-repository/)

## Download the Laravel Starter

The starter kit allows you to query and retrieve content from your Prismic content repository and integrate it into your website templates. It's the easiest way to get started with a new project.

[**Download the Starter**](https://github.com/prismicio/php-laravel-starter/archive/master.zip)

Unzip the downloaded project files into the desired location for your new project.

## Configure your project

Replace the repository URL in your Prismic configuration file (located at config/prismic.php) with your repository’s API endpoint:

```
// In config/prismic.php
'url' => 'https://your-repo-name.cdn.prismic.io/api/v2',
```

Fire up a terminal (command prompt or similar on Windows), point it to your project location and run the following commands!

> Note that you will need to make sure to first have [Composer](https://getcomposer.org/) installed before running this command. Check out the [Composer Getting Started](https://getcomposer.org/doc/00-intro.md) page for installation instructions. You may also need to update the version of PHP on your computer to get the project working correctly.

First you'll need to install the dependencies for the project. Run the following command:

```bash
composer install
```

Next you need to make a copy of the .env.example file and rename it to .env inside your Laravel project root:

```bash
cp .env.example .env
```

Then run the following command to generate your app key:

```bash
php artisan key:generate
```

Now you can launch your local server:

```bash
php artisan serve
```

You can now open your browser to [http://localhost:8000](http://localhost:8000), where you will find a tutorial page. This page contains information helpful to getting started. You will learn how to query the API and start building pages for your new site.

> **Pagination of API Results**
>
> When querying a Prismic repository, your results will be paginated. By default, there are 20 documents per page in the results. You can read more about how to manipulate the pagination in the [Pagination for Results](../02-query-the-api/18-pagination-for-results.md) page.

## And your Prismic journey begins!

Now you're all set to start building your new website with the Prismic content management system. Here are the next steps you need to take.

### Define your Custom Types

First you will need to model your pages, blog posts, articles, etc. into different Custom Types. Refer to our documentation to learn more about [constructing your Custom Types](https://user-guides.prismic.io/content-modeling-and-custom-types/structure-your-content/introduction-to-custom-type-building) using our easy drag and drop builder.

### Query your documents

After you have created and published some documents in your content repository, you will be able to query your API and retrieve the content. We provide explanations and plenty of examples of queries in the documentation. Start by learning more on the [How to Query the API](../02-query-the-api/01-how-to-query-the-api.md) page.

### Integrate content into your templates

The final step will be to integrate your content into the website templates. Check out the [templating documentation](../03-templating/01-the-response-object.md) to learn how to integrate each content field type.
