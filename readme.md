<p align="center">
<a href="https://www.balt.de"><img width="100" src="https://www.balt.de/images/balt.png" alt="BALT-TECHNOLOGIES"></a>
</p>
<p align="center">
<a href="https://github.com/balt-technologies/laravel-icon-captcha">LARAVEL - ICON - CAPTCHA</a>
</p>

## Laravel Icon Captcha

This is a simple but safe turing test for your laravel application.

- Simple, fast turing test
- Without collecting any data of the user
- Customizeable in color and size

You need a working Laravel 8 project to use this package without any errors.

## How to install Laravel-Icon-Captcha

- After installing the package you need to set it up

Use the following command to get started:

```
php artisan vendor:publish
```

Now you have all the files you need published in your resource path, and you're ready to start.

## How to use Laravel-Icon-Captcha

To use the graphical captcha, make sure to follow following steps:

Implement the app.js from the laravel-icon-captcha in your own app.js file. The easiest way is it to just require it.

In a usual Laravel-Folder Structure it should look like this.

```js
require('../assets/vendor/laravel-icon-captcha/js/app')
```

make sure you have Vue installed and that you require it in your app.js also dont forget to create a new Vue Instance.

Now you are ready to compile your files with laravel mix:

```
npm run dev
```

###Implement it in the frontend

- Make sure you have following div surrounding the form where you want to use the captcha:

```html
<div id="app"> Every other stuff </div>
```

- now you can just implement the vue component and the frontend part is done

```html
<laravel-icon-captcha></laravel-icon-captcha>
```

###Implement it in the backend

- To add the validation rule, you simply add following line to your request validation:

```php
'captcha' => ['required', new LaravelIconCaptchaRule];
```

That's it. You're ready to go.

You can simply customize your laravel-icon-captcha by editing the css file.
