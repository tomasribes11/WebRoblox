// src/App.jsx
// Root component. Sets up Context providers and the React Router.
// All pages are wrapped by the Layout component (Navbar + Outlet + Footer).

import { BrowserRouter, Routes, Route } from 'react-router-dom'
import { AuthProvider } from './context/AuthContext'
import { ThemeProvider } from './context/ThemeContext'
import Layout from './components/layout/Layout'
import HomePage from './pages/HomePage'
import ArticlesPage from './pages/ArticlesPage'
import ArticleDetailPage from './pages/ArticleDetailPage'
import LoginPage from './pages/LoginPage'
import RegisterPage from './pages/RegisterPage'
import NotFoundPage from './pages/NotFoundPage'

export default function App() {
  return (
    // ThemeProvider must wrap everything so Bootstrap dark mode applies globally
    <ThemeProvider>
      {/* AuthProvider makes user/login/logout available everywhere */}
      <AuthProvider>
        <BrowserRouter>
          <Routes>
            {/* All routes share the same Layout (Navbar + Footer) */}
            <Route element={<Layout />}>
              <Route path="/"                 element={<HomePage />} />
              <Route path="/articulos"        element={<ArticlesPage />} />
              <Route path="/articulos/:slug"  element={<ArticleDetailPage />} />
              {/* Category shortcuts — ArticlesPage filters by category prop */}
              <Route path="/trucos"   element={<ArticlesPage category="trucos" />} />
              <Route path="/guias"    element={<ArticlesPage category="guias" />} />
              <Route path="/noticias" element={<ArticlesPage category="noticias" />} />
              {/* Auth */}
              <Route path="/login"    element={<LoginPage />} />
              <Route path="/registro" element={<RegisterPage />} />
              {/* Catch-all */}
              <Route path="*" element={<NotFoundPage />} />
            </Route>
          </Routes>
        </BrowserRouter>
      </AuthProvider>
    </ThemeProvider>
  )
}
