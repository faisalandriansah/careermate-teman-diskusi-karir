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
                                                d="M9 3h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V5a2 2 0 012-2z"
                                            ></path>
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 13h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6a2 2 0 012-2z"
                                            ></path>
                                        </svg>
                                        Dashboard
                                    </div>
                                    <svg
                                        class="h-4 w-4 text-slate-400 transition group-hover:text-slate-600"
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

                    <div class="mb-8">
                        <p
                            class="mb-4 text-xs font-bold uppercase tracking-widest text-slate-400"
                        >
                            DATA MANAGEMENT
                        </p>
                        <ul class="space-y-1">
                            <li>
                                <router-link
                                    to="/admin/skill"
                                    class="group relative flex items-center justify-between rounded-lg px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                                    active-class="bg-blue-50 text-blue-700"
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
                                        Skills
                                    </div>
                                    <svg
                                        class="h-4 w-4 text-slate-400 transition group-hover:text-slate-600"
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
                                        Careers
                                    </div>
                                    <svg
                                        class="h-4 w-4 text-slate-400 transition group-hover:text-slate-600"
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
                                        Internships
                                    </div>
                                    <svg
                                        class="h-4 w-4 text-slate-400 transition group-hover:text-slate-600"
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
                                    to="/admin/mapping"
                                    class="group relative flex items-center justify-between rounded-lg px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                                    active-class="bg-blue-50 text-blue-700"
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
                                        Skill Mapping
                                    </div>
                                    <span
                                        class="rounded-full bg-emerald-100 px-2 py-0.5 text-xs font-semibold text-emerald-700"
                                        >NEW</span
                                    >
                                </router-link>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <p
                            class="mb-4 text-xs font-bold uppercase tracking-widest text-slate-400"
                        >
                            SETTINGS
                        </p>
                        <ul class="space-y-1">
                            <li>
                                <a
                                    href="#"
                                    class="group relative flex items-center justify-between rounded-lg px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
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
                                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"
                                            ></path>
                                        </svg>
                                        Settings
                                    </div>
                                    <svg
                                        class="h-4 w-4 text-slate-400 transition group-hover:text-slate-600"
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
                                </a>
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="group relative flex items-center justify-between rounded-lg px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
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
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                            ></path>
                                        </svg>
                                        Help & Support
                                    </div>
                                    <svg
                                        class="h-4 w-4 text-slate-400 transition group-hover:text-slate-600"
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
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Tampilan sidebar mini saat tertutup - hanya menampilkan ikon menu -->
                <div v-else class="flex-1 overflow-y-auto py-4">
                    <div class="space-y-4">
                        <!-- Menu utama -->
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
                                        d="M9 3h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V5a2 2 0 012-2z"
                                    ></path>
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 13h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6a2 2 0 012-2z"
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
                        </div>

                        <!-- Bagian bawah sidebar mini -->
                        <div class="pt-4 mt-auto border-t border-slate-200">
                            <a
                                href="#"
                                class="flex justify-center rounded-lg px-2 py-3 text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
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
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                                    ></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Footer hanya muncul saat sidebar terbuka -->
                <div
                    v-if="!isMiniSidebar"
                    class="border-t border-slate-200 px-4 py-4"
                >
                    <a
                        href="#"
                        class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
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
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                            ></path>
                        </svg>
                        Documentation
                    </a>
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
                        class="flex items-center justify-between gap-3 px-4 py-4 sm:px-6 lg:px-8"
                    >
                        <button
                            @click="toggleSidebar"
                            class="group relative inline-flex items-center justify-center rounded-lg border border-slate-200 p-2 text-slate-600 transition-all duration-200 hover:bg-slate-50 hover:border-slate-300 active:scale-95"
                            :title="
                                sidebarOpen
                                    ? 'Collapse sidebar'
                                    : 'Expand sidebar'
                            "
                        >
                            <div class="relative h-5 w-5">
                                <svg
                                    class="absolute inset-0 h-5 w-5 transition-transform duration-200"
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
                            </div>

                            <span
                                class="absolute inset-0 rounded-lg transition-all duration-200 group-hover:bg-slate-100/50"
                            ></span>
                        </button>

                        <div class="flex flex-1 items-center gap-2 sm:gap-3">
                            <div
                                class="hidden flex-1 items-center rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 shadow-sm transition-all duration-200 sm:flex hover:border-slate-300 hover:bg-slate-100"
                            >
                                <svg
                                    class="mr-2 h-4 w-4 text-slate-400"
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
                                    type="text"
                                    placeholder="Search..."
                                    class="w-full border-0 bg-transparent text-sm text-slate-600 outline-none placeholder:text-slate-400 transition-all duration-200"
                                />
                            </div>
                            <div
                                class="ml-auto flex items-center gap-2 sm:gap-3"
                            >
                                <div
                                    class="rounded-full bg-blue-50 px-3 py-1 text-sm font-medium text-blue-700 transition-opacity duration-200"
                                >
                                    Admin Panel
                                </div>
                                <div ref="acctRef" class="relative">
                                    <button
                                        @click="acctOpen = !acctOpen"
                                        class="flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5 shadow-sm hover:shadow-md transition-shadow duration-200"
                                    >
                                        <div
                                            class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-blue-600 to-blue-700 text-sm font-semibold text-white"
                                        >
                                            {{ shortName }}
                                        </div>
                                        <div class="text-sm text-left">
                                            <p
                                                class="font-semibold text-slate-800"
                                            >
                                                {{ displayName }}
                                            </p>
                                            <p class="text-xs text-slate-500">
                                                {{ displayRole }}
                                            </p>
                                        </div>
                                    </button>

                                    <div
                                        v-show="acctOpen"
                                        class="absolute right-0 z-50 mt-2 w-56 rounded-lg border border-slate-100 bg-white py-3 shadow-lg text-slate-900"
                                    >
                                        <div class="px-4 pb-3">
                                            <div
                                                class="text-sm font-semibold text-slate-900"
                                            >
                                                {{ displayName }}
                                            </div>
                                            <div class="text-xs text-slate-500">
                                                {{ displayEmail }}
                                            </div>
                                        </div>
                                        <hr
                                            class="my-2 border-t border-slate-100"
                                        />
                                        <ul>
                                            <li>
                                                <button
                                                    class="flex w-full items-center gap-3 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50"
                                                    @click="gotoProfile"
                                                >
                                                    Edit profile
                                                </button>
                                            </li>
                                            <li>
                                                <button
                                                    class="flex w-full items-center gap-3 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50"
                                                    @click="gotoAccount"
                                                >
                                                    Account settings
                                                </button>
                                            </li>
                                            <li>
                                                <button
                                                    class="flex w-full items-center gap-3 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50"
                                                    @click="gotoSupport"
                                                >
                                                    Support
                                                </button>
                                            </li>
                                        </ul>
                                        <hr
                                            class="my-2 border-t border-slate-100"
                                        />
                                        <div class="px-3">
                                            <button
                                                @click="signOut"
                                                class="flex w-full items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50"
                                            >
                                                Sign out
                                            </button>
                                        </div>
                                    </div>
                                </div>
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
import { ref, computed, onMounted, onBeforeUnmount } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import apiClient from "@/services/api";
import logo from "@/assets/logo.png";

const sidebarOpen = ref(true);
const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
};

// Account dropdown logic
const acctOpen = ref(false);
const acctRef = ref(null);
const router = useRouter();
const auth = useAuthStore();

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
    const el = acctRef.value;
    if (!el) return;
    if (!el.contains(e.target)) acctOpen.value = false;
}

let unregisterAfter = null;
onMounted(() => {
    document.addEventListener("click", onClickOutside);
    window.addEventListener("resize", onResize);
    sidebarOpen.value = isDesktop.value;

    if (router && router.afterEach)
        unregisterAfter = router.afterEach(() => {
            acctOpen.value = false;
            if (!isDesktop.value) sidebarOpen.value = false; // auto close di mobile/tablet
        });
});
onBeforeUnmount(() => {
    document.removeEventListener("click", onClickOutside);
    if (typeof unregisterAfter === "function") {
        try {
            unregisterAfter();
        } catch (e) {}
    }
});

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
