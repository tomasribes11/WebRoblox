// src/components/layout/Navbar.jsx
// Responsive Bootstrap 5.3 navbar.
// Includes: logo, nav links, language switcher, theme toggle, auth buttons.

import { Link, NavLink } from 'react-router-dom'
import { useContext } from 'react'
import { useTranslation } from 'react-i18next'
import { ThemeContext } from '../../context/ThemeContext'
import { useAuth } from '../../hooks/useAuth'
import LanguageSwitcher from '../ui/LanguageSwitcher'

export default function Navbar() {
  const { theme, toggleTheme } = useContext(ThemeContext)
  const { user, logout }       = useAuth()
  const { t }                  = useTranslation()

  return (
    <nav className="navbar navbar-expand-lg fixed-top" style={{ backdropFilter: 'blur(20px)' }}>
      <div className="container">

        {/* Logo */}
        <Link className="navbar-brand fw-bold text-gradient-accent" to="/">
          🎮 Mundo Roblox
        </Link>

        {/* Mobile hamburger toggle */}
        <button
          className="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarMain"
        >
          <span className="navbar-toggler-icon" />
        </button>

        <div className="collapse navbar-collapse" id="navbarMain">

          {/* Navigation links */}
          <ul className="navbar-nav me-auto mb-2 mb-lg-0">
            <li className="nav-item">
              <NavLink className="nav-link" to="/">{t('nav.home')}</NavLink>
            </li>
            <li className="nav-item">
              <NavLink className="nav-link" to="/trucos">{t('nav.tricks')}</NavLink>
            </li>
            <li className="nav-item">
              <NavLink className="nav-link" to="/guias">{t('nav.guides')}</NavLink>
            </li>
            <li className="nav-item">
              <NavLink className="nav-link" to="/noticias">{t('nav.news')}</NavLink>
            </li>
          </ul>

          {/* Right side controls */}
          <div className="d-flex align-items-center gap-2">

            {/* Language switcher */}
            <LanguageSwitcher />

            {/* Theme toggle */}
            <button
              className="btn btn-outline-secondary btn-sm"
              onClick={toggleTheme}
              title={theme === 'dark' ? t('theme.switchToLight') : t('theme.switchToDark')}
            >
              {theme === 'dark' ? '☀️' : '🌙'}
            </button>

            {/* Auth: show user name + logout, or login button */}
            {user ? (
              <>
                <span className="navbar-text small">
                  {t('nav.hello', { name: user.name.split(' ')[0] })}
                </span>
                <button className="btn btn-outline-danger btn-sm" onClick={logout}>
                  {t('nav.logout')}
                </button>
              </>
            ) : (
              <Link className="btn btn-accent btn-sm" to="/login">
                {t('nav.login')}
              </Link>
            )}
          </div>

        </div>
      </div>
    </nav>
  )
}
