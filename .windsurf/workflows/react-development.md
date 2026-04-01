---
description: Flujo de desarrollo React con Vite y Docker
---

# Flujo de Trabajo: Desarrollo React

## Comandos Esenciales

### Desarrollo
```bash
# Terminal en contenedor Node
docker compose exec node sh

# Instalar dependencias
docker compose exec node npm install

# Iniciar desarrollo (corriendo automáticamente)
docker compose exec node npm run dev -- --host

# Build para producción
docker compose exec node npm run build

# Preview de producción
docker compose exec node npm run preview
```

### Paquetes Útiles
```bash
# Instalar nuevo paquete
docker compose exec node npm install package-name

# Dev dependency
docker compose exec node npm install package-name --save-dev

# Global package
docker compose exec node npm install -g package-name
```

## Estructura de Frontend

```
frontend/
├── src/
│   ├── api/          ← API clients (axios, auth, articles)
│   ├── context/      ← React Context (Auth, Theme)
│   ├── hooks/        ← Custom hooks (useAuth, useArticles)
│   ├── components/   ← Reusable components
│   ├── pages/        ← Page components
│   └── styles/       ← Custom CSS + Bootstrap
├── public/
│   └── locales/      ← i18n translations (es/en/fr)
└── index.html        ← Entry point
```

## Desarrollo de Componentes

### Crear Nuevo Componente
```bash
# En directorio frontend/src/components/
mkdir new-component
touch new-component/index.jsx
touch new-component/NewComponent.module.css
```

### Estructura de Componente
```jsx
import React from 'react';
import { useTranslation } from 'react-i18next';

const ComponentName = () => {
  const { t } = useTranslation('common');
  
  return (
    <div className="component-wrapper">
      {/* Component JSX */}
    </div>
  );
};

export default ComponentName;
```

## Context API

### Auth Context
```jsx
import { useAuth } from '../context/AuthContext';

const { user, login, logout, loading } = useAuth();
```

### Theme Context
```jsx
import { useTheme } from '../context/ThemeContext';

const { theme, toggleTheme } = useTheme();
```

## API Integration

### Axios Configuration
```javascript
import axios from '../api/axios';

// GET request
const response = await axios.get('/articles');

// POST request
const response = await axios.post('/auth/login', credentials);
```

## Internacionalización

### Usar Traducciones
```jsx
import { useTranslation } from 'react-i18next';

const { t } = useTranslation('articles');
return <h1>{t('title')}</h1>;
```

### Estructura de Archivos
```
public/locales/
├── es/
│   ├── common.json
│   └── articles.json
├── en/
│   ├── common.json
│   └── articles.json
└── fr/
    ├── common.json
    └── articles.json
```

## Bootstrap 5.3 + Custom CSS

### Variables CSS
```css
:root {
  --bs-primary: #your-color;
  --bs-secondary: #your-color;
  --accent-color: #your-accent;
}
```

### Componentes Bootstrap
```jsx
import { Button, Card, Container, Row, Col } from 'react-bootstrap';

<Button variant="primary" className="w-100">
  Click me
</Button>
```

## Desarrollo Hot Reload

- **URL**: http://localhost:5173
- **HMR**: Activo automáticamente
- **Proxy**: Vite proxy a /api para Laravel

## Testing Frontend

```bash
# Tests unitarios (cuando se configuren)
docker compose exec node npm test

# Build verification
docker compose exec node npm run build
```

## Optimización

### Code Splitting
```jsx
import { lazy, Suspense } from 'react';

const LazyComponent = lazy(() => import('./LazyComponent'));

<Suspense fallback={<LoadingSpinner />}>
  <LazyComponent />
</Suspense>
```

### Bundle Analysis
```bash
# Analizar bundle size
docker compose exec node npm run build
docker compose exec node npx vite-bundle-analyzer dist
```

## Atajos Windsurf

- **Ctrl+Shift+N**: Instalar dependencias Node
- **Ctrl+Shift+B**: Build frontend
- **Ctrl+`**: Toggle terminal
- **F5**: Refresh browser (con Live Server)
