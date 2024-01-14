import { createWebHistory, createRouter } from "vue-router";
import Account from './pages/Account.vue'
import Section from './pages/Section.vue'
import Category from './pages/Category.vue'
import Content from './pages/Content.vue'
import Audit from './pages/Audit.vue'
import Setting from './pages/Setting.vue'
import CreateSection from './pages/CreateSection.vue'
import EditSection from './pages/EditSection.vue'
import CreateCategory from './pages/CreateCategory.vue'
import EditCategory from './pages/EditCategory.vue'
import CreateContent from './pages/CreateContent.vue'
import EditContent from './pages/EditContent.vue'

const routes = [
    {
        name:'/',
        path:'/',
        component: Account
    },
    {
        name:'/sections',
        path:'/sections',
        component: Section
    },
    {
        name:'categories',
        path:'/categories',
        component: Category
    },
    {
        name:'contents',
        path:'/contents',
        component: Content
    },
    {
        name:'audits',
        path:'/audits',
        component: Audit
    },
    {
        name:'settings',
        path:'/settings',
        component: Setting
    },
    {
        name:'section/create',
        path:'/section/create',
        component: CreateSection
    },
    {
        name:'section/edit/:id',
        path:'/section/edit/:id',
        component: EditSection
    },
    {
        name:'category/create',
        path:'/category/create',
        component: CreateCategory
    },
    {
        name:'category/edit/:id',
        path:'/category/edit/:id',
        component: EditCategory
    },
    {
        name:'content/create',
        path:'/content/create',
        component: CreateContent
    },
    {
        name:'content/edit/:id',
        path:'/content/edit/:id',
        component: EditContent
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router