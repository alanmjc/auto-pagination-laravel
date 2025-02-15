# My Packagist Package

Este paquete proporciona un middleware y un proveedor de servicios para manejar la paginación en las solicitudes de API en aplicaciones Laravel.

## Estructura del Proyecto

```
my-packagist-package
├── src
│   ├── Http
│   │   └── Middleware
│   │       └── PaginateMiddleware.php
│   ├── Providers
│   │   └── PaginationProvider.php
├── tests
│   └── Feature
│       └── PaginateApiTest.php
├── bootstrap
│   └── providers.php
├── composer.json
└── README.md
```

## Instalación

Para instalar este paquete, puedes usar Composer. Ejecuta el siguiente comando en tu terminal:

```
composer require tu-usuario/my-packagist-package
```

## Uso

1. **Registrar el Proveedor de Servicios**: Asegúrate de que el `PaginationProvider` esté registrado en tu archivo `bootstrap/providers.php`:

   ```php
   return [
       App\Providers\AppServiceProvider::class,
       App\Providers\PaginationProvider::class,
   ];
   ```

2. **Aplicar el Middleware**: Puedes aplicar el `PaginateMiddleware` a tus rutas en el archivo de rutas de tu aplicación:

   ```php
   Route::middleware([App\Http\Middleware\PaginateMiddleware::class])->group(function () {
       Route::get('/api/impresoras', [ImpresoraController::class, 'index']);
   });
   ```

## Pruebas

Este paquete incluye pruebas para verificar el comportamiento de la paginación. Puedes ejecutar las pruebas utilizando PHPUnit:

```
vendor/bin/phpunit
```

## Contribuciones

Las contribuciones son bienvenidas. Si deseas contribuir a este paquete, por favor abre un issue o un pull request en el repositorio.

## Licencia

Este proyecto está licenciado bajo la [Licencia MIT](LICENSE).