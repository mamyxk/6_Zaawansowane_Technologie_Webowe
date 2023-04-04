import { createRouter, createWebHistory } from 'vue-router'

import HomePage from './pages/HomePage.vue'

import AuthorAddPage from './pages/authors/AuthorAddPage'
import AuthorListPage from './pages/authors/AuthorListPage'

import BookListPage from './pages/books/BookListPage'
import BookAddPage from './pages/books/BookAddPage'
import BookDeletePage from './pages/books/BookDeletePage'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/', component: HomePage },
    {
      path: '/authors',
      children: [
        {
          path: 'add-new',
          component: AuthorAddPage
        },
        {
          path: 'list',
          component: AuthorListPage
        }
      ]
    },
    {
      path: '/books',
      children: [
        {
          path: 'add-new',
          component: BookAddPage
        },
        {
          path: 'list',
          component: BookListPage
        },
        {
          path: 'delete',
          component: BookDeletePage
        }
      ]
    }
  ]
})

export default router