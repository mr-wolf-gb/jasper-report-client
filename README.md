# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gaiththewolf/jasper-report-client.svg?style=flat-square)](https://packagist.org/packages/gaiththewolf/jasper-report-client)
[![Total Downloads](https://img.shields.io/packagist/dt/gaiththewolf/jasper-report-client.svg?style=flat-square)](https://packagist.org/packages/gaiththewolf/jasper-report-client)

This is a Laravel package integrating the Jasper Server REST v2 client (Jaspersoft/rest-client).

Inspired from [JasperReportBundle](https://github.com/nckenn/JasperReportBundle)

## Requirements

To use this package, you will need:
- JasperReports Server (version >= 5.2)
- PHP (version >= 5.3, with cURL extension)

## Installation

You can install the package via composer:

```bash
composer require gaiththewolf/jasper-report-client
```

The package will automatically register itself.

You can publish the config with:
```
php artisan vendor:publish --provider="Gaiththewolf\JasperReportClient\JasperReportClientServiceProvider" --tag="config"
```

## Config for .env file

```
JRS_BASE_URL="http://127.0.0.1:8080/jasperserver"
JRS_USERNAME="jasperadmin"
JRS_PASSWORD="jasperadmin"
JRS_ORG_ID=null
```

## Usage

### Generating report

```php
use JSRClient;

class TestController extends Controller {

    public function generate_report() {
        $format = "html";
        $reportUnit = "/reports/my_report_liste";
        $params = array(
            "inputControl1" => "value 1",
            "inputControl2" => "value 2",
            "inputControl3" => "value 3",
        );
        $res = JSRClient::generate($reportUnit, $params, $format);
        return $res;
    }
}
```

### Supported Format
```
- html
- xml
- pdf
- xlsx
- xls
- rtf
- csv
- odt
- docx
- ods
- pptx
```

### Get report input Controls

```php
use JSRClient;

class TestController extends Controller {

    public function get_inputControls_report() {
        $reportUnit = "/reports/my_report_liste";
        $res = JSRClient::getReportInputControls($reportUnit);
        dd($res);
    }
}
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email gaiththewolf@gmail.com instead of using the issue tracker.

## Credits

-   [GAITHTHEWOLF](https://github.com/gaiththewolf)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
