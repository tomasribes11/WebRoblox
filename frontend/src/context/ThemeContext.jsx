// src/context/ThemeContext.jsx
// Manages dark/light theme using Bootstrap 5.3's native dark mode.
// Sets data-bs-theme="dark"|"light" on the <html> element.
// Persists choice in localStorage.

import { createContext, useState, useEffect } from 'react'

export const ThemeContext = createContext(null)

export function ThemeProvider({ children }) {
  const [theme, setTheme] = useState(
    () => localStorage.getItem('theme') || 'dark'
  )

  // Apply theme to <html> element whenever it changes
  useEffect(() => {
    document.documentElement.setAttribute('data-bs-theme', theme)
    localStorage.setItem('theme', theme)
  }, [theme])

  const toggleTheme = () =>
    setTheme((prev) => (prev === 'dark' ? 'light' : 'dark'))

  return (
    <ThemeContext.Provider value={{ theme, toggleTheme }}>
      {children}
    </ThemeContext.Provider>
  )
}
