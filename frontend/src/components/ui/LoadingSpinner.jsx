// src/components/ui/LoadingSpinner.jsx
// Centered Bootstrap spinner for loading states.

export default function LoadingSpinner({ message = 'Cargando...' }) {
  return (
    <div className="d-flex flex-column align-items-center justify-content-center py-5 gap-3">
      <div className="spinner-border text-accent" role="status" style={{ width: '3rem', height: '3rem' }}>
        <span className="visually-hidden">{message}</span>
      </div>
      <p className="text-body-secondary">{message}</p>
    </div>
  )
}
