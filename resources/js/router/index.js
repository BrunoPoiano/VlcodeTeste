import { createRouter, createWebHistory } from 'vue-router'
import TodoList from '../Pages/MainPage/TodoList.vue'
import profile from '../Pages/Profile/Edit.vue'
import UserList from '../Pages/AdminPage/UserList.vue'

let isAdmin = localStorage.getItem('logged_user');

let routes = [];


if (isAdmin == 1){
    routes = [
        {
            path: '/dashboard',
            name: 'userList',
            component: UserList
        },
        {
            path: '/profile',
            name: 'profile',
            component: profile
        },
    ]
}else{
    routes = [
        {
            path: '/dashboard',
            name: 'TodoList',
            component: TodoList
        },
        {
            path: '/profile',
            name: 'profile',
            component: profile
        },
    ]
}

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router
