// src/components/articles/ArticleGrid.jsx
// Responsive Bootstrap grid of ArticleCard components.
// Shows loading state and empty state.

import { useTranslation } from 'react-i18next'
import ArticleCard from './ArticleCard'
import LoadingSpinner from '../ui/LoadingSpinner'
import ErrorMessage from '../ui/ErrorMessage'

export default function ArticleGrid({ articles, isLoading, error }) {
  const { t } = useTranslation('articles')

  if (isLoading) return <LoadingSpinner />
  if (error)     return <ErrorMessage message={error} />

  if (!articles?.length) {
    return (
      <div className="text-center py-5 text-body-secondary">
        <p className="fs-5">{t('noArticles')}</p>
      </div>
    )
  }

  return (
    <div className="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      {articles.map((article) => (
        <div key={article.id} className="col">
          <ArticleCard article={article} />
        </div>
      ))}
    </div>
  )
}
