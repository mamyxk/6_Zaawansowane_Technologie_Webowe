import { createRouter, createWebHistory } from 'vue-router'

import HomePage from './pages/HomePage.vue'

import AuthorAddPage from './pages/authors/AuthorAddPage'
import AuthorListPage from './pages/authors/AuthorListPage'

import BookListPage from './pages/books/BookListPage'
import BookAddPage from './pages/books/BookAddPage'
import BookDeletePage from './pages/books/BookDeletePage'

import CustomerAddPage from './pages/customers/CustomerAddPage'
import CustomerListPage from './pages/customers/CustomerListPage'

import BorrowBookPage from './pages/borrows/BorrowBookPage'
import ReturnBookPage from './pages/borrows/ReturnBookPage'
import BorrowListPage from './pages/borrows/BorrowListPage'

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
    },
    {
      path: '/customers',
      children: [
        {
          path: 'add-new',
          component: CustomerAddPage
        },
        {
          path: 'list',
          component: CustomerListPage
        }
      ]
    },
    {
      path: '/borrowings',
      children: [
        {
          path: 'borrow-book',
          component: BorrowBookPage
        },
        {
          path: 'return-book',
          component: ReturnBookPage
        },
        {
          path: 'all-borrowings',
          component: BorrowListPage
        }
      ]
    }
  ]
})

export default router