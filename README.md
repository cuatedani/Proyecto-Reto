# Reto Técnico – Desarrollo Web

## Objetivo

Construir un sistema web desde cero que permita:
1. **Iniciar sesión** con credenciales (usuario/contraseña)
2. **Administrar usuarios** mediante un CRUD completo (Crear, Leer, Actualizar, Eliminar)
3. **Manejar roles de acceso** (Administrador / Usuario)

---

## 🏗️ Arquitectura y Tecnologías

### Backend
- **Framework**: Laravel 11.x
- **Autenticación**: Laravel Sanctum + JWT (tymon/jwt-auth)
- **Base de datos**: MySQL 8.0+
- **Lenguaje**: PHP 8.2+

### Frontend
- **Framework CSS**: Tailwind CSS 3.x
- **JavaScript**: Alpine.js 3.x
- **Build Tool**: Vite

### Características Principales
- ✅ Sistema de autenticación con sesiones y tokens JWT
- ✅ CRUD completo de usuarios con validaciones
- ✅ Control de roles (Admin/Usuario)
- ✅ Interfaz responsive con Tailwind CSS
- ✅ Validaciones frontend y backend
- ✅ Middleware de autorización
- ✅ Panel de administración

---

## 🚀 Instrucciones de Despliegue

### 📦 Requerimientos del Sistema

Asegúrate de tener instalado:
- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.x
- **npm** >= 9.x
- **MySQL** >= 8.0
- **Git**

### 🔧 Instalación Paso a Paso

#### 1. Clonar el Repositorio
```bash
git clone <URL_DEL_REPOSITORIO>
cd <NOMBRE_DEL_PROYECTO>
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

# Generar la clave JWT
php artisan jwt:secret
```

#### 5. Configurar la Base de Datos

Edita el archivo `.env` con tus credenciales de MySQL:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
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

# Ejecutar seeders (si los hay)
php artisan db:seed
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

## 🔐 Credenciales de Acceso

### Cuenta Administrador
- **Email**: `yoevaluo@gmail.com`
- **Contraseña**: `12345678`
- **Rol**: Administrador
- **Permisos**: Acceso completo al sistema, gestión de usuarios

### Cuenta de Usuario Normal (Opcional)
Si creaste usuarios de prueba, puedes usar:
- **Email**: `usuario@example.com`
- **Contraseña**: `12345678`
- **Rol**: Usuario
- **Permisos**: Solo puede ver y editar su propio perfil

---

## 📁 Estructura del Proyecto
```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php      # Autenticación (login, registro, logout)
│   │   │   └── UserController.php      # CRUD de usuarios
│   │   └── Middleware/
│   │       ├── IsAdmin.php             # Middleware para administradores
│   │       └── IsUserAuth.php          # Middleware para usuarios autenticados
│   └── Models/
│       └── User.php                     # Modelo de Usuario
├── database/
│   ├── migrations/                      # Migraciones de base de datos
│   └── db_reto.sql                      # Archivo SQL de la base de datos
├── resources/
│   ├── views/
│   │   ├── auth/                        # Vistas de autenticación
│   │   ├── users/                       # Vistas de gestión de usuarios
│   │   ├── profile/                     # Vistas de perfil
│   │   ├── components/                  # Componentes reutilizables
│   │   ├── dashboard.blade.php          # Panel principal
│   │   └── welcome.blade.php            # Página de inicio
│   ├── css/
│   └── js/
├── routes/
│   ├── web.php                          # Rutas web
│   └── api.php                          # Rutas API
└── README.md
```

---

## 🎯 Funcionalidades Implementadas

### 1. Sistema de Autenticación
- ✅ Login con validación de credenciales
- ✅ Registro de nuevos usuarios
- ✅ Logout con invalidación de tokens
- ✅ Sesiones persistentes
- ✅ Tokens JWT para API

### 2. Gestión de Usuarios (CRUD)
- ✅ **Listar usuarios** - Tabla con paginación
- ✅ **Crear usuario** - Formulario con validaciones
- ✅ **Editar usuario** - Actualización de datos
- ✅ **Eliminar usuario** - Confirmación antes de eliminar
- ✅ Validaciones en frontend y backend

### 3. Roles y Permisos
- ✅ **Rol Administrador**:
  - Ver, crear, editar y eliminar cualquier usuario
  - Acceso al panel de administración
  - Gestión completa del sistema

- ✅ **Rol Usuario**:
  - Solo puede ver su propio perfil
  - Solo puede editar sus propios datos
  - No tiene acceso al panel de administración

### 4. Interfaz de Usuario
- ✅ Diseño responsive (móvil, tablet, desktop)
- ✅ Navegación intuitiva
- ✅ Feedback visual (mensajes de éxito/error)
- ✅ Componentes reutilizables

---

## 🛠️ Comandos Útiles
```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Regenerar archivos de configuración
php artisan config:cache
php artisan route:cache

# Ver rutas disponibles
php artisan route:list

# Crear un nuevo usuario desde consola
php artisan tinker
> User::create(['name' => 'Nombre', 'email' => 'email@example.com', 'password' => bcrypt('password'), 'role' => 'user']);

# Actualizar dependencias
composer update
npm update
```

---

## 🧪 Testing (Opcional)
```bash
# Ejecutar pruebas
php artisan test

# Ejecutar pruebas con cobertura
php artisan test --coverage
```

---

## 📝 Explicación de Decisiones Técnicas

### 1. Laravel como Framework Backend
**Por qué**: Laravel ofrece un ecosistema completo con autenticación integrada, ORM Eloquent para la base de datos, validaciones robustas y una arquitectura MVC clara.

### 2. Tailwind CSS para Estilos
**Por qué**: Permite un desarrollo rápido con clases utilitarias, es altamente personalizable y genera CSS optimizado para producción.

### 3. Alpine.js para Interactividad
**Por qué**: Es ligero (15KB), fácil de integrar con Laravel, y perfecto para interacciones simples como dropdowns y menús móviles.

### 4. JWT + Sanctum para Autenticación
**Por qué**: 
- **Sanctum**: Para autenticación basada en sesiones (web)
- **JWT**: Para autenticación de API (stateless)
- Ambos proporcionan seguridad y flexibilidad

### 5. Middleware para Control de Acceso
**Por qué**: Separar la lógica de autorización en middlewares mantiene el código limpio y reutilizable.

### 6. Validaciones Dobles (Frontend + Backend)
**Por qué**: 
- **Frontend**: Mejora la experiencia de usuario con feedback inmediato
- **Backend**: Garantiza la seguridad y la integridad de los datos

---

## 🐛 Resolución de Problemas Comunes

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

---

## 📧 Contacto

Si tienes preguntas o problemas durante el despliegue, no dudes en contactar:
- **Email**: yoevaluo@gmail.com

---

## 📄 Licencia

Este proyecto es parte de un reto técnico y está desarrollado con fines educativos y de evaluación.

---

**Desarrollado con ❤️ para Logística Empresarial Megamente**
