# com_cloudinary

[Cloudinary](http://cloudinary.com) is a cloud based image management service that acts as a CDN as well as an image manipulation
tool. `com_cloudinary` is a Joomla! package that handles image uploads, manipulation and even multiple accounts.

The system requirements are

* Nooku Server 12.X .
* PHP 5.3.6 or better

or

* Joomla 2.5 or 3.X
* Koowa 0.9 or 1.0 (as yet, Koowa 2 is not supported)
* PHP 5.3.10 or better

`com_cloudinary` was developed by [Moyo Web Architects](http://www.moyoweb.nl/).

## Installation

### Composer

Installation is done through composer. In your `composer.json` file, you should add the following lines to the repositories
section:

```json
{
    "name": "moyo/cloudinary",
    "type": "vcs",
    "url": "https://git.assembla.com/moyo-content.cloudinary.git"
}
```

The require section should contain the following line:

```json
    "moyo/cloudinary": "1.0.*",
```

Afterward, just run `composer update` from the root of your Joomla project.

### Github

Alternatively, clone `com_cloudinary` from our [public git repository](https://github.com/moyoweb/cloudinary).

### jsymlinker

A third option, currently only available for Moyo developers, is by using the jsymlink script from the [Moyo Git
Tools](https://github.com/derjoachim/moyo-git-tools).

## API

**Example: Upload and resize**

```php
@service('com://admin/cloudinary.controller.image')
    ->path(*path*)
    ->width(125)
    ->height(125)
    ->cache(0)
    ->read();
```

**Supported Cloudinary states**

<pre>
width
height
crop
gravity
radius
quality
angle
effect
border
background
overlay
underlay
page
density
fetch_format
</pre>


...and more.

Check out the [Cloudinary API](https://cloudinary.com/documentation/image_transformations) for more information about the
options for the states that you can use.