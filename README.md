# Auto Pagination Laravel

Este paquete proporciona un **middleware** y un **proveedor de servicios** para manejar la paginación en las solicitudes de API dentro de aplicaciones Laravel.

---

## Instalación

Ejecuta el siguiente comando en tu terminal:

```sh
composer require alanmjc/auto-pagination-laravel
```

---

## 🔧 Uso

### 1️⃣ Registrar el Proveedor de Servicios

Asegúrate de que `PaginationProvider` esté registrado en el archivo **`bootstrap/providers.php`**:

```php
return [
    // ...
    AutoPaginationLaravel\Providers\PaginationProvider::class,
];
```

---

### 2️⃣ Aplicar el Middleware

#### ✅ En las rutas:

Aplica `PaginateMiddleware` en el archivo de rutas:

```php
use AutoPaginationLaravel\Http\Middleware\PaginateMiddleware;

// ...

Route::middleware([PaginateMiddleware::class])->group(function () {
    Route::get('/test', [ExampleController::class, 'index']);
});
```

#### ✅ En un controlador específico:

También puedes aplicarlo junto con otros middlewares, como la autenticación:

```php
use AutoPaginationLaravel\Http\Middleware\PaginateMiddleware;

Route::group(['middleware' => ['auth:sanctum', PaginateMiddleware::class]], function () {
    Route::get('/test', [ExampleController::class, 'index']);
});
```

---

## 🤝 Contribuciones

¡Las contribuciones son bienvenidas! 🎉  
Si deseas colaborar con este paquete, abre un **issue** o un **pull request** en el repositorio.

---

## 📜 Licencia

Este proyecto está bajo la **[Licencia MIT](LICENSE)**.
