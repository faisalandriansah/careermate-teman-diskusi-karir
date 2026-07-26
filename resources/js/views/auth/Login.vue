<template>
  <div class="min-h-screen flex bg-white">

    <!-- LEFT: FORM -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-16 lg:px-24 py-10 relative">

      <!-- <router-link to="/dashboard" class="inline-flex items-center gap-1 text-gray-500 text-sm mb-10 hover:text-gray-700 w-fit">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to dashboard
      </router-link> -->

      <div class="max-w-md w-full mx-auto lg:mx-0">
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Sign In</h1>
        <p class="text-gray-500 mb-6">Enter your email and password to sign in!</p>

        <!-- SOCIAL BUTTONS -->
        <div class="grid grid-cols-2 gap-3 mb-6">
          <button type="button" @click="loginWithGoogle" class="flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-gray-50 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 transition">
            <svg class="w-5 h-5" viewBox="0 0 24 24">
              <path fill="#4285F4" d="M23.52 12.27c0-.84-.07-1.46-.22-2.1H12v3.81h6.6c-.13 1.05-.85 2.63-2.45 3.7l-.02.15 3.56 2.76.25.02c2.27-2.1 3.58-5.18 3.58-8.34"/>
              <path fill="#34A853" d="M12 24c3.24 0 5.95-1.07 7.93-2.91l-3.78-2.93c-1.02.71-2.4 1.21-4.15 1.21-3.17 0-5.86-2.1-6.82-5H1.28v3.03C3.25 21.3 7.31 24 12 24"/>
              <path fill="#FBBC05" d="M5.18 14.37A7.2 7.2 0 0 1 4.8 12c0-.82.14-1.63.37-2.37V6.6H1.28A11.98 11.98 0 0 0 0 12c0 1.94.47 3.78 1.28 5.4z"/>
              <path fill="#EA4335" d="M12 4.77c2.25 0 3.77.97 4.64 1.78l3.39-3.31C17.94 1.19 15.24 0 12 0 7.31 0 3.25 2.7 1.28 6.6l3.9 3.03c.95-2.9 3.65-4.86 6.82-4.86"/>
            </svg>
            Sign in with Google
          </button>
          <button type="button" @click="loginWithX" class="flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-gray-50 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100 transition">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
              <path d="M18.9 1.6h3.7l-8 9.15L24 22.4h-7.4l-5.8-7.6-6.6 7.6H.5l8.6-9.85L0 1.6h7.6l5.25 6.95zm-1.3 18.6h2L6.5 3.7h-2.1z"/>
            </svg>
            Sign in with X
          </button>
        </div>

        <!-- DIVIDER -->
        <div class="flex items-center gap-4 mb-6">
          <div class="flex-1 h-px bg-gray-200"></div>
          <span class="text-sm text-gray-400">Or</span>
          <div class="flex-1 h-px bg-gray-200"></div>
        </div>

        <form @submit.prevent="handleSubmit" class="space-y-5">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email<span class="text-red-500">*</span></label>
            <input
              id="email"
              v-model="form.email"
              type="email"
              required
              placeholder="info@gmail.com"
              class="w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm text-gray-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
            >
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password<span class="text-red-500">*</span></label>
            <div class="relative">
              <input
                id="password"
                v-model="form.password"
                :type="showPassword ? 'text' : 'password'"
                required
                placeholder="Enter your password"
                class="w-full rounded-lg border border-gray-200 bg-white px-4 py-2.5 pr-11 text-sm text-gray-800 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"
              >
              <button type="button" @click="showPassword = !showPassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                <svg v-if="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18M10.58 10.58a2 2 0 002.83 2.83M9.88 5.09A9.77 9.77 0 0112 5c4.48 0 8.27 2.94 9.54 7a10.05 10.05 0 01-4.17 5.19M6.1 6.1A10.06 10.06 0 002.46 12c1.27 4.06 5.06 7 9.54 7 1.02 0 2-.15 2.9-.42"/>
                </svg>
              </button>
            </div>
          </div>

          <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm text-gray-600">
              <input type="checkbox" v-model="form.remember" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
              Keep me logged in
            </label>
            <router-link to="/forgot-password" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">Forgot password?</router-link>
          </div>

          <button
            type="submit"
            :disabled="loading"
            class="w-full rounded-lg bg-indigo-600 hover:bg-indigo-700 transition py-3 text-sm font-semibold text-white disabled:opacity-60"
          >
            {{ loading ? 'Signing in...' : 'Sign In' }}
          </button>
        </form>

        <p v-if="errorMessage" class="mt-4 text-sm text-red-500">{{ errorMessage }}</p>

        <p class="mt-6 text-sm text-gray-500">
          Don't have an account?
          <router-link to="/register" class="font-medium text-indigo-600 hover:text-indigo-700">Sign Up</router-link>
        </p>
      </div>
    </div>

    <!-- RIGHT: BRAND PANEL -->
    <div class="hidden lg:flex w-1/2 relative items-center justify-center overflow-hidden bg-indigo-600">
      <div
        class="absolute inset-0 opacity-10"
        style="background-image: linear-gradient(to right, rgba(255,255,255,.5) 1px, transparent 1px), linear-gradient(to bottom, rgba(255,255,255,.5) 1px, transparent 1px); background-size: 60px 60px;"
      ></div>
      <div class="absolute top-24 right-40 w-16 h-16 bg-white/10 rounded"></div>
      <div class="absolute bottom-32 left-24 w-16 h-16 bg-white/10 rounded"></div>

      <div class="relative z-10 text-center px-10">
        <div class="flex items-center justify-center gap-3 mb-6">
          <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center">
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3v18m6-13v13M5 13v8"/>
            </svg>
          </div>
          <span class="text-4xl font-bold text-white">CareerMateAI</span>
        </div>
        <p class="text-indigo-100 max-w-sm mx-auto">
          Free and Open-Source Career Recommendation Platform
        </p>
      </div>
    </div>

  </div>
</template>

<script setup>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

const form = reactive({
  email: '',
  password: '',
  remember: false,
})

const showPassword = ref(false)
const loading = ref(false)
const errorMessage = ref('')

function loginWithGoogle() {
  // TODO: hit OAuth endpoint, misal: window.location.href = '/auth/google/redirect'
}

function loginWithX() {
  // TODO: hit OAuth endpoint, misal: window.location.href = '/auth/x/redirect'
}

async function handleSubmit() {
  loading.value = true
  errorMessage.value = ''
  try {
    // TODO: sesuaikan dengan API auth lo, contoh:
    // const res = await axios.post('/api/login', form)
    // localStorage.setItem('token', res.data.token)
    router.push('/dashboard')
  } catch (err) {
    errorMessage.value = 'Email atau password salah.'
  } finally {
    loading.value = false
  }
}
</script>