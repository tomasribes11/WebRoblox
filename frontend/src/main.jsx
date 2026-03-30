// src/main.jsx
// React application entry point.
// Initializes i18next before rendering, then mounts the app.

import React from 'react'
import ReactDOM from 'react-dom/client'
import App from './App'

// Bootstrap CSS (must be imported before custom CSS)
import 'bootstrap/dist/css/bootstrap.min.css'
import './styles/custom.css'

// i18n initialization (must run before any component renders)
import './i18n'

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
    <App />
  </React.StrictMode>
)
