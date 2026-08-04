<template>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex items-center gap-3">
            <div
                class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600/10 text-blue-600"
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
                        d="M11 4a7 7 0 100 14 7 7 0 000-14zm9 17l-4.35-4.35"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 3.5a2 2 0 012 2M9 20.5a2 2 0 01-2-2"
                        opacity="0"
                    />
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold text-slate-900 sm:text-2xl">
                    Career-Skill Mapping
                </h1>
                <p class="mt-0.5 text-sm text-slate-500">
                    Hubungkan skill dengan karier untuk rekomendasi CareerMate
                    AI
                </p>
            </div>
        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-5">
            <div class="lg:col-span-2">
                <SelectCareerCard
                    :careers="careers"
                    :selected-career="selectedCareer"
                    :skills="skills"
                    :loading="loadingCareers"
                    @select="handleSelectCareer"
                />
            </div>

            <div class="lg:col-span-3">
                <SelectSkillsCard
                    :skills="skills"
                    :loading="loadingSkills"
                    :saving="saving"
                    :disabled="!selectedCareer"
                    @toggle="handleToggleSkill"
                    @weight-change="handleWeightChange"
                    @reset="handleReset"
                    @save="handleSave"
                />
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted, watch } from "vue";
import SelectCareerCard from "./SelectCareerCard.vue";
import SelectSkillsCard from "./SelectSkillsCard.vue";
import careerService from "@/services/admin/careerService";
import careerSkillService from "@/services/admin/careerSkillService";
import { notify } from "@/utils/toast";

const careers = ref([]);
const selectedCareer = ref("");
const skills = ref([]);

const loadingCareers = ref(false);
const loadingSkills = ref(false);
const saving = ref(false);

const loadCareers = async () => {
    loadingCareers.value = true;
    try {
        const res = await careerService.getAll();
        careers.value = res.data.data;
    } catch (err) {
        notify.error("Gagal memuat daftar karier.");
        console.error(err);
    } finally {
        loadingCareers.value = false;
    }
};

const loadSkills = async () => {
    if (!selectedCareer.value) {
        skills.value = [];
        return;
    }
    loadingSkills.value = true;
    try {
        const res = await careerSkillService.getCareerSkills(
            selectedCareer.value,
        );
        skills.value = res.data.skills;
    } catch (err) {
        notify.error("Gagal memuat daftar skill untuk karier ini.");
        console.error(err);
        skills.value = [];
    } finally {
        loadingSkills.value = false;
    }
};

const handleSelectCareer = (careerId) => {
    selectedCareer.value = careerId;
};

const handleToggleSkill = (skillId) => {
    const skill = skills.value.find((s) => s.id === skillId);
    if (skill) skill.checked = !skill.checked;
};

const handleWeightChange = ({ id, weight }) => {
    const skill = skills.value.find((s) => s.id === id);
    if (skill) skill.weight = weight;
};

const handleReset = () => {
    loadSkills();
};

const handleSave = async () => {
    if (!selectedCareer.value) return;

    saving.value = true;
    try {
        const payload = skills.value
            .filter((s) => s.checked)
            .map((s) => ({ skill_id: s.id, weight: s.weight }));

        await careerSkillService.saveCareerSkills(
            selectedCareer.value,
            payload,
        );
        notify.success("Mapping berhasil disimpan.");
    } catch (err) {
        notify.error("Gagal menyimpan mapping.");
        console.error(err);
    } finally {
        saving.value = false;
    }
};

onMounted(loadCareers);
watch(selectedCareer, loadSkills);
</script>
