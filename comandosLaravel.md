# 📖 Guía Completa de Comandos Artisan para Laravel

Esta documentación detalla los comandos Artisan más utilizados y recomendados para este proyecto, organizados por categoría para facilitar su consulta y aplicación rápida.

---

## 📑 Tabla de Contenidos

1. [⚙️ Entorno y Servidor Local](#1-entorno-y-servidor-local)
2. [📦 Creación de Componentes Individuales (`make:`)](#2-creación-de-componentes-individuales-make)
   - [Modelos](#modelos)
   - [Migraciones](#migraciones)
   - [Controladores](#controladores)
   - [Form Requests (Validaciones)](#form-requests-validaciones)
   - [Vistas y Componentes](#vistas-y-componentes)
   - [Seeders y Factories (Poblado de Datos)](#seeders-y-factories-poblado-de-datos)
   - [Middlewares](#middlewares)
   - [Policies y Rules](#policies-y-rules)
3. [🗄️ Base de Datos y Migraciones](#3-base-de-datos-y-migraciones)
4. [🌐 Gestión de Rutas](#4-gestión-de-rutas)
5. [🧹 Caché y Optimización](#5-caché-y-optimización)
6. [🚀 Guía Paso a Paso: Cómo Crear un Módulo Completo](#6-guía-paso-a-paso-cómo-crear-un-módulo-completo)
7. [📑 Chuleta Rápida de Banderas (Flags)](#7-chuleta-rápida-de-banderas-flags)

---

## 1. ⚙️ Entorno y Servidor Local

| Comando | Descripción |
| :--- | :--- |
| `php artisan serve` | Inicia el servidor de desarrollo local en `http://127.0.0.1:8000`. |
| `composer run dev` | Inicia el entorno de desarrollo completo (servidor + Vite/Livewire). |
| `php artisan tinker` | Abre una consola interactiva para interactuar con la BD, modelos y código PHP. |
| `php artisan list` | Lista todos los comandos disponibles en el proyecto. |
| `php artisan help <comando>` | Muestra la ayuda y opciones de un comando específico (ej: `php artisan help make:model`). |
| `php artisan key:generate` | Genera o regenera la clave de aplicación `APP_KEY` en `.env`. |
| `php artisan storage:link` | Crea el enlace simbólico de `public/storage` a `storage/app/public` para archivos subidos. |

---

## 2. 📦 Creación de Componentes Individuales (`make:`)

### Modelos
Crea modelos Eloquent dentro de `app/Models/`.

```bash
# Modelo simple
php artisan make:model Laptop

# Modelo con migración (-m)
php artisan make:model Laptop -m

# Modelo con migración, controlador resource y factory
php artisan make:model Laptop -mcrf

# Modelo completo (Migración, Factory, Seeder, Controlador, Requests, Policy)
php artisan make:model Laptop -a --requests
```

---

### Migraciones
Crea archivos de migración en `database/migrations/`.

```bash
# Migración para CREAR una nueva tabla (sigue la convención create_nombre_table)
php artisan make:migration create_laptops_table

# Migración para MODIFICAR una tabla existente (agrega columnas, llaves foráneas, etc.)
php artisan make:migration add_status_to_laptops_table --table=laptops
```

---

### Controladores
Crea controladores en `app/Http/Controllers/`.

```bash
# Controlador básico vacío
php artisan make:controller LaptopController

# Controlador con métodos CRUD predefinidos (Resource: index, create, store, show, edit, update, destroy)
php artisan make:controller LaptopController --resource

# Controlador Resource vinculado directamente a un Modelo (Inyección de dependencias)
php artisan make:controller LaptopController --resource --model=Laptop

# Controlador con Form Requests generados automáticamente
php artisan make:controller LaptopController --resource --model=Laptop --requests

# Controlador para API (CRUD sin vistas create ni edit)
php artisan make:controller Api/LaptopController --api

# Controlador de acción única (Invokable)
php artisan make:controller ReportePrestamoController --invokable
```

---

### Form Requests (Validaciones)
Separa la lógica de validación del controlador en `app/Http/Requests/`.

```bash
# Request para creación / guardado
php artisan make:request StoreLaptopRequest

# Request para actualización / edición
php artisan make:request UpdateLaptopRequest
```

---

### Vistas y Componentes

```bash
# Crear un archivo de vista Blade (crea resources/views/laptops/index.blade.php)
php artisan make:view laptops.index

# Crear un componente Blade (clase en app/View/Components y vista en resources/views/components)
php artisan make:component Modal

# Crear un componente anónimo Blade (solo vista en resources/views/components)
php artisan make:component modal --view

# Crear un componente Livewire (crea clase PHP y vista Blade)
php artisan make:livewire LaptopTable
# o alternativamente:
php artisan livewire:make LaptopTable
```

---

### Seeders y Factories (Poblado de Datos)

```bash
# Crear un Factory para generar datos falsos de prueba con Faker (database/factories/)
php artisan make:factory LaptopFactory --model=Laptop

# Crear un Seeder para insertar datos en la BD (database/seeders/)
php artisan make:seeder LaptopSeeder
```

---

### Middlewares
Crea filtros de peticiones HTTP en `app/Http/Middleware/`.

```bash
# Crear un middleware
php artisan make:middleware CheckUserRole
```

---

### Policies y Rules

```bash
# Crear una Política de autorización vinculada a un Modelo (app/Policies/)
php artisan make:policy LaptopPolicy --model=Laptop

# Crear una Regla de validación personalizada (app/Rules/)
php artisan make:rule ValidarSerialLaptop
```

---

## 3. 🗄️ Base de Datos y Migraciones

| Comando | Descripción |
| :--- | :--- |
| `php artisan migrate` | Ejecuta las migraciones pendientes. |
| `php artisan migrate:status` | Muestra el estado de cada migración (si fue ejecutada o está pendiente). |
| `php artisan migrate:rollback` | Revierte el último lote de migraciones ejecutadas. |
| `php artisan migrate:rollback --step=1` | Revierte exactamente la última migración. |
| `php artisan migrate:reset` | Revierte **todas** las migraciones de la base de datos. |
| `php artisan migrate:refresh` | Revierte todas las migraciones y las vuelve a ejecutar. |
| `php artisan migrate:refresh --seed` | Revierte, ejecuta migraciones y vuelve a poblar la BD con seeders. |
| `php artisan migrate:fresh` | **Elimina todas las tablas** y ejecuta las migraciones desde cero. *(¡Usar con cuidado en desarrollo!)* |
| `php artisan migrate:fresh --seed` | Borra todo, migra desde cero y ejecuta los seeders (ideal para reiniciar la BD). |
| `php artisan db:seed` | Ejecuta el seeder principal (`DatabaseSeeder`). |
| `php artisan db:seed --class=LaptopSeeder` | Ejecuta un Seeder específico. |

---

## 4. 🌐 Gestión de Rutas

```bash
# Ver todas las rutas registradas en la aplicación
php artisan route:list

# Filtrar rutas por nombre o URI
php artisan route:list --path=laptops
php artisan route:list --name=laptops

# Ocultar rutas de paquetes de terceros
php artisan route:list --except-vendor

# Cachear rutas (Optimización para producción)
php artisan route:cache

# Limpiar la caché de rutas
php artisan route:clear
```

### ¿Cómo registrar rutas en `routes/web.php`?

```php
use App\Http\Controllers\LaptopController;
use Illuminate\Support\Facades\Route;

// Ruta individual
Route::get('/laptops', [LaptopController::class, 'index'])->name('laptops.index');

// Rutas CRUD completas automáticas (7 rutas estándar)
Route::resource('laptops', LaptopController::class);

// Rutas protegidas con autenticación
Route::middleware(['auth'])->group(function () {
    Route::resource('laptops', LaptopController::class);
});
```

---

## 5. 🧹 Caché y Optimización

Cuando hagas cambios en configuraciones (`.env`), rutas o eventos que no se reflejen, ejecuta estos comandos:

```bash
# LIMPIEZA TOTAL (Limpia caché de configuración, rutas, vistas y eventos)
php artisan optimize:clear

# O individualmente:
php artisan config:clear    # Limpia caché de configuración (.env)
php artisan route:clear     # Limpia caché de rutas
php artisan view:clear      # Limpia vistas Blade compiladas
php artisan cache:clear     # Limpia el cache general de la app

# MODO PRODUCCIÓN (Genera cachés de alto rendimiento)
php artisan optimize        # Cachea configuración, rutas y vistas a la vez
php artisan config:cache
php artisan route:cache
php artisan view:cache

# MODO MANTENIMIENTO
php artisan down            # Pone la aplicación en modo mantenimiento
php artisan up              # Vuelve a activar la aplicación
```

---

## 6. 🚀 Guía Paso a Paso: Cómo Crear un Módulo Completo

A continuación se muestra cómo construir un módulo desde cero utilizando como ejemplo un módulo de **`Laptop`** (Portátiles).

---

### Opción A: Modo Rápido (Comando Todo en Uno) ⚡

Ejecuta el siguiente comando para generar el modelo junto con su migración, controlador tipo resource, form requests, seeder, factory y policy:

```bash
php artisan make:model Laptop -a --requests
```

Esto generará automáticamente:
1. `app/Models/Laptop.php` (Modelo)
2. `database/migrations/xxxx_xx_xx_xxxxxx_create_laptops_table.php` (Migración)
3. `database/factories/LaptopFactory.php` (Factory)
4. `database/seeders/LaptopSeeder.php` (Seeder)
5. `app/Http/Requests/StoreLaptopRequest.php` (Validación Crear)
6. `app/Http/Requests/UpdateLaptopRequest.php` (Validación Editar)
7. `app/Http/Controllers/LaptopController.php` (Controlador Resource)
8. `app/Policies/LaptopPolicy.php` (Políticas de acceso)

---

### Opción B: Paso a Paso Estructurado y Modular 🛠️

Si prefieres tener control absoluto paso por paso:

#### Paso 1: Crear Modelo y Migración
```bash
php artisan make:model Laptop -m
```

#### Paso 2: Definir la estructura en la Migración
Abre el archivo generado en `database/migrations/xxxx_create_laptops_table.php` y define las columnas:

```php
public function up(): void
{
    Schema::create('laptops', function (Blueprint $table) {
        $table->id();
        $table->string('serial')->unique();
        $table->string('marca');
        $table->string('modelo');
        $table->enum('estado', ['disponible', 'prestado', 'mantenimiento'])->default('disponible');
        $table->text('observaciones')->nullable();
        $table->timestamps();
    });
}
```

Aplica la migración a la base de datos:
```bash
php artisan migrate
```

#### Paso 3: Configurar el Modelo
Edita `app/Models/Laptop.php` para habilitar la asignación masiva (`$fillable`):

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial',
        'marca',
        'modelo',
        'estado',
        'observaciones',
    ];
}
```

#### Paso 4: Crear los Form Requests (Validaciones)
```bash
php artisan make:request StoreLaptopRequest
php artisan make:request UpdateLaptopRequest
```

En `app/Http/Requests/StoreLaptopRequest.php`:
```php
public function authorize(): bool
{
    return true; // Cambiar a true si el usuario tiene permiso
}

public function rules(): array
{
    return [
        'serial' => 'required|string|unique:laptops,serial',
        'marca' => 'required|string|max:100',
        'modelo' => 'required|string|max:100',
        'estado' => 'required|in:disponible,prestado,mantenimiento',
        'observaciones' => 'nullable|string',
    ];
}
```

#### Paso 5: Crear el Controlador Resource
```bash
php artisan make:controller LaptopController --resource --model=Laptop
```

Edita los métodos del controlador `app/Http/Controllers/LaptopController.php` conectando los Requests y las Vistas:

```php
namespace App\Http\Controllers;

use App\Models\Laptop;
use App\Http\Requests\StoreLaptopRequest;
use App\Http\Requests\UpdateLaptopRequest;
use Illuminate\Http\Request;

class LaptopController extends Controller
{
    public function index()
    {
        $laptops = Laptop::latest()->paginate(10);
        return view('laptops.index', compact('laptops'));
    }

    public function create()
    {
        return view('laptops.create');
    }

    public function store(StoreLaptopRequest $request)
    {
        Laptop::create($request->validated());
        return redirect()->route('laptops.index')->with('success', 'Portátil registrado correctamente.');
    }

    public function show(Laptop $laptop)
    {
        return view('laptops.show', compact('laptop'));
    }

    public function edit(Laptop $laptop)
    {
        return view('laptops.edit', compact('laptop'));
    }

    public function update(UpdateLaptopRequest $request, Laptop $laptop)
    {
        $laptop->update($request->validated());
        return redirect()->route('laptops.index')->with('success', 'Portátil actualizado correctamente.');
    }

    public function destroy(Laptop $laptop)
    {
        $laptop->delete();
        return redirect()->route('laptops.index')->with('success', 'Portátil eliminado correctamente.');
    }
}
```

#### Paso 6: Crear las Vistas Blade
Crea las vistas necesarias para el CRUD:

```bash
php artisan make:view laptops.index
php artisan make:view laptops.create
php artisan make:view laptops.edit
php artisan make:view laptops.show
```

*(O si utilizas componentes Livewire en lugar de vistas tradicionales Blade, puedes crearlos con `php artisan make:livewire Laptops/Index`)*.

#### Paso 7: Registrar las Rutas
Abre `routes/web.php` y añade el recurso:

```php
use App\Http\Controllers\LaptopController;

Route::middleware(['auth'])->group(function () {
    Route::resource('laptops', LaptopController::class);
});
```

#### Paso 8: Factory y Seeder para Datos de Prueba (Opcional pero Recomendado)
```bash
php artisan make:factory LaptopFactory --model=Laptop
php artisan make:seeder LaptopSeeder
```

En `database/factories/LaptopFactory.php`:
```php
public function definition(): array
{
    return [
        'serial' => fake()->unique()->bothify('LP-####-????'),
        'marca' => fake()->randomElement(['Dell', 'HP', 'Lenovo', 'Asus']),
        'modelo' => fake()->word(),
        'estado' => fake()->randomElement(['disponible', 'prestado', 'mantenimiento']),
        'observaciones' => fake()->sentence(),
    ];
}
```

En `database/seeders/LaptopSeeder.php`:
```php
public function run(): void
{
    \App\Models\Laptop::factory(20)->create();
}
```

Ejecuta el seeder:
```bash
php artisan db:seed --class=LaptopSeeder
```

#### Paso 9: Validar Rutas
Comprueba que todas las rutas del módulo se han registrado correctamente:
```bash
php artisan route:list --name=laptops
```

---

## 7. 📑 Chuleta Rápida de Banderas (Flags)

Al usar `php artisan make:model <Nombre>`, puedes combinar las siguientes banderas:

| Bandera | Significado | Qué genera |
| :--- | :--- | :--- |
| `-m` | `--migration` | Crea el archivo de migración de base de datos. |
| `-c` | `--controller` | Crea el controlador. |
| `-r` | `--resource` | Hace que el controlador incluya métodos CRUD. |
| `-f` | `--factory` | Crea el Factory para datos faker. |
| `-s` | `--seed` | Crea el Seeder para poblar la tabla. |
| `-p` | `--pivot` | Indica que es un modelo de tabla intermedia (Pivot). |
| `-R` | `--requests` | Crea las clases `FormRequest` (Store y Update). |
| `--policy` | `--policy` | Crea la clase Policy de autorización. |
| `-a` | `--all` | Genera **Migración, Factory, Seeder, Policy, Resource Controller y Form Requests**. |
