<template>
    <div class="min-h-screen bg-[#f8fafc] text-slate-800">
        <div class="flex min-h-screen">
            <div
                v-if="sidebarOpen"
                @click="toggleSidebar"
                class="fixed inset-0 z-20 bg-slate-900/50 lg:hidden"
            ></div>
            <aside
                :class="[
                    'fixed inset-y-0 left-0 z-30 border-r border-slate-200 bg-white text-slate-700 shadow-[0_0_30px_rgba(15,23,42,0.06)] transition-all duration-200 ease-in-out flex flex-col',
                    sidebarOpen
                        ? 'translate-x-0 w-72'
                        : '-translate-x-full w-72',
                    'lg:translate-x-0',
                    sidebarOpen ? 'lg:w-72' : 'lg:w-20',
                ]"
            >
                <div
                    class="border-b border-slate-200 px-4 py-5 flex items-center justify-between"
                >
                    <router-link
                        to="/admin/dashboard"
                        class="flex items-center gap-2"
                    >
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-white shadow-md overflow-hidden flex-shrink-0"
                        >
                            <img
                                :src="logo"
                                alt="CareerMateAI logo"
                                class="h-9 w-9 object-contain"
                            />
                        </div>
                        <span
                            v-if="!isMiniSidebar"
                            class="text-lg font-bold tracking-tight text-slate-900 transition-opacity duration-200"
                            >CareerMateAI</span
                        >
                    </router-link>
                    <button
                        @click="toggleSidebar"
                        class="lg:hidden rounded-lg p-2 text-slate-500 transition hover:bg-slate-100"
                    >
                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>

                <div
                    v-if="!isMiniSidebar"
                    class="flex-1 overflow-y-auto px-4 py-6"
                >
                    <div class="mb-8">
                        <p
                            class="mb-4 text-xs font-bold uppercase tracking-widest text-slate-400"
                        >
                            MENU
                        </p>
                        <ul class="space-y-1">
                            <li>
                                <router-link
                                    to="/admin/dashboard"
                                    class="group relative flex items-center justify-between rounded-lg px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                                    active-class="bg-blue-50 text-blue-700"
                                    v-slot="{ isActive }"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                                            ></path>
                                        </svg>
                                        Dashboard
                                    </div>
                                    <svg
                                        :class="[
                                            'h-4 w-4 text-slate-400 transition-transform duration-200 group-hover:text-slate-600',
                                            isActive
                                                ? 'rotate-90 text-blue-600'
                                                : '',
                                        ]"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5l7 7-7 7"
                                        ></path>
                                    </svg>
                                </router-link>
                            </li>
                        </ul>
                    </div>

                    <!-- DATA MASTER -->
                    <div class="mb-8">
                        <p
                            class="mb-4 text-xs font-bold uppercase tracking-widest text-slate-400"
                        >
                            DATA MASTER
                        </p>
                        <ul class="space-y-1">
                            <li>
                                <router-link
                                    to="/admin/skill"
                                    class="group relative flex items-center justify-between rounded-lg px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                                    active-class="bg-blue-50 text-blue-700"
                                    v-slot="{ isActive }"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                                            ></path>
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                            ></path>
                                        </svg>
                                        Skill
                                    </div>
                                    <svg
                                        :class="[
                                            'h-4 w-4 text-slate-400 transition-transform duration-200 group-hover:text-slate-600',
                                            isActive
                                                ? 'rotate-90 text-blue-600'
                                                : '',
                                        ]"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5l7 7-7 7"
                                        ></path>
                                    </svg>
                                </router-link>
                            </li>
                            <li>
                                <router-link
                                    to="/admin/career"
                                    class="group relative flex items-center justify-between rounded-lg px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                                    active-class="bg-blue-50 text-blue-700"
                                    v-slot="{ isActive }"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                            ></path>
                                        </svg>
                                        Karier
                                    </div>
                                    <svg
                                        :class="[
                                            'h-4 w-4 text-slate-400 transition-transform duration-200 group-hover:text-slate-600',
                                            isActive
                                                ? 'rotate-90 text-blue-600'
                                                : '',
                                        ]"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5l7 7-7 7"
                                        ></path>
                                    </svg>
                                </router-link>
                            </li>
                            <li>
                                <router-link
                                    to="/admin/internship"
                                    class="group relative flex items-center justify-between rounded-lg px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                                    active-class="bg-blue-50 text-blue-700"
                                    v-slot="{ isActive }"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"
                                            ></path>
                                        </svg>
                                        Magang
                                    </div>
                                    <svg
                                        :class="[
                                            'h-4 w-4 text-slate-400 transition-transform duration-200 group-hover:text-slate-600',
                                            isActive
                                                ? 'rotate-90 text-blue-600'
                                                : '',
                                        ]"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5l7 7-7 7"
                                        ></path>
                                    </svg>
                                </router-link>
                            </li>
                        </ul>
                    </div>

                    <!-- CAREER ENGINE -->
                    <div class="mb-8">
                        <p
                            class="mb-4 text-xs font-bold uppercase tracking-widest text-slate-400"
                        >
                            CAREER ENGINE
                        </p>
                        <ul class="space-y-1">
                            <li>
                                <router-link
                                    to="/admin/mapping"
                                    class="group relative flex items-center justify-between rounded-lg px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                                    active-class="bg-blue-50 text-blue-700"
                                    v-slot="{ isActive }"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"
                                            ></path>
                                        </svg>
                                        Pemetaan Skill Karier
                                    </div>
                                    <svg
                                        :class="[
                                            'h-4 w-4 text-slate-400 transition-transform duration-200 group-hover:text-slate-600',
                                            isActive
                                                ? 'rotate-90 text-blue-600'
                                                : '',
                                        ]"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5l7 7-7 7"
                                        ></path>
                                    </svg>
                                </router-link>
                            </li>
                        </ul>
                    </div>

                    <!-- PENGGUNA -->
                    <div class="mb-8">
                        <p
                            class="mb-4 text-xs font-bold uppercase tracking-widest text-slate-400"
                        >
                            PENGGUNA
                        </p>
                        <ul class="space-y-1">
                            <li>
                                <router-link
                                    to="/admin/student"
                                    class="group relative flex items-center justify-between rounded-lg px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                                    active-class="bg-blue-50 text-blue-700"
                                    v-slot="{ isActive }"
                                >
                                    <div class="flex items-center gap-3">
                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4"
                                            />
                                        </svg>
                                        Mahasiswa
                                    </div>
                                    <svg
                                        :class="[
                                            'h-4 w-4 text-slate-400 transition-transform duration-200 group-hover:text-slate-600',
                                            isActive
                                                ? 'rotate-90 text-blue-600'
                                                : '',
                                        ]"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5l7 7-7 7"
                                        ></path>
                                    </svg>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Tampilan sidebar mini saat tertutup - hanya menampilkan ikon menu -->
                <div v-else class="flex-1 overflow-y-auto py-4">
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <router-link
                                to="/admin/dashboard"
                                class="group flex items-center justify-center rounded-lg px-2 py-3 text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                                active-class="bg-blue-50 text-blue-700"
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                                    ></path>
                                </svg>
                            </router-link>

                            <router-link
                                to="/admin/skill"
                                class="group flex items-center justify-center rounded-lg px-2 py-3 text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                                active-class="bg-blue-50 text-blue-700"
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                                    ></path>
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    ></path>
                                </svg>
                            </router-link>

                            <router-link
                                to="/admin/career"
                                class="group flex items-center justify-center rounded-lg px-2 py-3 text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                                active-class="bg-blue-50 text-blue-700"
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    ></path>
                                </svg>
                            </router-link>

                            <router-link
                                to="/admin/internship"
                                class="group flex items-center justify-center rounded-lg px-2 py-3 text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                                active-class="bg-blue-50 text-blue-700"
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"
                                    ></path>
                                </svg>
                            </router-link>

                            <router-link
                                to="/admin/mapping"
                                class="group flex items-center justify-center rounded-lg px-2 py-3 text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                                active-class="bg-blue-50 text-blue-700"
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"
                                    ></path>
                                </svg>
                            </router-link>

                            <router-link
                                to="/admin/student"
                                class="group flex items-center justify-center rounded-lg px-2 py-3 text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                                active-class="bg-blue-50 text-blue-700"
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4"
                                    />
                                </svg>
                            </router-link>
                        </div>
                    </div>
                </div>
            </aside>

            <div
                :class="[
                    'flex flex-col flex-1 w-full transition-all duration-200 ease-in-out',
                    isMiniSidebar ? 'lg:ml-20' : 'lg:ml-72',
                ]"
            >
                <header
                    class="sticky top-0 z-20 border-b border-slate-200 bg-white/90 backdrop-blur"
                >
                    <div
                        class="relative flex items-center justify-between gap-3 px-4 py-3.5 sm:px-6 lg:px-8"
                    >
                        <!-- Kiri: tombol toggle sidebar + breadcrumb halaman -->
                        <div class="flex items-center gap-3 min-w-0">
                            <button
                                @click="toggleSidebar"
                                class="group relative inline-flex flex-shrink-0 items-center justify-center rounded-lg border border-slate-200 p-2 text-slate-600 transition-all duration-200 hover:bg-slate-50 hover:border-slate-300 active:scale-95"
                                :title="
                                    sidebarOpen
                                        ? 'Collapse sidebar'
                                        : 'Expand sidebar'
                                "
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    ></path>
                                </svg>
                            </button>

                            <!-- Breadcrumb / judul halaman, disembunyikan di layar sangat kecil saat search mobile aktif -->
                            <div
                                v-show="!mobileSearchOpen"
                                class="hidden min-w-0 flex-col sm:flex"
                            >
                                <h1
                                    class="truncate text-base font-semibold text-slate-900"
                                >
                                    {{ pageTitle }}
                                </h1>
                                <p class="truncate text-xs text-slate-400">
                                    Admin Panel / {{ pageTitle }}
                                </p>
                            </div>
                        </div>

                        <!-- Tengah: search bar desktop (selalu tampil di layar >= sm) -->
                        <div
                            ref="searchWrapRef"
                            class="relative hidden flex-1 sm:block"
                        >
                            <form
                                @submit.prevent="submitSearch"
                                class="flex items-center rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 shadow-sm transition-all duration-200 focus-within:border-blue-300 focus-within:bg-white focus-within:ring-2 focus-within:ring-blue-100 hover:border-slate-300 hover:bg-slate-100"
                            >
                                <svg
                                    class="mr-2 h-4 w-4 flex-shrink-0 text-slate-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"
                                    />
                                </svg>
                                <input
                                    ref="searchInputRef"
                                    v-model="searchQuery"
                                    type="text"
                                    placeholder="Cari mahasiswa, karier, skill..."
                                    class="w-full border-0 bg-transparent text-sm text-slate-600 outline-none placeholder:text-slate-400"
                                    @focus="searchFocused = true"
                                    @keydown.down.prevent="moveActiveResult(1)"
                                    @keydown.up.prevent="moveActiveResult(-1)"
                                />
                                <button
                                    v-if="searchQuery"
                                    type="button"
                                    @click="clearSearch"
                                    class="ml-2 flex-shrink-0 rounded-full p-1 text-slate-400 transition hover:bg-slate-200 hover:text-slate-600"
                                    title="Bersihkan pencarian"
                                >
                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </form>

                            <!-- Dropdown hasil pencarian (desktop) -->
                            <Transition
                                enter-active-class="transition duration-150 ease-out"
                                enter-from-class="opacity-0 -translate-y-1"
                                enter-to-class="opacity-100 translate-y-0"
                                leave-active-class="transition duration-100 ease-in"
                                leave-from-class="opacity-100 translate-y-0"
                                leave-to-class="opacity-0 -translate-y-1"
                            >
                                <div
                                    v-if="showSuggestions"
                                    class="absolute left-0 right-0 top-full z-30 mt-2 overflow-hidden rounded-lg border border-slate-100 bg-white shadow-lg"
                                >
                                    <ul
                                        v-if="searchResults.length"
                                        class="max-h-72 overflow-y-auto py-1"
                                    >
                                        <li
                                            v-for="(item, idx) in searchResults"
                                            :key="item.path"
                                            @click="selectResult(item)"
                                            @mouseenter="
                                                activeResultIndex = idx
                                            "
                                            :class="[
                                                'flex cursor-pointer items-center gap-3 px-4 py-2.5 text-sm transition-colors',
                                                idx === activeResultIndex
                                                    ? 'bg-blue-50 text-blue-700'
                                                    : 'text-slate-600',
                                            ]"
                                        >
                                            <svg
                                                class="h-4 w-4 flex-shrink-0 text-slate-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 5l7 7-7 7"
                                                ></path>
                                            </svg>
                                            <div class="min-w-0">
                                                <p class="truncate font-medium">
                                                    {{ item.label }}
                                                </p>
                                                <p
                                                    class="truncate text-xs text-slate-400"
                                                >
                                                    {{ item.path }}
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                    <div
                                        v-else
                                        class="px-4 py-6 text-center text-sm text-slate-400"
                                    >
                                        Tidak ada menu yang cocok dengan "{{
                                            searchQuery
                                        }}"
                                    </div>
                                </div>
                            </Transition>
                        </div>

                        <!-- Overlay search mobile: di-teleport ke <body> supaya position:fixed-nya
                             tidak terpengaruh oleh backdrop-blur pada header (backdrop-filter membuat
                             containing block baru di banyak browser, ini penyebab overlay lama tidak
                             pernah presisi/berfungsi di mobile) -->
                        <Teleport to="body">
                            <Transition
                                enter-active-class="transition duration-150 ease-out"
                                enter-from-class="opacity-0"
                                enter-to-class="opacity-100"
                                leave-active-class="transition duration-100 ease-in"
                                leave-from-class="opacity-100"
                                leave-to-class="opacity-0"
                            >
                                <div
                                    v-if="mobileSearchOpen"
                                    class="fixed inset-0 z-[100] flex flex-col bg-white sm:hidden"
                                >
                                    <div
                                        class="flex items-center gap-2 border-b border-slate-200 px-3 py-3"
                                    >
                                        <button
                                            type="button"
                                            @click="closeMobileSearch"
                                            class="flex-shrink-0 rounded-lg p-2 text-slate-500 transition hover:bg-slate-100"
                                            title="Kembali"
                                        >
                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"
                                                />
                                            </svg>
                                        </button>
                                        <form
                                            @submit.prevent="submitSearch"
                                            class="flex flex-1 items-center rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 focus-within:border-blue-300 focus-within:bg-white"
                                        >
                                            <svg
                                                class="mr-2 h-4 w-4 flex-shrink-0 text-slate-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"
                                                />
                                            </svg>
                                            <input
                                                ref="mobileSearchInputRef"
                                                v-model="searchQuery"
                                                type="text"
                                                inputmode="search"
                                                placeholder="Cari mahasiswa, career, skill..."
                                                class="w-full border-0 bg-transparent text-sm text-slate-600 outline-none placeholder:text-slate-400"
                                                @keydown.down.prevent="
                                                    moveActiveResult(1)
                                                "
                                                @keydown.up.prevent="
                                                    moveActiveResult(-1)
                                                "
                                                @keyup.esc="closeMobileSearch"
                                            />
                                            <button
                                                v-if="searchQuery"
                                                type="button"
                                                @click="clearSearch"
                                                class="ml-2 flex-shrink-0 rounded-full p-1 text-slate-400 transition hover:bg-slate-200 hover:text-slate-600"
                                                title="Bersihkan pencarian"
                                            >
                                                <svg
                                                    class="h-4 w-4"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"
                                                    />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Hasil pencarian mobile: full list, tap langsung navigasi -->
                                    <ul
                                        v-if="searchResults.length"
                                        class="flex-1 overflow-y-auto py-2"
                                    >
                                        <li
                                            v-for="(item, idx) in searchResults"
                                            :key="item.path"
                                            @click="selectResult(item)"
                                            :class="[
                                                'flex cursor-pointer items-center gap-3 px-4 py-3 text-sm active:bg-slate-100',
                                                idx === activeResultIndex
                                                    ? 'bg-blue-50 text-blue-700'
                                                    : 'text-slate-600',
                                            ]"
                                        >
                                            <svg
                                                class="h-4 w-4 flex-shrink-0 text-slate-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 5l7 7-7 7"
                                                ></path>
                                            </svg>
                                            <div class="min-w-0">
                                                <p class="truncate font-medium">
                                                    {{ item.label }}
                                                </p>
                                                <p
                                                    class="truncate text-xs text-slate-400"
                                                >
                                                    {{ item.path }}
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                    <div
                                        v-else-if="searchQuery.trim()"
                                        class="flex-1 px-4 py-8 text-center text-sm text-slate-400"
                                    >
                                        Tidak ada menu yang cocok dengan "{{
                                            searchQuery
                                        }}"
                                    </div>
                                    <div
                                        v-else
                                        class="flex-1 px-4 py-8 text-center text-sm text-slate-400"
                                    >
                                        Ketik untuk mencari menu (mis.
                                        "student", "mapping")
                                    </div>
                                </div>
                            </Transition>
                        </Teleport>

                        <!-- Kanan: aksi + akun -->
                        <div
                            class="ml-auto flex flex-shrink-0 items-center gap-1.5 sm:gap-3"
                        >
                            <!-- tombol search khusus mobile -->
                            <button
                                v-if="!mobileSearchOpen"
                                @click="openMobileSearch"
                                class="inline-flex items-center justify-center rounded-lg border border-slate-200 p-2 text-slate-600 transition hover:bg-slate-50 hover:border-slate-300 sm:hidden"
                                title="Cari"
                            >
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z"
                                    />
                                </svg>
                            </button>

                            <!-- notifikasi -->
                            <div ref="notifRef" class="relative">
                                <button
                                    @click="notifOpen = !notifOpen"
                                    class="relative inline-flex items-center justify-center rounded-lg border border-slate-200 p-2 text-slate-600 transition hover:bg-slate-50 hover:border-slate-300"
                                    title="Notifikasi"
                                >
                                    <svg
                                        class="h-5 w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                                        ></path>
                                    </svg>
                                    <span
                                        v-if="unreadCount > 0"
                                        class="absolute -right-1 -top-1 flex h-4 min-w-[1rem] items-center justify-center rounded-full bg-red-500 px-1 text-[10px] font-semibold text-white"
                                    >
                                        {{
                                            unreadCount > 9 ? "9+" : unreadCount
                                        }}
                                    </span>
                                </button>

                                <Transition
                                    enter-active-class="transition duration-150 ease-out"
                                    enter-from-class="opacity-0 scale-95 -translate-y-1"
                                    enter-to-class="opacity-100 scale-100 translate-y-0"
                                    leave-active-class="transition duration-100 ease-in"
                                    leave-from-class="opacity-100 scale-100 translate-y-0"
                                    leave-to-class="opacity-0 scale-95 -translate-y-1"
                                >
                                    <div
                                        v-if="notifOpen"
                                        class="absolute right-0 z-50 mt-2 w-72 origin-top-right overflow-hidden rounded-xl border border-slate-100 bg-white py-2 shadow-xl text-slate-900"
                                    >
                                        <div
                                            class="flex items-center justify-between px-4 py-2"
                                        >
                                            <span class="text-sm font-semibold"
                                                >Notifikasi</span
                                            >
                                            <span
                                                v-if="unreadCount > 0"
                                                class="text-xs text-blue-600"
                                                >{{ unreadCount }} baru</span
                                            >
                                        </div>
                                        <hr class="border-t border-slate-100" />
                                        <div
                                            v-if="notifications.length === 0"
                                            class="px-4 py-6 text-center text-sm text-slate-400"
                                        >
                                            Belum ada notifikasi
                                        </div>
                                        <ul
                                            v-else
                                            class="max-h-72 overflow-y-auto"
                                        >
                                            <li
                                                v-for="n in notifications"
                                                :key="n.id"
                                                class="cursor-pointer px-4 py-3 text-sm transition-colors hover:bg-slate-50"
                                            >
                                                <p
                                                    class="font-medium text-slate-800"
                                                >
                                                    {{ n.title }}
                                                </p>
                                                <p
                                                    class="text-xs text-slate-400"
                                                >
                                                    {{ n.time }}
                                                </p>
                                            </li>
                                        </ul>
                                    </div>
                                </Transition>
                            </div>

                            <div
                                class="hidden rounded-full bg-blue-50 px-3 py-1 text-sm font-medium text-blue-700 sm:block"
                            >
                                Admin Panel
                            </div>

                            <!-- akun -->
                            <div ref="acctRef" class="relative">
                                <button
                                    @click="acctOpen = !acctOpen"
                                    class="flex items-center gap-2 rounded-full border border-slate-200 bg-white px-2 py-1.5 shadow-sm transition-shadow duration-200 hover:shadow-md sm:px-3"
                                >
                                    <div
                                        class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br from-blue-600 to-blue-700 text-sm font-semibold text-white"
                                    >
                                        {{ shortName }}
                                    </div>
                                    <div
                                        class="hidden text-left text-sm sm:block"
                                    >
                                        <p class="font-semibold text-slate-800">
                                            {{ displayName }}
                                        </p>
                                        <p class="text-xs text-slate-500">
                                            {{ displayRole }}
                                        </p>
                                    </div>
                                    <svg
                                        class="hidden h-4 w-4 text-slate-400 sm:block"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M19 9l-7 7-7-7"
                                        ></path>
                                    </svg>
                                </button>

                                <Transition
                                    enter-active-class="transition duration-150 ease-out"
                                    enter-from-class="opacity-0 scale-95 -translate-y-1"
                                    enter-to-class="opacity-100 scale-100 translate-y-0"
                                    leave-active-class="transition duration-100 ease-in"
                                    leave-from-class="opacity-100 scale-100 translate-y-0"
                                    leave-to-class="opacity-0 scale-95 -translate-y-1"
                                >
                                    <div
                                        v-if="acctOpen"
                                        class="absolute right-0 z-50 mt-2 w-64 origin-top-right overflow-hidden rounded-xl border border-slate-100 bg-white shadow-xl text-slate-900"
                                    >
                                        <!-- Header profil -->
                                        <div
                                            class="bg-gradient-to-br from-blue-600 to-blue-700 px-4 pb-8 pt-4"
                                        >
                                            <span
                                                class="inline-block rounded-full bg-white/15 px-2 py-0.5 text-[10px] font-medium uppercase tracking-wide text-blue-50"
                                            >
                                                {{ displayRole }}
                                            </span>
                                        </div>
                                        <div class="-mt-6 px-4">
                                            <div
                                                class="flex h-12 w-12 items-center justify-center rounded-full border-4 border-white bg-gradient-to-br from-blue-500 to-blue-600 text-base font-semibold text-white shadow-sm"
                                            >
                                                {{ shortName }}
                                            </div>
                                            <div class="mt-2 pb-4">
                                                <p
                                                    class="truncate text-sm font-semibold text-slate-900"
                                                >
                                                    {{ displayName }}
                                                </p>
                                                <p
                                                    class="truncate text-xs text-slate-500"
                                                >
                                                    {{ displayEmail }}
                                                </p>
                                            </div>
                                        </div>

                                        <hr class="border-t border-slate-100" />

                                        <ul class="py-1.5">
                                            <li>
                                                <button
                                                    class="flex w-full items-center gap-3 px-4 py-2.5 text-sm text-slate-700 transition-colors hover:bg-slate-50"
                                                    @click="gotoProfile"
                                                >
                                                    <svg
                                                        class="h-4 w-4 flex-shrink-0 text-slate-400"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                        ></path>
                                                    </svg>
                                                    Edit profile
                                                </button>
                                            </li>
                                            <li>
                                                <button
                                                    class="flex w-full items-center gap-3 px-4 py-2.5 text-sm text-slate-700 transition-colors hover:bg-slate-50"
                                                    @click="gotoAccount"
                                                >
                                                    <svg
                                                        class="h-4 w-4 flex-shrink-0 text-slate-400"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                                                        ></path>
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                        ></path>
                                                    </svg>
                                                    Account settings
                                                </button>
                                            </li>
                                            <li>
                                                <button
                                                    class="flex w-full items-center gap-3 px-4 py-2.5 text-sm text-slate-700 transition-colors hover:bg-slate-50"
                                                    @click="gotoSupport"
                                                >
                                                    <svg
                                                        class="h-4 w-4 flex-shrink-0 text-slate-400"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                                        ></path>
                                                    </svg>
                                                    Support
                                                </button>
                                            </li>
                                        </ul>

                                        <hr class="border-t border-slate-100" />

                                        <div class="p-2">
                                            <button
                                                @click="signOut"
                                                class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-red-600 transition-colors hover:bg-red-50"
                                            >
                                                <svg
                                                    class="h-4 w-4 flex-shrink-0"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                                    ></path>
                                                </svg>
                                                Sign out
                                            </button>
                                        </div>
                                    </div>
                                </Transition>
                            </div>
                        </div>
                    </div>
                </header>

                <main
                    class="flex-1 p-4 transition-all duration-200 sm:p-6 lg:p-8"
                >
                    <router-view />
                </main>
            </div>
        </div>
    </div>
</template>

<script setup>
import {
    ref,
    computed,
    watch,
    nextTick,
    onMounted,
    onBeforeUnmount,
} from "vue";
import { useRouter, useRoute } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import apiClient from "@/services/api";
import logo from "@/assets/logo.png";

const sidebarOpen = ref(true);
const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
};

const router = useRouter();
const route = useRoute();
const auth = useAuthStore();

/* ================== Judul halaman / breadcrumb ================== */
const routeTitleMap = {
    "/admin/dashboard": "Dashboard",
    "/admin/skill": "Skill",
    "/admin/career": "Karier",
    "/admin/internship": "Magang",
    "/admin/mapping": "Pemetaan Skill Karier",
    "/admin/student": "Mahasiswa",
};
const pageTitle = computed(() => {
    if (route.meta && route.meta.title) return route.meta.title;
    return routeTitleMap[route.path] || route.name || "Dashboard";
});

/* ================== Search (fungsional) ==================. */
const searchQuery = ref("");
const mobileSearchOpen = ref(false);
const searchInputRef = ref(null);
const mobileSearchInputRef = ref(null);
const searchWrapRef = ref(null);
const searchFocused = ref(false);
const activeResultIndex = ref(0);
let debounceTimer = null;

const emit = defineEmits(["search"]);

// Index menu yang bisa dicari (label + kata kunci + tujuan route)
const searchIndex = [
    {
        label: "Dashboard",
        path: "/admin/dashboard",
        keywords: ["dashboard", "beranda", "home"],
    },
    {
        label: "Skill",
        path: "/admin/skill",
        keywords: ["skill", "skills", "keahlian"],
    },
    {
        label: "Karier",
        path: "/admin/career",
        keywords: ["career", "careers", "karier", "pekerjaan", "karir"],
    },
    {
        label: "Magang",
        path: "/admin/internship",
        keywords: ["internship", "internships", "magang", "pkl"],
    },
    {
        label: "Pemetaan Skill Karier",
        path: "/admin/mapping",
        keywords: ["mapping", "pemetaan", "career skill"],
    },
    {
        label: "Mahasiswa",
        path: "/admin/student",
        keywords: ["student", "students", "mahasiswa", "siswa"],
    },
];

const searchResults = computed(() => {
    const q = searchQuery.value.trim().toLowerCase();
    if (!q) return [];
    return searchIndex
        .filter(
            (item) =>
                item.label.toLowerCase().includes(q) ||
                item.keywords.some((k) => k.includes(q) || q.includes(k)),
        )
        .slice(0, 6);
});

const showSuggestions = computed(
    () => searchFocused.value && searchQuery.value.trim().length > 0,
);

watch(searchResults, () => {
    activeResultIndex.value = 0;
});

function moveActiveResult(dir) {
    if (!searchResults.value.length) return;
    const len = searchResults.value.length;
    activeResultIndex.value = (activeResultIndex.value + dir + len) % len;
}

function selectResult(item) {
    router.push(item.path);
    searchQuery.value = "";
    searchFocused.value = false;
    if (mobileSearchOpen.value) closeMobileSearch();
}

function performSearch(value) {
    emit("search", value);
    // Sinkronkan ke query string URL supaya halaman anak yang mau ikut
    // menyaring datanya sendiri bisa membaca route.query.q
    router.replace({
        path: route.path,
        query: { ...route.query, q: value || undefined },
    });
}

// Live emit + sync URL dengan debounce ketika user mengetik
watch(searchQuery, (value) => {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => performSearch(value.trim()), 350);
});

function submitSearch() {
    clearTimeout(debounceTimer);
    // Enter → langsung ke hasil teratas kalau ada, kalau tidak baru sync biasa
    if (searchResults.value.length) {
        selectResult(
            searchResults.value[activeResultIndex.value] ||
                searchResults.value[0],
        );
        return;
    }
    performSearch(searchQuery.value.trim());
    if (mobileSearchOpen.value) closeMobileSearch();
}

function clearSearch() {
    searchQuery.value = "";
    performSearch("");
    searchInputRef.value?.focus();
}

async function openMobileSearch() {
    mobileSearchOpen.value = true;
    document.body.style.overflow = "hidden";
    await nextTick();
    mobileSearchInputRef.value?.focus();
}
function closeMobileSearch() {
    mobileSearchOpen.value = false;
    searchFocused.value = false;
    document.body.style.overflow = "";
}

// Ambil query awal dari URL (mis. saat reload halaman search)
onMounted(() => {
    if (route.query.q) searchQuery.value = String(route.query.q);
});

/* ================== Notifikasi ================== */
const notifOpen = ref(false);
const notifRef = ref(null);
const notifications = ref([]);
const unreadCount = computed(() => notifications.value.length);

async function fetchNotifications() {
    try {
        const res = await apiClient.get("/admin/notifications");
        notifications.value = res.data?.data || res.data || [];
    } catch (e) {
        // endpoint notifikasi belum tersedia / gagal diambil, biarkan kosong
        notifications.value = [];
    }
}

/* ================== Account dropdown ================== */
const acctOpen = ref(false);
const acctRef = ref(null);

const displayName = computed(() =>
    auth.user && auth.user.name ? auth.user.name : "Administrator",
);
const displayEmail = computed(() =>
    auth.user && auth.user.email ? auth.user.email : "randomuser@pimjo.com",
);
const displayRole = computed(() => {
    if (!auth.user) return "";
    return auth.user.role === "admin" ? "Administrator" : "Mahasiswa";
});
const shortName = computed(() => {
    if (auth.user && auth.user.name)
        return auth.user.name
            .split(" ")
            .map((n) => n[0])
            .join("")
            .slice(0, 2)
            .toUpperCase();
    return "A";
});

async function signOut() {
    try {
        await apiClient.post("/auth/logout");
    } catch (e) {
        console.log(e);
    }
    auth.logout();
    acctOpen.value = false;
    router.push("/login");
}

function gotoProfile() {
    acctOpen.value = false;
    router.push("/profile");
}
function gotoAccount() {
    acctOpen.value = false;
    router.push("/account");
}
function gotoSupport() {
    acctOpen.value = false;
    window.location.href = "/support";
}

function onClickOutside(e) {
    if (acctRef.value && !acctRef.value.contains(e.target))
        acctOpen.value = false;
    if (notifRef.value && !notifRef.value.contains(e.target))
        notifOpen.value = false;
    if (searchWrapRef.value && !searchWrapRef.value.contains(e.target)) {
        searchFocused.value = false;
    }
}

let unregisterAfter = null;
onMounted(() => {
    document.addEventListener("click", onClickOutside);
    fetchNotifications();

    if (router && router.afterEach)
        unregisterAfter = router.afterEach(() => {
            acctOpen.value = false;
            notifOpen.value = false;
            mobileSearchOpen.value = false;
            document.body.style.overflow = "";
            if (!isDesktop.value) sidebarOpen.value = false; // auto close di mobile/tablet
        });
});
onBeforeUnmount(() => {
    document.removeEventListener("click", onClickOutside);
    clearTimeout(debounceTimer);
    document.body.style.overflow = "";
    if (typeof unregisterAfter === "function") {
        try {
            unregisterAfter();
        } catch (e) {}
    }
});

/* ================== Responsive sidebar ================== */
const isDesktop = ref(window.innerWidth >= 1024);
function onResize() {
    isDesktop.value = window.innerWidth >= 1024;
}
onMounted(() => {
    window.addEventListener("resize", onResize);
    sidebarOpen.value = isDesktop.value;
});
onBeforeUnmount(() => window.removeEventListener("resize", onResize));

const isMiniSidebar = computed(() => isDesktop.value && !sidebarOpen.value);
</script>
