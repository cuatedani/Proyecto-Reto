# Reto Técnico – Desarrollo Web

## Objetivo

Construir un sistema web desde cero que permita:
1. **Iniciar sesión** con credenciales (usuario/contraseña)
2. **Administrar usuarios** mediante un CRUD completo (Crear, Leer, Actualizar, Eliminar)
3. **Manejar roles de acceso** (Administrador / Usuario)

---

## Explicación de Decisiones Técnicas

### 1. Laravel
**Por qué**: Me decidi por utilizar Laravel ya que es el framework que se solicita en la vacante, ademas de que tiene seguridad y herramientas para aguilizar el desarrollo.

### 2. Tailwind CSS
**Por qué**: Es el framework de estilos que eh estado utilizando mas recientemente, sus estilos me parecen modernos.

### 3. Alpine.js para Interactividad
**Por qué**: Es una manera muy sencilla de implementar js en archivos blade, para funciones simples.

### 4. Auth para Autenticación
**Por qué**: Decidi usar Auth por que es la opcion mas segura para un sistema de inicio de sesion sencillo, auth se encarga de manejar token y sesiones.

### 5. Middleware para Control de Acceso
**Por qué**: Con el middleware de auth se evalua la autenticacion de los usuarios del sistema y con el middleware IsAdmin se evalua la autorización de los usuarios.

### 6. Base de datos MYSQL
**Por qué**: Con las migraciones de laravel se le puede restar importancia a la seleccion de una base de datos en especifico por lo cual utilice mi instancia de mysql por defecto.

---

## Arquitectura y Tecnologías

### Backend
- **Framework**: Laravel 12
- **Autenticación**: Laravel Auth
- **Base de datos**: MySQL
- **Lenguaje**: PHP 8.2+

### Frontend
- **Framework CSS**: Tailwind CSS
- **JavaScript**: Alpine.js
- **Build Tool**: Vite

### Características Principales
- Sistema de autenticación con sesiones
- CRUD completo de usuarios con validaciones
- Control de roles (Admin/Usuario)
- Interfaz responsive con Tailwind CSS
- Validaciones frontend y backend
- Middleware de autorización
- Panel de administración

---

## Instrucciones de Despliegue

### Requerimientos del Sistema

Asegúrate de tener instalado:
- **PHP** >= 8.2
- **Composer** >= 2.x
- **Node.js** >= 22.x
- **npm** >= 10.x
- **MySQL** >= 8.x
- **Git**

### Instalación Paso a Paso

#### 1. Clonar el Repositorio
```bash
git https://github.com/cuatedani/Proyecto-Reto.git
cd proyecto-reto
```

#### 2. Instalar Dependencias de PHP
```bash
composer install
```

#### 3. Instalar Dependencias de Node.js
```bash
npm install
```

#### 4. Configurar Variables de Entorno
```bash
# Copiar el archivo de ejemplo
cp .env.example .env

# Generar la clave de aplicación
php artisan key:generate
```

#### 5. Configurar la Base de Datos

Edita el archivo `.env` con tus credenciales de MySQL:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_reto
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

#### 6. Crear la Base de Datos

**Opción A: Importar el archivo SQL (Recomendado)**
```bash
# Crear la base de datos
mysql -u root -p -e "CREATE DATABASE nombre_de_tu_base_de_datos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Importar el archivo SQL
mysql -u root -p nombre_de_tu_base_de_datos < database/db_reto.sql
```

**Opción B: Usar Migraciones de Laravel**
```bash
# Ejecutar migraciones
php artisan migrate
```

#### 7. Compilar Assets
```bash
# Desarrollo
npm run dev

# Producción
npm run build
```

#### 8. Iniciar el Servidor
```bash
# Servidor de desarrollo
php artisan serve
```

La aplicación estará disponible en: **http://localhost:8000**

---

## Credenciales de Acceso

### Cuenta Administrador
- **Email**: `yoevaluo@gmail.com`
- **Contraseña**: `12345678`
- **Rol**: Administrador
- **Permisos**: Acceso completo al sistema, gestión de usuarios

### Cuenta Usuario
- **Email**: `tuspiderman@gmail.com`
- **Contraseña**: `12345678`
- **Rol**: Usuario
- **Permisos**: Solo puede ver y editar su propio perfil

---

## Problemas Comunes

### Error: "Error: could not find driver SQLSTATE[HY000] [2002] No such file or directory"

# INCORRECTO - Extensión deshabilitada (comentada)
```bash
;extension=pdo_mysql
;extension=mbstring
;extension=fileinfo
```

# CORRECTO - Extensión habilitada
```bash
extension=pdo_mysql
extension=mbstring
extension=fileinfo
```

### Error: "No application encryption key has been specified"
```bash
php artisan key:generate
```

### Error: "SQLSTATE[HY000] [1045] Access denied"
Verifica las credenciales en el archivo `.env`

### Error: "Vite manifest not found"
```bash
npm install
npm run build
```

### Error: "Class 'Tymon\JWTAuth\...' not found"
```bash
composer require tymon/jwt-auth
php artisan jwt:secret
```

### Los estilos no se aplican
```bash
npm run dev
# o
npm run build
```

### Los estilos no se aplican
```bash
npm run dev
# o
npm run build
```

---

**Desarrollado para postulacion de Logística Empresarial Megamente**
