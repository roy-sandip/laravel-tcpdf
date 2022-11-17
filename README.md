
# Laravel TCPDF

TCPDF support for laravel app. This package allows to use TCPDF with Laravel as native TCPDF.

# Usages
You can use just like TCPDF native. Check its official documentation for all the reatures.

```php
use RoySandip\LaravelTcpdf\PDF;

$pdf = new PDF;
$pdf->writeHTML('Hello World!', true, false, true, false, '');
$pdf->Output('example.pdf', 'D');
```

For working conveniently, there are some features like-

```php
 $pdf->view('admin.pdf.booking-receipt', ['dataModel' => $model])
      ->download('file_name'); //file name can be set optionally
 ```               

Publish Configuration
```console
php artisan vendor:publish --tag=tcpdf-config
```
TCPDF default configuration can be edited at config/tcpdf.php

Publish Fonts
```console
php artisan vendor:publish --tag=tcpdf-fonts
```




# Documentation
Check TCPDF official Documentation. 


