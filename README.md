# ESTADO : COMPLETADO

# 📦 Ejercicio 1: Envío de email masivos

Envío en masa de un correo promocional a 1,000,000 usuarios sin afectar el rendimiento principal de la aplicación.

### 🕵 **Normativas**

- ⛔ prohibido paquetes externos
- ⛔ prohibido inteligencia artificial
- ⛔ prohibido github copilot
- ✅ permitido documentacion de laravel
- ✅ permitido google, stackoverflow

### 🛠 **Configuración Inicial:**

1. **Instalacion** ejercicio laravel:
```bash
composer require byancode/laravel-exercise-1
```
2. **Service Provider** ejecuta el comando:
```bash
php artisan vendor:publish --provider="Byancode\LaravelExercise1\ServiceProvider"
```
3. **Variables de Entorno:**
```properties
MAIL_FROM_ADDRESS="test@byancode.com"
MAIL_FROM_NAME="Byancode"
```

### 📋 **Informacion adicional:**

1. **Modelo `Notification`:** [reference](https://laravel.com/docs/10.x/eloquent-relationships#many-to-many-model-structure)
    - Crea un modelo llamado `Notification` con los siguientes atributos:
        - `id`
        - `title`
    - Establece una relación `belongsToMany` con el modelo `User`.

2. **Población de Datos (Seeders):** [reference](https://laravel.com/docs/10.x/seeding#writing-seeders)
    - Llena la tabla `users` con 1,000,000 registros de usuarios ficticios.
    - Agrega un registro en la tabla `notifications`, donde el contenido del atributo `title` sea: **'Nueva actualización del sistema'**.

3. **Comando Personalizado:** [reference](https://laravel.com/docs/10.x/artisan#generating-commands)
    - Crea un comando que pueda invocarse como: php artisan `users:send-newsletter`.

4. **Clase Mailable `NotificationShipped`:** [reference](https://laravel.com/docs/10.x/mail#generating-mailables)
    - Crea una clase mailable llamada `NotificationShipped`.
    - En el constructor, recibe el modelo `Notification` como parámetro.

5. **Programación del Comando:** [reference](https://laravel.com/docs/10.x/scheduling#scheduling-artisan-commands)
    - Programa el comando `users:send-newsletter` en el `Kernel` de la consola, para que se ejecute cada minuto.

### 📒 NOTA:
> El modelo `Notification` servira para registrar los usuarios que se les envio un email mediante la relacion `BelongsToMany`
