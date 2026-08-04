import { createRouter, createWebHistory } from "vue-router";

// Import layout
import AuthLayout from "@/layouts/AuthLayout.vue";
import AdminLayout from "@/layouts/AdminLayout.vue";
import StudentLayout from "@/layouts/StudentLayout.vue";

// Import views
import Login from "@/views/auth/Login.vue";
import Register from "@/views/auth/Register.vue";
import AdminDashboard from "@/views/admin/Dashboard.vue";
import StudentDashboard from "@/views/student/Dashboard.vue";
import StudentProfile from "@/views/student/Profile.vue";
import StudentHasilAnalisis from "@/views/student/HasilAnalisis.vue";
import StudentCV from "@/views/student/CV.vue";
import StudentRiwayatAnalisis from "@/views/student/RiwayatAnalisis.vue";
import StudentSupport from "@/views/student/Support.vue";

// Import skill components
import SkillList from "@/views/admin/skill/List.vue";
import SkillCreate from "@/views/admin/skill/Create.vue";
import SkillEdit from "@/views/admin/skill/Edit.vue";

// Import career components
import CareerList from "@/views/admin/career/List.vue";
import CareerCreate from "@/views/admin/career/Create.vue";
import CareerEdit from "@/views/admin/career/Edit.vue";

// Import internship components
import InternshipList from "@/views/admin/internship/List.vue";
import InternshipCreate from "@/views/admin/internship/Create.vue";
import InternshipEdit from "@/views/admin/internship/Edit.vue";

// Import mapping components
import CareerSkillMapping from "@/views/admin/mapping/CareerSkillMapping.vue";

// Import student components
import StudentManagement from "@/views/admin/student/StudentManagement.vue";

const routes = [
    {
        path: "/",
        redirect: "/login",
    },
    {
        path: "/login",
        name: "Login",
        component: Login,
        meta: { layout: "auth" },
    },
    {
        path: "/register",
        name: "Register",
        component: Register,
        meta: { layout: "auth" },
    },
    {
        path: "/admin",
        redirect: "/admin/dashboard",
        component: AdminLayout,
        meta: { layout: "admin" },
        children: [
            {
                path: "dashboard",
                name: "AdminDashboard",
                component: AdminDashboard,
                meta: {
                    requiresAuth: true,
                    role: "admin",
                },
            },
            // Student routes
            {
                path: "student",
                name: "StudentManagement",
                component: StudentManagement,
                meta: {
                    requiresAuth: true,
                    role: "admin",
                },
            },
            // Skill routes
            {
                path: "skill",
                name: "SkillList",
                component: SkillList,
                meta: {
                    requiresAuth: true,
                    role: "admin",
                },
            },
            {
                path: "skill/create",
                name: "SkillCreate",
                component: SkillCreate,
                meta: {
                    requiresAuth: true,
                    role: "admin",
                },
            },
            {
                path: "skill/:id/edit",
                name: "SkillEdit",
                component: SkillEdit,
                meta: {
                    requiresAuth: true,
                    role: "admin",
                },
                props: true,
            },
            // Career routes
            {
                path: "career",
                name: "CareerList",
                component: CareerList,
                meta: {
                    requiresAuth: true,
                    role: "admin",
                },
            },
            {
                path: "career/create",
                name: "CareerCreate",
                component: CareerCreate,
                meta: {
                    requiresAuth: true,
                    role: "admin",
                },
            },
            {
                path: "career/:id/edit",
                name: "CareerEdit",
                component: CareerEdit,
                meta: {
                    requiresAuth: true,
                    role: "admin",
                },
                props: true,
            },
            // Internship routes
            {
                path: "internship",
                name: "InternshipList",
                component: InternshipList,
                meta: {
                    requiresAuth: true,
                    role: "admin",
                },
            },
            {
                path: "internship/create",
                name: "InternshipCreate",
                component: InternshipCreate,
                meta: {
                    requiresAuth: true,
                    role: "admin",
                },
            },
            {
                path: "internship/:id/edit",
                name: "InternshipEdit",
                component: InternshipEdit,
                meta: {
                    requiresAuth: true,
                    role: "admin",
                },
                props: true,
            },
            // Mapping routes
            {
                path: "mapping",
                name: "CareerSkillMapping",
                component: CareerSkillMapping,
                meta: {
                    requiresAuth: true,
                    role: "admin",
                },
            },
        ],
    },
    {
        path: "/student",
        redirect: "/student/dashboard",
        component: StudentLayout,
        meta: { layout: "student" },
        children: [
            {
                path: "dashboard",
                name: "StudentDashboard",
                component: StudentDashboard,
                meta: {
                    requiresAuth: true,
                    role: "mahasiswa",
                },
            },
            {
                path: "profile",
                name: "StudentProfile",
                component: StudentProfile,
                meta: {
                    requiresAuth: true,
                    role: "mahasiswa",
                },
            },
            {
                path: "hasilAnalisis",
                name: "StudentHasilAnalisis",
                component: StudentHasilAnalisis,
                meta: {
                    requiresAuth: true,
                    role: "mahasiswa",
                },
            },
            {
                path: "cv",
                name: "StudentCV",
                component: StudentCV,
                meta: {
                    requiresAuth: true,
                    role: "mahasiswa",
                },
            },
            {
                path: "riwayatAnalisis",
                name: "StudentRiwayatAnalisis",
                component: StudentRiwayatAnalisis,
                meta: {
                    requiresAuth: true,
                    role: "mahasiswa",
                },
            },
            {
                path: "support",
                name: "StudentSupport",
                component: StudentSupport,
                meta: {
                    requiresAuth: true,
                    role: "mahasiswa",
                },
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL || "/"),
    routes,
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("token");
    const rawUser = localStorage.getItem("user");

    // Pengecekan aman untuk JSON parsing
    let user = null;
    if (rawUser && rawUser !== "undefined") {
        try {
            user = JSON.parse(rawUser);
        } catch (error) {
            console.error("Data user di localStorage tidak valid:", error);
            localStorage.removeItem("user"); // Hapus data korup
        }
    }

    // Jika membutuhkan autentikasi tapi token tidak ada
    if (to.meta.requiresAuth && !token) {
        return next("/login");
    }

    // Jika sudah login tetapi mencoba akses halaman login/register
    if ((to.path === "/login" || to.path === "/register") && token) {
        if (user?.role === "admin") {
            return next("/admin/dashboard");
        }
        return next("/student/dashboard");
    }

    // Cek role user
    if (to.meta.role && user?.role !== to.meta.role) {
        if (user?.role === "admin") {
            return next("/admin/dashboard");
        }
        return next("/student/dashboard");
    }

    next();
});

export default router;
