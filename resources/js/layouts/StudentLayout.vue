<template>
    <div class="min-h-screen bg-slate-100">
        <!-- Simple header for student layout -->
        <header
            class="sticky top-0 bg-white/80 backdrop-blur-xl border-b border-slate-200/60 relative z-40"
        >
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 gap-4">
                    <!-- Left: Logo -->
                    <div class="flex-1 flex items-center min-w-0">
                        <router-link
                            to="/student/dashboard"
                            class="flex items-center gap-2.5 shrink-0"
                        >
                            <img
                                :src="logo"
                                alt="CareerMateAI logo"
                                class="w-8 h-8 object-contain"
                            />
                            <span
                                class="font-display text-lg font-bold text-slate-900 tracking-tight"
                                >CareerMate</span
                            >
                        </router-link>
                    </div>

                    <!-- Center: Nav -->
                    <nav class="hidden lg:flex items-center gap-0.5 shrink-0">
                        <router-link
                            v-for="item in navItems"
                            :key="item.to"
                            :to="item.to"
                            class="px-3 py-2 text-sm font-medium rounded-lg whitespace-nowrap transition-colors"
                            :class="
                                isActive(item.to)
                                    ? 'text-blue-600 font-semibold'
                                    : 'text-slate-600 hover:text-slate-900'
                            "
                            >{{ item.label }}</router-link
                        >
                    </nav>

                    <!-- Right: Actions -->
                    <div
                        class="flex-1 flex items-center justify-end gap-2 sm:gap-3 min-w-0"
                    >
                        <!-- Search (desktop) -->
                        <div ref="searchEl" class="relative hidden xl:block">
                            <svg
                                class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 pointer-events-none"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-4.35-4.35M17 10.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z"
                                />
                            </svg>
                            <input
                                ref="searchInput"
                                v-model="searchQuery"
                                @focus="openSearch"
                                @keydown.enter.prevent="submitSearch"
                                @keydown.esc="closeSearch"
                                type="text"
                                placeholder="Cari halaman..."
                                class="h-10 w-48 pl-9 pr-9 text-sm rounded-xl border border-slate-200 bg-slate-50/70 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition placeholder:text-slate-400"
                            />
                            <span
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-[11px] font-semibold text-slate-300 border border-slate-200 rounded px-1.5 py-0.5"
                                >/</span
                            >
                            <transition name="dropdown">
                                <div
                                    v-if="searchOpen && searchResults.length"
                                    class="dropdown-panel absolute right-0 z-50 mt-2 w-72 rounded-xl border border-slate-100 bg-white shadow-xl shadow-slate-200/60 overflow-hidden"
                                >
                                    <button
                                        v-for="(item, i) in searchResults"
                                        :key="item.to"
                                        @click="goSearch(item.to)"
                                        class="flex w-full items-center justify-between gap-3 px-4 py-2.5 text-left text-sm text-slate-700 hover:bg-slate-50 hover:text-slate-900 transition-colors"
                                    >
                                        <span>{{ item.label }}</span>
                                        <span
                                            v-if="i === 0"
                                            class="text-[10px] font-bold text-slate-300"
                                            >↵</span
                                        >
                                    </button>
                                </div>
                                <div
                                    v-else-if="searchOpen && searchQuery"
                                    class="dropdown-panel absolute right-0 z-50 mt-2 w-72 rounded-xl border border-slate-100 bg-white shadow-xl shadow-slate-200/60 px-4 py-3 text-sm text-slate-400"
                                >
                                    Tidak ada halaman cocok
                                </div>
                            </transition>
                        </div>

                        <!-- Notification Bell -->
                        <!-- <div ref="notifRef" class="relative hidden sm:block">
                            <button
                                @click="notifOpen = !notifOpen"
                                class="flex items-center justify-center h-10 w-10 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition-colors relative"
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
                                    />
                                </svg>
                                <span
                                    class="absolute top-2.5 right-2.5 h-2 w-2 rounded-full bg-blue-600 ring-2 ring-white"
                                ></span>
                            </button>
                            <transition name="dropdown">
                                <div
                                    v-if="notifOpen"
                                    class="dropdown-panel absolute right-0 z-50 mt-2 w-72 rounded-xl border border-slate-100 bg-white shadow-xl shadow-slate-200/60 p-5 text-center"
                                >
                                    <div
                                        class="mx-auto w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center"
                                    >
                                        <svg
                                            class="h-5 w-5 text-blue-600"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                                            />
                                        </svg>
                                    </div>
                                    <p
                                        class="mt-3 text-sm font-semibold text-slate-700"
                                    >
                                        Belum ada notifikasi
                                    </p>
                                    <p class="text-xs text-slate-400 mt-1">
                                        Kabar baru akan muncul di sini.
                                    </p>
                                </div>
                            </transition>
                        </div> -->

                        <!-- Career Match Terakhir -->
                        <div ref="careerMatchRef" class="relative">
                            <button
                                @click="toggleCareerMatch"
                                class="flex items-center justify-center h-10 w-10 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition-colors"
                                title="Career Match Terakhir"
                                aria-label="Career Match Terakhir"
                            >
                                <!-- Target Icon -->
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="9"
                                        stroke-width="2"
                                    />
                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="5"
                                        stroke-width="2"
                                    />
                                    <circle
                                        cx="12"
                                        cy="12"
                                        r="1.5"
                                        fill="currentColor"
                                        stroke="none"
                                    />
                                </svg>
                            </button>

                            <transition name="dropdown">
                                <div
                                    v-if="careerMatchOpen"
                                    class="fixed left-3 right-3 top-[4.5rem] z-50 sm:absolute sm:left-auto sm:right-0 sm:top-full sm:mt-2 sm:w-80 rounded-xl border border-slate-100 bg-white shadow-xl shadow-slate-200/60 p-4"
                                >
                                    <!-- Header -->
                                    <div class="mb-4">
                                        <p
                                            class="text-sm font-semibold text-slate-800"
                                        >
                                            Rekomendasi Karier
                                        </p>
                                        <p class="text-xs text-slate-400 mt-1">
                                            Berdasarkan analisis CV terakhir
                                            kamu
                                        </p>
                                    </div>

                                    <!-- Loading -->
                                    <div
                                        v-if="careerMatchLoading"
                                        class="animate-pulse"
                                    >
                                        <div
                                            class="rounded-xl border border-slate-100 bg-slate-50 p-4"
                                        >
                                            <div
                                                class="flex items-center gap-3"
                                            >
                                                <div
                                                    class="h-10 w-10 shrink-0 rounded-lg bg-slate-200"
                                                ></div>
                                                <div
                                                    class="min-w-0 flex-1 space-y-2"
                                                >
                                                    <div
                                                        class="h-2.5 w-16 rounded bg-slate-200"
                                                    ></div>
                                                    <div
                                                        class="h-3 w-24 rounded bg-slate-200"
                                                    ></div>
                                                </div>
                                                <div
                                                    class="h-6 w-10 rounded bg-slate-200"
                                                ></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Profil belum lengkap -->
                                    <div
                                        v-else-if="!auth.isProfileComplete"
                                        class="rounded-xl border border-dashed border-amber-200 bg-amber-50/60 p-4 text-center"
                                    >
                                        <p
                                            class="text-sm font-medium text-amber-700"
                                        >
                                            Lengkapi profil dulu
                                        </p>
                                        <p
                                            class="text-xs text-amber-600/80 mt-1 leading-5"
                                        >
                                            Isi profil kamu biar bisa upload CV
                                            dan dapetin rekomendasi karier.
                                        </p>
                                    </div>

                                    <!-- Belum ada hasil analisis -->
                                    <div
                                        v-else-if="!hasCareerMatch"
                                        class="rounded-xl border border-dashed border-slate-200 bg-slate-50/60 p-4 text-center"
                                    >
                                        <p
                                            class="text-sm font-medium text-slate-600"
                                        >
                                            Belum ada hasil analisis
                                        </p>
                                        <p
                                            class="text-xs text-slate-400 mt-1 leading-5"
                                        >
                                            Upload CV kamu dulu buat dapetin
                                            rekomendasi karier.
                                        </p>
                                    </div>

                                    <!-- Career Match -->
                                    <div
                                        v-else
                                        class="rounded-xl border border-slate-100 bg-slate-50 p-4"
                                    >
                                        <div class="flex items-center gap-3">
                                            <!-- Icon -->
                                            <div
                                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-blue-600"
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
                                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622C17.176 19.29 21 14.591 21 9c0-1.042-.133-2.052-.382-3.016z"
                                                    />
                                                </svg>
                                            </div>

                                            <div class="min-w-0 flex-1">
                                                <p
                                                    class="text-xs text-slate-400"
                                                >
                                                    Career Match
                                                </p>
                                                <p
                                                    class="mt-0.5 text-sm font-semibold text-slate-700 truncate"
                                                >
                                                    {{
                                                        careerMatchData.career
                                                            ?.title
                                                    }}
                                                </p>
                                            </div>

                                            <div class="text-right shrink-0">
                                                <p
                                                    class="text-xl font-bold text-blue-600"
                                                >
                                                    {{
                                                        Math.round(
                                                            careerMatchData.match_score ??
                                                                0,
                                                        )
                                                    }}%
                                                </p>
                                                <p
                                                    class="text-[11px] text-slate-400"
                                                >
                                                    cocok
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Info -->
                                    <div
                                        v-if="
                                            !careerMatchLoading &&
                                            auth.isProfileComplete
                                        "
                                        class="mt-3 flex items-start gap-2"
                                    >
                                        <svg
                                            class="mt-0.5 h-4 w-4 shrink-0 text-slate-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M12 22a10 10 0 100-20 10 10 0 000 20z"
                                            />
                                        </svg>
                                        <p
                                            class="text-xs leading-5 text-slate-400"
                                        >
                                            {{
                                                hasCareerMatch
                                                    ? "Hasil ini berdasarkan skill yang terdeteksi dari CV terakhir kamu."
                                                    : "Rekomendasi karier akan muncul setelah CV kamu dianalisis."
                                            }}
                                        </p>
                                    </div>

                                    <!-- Button -->
                                    <button
                                        v-if="hasCareerMatch"
                                        @click="gotoHasilAnalisis"
                                        class="mt-4 w-full rounded-lg bg-slate-900 px-3 py-2.5 text-xs font-medium text-white hover:bg-slate-800 transition-colors"
                                    >
                                        Lihat Hasil Analisis
                                    </button>
                                    <button
                                        v-else-if="
                                            !careerMatchLoading &&
                                            auth.isProfileComplete
                                        "
                                        @click="
                                            careerMatchOpen = false;
                                            router.push('/student/cv');
                                        "
                                        class="mt-4 w-full rounded-lg bg-slate-900 px-3 py-2.5 text-xs font-medium text-white hover:bg-slate-800 transition-colors"
                                    >
                                        Upload CV Sekarang
                                    </button>
                                    <button
                                        v-else-if="!careerMatchLoading"
                                        @click="
                                            careerMatchOpen = false;
                                            router.push('/student/profile');
                                        "
                                        class="mt-4 w-full rounded-lg bg-amber-500 px-3 py-2.5 text-xs font-medium text-white hover:bg-amber-600 transition-colors"
                                    >
                                        Lengkapi Profil
                                    </button>
                                </div>
                            </transition>
                        </div>

                        <!-- Mobile Menu Button -->
                        <button
                            ref="mobBtnRef"
                            @click.stop="toggleMobile"
                            class="lg:hidden flex items-center justify-center h-10 w-10 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition-colors"
                            :aria-label="
                                mobileOpen ? 'Tutup menu' : 'Buka menu'
                            "
                        >
                            <svg
                                v-if="!mobileOpen"
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
                                />
                            </svg>
                            <svg
                                v-else
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

                        <!-- Account Dropdown -->
                        <div ref="stdRef" class="relative">
                            <button
                                @click="toggleAccountDropdown"
                                title="Menu akun"
                                aria-label="Menu akun"
                                class="h-9 w-9 rounded-full overflow-hidden transition-all duration-200"
                                :class="
                                    stdOpen
                                        ? 'ring-2 ring-blue-200'
                                        : 'hover:ring-2 hover:ring-blue-100'
                                "
                            >
                                <img
                                    v-if="accountAvatar"
                                    :src="accountAvatar"
                                    alt="Foto profil"
                                    class="h-full w-full object-cover"
                                />
                                <div
                                    v-else
                                    class="h-full w-full bg-blue-600 flex items-center justify-center text-white text-sm font-semibold"
                                >
                                    {{ shortInitial }}
                                </div>
                            </button>

                            <!-- Dropdown Panel -->
                            <transition name="dropdown">
                                <div
                                    v-if="stdOpen"
                                    class="dropdown-panel absolute right-0 z-50 mt-3 w-64 max-w-[calc(100vw-1.5rem)] rounded-xl border border-slate-100 bg-white shadow-xl shadow-slate-200/60"
                                >
                                    <!-- Profile Summary -->
                                    <div
                                        class="px-4 py-4 border-b border-slate-100"
                                    >
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="h-10 w-10 shrink-0 rounded-full overflow-hidden bg-blue-600 flex items-center justify-center text-white text-sm font-semibold"
                                            >
                                                <img
                                                    v-if="accountAvatar"
                                                    :src="accountAvatar"
                                                    alt="Foto profil"
                                                    class="h-full w-full object-cover"
                                                />
                                                <template v-else>
                                                    {{ shortInitial }}
                                                </template>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p
                                                    class="text-sm font-semibold text-slate-800 truncate"
                                                >
                                                    {{ displayName }}
                                                </p>
                                                <p
                                                    class="text-xs text-slate-400 truncate"
                                                >
                                                    {{ displayEmail }}
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Status badge -->
                                        <div class="mt-3">
                                            <span
                                                v-if="auth.isProfileComplete"
                                                class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-medium text-emerald-700 border border-emerald-100"
                                            >
                                                <svg
                                                    class="h-3 w-3"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="3"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                >
                                                    <polyline
                                                        points="20 6 9 17 4 12"
                                                    ></polyline>
                                                </svg>
                                                Profil Lengkap
                                            </span>
                                            <span
                                                v-else
                                                class="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2.5 py-1 text-[11px] font-medium text-amber-700 border border-amber-100"
                                            >
                                                <span
                                                    class="h-1.5 w-1.5 rounded-full bg-amber-500"
                                                ></span>
                                                Lengkapi Profil
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Menu -->
                                    <div class="p-1.5">
                                        <button
                                            @click="gotoProfile"
                                            class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors"
                                        >
                                            <svg
                                                class="h-4 w-4 text-slate-400"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            >
                                                <path
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                                ></path>
                                            </svg>
                                            <span class="flex-1 text-left"
                                                >Edit Profil</span
                                            >
                                        </button>

                                        <button
                                            @click="gotoRiwayat"
                                            class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors"
                                        >
                                            <svg
                                                class="h-4 w-4 text-slate-400"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            >
                                                <path
                                                    d="M3 12a9 9 0 109-9 9.75 9.75 0 00-6.74 2.74L3 8"
                                                ></path>
                                                <path d="M3 3v5h5"></path>
                                                <path d="M12 7v5l4 2"></path>
                                            </svg>
                                            <span class="flex-1 text-left"
                                                >Riwayat Analisis</span
                                            >
                                        </button>

                                        <button
                                            @click="gotoSupport"
                                            class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors"
                                        >
                                            <svg
                                                class="h-4 w-4 text-slate-400"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            >
                                                <path
                                                    d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"
                                                ></path>
                                            </svg>
                                            <span class="flex-1 text-left"
                                                >Pusat Bantuan</span
                                            >
                                        </button>
                                    </div>

                                    <div
                                        class="mx-3 border-t border-slate-100"
                                    ></div>

                                    <!-- Logout -->
                                    <div class="p-1.5">
                                        <button
                                            @click="signOut"
                                            class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm font-medium text-rose-600 hover:bg-rose-50 transition-colors"
                                        >
                                            <svg
                                                class="h-4 w-4"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            >
                                                <path
                                                    d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"
                                                ></path>
                                                <polyline
                                                    points="16 17 21 12 16 7"
                                                ></polyline>
                                                <line
                                                    x1="21"
                                                    y1="12"
                                                    x2="9"
                                                    y2="12"
                                                ></line>
                                            </svg>
                                            <span class="flex-1 text-left"
                                                >Keluar</span
                                            >
                                        </button>
                                    </div>
                                </div>
                            </transition>
                        </div>
                    </div>
                </div>

                <!-- Mobile Nav Panel -->
                <transition name="mobile-nav">
                    <nav
                        v-if="mobileOpen"
                        ref="mobRef"
                        class="lg:hidden pb-3 pt-2 border-t border-slate-100 space-y-0.5"
                    >
                        <!-- Mobile Search -->
                        <div class="relative px-1 pb-2">
                            <svg
                                class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 pointer-events-none"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-4.35-4.35M17 10.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z"
                                />
                            </svg>
                            <input
                                v-model="mobileSearch"
                                @keydown.enter.prevent="submitMobileSearch"
                                type="text"
                                placeholder="Cari halaman..."
                                class="w-full h-10 pl-9 pr-3 text-sm rounded-xl border border-slate-200 bg-slate-50/70 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition placeholder:text-slate-400"
                            />
                        </div>

                        <router-link
                            v-for="item in mobileNavItems"
                            :key="item.to"
                            :to="item.to"
                            @click="closeMobileNav"
                            class="block px-3 py-2.5 text-sm font-medium text-slate-600 rounded-lg hover:bg-slate-100 hover:text-slate-900 transition-colors"
                            active-class="text-blue-600 font-semibold bg-blue-50"
                            >{{ item.label }}</router-link
                        >

                        <p
                            v-if="mobileSearch && !mobileNavItems.length"
                            class="px-3 py-2.5 text-sm text-slate-400"
                        >
                            Tidak ada halaman cocok
                        </p>
                    </nav>
                </transition>
            </div>
        </header>

        <!-- Content -->
        <main>
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <router-view />
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount, watch } from "vue";
import { useRouter, useRoute } from "vue-router";
import { useAuthStore } from "@/stores/auth";
import apiClient from "@/services/api";
import logo from "@/assets/logo.png";
import analysisService from "@/services/student/analysisService";

// Komponen layout student sederhana
const stdOpen = ref(false);
const mobileOpen = ref(false);
const stdRef = ref(null);
const mobRef = ref(null);
const mobBtnRef = ref(null);
const lastMobileToggle = ref(0);
const searchQuery = ref("");
const mobileSearch = ref("");
const searchOpen = ref(false);
const searchEl = ref(null);
const searchInput = ref(null);
const notifOpen = ref(false);
const notifRef = ref(null);
const router = useRouter();
const route = useRoute();
const auth = useAuthStore();

//untuk fitur career match terakhir diheader
const careerMatchOpen = ref(false);
const careerMatchLoading = ref(true);
const careerMatchData = ref(null);
const careerMatchRef = ref(null);

async function fetchLatestCareerMatch() {
    if (!auth.token || !auth.isProfileComplete) {
        careerMatchLoading.value = false;
        return;
    }

    careerMatchLoading.value = true;
    try {
        const result = await analysisService.getLatest();
        careerMatchData.value = result.data;
    } catch (e) {
        careerMatchData.value = null;
    } finally {
        careerMatchLoading.value = false;
    }
}

const hasCareerMatch = computed(() => !!careerMatchData.value?.career);

function gotoHasilAnalisis() {
    careerMatchOpen.value = false;
    router.push("/student/hasilAnalisis");
}
// end

watch(
    () => route.path,
    () => {
        fetchLatestCareerMatch();
    },
);

function closeAllDropdowns() {
    careerMatchOpen.value = false;
    stdOpen.value = false;
    mobileOpen.value = false;
    mobileSearch.value = "";
    searchOpen.value = false;
    notifOpen.value = false;
}

function toggleCareerMatch() {
    const opening = !careerMatchOpen.value;
    closeAllDropdowns();
    careerMatchOpen.value = opening;
}

function toggleAccountDropdown() {
    const opening = !stdOpen.value;
    closeAllDropdowns();
    stdOpen.value = opening;
}

function openSearch() {
    closeAllDropdowns();
    searchOpen.value = true;
}

const navItems = [
    { to: "/student/dashboard", label: "Dashboard" },
    { to: "/student/profile", label: "Profile" },
    { to: "/student/cv", label: "Upload CV" },
    { to: "/student/hasilAnalisis", label: "Hasil Analisis" },
    { to: "/student/riwayatAnalisis", label: "Riwayat Analisis" },
    { to: "/student/support", label: "Support" },
];

function isActive(path) {
    return route.path === path || route.path.startsWith(path + "/");
}

const searchResults = computed(() => {
    const q = searchQuery.value.trim().toLowerCase();
    if (!q) return [];
    return navItems.filter((i) => i.label.toLowerCase().includes(q));
});

function closeSearch() {
    searchOpen.value = false;
    searchQuery.value = "";
    searchInput.value?.blur();
}
function submitSearch() {
    const results = searchResults.value;
    if (results.length) {
        closeSearch();
        router.push(results[0].to);
    }
}
function goSearch(to) {
    closeSearch();
    router.push(to);
}

const mobileNavItems = computed(() => {
    const q = mobileSearch.value.trim().toLowerCase();
    if (!q) return navItems;
    return navItems.filter((i) => i.label.toLowerCase().includes(q));
});

function submitMobileSearch() {
    const results = mobileNavItems.value;
    if (results.length) {
        closeMobileNav();
        router.push(results[0].to);
    }
}

function closeMobileNav() {
    mobileOpen.value = false;
    mobileSearch.value = "";
}
function onKeydown(e) {
    if (e.key !== "/") return;
    const tag = e.target?.tagName;
    if (tag !== "INPUT" && tag !== "TEXTAREA") {
        e.preventDefault();
        searchInput.value?.focus();
    }
}

const displayName = computed(() => auth.user?.name || "Student User");
const displayEmail = computed(() => auth.user?.email || "");
const displayRole = computed(() => auth.user?.role ?? "Mahasiswa");
const accountAvatar = computed(
    () => auth.user?.student_profile?.photo_url || null,
);
const shortInitial = computed(() => {
    if (!auth.user?.name) return "S";

    return auth.user.name
        .split(" ")
        .map((n) => n[0])
        .join("")
        .substring(0, 2)
        .toUpperCase();
});
async function signOut() {
    try {
        await apiClient.post("/auth/logout");
    } catch (e) {
        console.log(e);
    }

    auth.logout();

    stdOpen.value = false;

    router.push("/login");
}
function gotoProfile() {
    stdOpen.value = false;
    router.push("/student/profile");
}
function gotoRiwayat() {
    stdOpen.value = false;
    router.push("/student/riwayatAnalisis");
}
function gotoSupport() {
    stdOpen.value = false;
    router.push("/student/support");
}

function toggleMobile() {
    const now = Date.now();
    if (now - lastMobileToggle.value < 400) return;
    lastMobileToggle.value = now;
    const opening = !mobileOpen.value;
    closeAllDropdowns();
    mobileOpen.value = opening;
}

function onClickOutside(e) {
    const stdEl = stdRef.value;
    const mobEl = mobRef.value;
    const searchElRef = searchEl.value;
    const notifEl = notifRef.value;
    const careerMatchEl = careerMatchRef.value;
    if (stdEl && !stdEl.contains(e.target)) stdOpen.value = false;
    if (mobEl && !mobEl.contains(e.target)) mobileOpen.value = false;
    if (searchElRef && !searchElRef.contains(e.target))
        searchOpen.value = false;
    if (notifEl && !notifEl.contains(e.target)) notifOpen.value = false;
    if (careerMatchEl && !careerMatchEl.contains(e.target))
        careerMatchOpen.value = false;
}

onMounted(async () => {
    document.addEventListener("click", onClickOutside);
    document.addEventListener("keydown", onKeydown);

    if (auth.token) {
        try {
            await auth.fetchMe();
        } catch (e) {
            console.log("Auth me gagal", e);
        }
        fetchLatestCareerMatch();
    }
});
onBeforeUnmount(() => {
    document.removeEventListener("click", onClickOutside);
    document.removeEventListener("keydown", onKeydown);
});
</script>

<style scoped>
/* Dropdown Panel */
.dropdown-panel {
    transform-origin: top right;
}

.dropdown-enter-active,
.dropdown-leave-active {
    transition:
        transform 0.18s cubic-bezier(0.16, 1, 0.3, 1),
        opacity 0.16s ease;
}
.dropdown-enter-from,
.dropdown-leave-to {
    opacity: 0;
    transform: translateY(6px) scale(0.98);
}

/* Mobile nav panel */
.mobile-nav-enter-active,
.mobile-nav-leave-active {
    transition:
        transform 0.2s cubic-bezier(0.16, 1, 0.3, 1),
        opacity 0.18s ease;
}
.mobile-nav-enter-from,
.mobile-nav-leave-to {
    opacity: 0;
    transform: translateY(-6px);
}

@media (prefers-reduced-motion: reduce) {
    .dropdown-enter-active,
    .dropdown-leave-active,
    .mobile-nav-enter-active,
    .mobile-nav-leave-active {
        transition: none;
    }
    .dropdown-enter-from,
    .dropdown-leave-to,
    .mobile-nav-enter-from,
    .mobile-nav-leave-to {
        transform: none;
        opacity: 0;
    }
}
</style>
