// src/api/articles.js
// Article and category API calls.

import api from './axios'

// GET /api/v1/articles
// params: { locale, category, page, perPage }
export const getArticles = ({ locale = 'es', category = null, page = 1, perPage = 12 } = {}) => {
  const params = { locale, page, per_page: perPage }
  if (category) params.category = category
  return api.get('/articles', { params }).then((r) => r.data)
}

// GET /api/v1/articles/{slug}
// Returns the full article including content.
export const getArticle = (slug, locale = 'es') =>
  api.get(`/articles/${slug}`, { params: { locale } }).then((r) => r.data)

// GET /api/v1/categories
export const getCategories = (locale = 'es') =>
  api.get('/categories', { params: { locale } }).then((r) => r.data)
