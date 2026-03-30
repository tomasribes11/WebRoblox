// src/components/ui/ErrorMessage.jsx
// Bootstrap alert for displaying error messages.

export default function ErrorMessage({ message }) {
  if (!message) return null
  return (
    <div className="alert alert-danger" role="alert">
      {message}
    </div>
  )
}
