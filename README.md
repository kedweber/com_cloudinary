cloudinary
==========

Re-usable [Cloudinary](http://cloudinary.com/) component for Nooku Server.

## Requirements
* Nooku Server 12.1
* PHP 5.3

## API

**Example: Upload and resize**                  

<pre>
@service('com://admin/cloudinary.controller.image')
	->path(*path*)
	->width(125)
	->height(125)
	->cache(0)
	->read();
</pre>

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

Check out the [Cloudinary API](https://cloudinary.com/documentation/image_transformations) for more information about the options for the state's that you can use.