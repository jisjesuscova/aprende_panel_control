import { createRouter, createWebHistory } from 'vue-router'
import SectionView from '../views/SectionView.vue'
import SectionShowView from '../views/SectionShowView.vue'
import CategoryView from '../views/CategoryView.vue'
import CategoryShowView from '../views/CategoryShowView.vue'
import ContentView from '../views/ContentView.vue'
import ContentShowView from '../views/ContentShowView.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'section_view',
      component: SectionView
    },
    {
      path: '/section/show/:id',
      name: 'section_show',
      component: SectionShowView
    },
    {
      path: '/category/:id',
      name: 'category',
      component: CategoryView
    },
    {
      path: '/category/show/:id',
      name: 'category_show',
      component: CategoryShowView
    },
    {
      path: '/content/:section_id/:category_id',
      name: 'content',
      component: ContentView
    },
    {
      path: '/content/show/:id',
      name: 'content_show',
      component: ContentShowView
    },
  ]
})

export default router
