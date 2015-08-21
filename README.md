Movies In the Park
=======

This is an example all ready to be made responsive using twitter bootstrap. To get this far:

`wget -r www.parkmovies.ca`
------

You will likely need to get wget. For windows [it is here.](https://code.google.com/p/mingw-and-ndk/downloads/detail?name=wget-1.13.4-static-mingw.7z). You will need to copy it into your path. The most likely place is the location of your `Git Bash.vbs` in the `bin` subfolder.

On OSX you can [find wget here](http://rudix.org/packages/wget.html).

Once you have wget, you will open a new folder in brackets, click on the shell icon and in the resulting shell type:

`wget -r www.parkmovies.ca`

This will result in a subfolder www.parkmovies.ca. You can rename this to www in brackets and in your shell change in to this directory.

`php -S localhost:8000`
-----

Now if you surf to http://localhost:8000 you should see the complete site.

`composer init`
----------

Before making the site responsive we will gather all of the common files into a shared _layout.phtml file. The layout will be shared with `rhildred/slimphpviews` and the `slim/slim` microframework. `composer init` will prompt you for these dependencies. This is what I typed:

![composer init](https://res.cloudinary.com/salesucation-com-inc/image/upload/v1440180520/composerinit_oyigov.png "composer init")

I pressed enter and typed `no` to get back to a prompt. At the prompt type `composer update` to actually retrieve the dependencies.

Creating and using the shared layout
---

Start by saving the index.html file as _layout.phtml. Don't rename it as you still need index.html. index.html is a table layout. The second last row in the table is unique to the index.html file. In the _layout.html file replace the second last row with:

```
<?php
    $this->renderBody();
?>
```

In the index.html file replace everything before the second last row with:

```
<?php $this->layout("_layout.phtml") ?>
```

Delete everything after the second last row, save the file and rename it as index.phtml.

Rendering the individual views
------

To render the different "pages" we will be using a model view controller pattern. In our case, we don't really have a model as yet. We will create our controller in the www folder as `index.php`

```
<?php
    require '../vendor/autoload.php';
// make a new slim object with view Engine PHPView
    $app = new \Slim\Slim(array(
        'view' => new \PHPView\PHPView(),
        'templates.path' => __DIR__ ));
    $app->get('/', $index = function () use($app) {
        $app->render("index.phtml", array("page" => "index"));
    });
    $app->get('/movie', $index = function () use($app) {
        $app->render("movie.phtml", array("page" => "movie"));
    });
    $app->get('/directions', $index = function () use($app) {
        $app->render("directions.phtml", array("page" => "directions"));
    });
    $app->get('/pics', $index = function () use($app) {
        $app->render("pics.phtml", array("page" => "pics"));
    });
    $app->run();
```
We need to route all requests to our controller, which we will do with an apache `.htaccess` file (also supported by php -S).

```
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^([^?]*)$ /index.php?path=$1 [NC,L,QSA]
```

Now you will need to go through the rest of the .html files, renaming them to .phtml files and fixing the anchor href attributes to match our controller. When you are finished, there should be almost no repetition in the .phtml files. You should be able to make the site responsive by editing only the _layout.phtml file.