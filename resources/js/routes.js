import { createWebHistory, createRouter } from "vue-router";

// Auth and home
import Home from "./views/home.vue";
import Register from "./views/register.vue";
import Login from "./views/login.vue";
import Projects from "./views/projects.vue";
//Admin
import DashboardAdmin from "./views/admin/dashboard.vue";
import AdminHome from "./views/admin/admin-home.vue";
import AdminProfile from "./views/admin/admin-profile.vue";
import AdminEditProfile from "./views/admin/admin-edit-profiles.vue";
import AdminProjects from "./views/admin/admin-project.vue";

//User
import UserHome from "./views/users/users-home.vue";
import UserProfile from "./views/users/profile.vue";
import EditUserProfile from "./views/users/edit.vue";
import NewPassword from "./views/users/new-password.vue";
import RegisterProjects from "./views/users/register-project.vue";

export default {
    mode: "history",
    fallback: true,
    routes: [
        {
            name: "home",
            path: "/",
            component: Home,
            children: [
                {
                    name: "projects",
                    path: "/",
                    component: Projects,
                },
                {
                    name: "register",
                    path: "/register",
                    component: Register,
                },
                {
                    name: "login",
                    path: "/login",
                    component: Login,
                },
            ],
        },
        {
            name: "admin",
            path: "/admin",
            component: AdminHome,
            children: [
                {
                    name: "admin-dashboard",
                    path: "/admin-dashboard",
                    component: DashboardAdmin,
                },
                {
                    name: "admin-profile",
                    path: "/admin-profile/:id",
                    component: AdminProfile,
                },
                {
                    name: "admin-edit-user-profile",
                    path: "/admin-profile/edit",
                    component: AdminEditProfile,
                },
                {
                    name: "admin-project",
                    path: "/admin/projects",
                    component: AdminProjects,
                },
            ],
        },
        {
            name: "user",
            path: "/user",
            component: UserHome,
            children: [
                {
                    name: "user-profile",
                    path: "/profile",
                    component: UserProfile,
                },
                {
                    name: "edit-user-profile",
                    path: "/profile/edit",
                    component: EditUserProfile,
                },
                {
                    name: "new-password",
                    path: "/profile/edit-password",
                    component: NewPassword,
                },
                {
                    name: "register-project",
                    path: "/profile/projects",
                    component: RegisterProjects,
                },
            ],
        },
        {
            path: "*",
            redirect: "/login",
        },
    ],
};
