<template>
    <div
        v-if="open"
        class="fixed inset-0 z-[60] flex items-end sm:items-center justify-center"
    >
        <!-- Backdrop -->
        <div
            class="fixed inset-0 bg-slate-900/70 backdrop-blur-sm"
            @click="handleClose"
        ></div>

        <!-- Modal panel -->
        <div
            class="relative w-full sm:max-w-2xl bg-white rounded-t-2xl sm:rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[92vh]"
        >
            <!-- Header -->
            <div
                class="flex items-center justify-between px-5 sm:px-6 py-4 border-b border-slate-100 shrink-0"
            >
                <h3 class="text-base font-semibold text-slate-800">
                    Atur Foto Profil
                </h3>
                <button
                    type="button"
                    class="p-1.5 rounded-md text-slate-400 hover:text-slate-600 hover:bg-slate-100 focus:outline-none"
                    @click="handleClose"
                    :disabled="saving"
                >
                    <svg
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
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

            <!-- Body -->
            <div class="p-5 sm:p-6 overflow-y-auto flex-1">
                <p class="text-sm text-slate-500 mb-4">
                    Geser dan atur zoom foto. Isi kotak ini adalah bagian yang akan
                    dipakai sebagai foto profil.
                </p>

                <!-- Crop Area (kotak, WYSIWYG) -->
                <div class="relative mx-auto w-full max-w-[560px]">
                    <div
                        ref="cropAreaEl"
                        class="relative aspect-square rounded-2xl overflow-hidden bg-slate-900 select-none touch-none cursor-grab active:cursor-grabbing shadow-xl ring-1 ring-slate-300"
                        @pointerdown="onPointerDown"
                        @pointermove="onPointerMove"
                        @pointerup="onPointerUp"
                        @pointercancel="onPointerUp"
                        @wheel.prevent="onWheel"
                    >
                        <!-- Gambar -->
                        <img
                            ref="imgEl"
                            :src="imageUrl"
                            alt="Preview foto"
                            draggable="false"
                            class="absolute left-1/2 top-1/2 max-w-none will-change-transform"
                            :class="loaded ? 'opacity-100' : 'opacity-0'"
                            :style="imgStyle"
                        />

                        <!-- Bingkai tipis penanda batas krop -->
                        <div
                            class="pointer-events-none absolute inset-0 rounded-2xl border-2 border-dashed border-white/60"
                        ></div>

                        <!-- Hint (muncul sekali saat pertama buka) -->
                        <transition name="fade">
                            <div
                                v-if="showHint && loaded"
                                class="pointer-events-none absolute inset-0 rounded-2xl flex items-center justify-center"
                            >
                                <div
                                    class="bg-slate-900/65 backdrop-blur-sm text-white text-sm font-medium rounded-full px-5 py-2.5 flex items-center gap-2 shadow-lg"
                                >
                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 5l7 7-7 7M5 5l7 7-7 7"
                                        />
                                    </svg>
                                    Geser foto untuk mengatur posisi
                                </div>
                            </div>
                        </transition>

                        <!-- Indikator loading -->
                        <div
                            v-if="!loaded"
                            class="absolute inset-0 flex items-center justify-center"
                        >
                            <svg
                                class="h-8 w-8 text-white/70 animate-spin"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"
                                ></circle>
                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                                ></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Zoom Controls -->
                <div class="mt-6 max-w-[560px] mx-auto">
                    <div class="flex items-center justify-between mb-2">
                        <span
                            class="text-xs font-semibold text-slate-400 uppercase tracking-wider"
                            >Zoom</span
                        >
                        <button
                            type="button"
                            class="text-xs font-semibold text-blue-600 hover:text-blue-700 transition"
                            @click="resetView"
                            :disabled="saving || !loaded"
                        >
                            ↺ Reset
                        </button>
                    </div>
                    <div class="flex items-center gap-4">
                        <button
                            type="button"
                            class="shrink-0 h-12 w-12 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition disabled:opacity-40"
                            @click="zoomBy(-0.1)"
                            :disabled="saving"
                            title="Perkecil"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M20 12H4"
                                />
                            </svg>
                        </button>
                        <input
                            type="range"
                            :min="minZoom"
                            :max="maxZoom"
                            step="0.01"
                            v-model.number="zoom"
                            class="flex-1 h-2 accent-blue-600"
                            @input="setZoom(zoom)"
                            :disabled="saving"
                        />
                        <button
                            type="button"
                            class="shrink-0 h-12 w-12 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition disabled:opacity-40"
                            @click="zoomBy(0.1)"
                            :disabled="saving"
                            title="Perbesar"
                        >
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4"
                                />
                            </svg>
                        </button>
                        <span
                            class="shrink-0 w-14 text-center text-xs font-semibold text-slate-500 tabular-nums"
                            >{{ zoomPercent }}%</span
                        >
                    </div>
                    <p class="mt-2 text-center text-xs text-slate-400">
                        Geser lingkaran untuk memindah • tebak gulir (scroll) untuk
                        memperbesar
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <div
                class="flex items-center justify-end gap-3 px-5 sm:px-6 py-4 border-t border-slate-100 bg-slate-50/60 shrink-0"
            >
                <button
                    type="button"
                    class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition"
                    @click="handleClose"
                    :disabled="saving"
                >
                    Batal
                </button>
                <button
                    type="button"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition disabled:opacity-50 disabled:cursor-not-allowed"
                    @click="handleSave"
                    :disabled="saving || !loaded"
                >
                    <svg
                        v-if="saving"
                        class="h-4 w-4 animate-spin"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"
                        ></circle>
                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                        ></path>
                    </svg>
                    {{ saving ? "Menyimpan..." : "Simpan" }}
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, nextTick, computed, onBeforeUnmount } from "vue";

const props = defineProps({
    open: {
        type: Boolean,
        default: false,
    },
    imageUrl: {
        type: String,
        default: "",
    },
    saving: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["close", "save"]);

const cropAreaEl = ref(null);
const imgEl = ref(null);

const loaded = ref(false);
const naturalW = ref(0);
const naturalH = ref(0);
const zoom = ref(1);
const minZoom = ref(1);
const maxZoom = ref(4);
const panX = ref(0);
const panY = ref(0);

let areaW = 0;
let areaH = 0;
let dragging = false;
let startX = 0;
let startY = 0;
let startPanX = 0;
let startPanY = 0;
let hintTimer = null;

const showHint = ref(false);

const zoomPercent = computed(() =>
    minZoom.value > 0 ? Math.round((zoom.value / minZoom.value) * 100) : 100,
);

const imgStyle = computed(() => ({
    transform: `translate(calc(-50% + ${panX.value}px), calc(-50% + ${panY.value}px)) scale(${zoom.value})`,
}));

function reset() {
    loaded.value = false;
    naturalW.value = 0;
    naturalH.value = 0;
    panX.value = 0;
    panY.value = 0;
    zoom.value = 1;
    showHint.value = false;
    if (hintTimer) {
        clearTimeout(hintTimer);
        hintTimer = null;
    }
}

function measureArea() {
    const el = cropAreaEl.value;
    if (!el) return { w: 0, h: 0 };
    const r = el.getBoundingClientRect();
    areaW = r.width;
    areaH = r.height;
    return { w: areaW, h: areaH };
}

function computeBase() {
    if (!areaW || !naturalW.value || !naturalH.value) return;
    minZoom.value = Math.max(areaW / naturalW.value, areaH / naturalH.value);
    maxZoom.value = minZoom.value * 5;
    zoom.value = minZoom.value;
    panX.value = 0;
    panY.value = 0;
    loaded.value = true;

    // Tampilkan hint panduan beberapa detik (hanya sekali per buka modal)
    showHint.value = true;
    hintTimer = setTimeout(() => {
        showHint.value = false;
    }, 2000);
}

function onImgLoad() {
    const img = imgEl.value;
    if (!img || !img.naturalWidth) return;
    naturalW.value = img.naturalWidth;
    naturalH.value = img.naturalHeight;
    measureArea();
    computeBase();
}

function clampPan() {
    const limX = Math.max(0, (naturalW.value * zoom.value - areaW) / 2);
    const limY = Math.max(0, (naturalH.value * zoom.value - areaH) / 2);
    panX.value = Math.min(limX, Math.max(-limX, panX.value));
    panY.value = Math.min(limY, Math.max(-limY, panY.value));
}

// Zoom terhadap suatu titik pada container (px,py). Titik kursor tetap di tempat,
// sehingga perbesaran terasa natural & tidak melompat.
function zoomAroundPoint(px, py, z) {
    const z1 = Math.min(maxZoom.value, Math.max(minZoom.value, Number(z)));
    const imgX = (px - areaW / 2 - panX.value) / zoom.value + naturalW.value / 2;
    const imgY = (py - areaH / 2 - panY.value) / zoom.value + naturalH.value / 2;

    zoom.value = z1;
    panX.value = px - areaW / 2 - (imgX - naturalW.value / 2) * z1;
    panY.value = py - areaH / 2 - (imgY - naturalH.value / 2) * z1;
    clampPan();
}

function setZoom(value) {
    zoomAroundPoint(areaW / 2, areaH / 2, value);
}

function zoomBy(step) {
    setZoom(zoom.value + step);
}

function resetView() {
    zoom.value = minZoom.value;
    panX.value = 0;
    panY.value = 0;
    clampPan();
}

function onWheel(e) {
    const rect = cropAreaEl.value?.getBoundingClientRect();
    if (!rect) return;
    const px = e.clientX - rect.left;
    const py = e.clientY - rect.top;
    const delta = e.deltaY < 0 ? 0.1 : -0.1;
    zoomAroundPoint(px, py, zoom.value + delta);
}

function onPointerDown(e) {
    dragging = true;
    startX = e.clientX;
    startY = e.clientY;
    startPanX = panX.value;
    startPanY = panY.value;
    if (e.currentTarget.setPointerCapture) {
        e.currentTarget.setPointerCapture(e.pointerId);
    }
}

function onPointerMove(e) {
    if (!dragging) return;
    panX.value = startPanX + (e.clientX - startX);
    panY.value = startPanY + (e.clientY - startY);
    clampPan();
}

function onPointerUp() {
    dragging = false;
}

function init() {
    reset();
    nextTick(() => {
        measureArea();
        const img = imgEl.value;
        if (!img) return;

        if (img.complete && img.naturalWidth > 0) {
            onImgLoad();
        } else {
            img.addEventListener("load", onImgLoad, { once: true });
        }
    });
}

watch(
    () => props.open,
    (open) => {
        if (open) init();
        else reset();
    },
);

function handleSave() {
    if (!loaded.value || !naturalW.value || !naturalH.value) return;
    measureArea();
    if (!areaW || !areaH) return;

    const canvas = document.createElement("canvas");
    canvas.width = 512;
    canvas.height = 512;
    const ctx = canvas.getContext("2d");
    if (!ctx) return;

    // Region tampil (kuadran kiri-atas) dalam koordinat gambar asli.
    // Inverse dari transform: translate(calc(-50% + pan)) scale(zoom) dengan origin di tengah.
    const sx = naturalW.value / 2 - (areaW / 2 + panX.value) / zoom.value;
    const sy = naturalH.value / 2 - (areaH / 2 + panY.value) / zoom.value;
    const sw = areaW / zoom.value;
    const sh = areaH / zoom.value;

    ctx.imageSmoothingEnabled = true;
    ctx.imageSmoothingQuality = "high";
    ctx.drawImage(imgEl.value, sx, sy, sw, sh, 0, 0, 512, 512);

    canvas.toBlob(
        (blob) => {
            if (blob) emit("save", blob);
        },
        "image/jpeg",
        0.92,
    );
}

function handleClose() {
    emit("close");
}

onBeforeUnmount(reset);
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>