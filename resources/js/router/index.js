import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "../stores/auth";

const routes = [
    // Guest Routes
    {
        path: "/",
        redirect: "/admin/dashboard",
    },

    // Admin Routes
    {
        path: "/admin/dashboard",
        name: "AdminDashboard",
        component: () => import("../views/admin/Dashboard.vue"),
        meta: { requiresAuth: true, role: "admin", layout: "AdminLayout" },
    },
    {
        path: "/admin/skills",
        name: "AdminSkills",
        component: () => import("../views/admin/skill/Index.vue"),
        meta: { requiresAuth: true, role: "admin", layout: "AdminLayout" },
    },
    {
        path: "/admin/skills/create",
        name: "AdminSkillsCreate",
        component: () => import("../views/admin/skill/Create.vue"),
        meta: { requiresAuth: true, role: "admin", layout: "AdminLayout" },
    },
    {
        path: "/admin/skills/:id/edit",
        name: "AdminSkillsEdit",
        component: () => import("../views/admin/skill/Edit.vue"),
        meta: { requiresAuth: true, role: "admin", layout: "AdminLayout" },
        props: true,
    },
    {
        path: "/admin/careers",
        name: "AdminCareers",
        component: () => import("../views/admin/career/Index.vue"),
        meta: { requiresAuth: true, role: "admin", layout: "AdminLayout" },
    },
    {
        path: "/admin/careers/create",
        name: "AdminCareersCreate",
        component: () => import("../views/admin/career/Create.vue"),
        meta: { requiresAuth: true, role: "admin", layout: "AdminLayout" },
    },
    {
        path: "/admin/careers/:id/edit",
        name: "AdminCareersEdit",
        component: () => import("../views/admin/career/Edit.vue"),
        meta: { requiresAuth: true, role: "admin", layout: "AdminLayout" },
        props: true,
    },
    {
        path: "/admin/careers/mapping",
        name: "AdminCareerMapping",
        component: () => import("../views/admin/career/Mapping.vue"),
        meta: { requiresAuth: true, role: "admin", layout: "AdminLayout" },
    },
    {
        path: "/admin/internships",
        name: "AdminInternships",
        component: () => import("../views/admin/internship/Index.vue"),
        meta: { requiresAuth: true, role: "admin", layout: "AdminLayout" },
    },
    {
        path: "/admin/internships/create",
        name: "AdminInternshipsCreate",
        component: () => import("../views/admin/internship/Create.vue"),
        meta: { requiresAuth: true, role: "admin", layout: "AdminLayout" },
    },
    {
        path: "/admin/internships/:id/edit",
        name: "AdminInternshipsEdit",
        component: () => import("../views/admin/internship/Edit.vue"),
        meta: { requiresAuth: true, role: "admin", layout: "AdminLayout" },
        props: true,
    },

    // Student Routes
    {
        path: "/student/dashboard",
        name: "StudentDashboard",
        component: () => import("../views/student/Dashboard.vue"),
        meta: { requiresAuth: true, role: "student", layout: "StudentLayout" },
    },
    {
        path: "/student/upload",
        name: "StudentUpload",
        component: () => import("../views/student/UploadCV.vue"),
        meta: { requiresAuth: true, role: "student", layout: "StudentLayout" },
    },
    {
        path: "/student/result",
        name: "StudentResult",
        component: () => import("../views/student/Result.vue"),
        meta: { requiresAuth: true, role: "student", layout: "StudentLayout" },
    },
    {
        path: "/student/history",
        name: "StudentHistory",
        component: () => import("../views/student/History.vue"),
        meta: { requiresAuth: true, role: "student", layout: "StudentLayout" },
    },
    {
        path: "/student/profile",
        name: "StudentProfile",
        component: () => import("../views/student/Profile.vue"),
        meta: { requiresAuth: true, role: "student", layout: "StudentLayout" },
    },

    // Redirect
    {
        path: "/",
        redirect: "/login",
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Global route guard (Development Mode)
router.beforeEach((to, from, next) => {
    next();
});

export default router;
