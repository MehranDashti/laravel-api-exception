# Laravel / lumen api exceptions handler

a lightweight package for create and pass response for use in laravel || lumen


### Installation

```
$ composer require mehrand/api-exceptions
```

### lumen specific installation
if your project is lumen so you should copy `mehrand/api-exceptions/src/config/exceptions` to your `config` directory !
*NOTE* : If you don't have `config` directory so create it !

then add below code in your `bootstrap/app.php` :
```
  $app->configure(exceptions);
```

### laravel specific installation
```
$ php artisan vendor:publish --provider="mehrand/ApiExceptions/Providers/ApiExceptionServiceProvider"
```


## Usage

overwrite `render` method of `App\Exceptions\Handler` like this :
```
    use Mehrand\ApiExceptions\Handlers\ApiException;
  
    public function render($request, Throwable $exception)
    {
        return ApiException::handle($exception);
    }
```

## Authors

* **Mehran Dashti** - *Initial work* - [github](https://github.com/MehranDashti)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details