// src/components/layout/Layout.jsx
// Shared page wrapper: Navbar + page content (Outlet) + Footer.
// React Router renders child routes into <Outlet />.

import { Outlet } from 'react-router-dom'
import Navbar from './Navbar'
import Footer from './Footer'

export default function Layout() {
  return (
    <div className="d-flex flex-column min-vh-100">
      <Navbar />
      {/* pt-5 adds top padding so content is not hidden under the fixed navbar */}
      <main className="flex-grow-1 pt-5">
        <Outlet />
      </main>
      <Footer />
    </div>
  )
}
