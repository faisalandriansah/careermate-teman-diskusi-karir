<template>
    <div class="container mx-auto px-4 py-8 max-w-5xl perspective-1200">
        <!-- 3D Main Card Container -->
        <div
            ref="cardRef"
            @mousemove="handleMouseMove"
            @mouseleave="handleMouseLeave"
            class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden transition-transform duration-200 ease-out relative group transform-preserve-3d"
            :style="cardTransformStyle"
        >
            <!-- Dynamic Ambient Light (Glow Effect) -->
            <div
                class="pointer-events-none absolute -inset-full opacity-0 group-hover:opacity-20 transition-opacity duration-500 bg-[radial-gradient(circle_at_var(--mouse-x)_var(--mouse-y),rgba(99,102,241,0.6),transparent_40%)] z-10"
            ></div>

            <!-- Header Section -->
            <div
                class="p-6 sm:p-8 border-b border-slate-100 bg-gradient-to-r from-indigo-50/60 via-slate-50/30 to-white relative z-20"
            >
                <div
                    class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 translate-z-8"
                >
                    <div class="flex items-center gap-3.5">
                        <!-- Icon Badge Support -->
                        <div
                            class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center shrink-0 shadow-lg shadow-indigo-500/30"
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
                                    d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"
                                ></path>
                                <path d="M12 8v4"></path>
                                <path d="M12 16h.01"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-slate-800">
                                Support & Help Center
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                                Pusat bantuan & layanan komunikasi terpadu
                                CareerMate.
                            </p>
                        </div>
                    </div>

                    <!-- Quick Status Badge -->
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold w-fit"
                    >
                        <span
                            class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"
                        ></span>
                        <span>Tim Support Online</span>
                    </div>
                </div>
            </div>

            <!-- Contact Info Cards (3 Columns - Full Width) -->
            <div
                class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-slate-100 border-b border-slate-100 relative z-20"
            >
                <!-- Email -->
                <a
                    href="mailto:support@careermate.example"
                    class="p-6 hover:bg-indigo-50/30 transition group/item translate-z-4"
                >
                    <div
                        class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-3 group-hover/item:scale-110 transition-transform shadow-sm"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
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
                        class="text-sm font-semibold text-slate-800 group-hover/item:text-indigo-600 transition truncate mt-0.5"
                    >
                        support@careermate.example
                    </p>
                </a>

                <!-- Phone / WA -->
                <a
                    href="tel:+6281234567890"
                    class="p-6 hover:bg-emerald-50/30 transition group/item translate-z-4"
                >
                    <div
                        class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3 group-hover/item:scale-110 transition-transform shadow-sm"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
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
                        class="text-sm font-semibold text-slate-800 group-hover/item:text-emerald-600 transition truncate mt-0.5"
                    >
                        +62 812-3456-7890
                    </p>
                </a>

                <!-- Working Hours -->
                <div class="p-6 bg-slate-50/30 translate-z-4">
                    <div
                        class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-3 shadow-sm"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
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
                        class="text-sm font-semibold text-slate-800 truncate mt-0.5"
                    >
                        Senin - Jumat (09:00 - 17:00 WIB)
                    </p>
                </div>
            </div>

            <!-- Quick Topics / FAQ Highlights (Mengisi Space Kosong) -->
            <div
                class="p-6 sm:p-8 bg-slate-50/50 border-b border-slate-100 relative z-20"
            >
                <p
                    class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4"
                >
                    Topik Bantuan Populer
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div
                        v-for="topic in quickTopics"
                        :key="topic.title"
                        class="p-4 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-indigo-200 hover:shadow-md transition cursor-pointer group/topic"
                    >
                        <div class="flex items-center gap-3">
                            <span class="text-xl">{{ topic.emoji }}</span>
                            <div>
                                <p
                                    class="text-xs font-bold text-slate-800 group-hover/topic:text-indigo-600 transition"
                                >
                                    {{ topic.title }}
                                </p>
                                <p class="text-[11px] text-slate-500 mt-0.5">
                                    {{ topic.desc }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Location & Interactive Map Section -->
            <div class="grid grid-cols-1 md:grid-cols-12 relative z-20">
                <!-- Address Side -->
                <div
                    class="md:col-span-5 p-6 sm:p-8 flex flex-col justify-between bg-white border-b md:border-b-0 md:border-r border-slate-100"
                >
                    <div>
                        <div
                            class="flex items-center gap-2 text-indigo-600 mb-2"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5"
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
                            <span
                                class="text-xs font-bold uppercase tracking-wider"
                                >Lokasi Kantor</span
                            >
                        </div>
                        <h3 class="text-base font-bold text-slate-800 mb-1">
                            Jakarta Head Office
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            {{ officeAddress }}
                        </p>
                    </div>

                    <div
                        class="mt-6 pt-6 border-t border-slate-100 flex items-center gap-3"
                    >
                        <button
                            @click="copyAddress"
                            class="flex-1 py-2 px-3 rounded-xl border border-slate-200 text-slate-700 text-xs font-semibold hover:bg-slate-50 transition text-center"
                        >
                            {{ isCopied ? "✓ Tersalin" : "Salin Alamat" }}
                        </button>
                        <a
                            :href="directionsUrl"
                            target="_blank"
                            class="flex-1 py-2 px-3 rounded-xl bg-indigo-600 text-white text-xs font-semibold hover:bg-indigo-700 transition text-center shadow-xs"
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
                </div>
            </div>

            <!-- Footer CTA -->
            <div
                class="p-6 bg-slate-900 text-white flex flex-col sm:flex-row items-center justify-between gap-4 relative z-20"
            >
                <div>
                    <p class="text-sm font-bold">
                        Masih Mengalami Kendala Teknis?
                    </p>
                    <p class="text-xs text-slate-400 mt-0.5">
                        Buat tiket pengaduan agar ditangani langsung oleh tim
                        engineer kami.
                    </p>
                </div>
                <button
                    @click="isModalOpen = true"
                    class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold transition shadow-lg shadow-indigo-600/30 whitespace-nowrap"
                >
                    Open Support Ticket
                </button>
            </div>
        </div>

        <!-- Ticket Modal Demo -->
        <div
            v-if="isModalOpen"
            class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center p-4 z-50"
        >
            <div
                class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl border border-slate-100"
            >
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-slate-800">
                        Buat Tiket Kendala
                    </h3>
                    <button
                        @click="isModalOpen = false"
                        class="text-slate-400 hover:text-slate-600 text-xl font-bold"
                    >
                        ✕
                    </button>
                </div>
                <p class="text-xs text-slate-500 mb-4">
                    Tuliskan deskripsi singkat masalah atau pertanyaan Anda di
                    bawah ini.
                </p>
                <textarea
                    placeholder="Jelaskan masalah Anda secara detail..."
                    rows="4"
                    class="w-full text-xs p-3.5 rounded-xl border border-slate-200 focus:outline-none focus:border-indigo-600 mb-4"
                ></textarea>
                <button
                    @click="submitTicket"
                    class="w-full py-3 rounded-xl bg-indigo-600 text-white text-xs font-semibold hover:bg-indigo-700 transition shadow-md"
                >
                    Kirim Tiket Sekarang
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";

const cardRef = ref(null);
const rotateX = ref(0);
const rotateY = ref(0);
const isCopied = ref(false);
const isModalOpen = ref(false);

const officeLat = -6.2;
const officeLng = 106.816666;
const officeAddress =
    "Jl. MH Thamrin No. 12, Menteng, Jakarta Pusat, DKI Jakarta 10350";

const quickTopics = [
    {
        emoji: "📄",
        title: "Analisis CV Gagal",
        desc: "Format file tidak terbaca",
    },
    {
        emoji: "💳",
        title: "Pertanyaan Kuota",
        desc: "Masalah sisa kredit analisis",
    },
    { emoji: "🔐", title: "Keamanan Akun", desc: "Ubah kata sandi & profil" },
];

function handleMouseMove(e) {
    if (!cardRef.value) return;
    const rect = cardRef.value.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    const centerX = rect.width / 2;
    const centerY = rect.height / 2;

    // Kemiringan halus 3D 5 derajat
    rotateX.value = -((y - centerY) / centerY) * 5;
    rotateY.value = ((x - centerX) / centerX) * 5;

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

function submitTicket() {
    alert("Tiket bantuan berhasil dikirim!");
    isModalOpen.value = false;
}
</script>

<style scoped>
.perspective-1200 {
    perspective: 1200px;
}
.transform-preserve-3d {
    transform-style: preserve-3d;
}
.translate-z-4 {
    transform: translateZ(12px);
}
.translate-z-8 {
    transform: translateZ(24px);
}
</style>
