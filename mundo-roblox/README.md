# Mundo Roblox - Web App

## 📋 Descripción del Proyecto

Mundo Roblox es una aplicación web completa sobre el universo Roblox que incluye:

- **Artículos detallados** sobre trucos, guías y tutoriales
- **Sistema de modales** para navegar contenido
- **Navegación responsive** con menú móvil
- **Sistema de autenticación** simulado
- **Soporte multiidioma** (Español, Inglés, Francés)
- **Tema claro/oscuro** con CSS variables
- **Diseño moderno** con gradientes y animaciones

## 🏗️ Arquitectura del Proyecto

### Estructura de Archivos

```
mundo-roblox/
├── index.html          # Archivo principal (HTML + CSS + JavaScript)
└── README.md          # Este archivo de documentación
```

### Arquitectura Monolítica

El proyecto utiliza una **arquitectura de un solo archivo**:

1. **HTML**: Estructura semántica completa
2. **CSS**: Estilos embebidos en `<style>`
3. **JavaScript**: Todo el código en `<script>` al final del body

### Componentes Principales

#### 1. **Sistema de Modales**
- `ModalSystem`: Gestiona apertura/cierre de modales
- Soporte para diferentes tipos (artículos, navegación, auth)
- Animaciones suaves con CSS transitions

#### 2. **Sistema de Navegación**
- `MobileNav`: Menú hamburguesa responsive
- Navegación principal con enlaces a modales
- Navegación móvil con toggle animation

#### 3. **Sistema de Autenticación**
- `AuthService`: Sistema de login/registro simulado
- Almacenamiento en localStorage
- Estados de usuario (logueado/no logueado)

#### 4. **Sistema de Tema e Idioma**
- `ThemeLanguageSystem`: Gestión de tema e idioma
- Persistencia en localStorage
- Actualización dinámica de UI

#### 5. **Base de Datos Embebida**
- `articles`: Objeto con todos los artículos
- `navContent`: Contenido para modales de navegación
- `translations`: Sistema multiidioma

## 🌐 Servidor Localhost (Puerto 8000)

### ¿Cómo Funciona el Servidor?

El servidor utiliza **Python HTTP Server**, un servidor web incorporado en Python:

```bash
python -m http.server 8000 --bind 0.0.0.0
```

#### Componentes del Servidor:

1. **Python HTTP Server**: Servidor web ligero incorporado
2. **Puerto 8000**: Puerto estándar para desarrollo local
3. **Bind 0.0.0.0**: Escucha en todas las interfaces de red
4. **Directorio actual**: Sirve archivos desde la carpeta `mundo-roblox/`

#### Flujo de Funcionamiento:

```
1. Python inicia servidor en puerto 8000
2. Servidor escucha peticiones HTTP
3. Navegador solicita http://127.0.0.1:8000
4. Servidor responde con index.html
5. Navegador renderiza HTML + CSS + JavaScript
6. JavaScript se ejecuta y añade interactividad
```

#### ¿Por qué Puerto 8000?

- **No requiere privilegios de administrador**
- **No está ocupado por servicios comunes**
- **Estándar para desarrollo web**
- **Fácil de recordar y usar**

## 🚀 Instalación y Puesta en Marcha

### Requisitos Previos

- **Python 3.x** instalado en el sistema
- **Terminal/Consola** con acceso a comandos
- **Navegador web moderno** (Chrome, Firefox, Edge, Safari)

### Paso 1: Verificar Instalación de Python

Abre una terminal y ejecuta:

```bash
python --version
```

O si usas Windows:

```bash
python -V
```

Si no tienes Python, descárgalo desde [python.org](https://python.org)

### Paso 2: Navegar al Directorio del Proyecto

```bash
cd "c:/Users/Usuario/OneDrive - Fundació Escoles Garbí/Escritorio/web roblox/mundo-roblox"
```

### Paso 3: Iniciar el Servidor Local

```bash
python -m http.server 8000 --bind 0.0.0.0
```

**Opción alternativa (background):**

```bash
python -m http.server 8000 --bind 0.0.0.0 &
```

### Paso 4: Acceder a la Aplicación

Abre tu navegador y navega a:

**Principal:**
```
http://127.0.0.1:8000
```

**Alternativo:**
```
http://localhost:8000
```

### Paso 5: Verificar Funcionamiento

Deberías ver:
- ✅ Página de "Mundo Roblox" cargada
- ✅ Botones funcionando
- ✅ Modales abriendo correctamente
- ✅ Diseño responsive
- ✅ Animaciones suaves

## 🔧 Troubleshooting

### Problemas Comunes y Soluciones

#### 1. **Puerto 8000 Ocupado**

```bash
# Usar otro puerto
python -m http.server 8001 --bind 0.0.0.0

# O matar proceso en puerto 8000 (Windows)
netstat -ano | findstr :8000
taskkill /PID <PID> /F
```

#### 2. **Python No Reconocido**

```bash
# Intentar con python3
python3 -m http.server 8000 --bind 0.0.0.0

# O agregar Python al PATH del sistema
```

#### 3. **Permisos Denegados**

```bash
# Ejecutar como administrador (Windows)
# O usar sudo (Linux/Mac)
sudo python3 -m http.server 8000 --bind 0.0.0.0
```

#### 4. **Botones No Funcionan**

1. **Abrir consola del navegador** (F12)
2. **Buscar errores JavaScript**
3. **Verificar que el servidor está corriendo**
4. **Recargar la página** (Ctrl+F5)

#### 5. **Estilos No Cargan**

1. **Verificar conexión al servidor**
2. **Limpiar caché del navegador**
3. **Recargar con Ctrl+Shift+R**

## 📱 Características Técnicas

### Tecnologías Utilizadas

- **HTML5**: Estructura semántica
- **CSS3**: Variables, Grid, Flexbox, Animaciones
- **JavaScript ES6+**: Clases, Arrow functions, Template literals
- **LocalStorage**: Persistencia de datos
- **Responsive Design**: Mobile-first approach

### Optimizaciones

- **Un solo archivo**: Minimiza peticiones HTTP
- **CSS Variables**: Facilita tematización
- **Event Delegation**: Mejor rendimiento
- **Lazy Loading**: Carga de contenido bajo demanda

### Compatibilidad

- **Navegadores modernos**: Chrome 60+, Firefox 55+, Safari 12+, Edge 79+
- **Dispositivos**: Desktop, Tablet, Mobile
- **Resoluciones**: 320px - 4K+

## 🎯 Uso de la Aplicación

### Navegación

1. **Menú principal**: Click en enlaces del navbar
2. **Artículos**: Click en "Leer más" en cada tarjeta
3. **Móvil**: Usar menú hamburguesa
4. **Cerrar modales**: Click en "X" o fuera del modal

### Funcionalidades

- **Tema claro/oscuro**: Click en icono de luna/sol
- **Cambiar idioma**: Click en bandera del idioma
- **Autenticación**: Click en "Crear cuenta / Iniciar sesión"
- **Compartir**: Click en botón de compartir en modales

## 📝 Notas de Desarrollo

### Extensiones Futuras

- [ ] Backend real con Node.js/Express
- [ ] Base de datos (MongoDB/PostgreSQL)
- [ ] Sistema de comentarios
- [ ] Panel de administración
- [ ] API RESTful
- [ ] Deploy en producción

### Mejoras de Rendimiento

- [ ] Code splitting
- [ ] Imágenes optimizadas
- [ ] Service Worker
- [ ] Caching avanzado
- [ ] Minificación de código

## 📞 Soporte

Si encuentras problemas:

1. **Revisa este README**
2. **Abre la consola del navegador**
3. **Verifica los logs del servidor**
4. **Prueba en otro navegador**

---

**Desarrollado con ❤️ para la comunidad Roblox**
