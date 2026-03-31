# Frontend — React 18 + Vite + Bootstrap 5.3

Interfaz de usuario del sitio WebRoblox. Single Page Application (SPA) que consume la API Laravel.

## Tech Stack

- React 18 + Vite 5
- Bootstrap 5.3 (dark mode nativo)
- react-i18next (ES/EN/FR)
- react-router-dom v6
- axios

## Acceso

En desarrollo: http://localhost (nginx proxía al servidor Vite en el puerto 5173)

## Variables de entorno

```bash
cp .env.example .env.local
```

| Variable | Descripción | Valor dev |
|----------|-------------|-----------|
| `VITE_API_URL` | URL base de la API Laravel | `http://localhost/api/v1` |

## Scripts disponibles

```bash
npm run dev      # Servidor de desarrollo con HMR (se ejecuta dentro de Docker)
npm run build    # Build de producción → genera /dist
npm run preview  # Previsualizar el build de producción localmente
```

## Estructura src/

```
src/
├── api/           ← Llamadas HTTP (axios.js, auth.js, articles.js)
├── context/       ← Estado global (AuthContext, ThemeContext)
├── hooks/         ← Custom hooks (useAuth, useArticles)
├── components/
│   ├── layout/    ← Layout, Navbar, Footer
│   ├── articles/  ← ArticleCard, ArticleGrid
│   ├── auth/      ← LoginForm, RegisterForm
│   └── ui/        ← LoadingSpinner, ErrorMessage, LanguageSwitcher
├── pages/         ← Una página por ruta
├── locales/       ← Archivos de traducción JSON (es/en/fr)
└── styles/        ← custom.css (extensiones sobre Bootstrap)
```

## Añadir una traducción nueva

1. Abre `public/locales/es/common.json` y añade la clave
2. Repite en `en/common.json` y `fr/common.json`
3. Usa en el componente: `const { t } = useTranslation(); t('mi.clave')`

## Añadir una página nueva

1. Crea `src/pages/MiPagina.jsx`
2. Añade la ruta en `src/App.jsx`:
   ```jsx
   <Route path="/mi-pagina" element={<MiPagina />} />
   ```
3. Añade el enlace en `src/components/layout/Navbar.jsx` si aplica

## Sistema de temas (Bootstrap 5.3 Dark Mode)

El ThemeContext aplica `data-bs-theme="dark"` o `"light"` en `<html>`.
Bootstrap aplica sus variables CSS automáticamente.

Para añadir estilos específicos por tema:
```css
:root[data-bs-theme="dark"]  { /* estilos oscuros */ }
:root[data-bs-theme="light"] { /* estilos claros */ }
```
