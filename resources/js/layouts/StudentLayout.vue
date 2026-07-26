<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Simple header for student layout -->
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <router-link to="/student/dashboard" class="flex items-center gap-2">
              <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
              </svg>
              <span class="text-xl font-bold text-slate-800">CareerMate</span>
            </router-link>
          </div>
            <div class="flex items-center space-x-4">
              <nav class="hidden sm:flex items-center space-x-2">
                <router-link to="/student/dashboard" class="px-3 py-2 text-sm text-slate-600 rounded-md hover:bg-slate-50" active-class="bg-slate-100 font-semibold">Dashboard</router-link>
                <router-link to="/student/profile" class="px-3 py-2 text-sm text-slate-600 rounded-md hover:bg-slate-50" active-class="bg-slate-100 font-semibold">Profile</router-link>
                <router-link to="/student/cv" class="px-3 py-2 text-sm text-slate-600 rounded-md hover:bg-slate-50" active-class="bg-slate-100 font-semibold">My CV</router-link>
                <router-link to="/student/skills" class="px-3 py-2 text-sm text-slate-600 rounded-md hover:bg-slate-50" active-class="bg-slate-100 font-semibold">Skills</router-link>
                <router-link to="/student/internships" class="px-3 py-2 text-sm text-slate-600 rounded-md hover:bg-slate-50" active-class="bg-slate-100 font-semibold">Internships</router-link>
                <router-link to="/student/roadmap" class="px-3 py-2 text-sm text-slate-600 rounded-md hover:bg-slate-50" active-class="bg-slate-100 font-semibold">Roadmap</router-link>
                <router-link to="/student/support" class="px-3 py-2 text-sm text-slate-600 rounded-md hover:bg-slate-50" active-class="bg-slate-100 font-semibold">Support</router-link>
              </nav>

              <div ref="stdRef" class="relative">
                <button @click="stdOpen = !stdOpen" class="flex items-center gap-3 rounded-full border border-slate-200 bg-white px-3 py-1.5 shadow-sm hover:shadow-md transition-all duration-150">
                  <div class="h-8 w-8 rounded-full bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center text-white font-semibold">{{ shortInitial }}</div>
                  <div class="hidden sm:block text-left">
                    <div class="text-sm font-medium text-slate-800">{{ displayName }}</div>
                    <div class="text-xs text-slate-500">{{ displayRole }}</div>
                  </div>
                </button>

                <div v-show="stdOpen" class="absolute right-0 z-50 mt-2 w-56 rounded-lg border border-slate-100 bg-white py-3 shadow-lg text-slate-900">
                  <div class="px-4 pb-3">
                    <div class="text-sm font-semibold">{{ displayName }}</div>
                    <div class="text-xs text-slate-500">{{ displayEmail }}</div>
                  </div>
                  <hr class="my-2 border-t border-slate-100" />
                  <ul>
                    <li>
                      <button class="flex w-full items-center gap-3 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50" @click="gotoProfile">
                        Edit profile
                      </button>
                    </li>
                    <li>
                      <button class="flex w-full items-center gap-3 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50" @click="gotoSupport">
                        Support
                      </button>
                    </li>
                  </ul>
                  <hr class="my-2 border-t border-slate-100" />
                  <div class="px-3">
                    <button @click="signOut" class="flex w-full items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50">
                      Sign out
                    </button>
                  </div>
                </div>
              </div>
            </div>
        </div>
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
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { useRouter } from 'vue-router';
import useAuthStore from '@/stores/useAuthStore';

// Komponen layout student sederhana
const stdOpen = ref(false);
const stdRef = ref(null);
const router = useRouter();
const auth = useAuthStore();

const displayName = computed(() => (auth.user && auth.user.name) ? auth.user.name : 'Student User');
const displayEmail = computed(() => (auth.user && auth.user.email) ? auth.user.email : 'student@example.com');
const avatarUrl = computed(() => {
  if (auth.user && auth.user.avatar) return auth.user.avatar;
  const name = encodeURIComponent(displayName.value);
  return `https://ui-avatars.com/api/?name=${name}&background=10B981&color=fff`;
});

function signOut(){ auth.logout(); stdOpen.value = false; router.push('/login'); }
function gotoProfile(){ stdOpen.value = false; router.push('/student/profile'); }
function gotoSupport(){ stdOpen.value = false; window.location.href = '/support'; }

function onClickOutside(e){ const el = stdRef.value; if(!el) return; if(!el.contains(e.target)) stdOpen.value = false; }

onMounted(()=>{ document.addEventListener('click', onClickOutside); });
onBeforeUnmount(()=>{ document.removeEventListener('click', onClickOutside); });
</script>