<template>
    <div class="bg-white rounded-md shadow-sm border overflow-hidden">
        <!-- Header -->
        <div class="p-6 border-b">
            <h2 class="text-xl font-semibold text-gray-800 mb-1">
                Support &amp; Help
            </h2>
            <p class="text-sm text-gray-500">Need help? Contact us at:</p>
        </div>

        <!-- Contact Info -->
        <div
            class="grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x"
        >
            <a
                href="mailto:support@careermate.example"
                class="flex items-center gap-3 p-4 hover:bg-gray-50 transition-colors"
            >
                <div
                    class="w-9 h-9 flex-shrink-0 flex items-center justify-center rounded-full bg-blue-50 text-blue-600 text-sm"
                >
                    <span>&#9993;</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-gray-400">Email</p>
                    <p class="text-sm text-gray-700 truncate">
                        support@careermate.example
                    </p>
                </div>
            </a>

            <a
                href="tel:+6281234567890"
                class="flex items-center gap-3 p-4 hover:bg-gray-50 transition-colors"
            >
                <div
                    class="w-9 h-9 flex-shrink-0 flex items-center justify-center rounded-full bg-green-50 text-green-600 text-sm"
                >
                    <span>&#128222;</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-gray-400">Phone</p>
                    <p class="text-sm text-gray-700 truncate">
                        +62 812-3456-7890
                    </p>
                </div>
            </a>

            <div class="flex items-center gap-3 p-4">
                <div
                    class="w-9 h-9 flex-shrink-0 flex items-center justify-center rounded-full bg-amber-50 text-amber-600 text-sm"
                >
                    <span>&#128337;</span>
                </div>
                <div class="min-w-0">
                    <p class="text-xs text-gray-400">Working hours</p>
                    <p class="text-sm text-gray-700 truncate">
                        Mon-Fri 09:00 - 17:00
                    </p>
                </div>
            </div>
        </div>

        <!-- Peta Lokasi Kantor -->
        <div class="border-t">
            <div class="px-4 sm:px-6 pt-4 pb-3">
                <p class="text-sm font-medium text-gray-700">Office Location</p>
                <p class="text-xs text-gray-500 mt-0.5">{{ officeAddress }}</p>
            </div>

            <div class="w-full h-56 sm:h-72">
                <iframe
                    class="w-full h-full border-0"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    :src="mapEmbedUrl"
                ></iframe>
            </div>

            <div class="px-4 sm:px-6 py-3 border-t bg-gray-50">
                <a
                    :href="directionsUrl"
                    target="_blank"
                    rel="noopener"
                    class="inline-flex items-center gap-1 text-sm font-medium text-blue-600 hover:text-blue-700"
                >
                    Get Directions <span>&#8594;</span>
                </a>
            </div>
        </div>

        <!-- CTA -->
        <div class="px-4 sm:px-6 py-4 border-t">
            <button
                class="w-full sm:w-auto px-4 py-2 rounded bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition-colors"
            >
                Open support ticket (Demo)
            </button>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";

// TODO: ganti dengan koordinat & alamat kantor asli lo
const officeLat = -6.2;
const officeLng = 106.816666;
const officeAddress = "Jl. Contoh No. 123, Jakarta, Indonesia";

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
</script>
