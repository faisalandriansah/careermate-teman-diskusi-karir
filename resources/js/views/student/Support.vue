<template>
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- ========== HERO HERO HERO ========== -->
        <div
            class="support-hero relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 p-6 md:p-12 mb-8 shadow-2xl fade-up"
        >
            <!-- Ambient Orbs -->
            <div class="orb orb-blue"></div>
            <div class="orb orb-indigo"></div>
            <div class="orb orb-amber"></div>

            <!-- Grid Pattern Background -->
            <div
                class="absolute inset-0 opacity-[0.07] support-grid pointer-events-none"
            ></div>

            <!-- Floating 3D Help Icon -->
            <div
                class="hero-icon absolute right-8 md:right-16 top-1/2 -translate-y-1/2 hidden lg:flex"
            >
                <div class="float-3d float-anim">
                    <div
                        class="w-32 h-32 rounded-3xl bg-gradient-to-br from-indigo-500 via-violet-500 to-indigo-700 flex items-center justify-center shadow-2xl shadow-indigo-500/40 border border-white/10"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-16 h-16 text-white/90 drop-shadow-lg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.6"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path
                                d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"
                            ></path>
                            <path
                                d="M12 8a2 2 0 1 0-1.83 1.15A2 2 0 1 1 12 11"
                            ></path>
                            <path d="M12 14h.01"></path>
                        </svg>
                    </div>
                    <!-- Floating mini badges around icon -->
                    <div
                        class="float-badge absolute -left-6 top-6 bg-white text-slate-800 text-xs font-bold px-3 py-1.5 rounded-xl shadow-lg float-anim-delay"
                    >
                        💬 24/7
                    </div>
                    <div
                        class="float-badge absolute -bottom-3 -right-4 bg-emerald-500 text-white text-xs font-bold px-3 py-1.5 rounded-xl shadow-lg shadow-emerald-500/30 float-anim-delay2"
                    >
                        ⚡ Respon Cepat
                    </div>
                </div>
            </div>

            <!-- Hero Content -->
            <div class="relative z-10 max-w-xl">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/10 backdrop-blur-md text-indigo-200 text-[11px] font-semibold uppercase tracking-widest mb-4"
                >
                    <span
                        class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"
                    ></span>
                    Support Center
                </div>
                <h1
                    class="text-3xl md:text-4xl font-bold text-white leading-tight"
                >
                    Kami Siap
                    <span
                        class="bg-gradient-to-r from-indigo-300 via-violet-300 to-fuchsia-300 bg-clip-text text-transparent"
                        >Membantu Kamu</span
                    >
                    🚀
                </h1>
                <p class="mt-3 text-sm md:text-base text-indigo-200/80 max-w-md leading-relaxed">
                    Pusat bantuan CareerMate. Tim support kami online untuk
                    menjawab kendala teknis, pertanyaan kuota, dan seputar
                    analisis CV berbasis AI.
                </p>

                <!-- Stats Row -->
                <div class="mt-7 grid grid-cols-3 gap-3 max-w-sm">
                    <div
                        class="bg-white/5 backdrop-blur-md rounded-2xl border border-white/10 px-3 py-3 text-center"
                    >
                        <p class="text-xl md:text-2xl font-bold text-white">
                            &lt; 5<span class="text-indigo-300">mnt</span>
                        </p>
                        <p class="text-[10px] text-indigo-200/70 mt-0.5">
                            Rata-rata respon
                        </p>
                    </div>
                    <div
                        class="bg-white/5 backdrop-blur-md rounded-2xl border border-white/10 px-3 py-3 text-center"
                    >
                        <p class="text-xl md:text-2xl font-bold text-white">
                            24/7
                        </p>
                        <p class="text-[10px] text-indigo-200/70 mt-0.5">
                            Layanan aktif
                        </p>
                    </div>
                    <div
                        class="bg-white/5 backdrop-blur-md rounded-2xl border border-white/10 px-3 py-3 text-center"
                    >
                        <p class="text-xl md:text-2xl font-bold text-white">
                            99%
                        </p>
                        <p class="text-[10px] text-indigo-200/70 mt-0.5">
                            Masalah teratasi
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== 3D TILT MAIN CARD ========== -->
        <div class="perspective-1200">
            <div
                ref="cardRef"
                @mousemove="handleMouseMove"
                @mouseleave="handleMouseLeave"
                class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/60 overflow-hidden relative group transform-preserve-3d transition-shadow duration-300"
                :style="cardTransformStyle"
            >
                <!-- Glare / Spotlight -->
                <div
                    class="pointer-events-none absolute -inset-full opacity-0 group-hover:opacity-100 transition-opacity duration-500 bg-[radial-gradient(circle_at_var(--mouse-x)_var(--mouse-y),rgba(99,102,241,0.15),transparent_45%)] z-10"
                ></div>
                <!-- Edge glow line top -->
                <div
                    class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-indigo-400/60 to-transparent z-30"
                ></div>

                <!-- Contact Info Cards -->
                <div
                    class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-slate-100 border-b border-slate-100 relative z-20 translate-z-2"
                >
                    <!-- Email -->
                    <div
                        @mousemove="tiltCard"
                        @mouseleave="untiltCard"
                        class="tilt-card p-7 relative group/email"
                    >
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-blue-50/0 via-blue-50/0 to-blue-50/80 opacity-0 group-hover/email:opacity-100 transition-all duration-300 pointer-events-none"
                        ></div>
                        <a href="mailto:support@careermate.example" class="relative block">
                            <div
                                class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 text-white flex items-center justify-center mb-4 shadow-lg shadow-blue-500/30 group-hover/email:scale-110 group-hover/email:-rotate-6 transition-transform duration-300"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path
                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
                                    ></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </div>
                            <p
                                class="text-[11px] font-bold text-slate-400 uppercase tracking-wider"
                            >
                                Email Support
                            </p>
                            <p
                                class="text-sm font-semibold text-slate-800 group-hover/email:text-blue-600 transition mt-1 truncate"
                            >
                                support@careermate.example
                            </p>
                            <p
                                class="text-[11px] text-slate-400 mt-1 opacity-0 group-hover/email:opacity-100 transition"
                            >
                                Balasan dalam &lt; 24 jam →
                            </p>
                        </a>
                    </div>

                    <!-- Phone / WA -->
                    <div
                        @mousemove="tiltCard"
                        @mouseleave="untiltCard"
                        class="tilt-card p-7 relative group/wa"
                    >
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-emerald-50/0 via-emerald-50/0 to-emerald-50/80 opacity-0 group-hover/wa:opacity-100 transition-all duration-300 pointer-events-none"
                        ></div>
                        <a href="tel:+6281234567890" class="relative block">
                            <div
                                class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 text-white flex items-center justify-center mb-4 shadow-lg shadow-emerald-500/30 group-hover/wa:scale-110 group-hover/wa:-rotate-6 transition-transform duration-300"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"
                                    ></path>
                                </svg>
                            </div>
                            <p
                                class="text-[11px] font-bold text-slate-400 uppercase tracking-wider"
                            >
                                Hotline / WhatsApp
                            </p>
                            <p
                                class="text-sm font-semibold text-slate-800 group-hover/wa:text-emerald-600 transition mt-1 truncate"
                            >
                                +62 812-3456-7890
                            </p>
                            <p
                                class="text-[11px] text-slate-400 mt-1 opacity-0 group-hover/wa:opacity-100 transition"
                            >
                                Langsung ke tim support →
                            </p>
                        </a>
                    </div>

                    <!-- Working Hours -->
                    <div
                        @mousemove="tiltCard"
                        @mouseleave="untiltCard"
                        class="tilt-card p-7 relative group/hours"
                    >
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-amber-50/0 via-amber-50/0 to-amber-50/80 opacity-0 group-hover/hours:opacity-100 transition-all duration-300 pointer-events-none"
                        ></div>
                        <div class="relative block">
                            <div
                                class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-500 text-white flex items-center justify-center mb-4 shadow-lg shadow-amber-500/30 group-hover/hours:scale-110 group-hover/hours:rotate-6 transition-transform duration-300"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </div>
                            <p
                                class="text-[11px] font-bold text-slate-400 uppercase tracking-wider"
                            >
                                Jam Operasional
                            </p>
                            <p
                                class="text-sm font-semibold text-slate-800 mt-1 truncate"
                            >
                                Senin - Jumat (09:00 - 17:00 WIB)
                            </p>
                            <p
                                class="text-[11px] text-slate-400 mt-1"
                            >
                                Live chat 24/7 via WhatsApp
                            </p>
                        </div>
                    </div>
                </div>

                <!-- ========== FAQ + QUICK TOPICS ========== -->
                <div
                    class="p-6 sm:p-8 bg-slate-50/60 border-b border-slate-100 relative z-20 translate-z-2"
                >
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- FAQ Accordion -->
                        <div>
                            <p
                                class="text-xs font-bold text-indigo-600 uppercase tracking-wider mb-4 flex items-center gap-2"
                            >
                                <svg
                                    class="w-4 h-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                                Pertanyaan Umum
                            </p>
                            <div class="space-y-2.5">
                                <div
                                    v-for="(faq, i) in faqs"
                                    :key="faq.q"
                                    class="rounded-2xl bg-white border transition-all duration-300"
                                    :class="
                                        openFaq === i
                                            ? 'border-indigo-200 shadow-lg shadow-indigo-100'
                                            : 'border-slate-200/80 hover:border-indigo-200'
                                    "
                                >
                                    <button
                                        @click="openFaq = openFaq === i ? null : i"
                                        class="w-full flex items-center justify-between gap-3 p-4 text-left"
                                    >
                                        <span
                                            class="text-xs sm:text-[13px] font-semibold text-slate-800"
                                            :class="{ 'text-indigo-600': openFaq === i }"
                                        >
                                            {{ faq.q }}
                                        </span>
                                        <span
                                            class="shrink-0 w-6 h-6 rounded-full flex items-center justify-center transition-all duration-300"
                                            :class="
                                                openFaq === i
                                                    ? 'bg-indigo-600 text-white rotate-180'
                                                    : 'bg-slate-100 text-slate-500'
                                            "
                                        >
                                            <svg
                                                class="w-3.5 h-3.5"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2.5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            >
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                            </svg>
                                        </span>
                                    </button>
                                    <transition
                                        name="faq"
                                        @enter="setFaqHeight"
                                        @after-enter="clearFaqHeight"
                                        @before-leave="setFaqHeight"
                                        @after-leave="clearFaqHeight"
                                    >
                                        <div
                                            v-if="openFaq === i"
                                            class="overflow-hidden"
                                        >
                                            <div
                                                class="px-4 pb-4 text-xs text-slate-500 leading-relaxed"
                                            >
                                                {{ faq.a }}
                                            </div>
                                        </div>
                                    </transition>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Topics -->
                        <div>
                            <p
                                class="text-xs font-bold text-indigo-600 uppercase tracking-wider mb-4 flex items-center gap-2"
                            >
                                <svg
                                    class="w-4 h-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                                Topik Bantuan Populer
                            </p>
                            <div class="space-y-2.5">
                                <button
                                    v-for="topic in quickTopics"
                                    :key="topic.title"
                                    @click="openFaq = topic.faqIndex ?? null"
                                    class="tilt-card w-full p-4 rounded-2xl bg-white border border-slate-200/80 hover:border-indigo-200 shadow-xs hover:shadow-md transition-all duration-300 text-left group/topic relative overflow-hidden"
                                >
                                    <div
                                        class="absolute -right-6 -top-6 w-20 h-20 rounded-full opacity-10 group-hover/topic:opacity-25 transition group-hover/topic:scale-125"
                                        :style="{ background: topic.color }"
                                    ></div>
                                    <div class="flex items-center gap-3.5 relative">
                                        <span
                                            class="w-10 h-10 rounded-xl flex items-center justify-center text-xl shadow-sm shrink-0"
                                            :style="{
                                                background: topic.bg,
                                            }"
                                        >
                                            {{ topic.emoji }}
                                        </span>
                                        <div class="min-w-0">
                                            <p
                                                class="text-xs font-bold text-slate-800 group-hover/topic:text-indigo-600 transition"
                                            >
                                                {{ topic.title }}
                                            </p>
                                            <p
                                                class="text-[11px] text-slate-500 mt-0.5"
                                            >
                                                {{ topic.desc }}
                                            </p>
                                        </div>
                                        <svg
                                            class="w-4 h-4 text-slate-300 group-hover/topic:text-indigo-400 group-hover/topic:translate-x-1 transition ml-auto shrink-0"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <path d="M5 12h14"></path>
                                            <path d="M12 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </button>
                            </div>

                            <!-- CTA Card -->
                            <div
                                class="mt-4 p-4 rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600 text-white relative overflow-hidden"
                            >
                                <div class="orb orb-card"></div>
                                <div class="relative flex items-center gap-3.5">
                                    <span class="text-2xl">🛠️</span>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-xs font-bold">
                                            Tidak menemukan solusinya?
                                        </p>
                                        <p
                                            class="text-[11px] text-indigo-100/90 mt-0.5"
                                        >
                                            Buka tiket dan tim kami akan bantu
                                            langsung.
                                        </p>
                                    </div>
                                    <button
                                        @click="openTicketForm"
                                        class="shrink-0 px-3.5 py-2 rounded-xl bg-white text-indigo-700 text-xs font-bold hover:bg-indigo-50 transition shadow-md"
                                    >
                                        Buka Tiket
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========== LOCATION & MAP ========== -->
                <div
                    class="grid grid-cols-1 md:grid-cols-12 relative z-20 translate-z-2"
                >
                    <!-- Address Side -->
                    <div
                        class="md:col-span-5 p-6 sm:p-8 flex flex-col justify-between bg-white border-b md:border-b-0 md:border-r border-slate-100"
                    >
                        <div>
                            <div
                                class="flex items-center gap-2 text-indigo-600 mb-3"
                            >
                                <span
                                    class="w-8 h-8 rounded-xl bg-indigo-50 flex items-center justify-center"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <path
                                            d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"
                                        ></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </span>
                                <span
                                    class="text-xs font-bold uppercase tracking-wider"
                                    >Lokasi Kantor</span
                                >
                            </div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1.5">
                                Jakarta Head Office
                            </h3>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                {{ officeAddress }}
                            </p>

                            <!-- mini info -->
                            <div class="mt-4 space-y-2">
                                <div class="flex items-center gap-2 text-xs text-slate-500">
                                    <span class="text-emerald-500">●</span>
                                    Kunjungan: Sen–Jum 09.00–16.00
                                </div>
                                <div class="flex items-center gap-2 text-xs text-slate-500">
                                    <span class="text-indigo-500">●</span>
                                    Parkir tersedia di area Gedung Thamrin
                                </div>
                            </div>
                        </div>

                        <div
                            class="mt-6 pt-5 border-t border-slate-100 flex items-center gap-3"
                        >
                            <button
                                @click="copyAddress"
                                class="flex-1 py-2.5 px-3 rounded-xl border border-slate-200 text-slate-700 text-xs font-semibold hover:bg-slate-50 hover:border-slate-300 transition text-center active:scale-[0.98]"
                            >
                                {{
                                    isCopied
                                        ? "✓ Tersalin"
                                        : "📋 Salin Alamat"
                                }}
                            </button>
                            <a
                                :href="directionsUrl"
                                target="_blank"
                                class="flex-1 py-2.5 px-3 rounded-xl bg-indigo-600 text-white text-xs font-semibold hover:bg-indigo-700 transition text-center shadow-md shadow-indigo-600/20 active:scale-[0.98]"
                            >
                                Google Maps ↗
                            </a>
                        </div>
                    </div>

                    <!-- Map Embed Side -->
                    <div
                        class="md:col-span-7 h-64 md:h-auto min-h-[260px] relative bg-slate-100"
                    >
                        <iframe
                            class="w-full h-full border-0 filter grayscale-20 hover:grayscale-0 transition-all duration-300"
                            loading="lazy"
                            :src="mapEmbedUrl"
                        ></iframe>
                        <div
                            class="absolute top-3 left-3 px-3 py-1.5 rounded-xl bg-white/90 backdrop-blur shadow-md text-[10px] font-bold text-slate-600 flex items-center gap-1.5 pointer-events-none"
                        >
                            <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                            CareerMate HQ
                        </div>
                    </div>
                </div>

                <!-- ========== FOOTER CTA ========== -->
                <div
                    class="p-6 md:p-7 bg-slate-900 text-white flex flex-col sm:flex-row items-center justify-between gap-4 relative z-20 overflow-hidden translate-z-2"
                >
                    <div class="orb orb-footer"></div>
                    <div class="relative">
                        <p class="text-sm md:text-base font-bold">
                            Masih Mengalami Kendala Teknis?
                        </p>
                        <p class="text-xs text-slate-400 mt-0.5">
                            Buat tiket pengaduan agar ditangani langsung oleh
                            tim engineer kami.
                        </p>
                    </div>
                    <button
                        @click="openTicketForm"
                        class="relative w-full sm:w-auto px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-500 to-violet-500 hover:from-indigo-400 hover:to-violet-400 text-white text-xs font-semibold transition shadow-lg shadow-indigo-500/30 whitespace-nowrap active:scale-[0.98]"
                    >
                        Open Support Ticket
                    </button>
                </div>
            </div>
        </div>

        <!-- ========== TICKET MODAL ========== -->
        <transition name="modal">
            <div
                v-if="isModalOpen"
                class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 z-50"
                @click.self="isModalOpen = false"
            >
                <div
                    class="bg-white rounded-3xl w-full max-w-lg shadow-2xl border border-slate-100 overflow-hidden modal-pop"
                >
                    <!-- Modal Header -->
                    <div
                        class="relative p-6 bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 overflow-hidden"
                    >
                        <div class="orb orb-blue"></div>
                        <div class="orb orb-amber"></div>
                        <div class="relative flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-white">
                                    Buat Tiket Kendala
                                </h3>
                                <p class="text-xs text-indigo-200/80 mt-0.5">
                                    Tim engineer kami akan merespons maksimal 24
                                    jam.
                                </p>
                            </div>
                            <button
                                @click="isModalOpen = false"
                                class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-slate-200 flex items-center justify-center transition"
                            >
                                <svg
                                    class="w-4 h-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2.5"
                                    stroke-linecap="round"
                                >
                                    <path d="M18 6L6 18M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <form
                        class="p-6 space-y-4"
                        @submit.prevent="submitTicket"
                        novalidate
                    >
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5"
                                >
                                    Nama Lengkap
                                </label>
                                <input
                                    v-model="ticket.name"
                                    type="text"
                                    placeholder="Nama kamu"
                                    :class="[
                                        'w-full text-xs p-3 rounded-xl border focus:outline-none focus:ring-2 transition',
                                        errors.name
                                            ? 'border-rose-300 focus:ring-rose-200'
                                            : 'border-slate-200 focus:border-indigo-500 focus:ring-indigo-100',
                                    ]"
                                />
                                <p
                                    v-if="errors.name"
                                    class="text-[11px] text-rose-500 mt-1"
                                >
                                    {{ errors.name }}
                                </p>
                            </div>
                            <div>
                                <label
                                    class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5"
                                >
                                    Email
                                </label>
                                <input
                                    v-model="ticket.email"
                                    type="email"
                                    placeholder="email@kamu.com"
                                    :class="[
                                        'w-full text-xs p-3 rounded-xl border focus:outline-none focus:ring-2 transition',
                                        errors.email
                                            ? 'border-rose-300 focus:ring-rose-200'
                                            : 'border-slate-200 focus:border-indigo-500 focus:ring-indigo-100',
                                    ]"
                                />
                                <p
                                    v-if="errors.email"
                                    class="text-[11px] text-rose-500 mt-1"
                                >
                                    {{ errors.email }}
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5"
                                >
                                    Kategori
                                </label>
                                <select
                                    v-model="ticket.category"
                                    class="w-full text-xs p-3 rounded-xl border border-slate-200 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition bg-white"
                                >
                                    <option
                                        v-for="cat in categories"
                                        :key="cat"
                                        :value="cat"
                                    >
                                        {{ cat }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label
                                    class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5"
                                >
                                    Prioritas
                                </label>
                                <div class="grid grid-cols-3 gap-1.5">
                                    <button
                                        type="button"
                                        v-for="p in priorities"
                                        :key="p.value"
                                        @click="ticket.priority = p.value"
                                        class="py-2.5 rounded-xl text-[11px] font-bold border transition"
                                        :class="
                                            ticket.priority === p.value
                                                ? p.activeClass
                                                : 'border-slate-200 text-slate-500 hover:border-slate-300'
                                        "
                                    >
                                        {{ p.label }}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1.5"
                            >
                                Deskripsi Masalah
                            </label>
                            <textarea
                                v-model="ticket.message"
                                rows="4"
                                placeholder="Jelaskan masalah Anda secara detail... contoh: halaman analisis CV error saat upload file PDF."
                                :class="[
                                    'w-full text-xs p-3.5 rounded-xl border focus:outline-none focus:ring-2 transition resize-none',
                                    errors.message
                                        ? 'border-rose-300 focus:ring-rose-200'
                                        : 'border-slate-200 focus:border-indigo-500 focus:ring-indigo-100',
                                ]"
                            ></textarea>
                            <p
                                v-if="errors.message"
                                class="text-[11px] text-rose-500 mt-1"
                            >
                                {{ errors.message }}
                            </p>
                        </div>

                        <button
                            type="submit"
                            :disabled="sending"
                            class="w-full py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 text-white text-xs font-bold hover:from-indigo-500 hover:to-violet-500 transition shadow-lg shadow-indigo-500/25 active:scale-[0.99] disabled:opacity-60"
                        >
                            {{
                                sending
                                    ? "Mengirim Tiket..."
                                    : "Kirim Tiket Sekarang"
                            }}
                        </button>
                    </form>
                </div>
            </div>
        </transition>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";

const cardRef = ref(null);
const rotateX = ref(0);
const rotateY = ref(0);
const isCopied = ref(false);
const isModalOpen = ref(false);
const openFaq = ref(0);
const sending = ref(false);

const officeLat = -6.2;
const officeLng = 106.816666;
const officeAddress =
    "Jl. MH Thamrin No. 12, Menteng, Jakarta Pusat, DKI Jakarta 10350";

const faqs = [
    {
        q: "Kenapa hasil analisis CV saya berbeda dari CV asli?",
        a: "AI kami membaca teks yang bisa diekstrak dari file CV. Pastikan CV dalam format PDF dengan teks yang bisa diseleksi (bukan hasil scan/gambar) agar analisis lebih akurat.",
    },
    {
        q: "Bagaimana cara menambah kuota analisis?",
        a: "Kuota analisis dapat ditingkatkan melalui menu akun. Jika kamu masih mahasiswa aktif, hubungi admin kampus untuk mendapatkan tambahan kuota gratis.",
    },
    {
        q: "Apakah data CV saya aman dan privat?",
        a: "Ya, seluruh CV yang diunggah dienkripsi dan hanya dapat diakses oleh kamu serta admin internal yang berwenang. Data tidak pernah dibagikan ke pihak ketiga.",
    },
    {
        q: "Profil saya sudah lengkap tapi masih diminta lengkapi profil?",
        a: "Coba muat ulang halaman dashboard atau lakukan logout lalu login kembali. Pastikan kolom Universitas, Jurusan, Semester, dan No. HP sudah terisi semua.",
    },
];

const quickTopics = [
    {
        emoji: "📄",
        title: "Analisis CV Gagal",
        desc: "Format file tidak terbaca oleh AI",
        color: "#6366f1",
        bg: "#eef2ff",
        faqIndex: 0,
    },
    {
        emoji: "💳",
        title: "Pertanyaan Kuota",
        desc: "Masalah sisa kredit analisis",
        color: "#10b981",
        bg: "#ecfdf5",
        faqIndex: 1,
    },
    {
        emoji: "🔐",
        title: "Keamanan Akun",
        desc: "Ubah kata sandi & data pribadi",
        color: "#f59e0b",
        bg: "#fffbeb",
        faqIndex: 2,
    },
];

const categories = [
    "Akun & Login",
    "Analisis CV",
    "Kuota & Pembayaran",
    "Kendala Teknis",
    "Lainnya",
];

const priorities = [
    {
        label: "Rendah",
        value: "rendah",
        activeClass:
            "bg-slate-100 text-slate-700 border-slate-300",
    },
    {
        label: "Normal",
        value: "normal",
        activeClass:
            "bg-indigo-600 text-white border-indigo-600 shadow-md shadow-indigo-500/30",
    },
    {
        label: "Urgent",
        value: "urgent",
        activeClass:
            "bg-rose-600 text-white border-rose-600 shadow-md shadow-rose-500/30",
    },
];

const ticket = ref({
    name: "",
    email: "",
    category: "Kendala Teknis",
    priority: "normal",
    message: "",
});

const errors = ref({});

// ---- 3D Tilt (main card) ----
function handleMouseMove(e) {
    if (!cardRef.value) return;
    const rect = cardRef.value.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    const centerX = rect.width / 2;
    const centerY = rect.height / 2;

    rotateX.value = -((y - centerY) / centerY) * 6;
    rotateY.value = ((x - centerX) / centerX) * 8;

    cardRef.value.style.setProperty("--mouse-x", `${x}px`);
    cardRef.value.style.setProperty("--mouse-y", `${y}px`);
}

function handleMouseLeave() {
    rotateX.value = 0;
    rotateY.value = 0;
}

const cardTransformStyle = computed(() => ({
    transform: `rotateX(${rotateX.value}deg) rotateY(${rotateY.value}deg)`,
}));

// ---- Per-card magnetic tilt ----
function tiltCard(e) {
    const card = e.currentTarget;
    const rect = card.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    const rx = -((y - rect.height / 2) / rect.height) * 10;
    const ry = ((x - rect.width / 2) / rect.width) * 12;
    card.style.transform = `perspective(500px) rotateX(${rx}deg) rotateY(${ry}deg) translateY(-3px)`;
    card.style.boxShadow = "0 18px 35px -15px rgba(79, 70, 229, 0.25)";
    card.style.transition = "transform 0.1s ease-out";
}

function untiltCard(e) {
    const card = e.currentTarget;
    card.style.transform =
        "perspective(500px) rotateX(0deg) rotateY(0deg) translateY(0)";
    card.style.boxShadow = "";
    card.style.transition = "transform 0.45s cubic-bezier(0.16, 1, 0.3, 1)";
}

// ---- FAQ height animation ----
function setFaqHeight(el) {
    el.style.height = el.scrollHeight + "px";
}
function clearFaqHeight(el) {
    el.style.height = "";
}

// ---- Map & copy ----
const bbox = computed(() => {
    const d = 0.005;
    return `${officeLng - d}%2C${officeLat - d}%2C${officeLng + d}%2C${officeLat + d}`;
});

const mapEmbedUrl = computed(
    () =>
        `https://www.openstreetmap.org/export/embed.html?bbox=${bbox.value}&layer=mapnik&marker=${officeLat}%2C${officeLng}`,
);

const directionsUrl = computed(
    () =>
        `https://www.google.com/maps/dir/?api=1&destination=${officeLat},${officeLng}`,
);

function copyAddress() {
    navigator.clipboard.writeText(officeAddress);
    isCopied.value = true;
    setTimeout(() => (isCopied.value = false), 2000);
}

// ---- Ticket form ----
function openTicketForm() {
    errors.value = {};
    isModalOpen.value = true;
}

function validateTicket() {
    const errs = {};
    if (!ticket.value.name.trim()) errs.name = "Nama wajib diisi.";
    if (!ticket.value.email.trim()) {
        errs.email = "Email wajib diisi.";
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(ticket.value.email)) {
        errs.email = "Format email tidak valid.";
    }
    if (!ticket.value.message.trim()) {
        errs.message = "Deskripsi masalah wajib diisi.";
    } else if (ticket.value.message.trim().length < 10) {
        errs.message = "Minimal 10 karakter.";
    }
    return errs;
}

async function submitTicket() {
    errors.value = validateTicket();
    if (Object.keys(errors.value).length) return;

    sending.value = true;
    await new Promise((r) => setTimeout(r, 1200));
    sending.value = false;
    isModalOpen.value = false;
    ticket.value = {
        name: "",
        email: "",
        category: "Kendala Teknis",
        priority: "normal",
        message: "",
    };
}
</script>

<style scoped>
.fade-up {
    animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(14px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ===== 3D utilities ===== */
.perspective-1200 {
    perspective: 1200px;
}
.transform-preserve-3d {
    transform-style: preserve-3d;
    will-change: transform;
}
.translate-z-2 {
    transform: translateZ(16px);
}

/* ===== Orbs ===== */
.orb {
    position: absolute;
    border-radius: 9999px;
    filter: blur(48px);
    opacity: 0.3;
    pointer-events: none;
}
.orb-blue {
    width: 220px;
    height: 220px;
    background: #3b82f6;
    top: -70px;
    right: 30px;
}
.orb-indigo {
    width: 260px;
    height: 260px;
    background: #6366f1;
    bottom: -100px;
    left: -60px;
}
.orb-amber {
    width: 160px;
    height: 160px;
    background: #f59e0b;
    bottom: -40px;
    right: 140px;
}
.orb-card {
    width: 120px;
    height: 120px;
    background: #a78bfa;
    top: -50px;
    right: -40px;
}
.orb-footer {
    width: 160px;
    height: 160px;
    background: #6366f1;
    top: -60px;
    right: -30px;
}

/* Grid pattern */
.support-grid {
    background-image: linear-gradient(rgba(255, 255, 255, 0.5) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255, 255, 255, 0.5) 1px, transparent 1px);
    background-size: 44px 44px;
}

/* ===== Hero floating icon ===== */
.hero-icon {
    z-index: 1;
}
.float-anim {
    animation: floatY 6s ease-in-out infinite;
}
.float-anim-delay {
    animation: floatY 5s ease-in-out infinite 1s;
}
.float-anim-delay2 {
    animation: floatY 5.5s ease-in-out infinite 0.5s;
}
@keyframes floatY {
    0%,
    100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-16px) rotate(-2deg);
    }
}

/* ===== FAQ transition ===== */
.faq-enter-active,
.faq-leave-active {
    transition: height 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

/* ===== Modal transition ===== */
.modal-enter-active,
.modal-leave-active {
    transition: opacity 0.25s ease;
}
.modal-enter-from,
.modal-leave-to {
    opacity: 0;
}
.modal-enter-active .modal-pop,
.modal-leave-active .modal-pop {
    transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.25s ease;
}
.modal-enter-from .modal-pop,
.modal-leave-to .modal-pop {
    transform: translateY(20px) scale(0.95);
    opacity: 0;
}

@media (prefers-reduced-motion: reduce) {
    .float-anim,
    .float-anim-delay,
    .float-anim-delay2 {
        animation: none;
    }
    .fade-up {
        animation: none;
    }
}
</style>
