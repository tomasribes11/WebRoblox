// src/components/articles/ArticleCard.jsx
// Bootstrap card for displaying an article preview in the grid.

import { Link } from 'react-router-dom'
import { useTranslation } from 'react-i18next'

export default function ArticleCard({ article }) {
  const { t } = useTranslation('articles')

  return (
    <div className="card h-100 shadow-sm article-card">
      {/* Cover image — placeholder shown if no image is set */}
      {article.cover_image ? (
        <img
          src={article.cover_image}
          className="card-img-top"
          alt={article.title}
          style={{ height: '180px', objectFit: 'cover' }}
        />
      ) : (
        <div
          className="card-img-top d-flex align-items-center justify-content-center bg-gradient-accent"
          style={{ height: '180px', fontSize: '3rem' }}
        >
          🎮
        </div>
      )}

      <div className="card-body d-flex flex-column">
        {/* Category badge */}
        <span className="badge bg-accent mb-2 align-self-start">
          {article.category?.name}
        </span>

        {/* Title */}
        <h5 className="card-title fw-bold">{article.title}</h5>

        {/* Description */}
        <p className="card-text text-body-secondary flex-grow-1">
          {article.description}
        </p>

        {/* Footer: views + read more */}
        <div className="d-flex justify-content-between align-items-center mt-3">
          <small className="text-body-secondary">
            👁 {article.view_count} {t('views')}
          </small>
          <Link
            to={`/articulos/${article.slug}`}
            className="btn btn-accent btn-sm"
          >
            {t('readMore')}
          </Link>
        </div>
      </div>
    </div>
  )
}
