<template>
  <div class="min-h-screen bg-[#f8fafc] px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto flex min-h-[calc(100vh-5rem)] max-w-6xl overflow-hidden rounded-[32px] border border-slate-200 bg-white shadow-[0_20px_60px_rgba(15,23,42,0.08)]">
      <div class="hidden w-[45%] bg-gradient-to-br from-slate-900 via-slate-800 to-blue-700 p-10 lg:flex lg:flex-col lg:justify-between">
        <div>
          <div class="inline-flex items-center gap-3 rounded-full border border-white/20 bg-white/10 px-3 py-1.5 text-sm font-medium text-white/90 backdrop-blur">
            <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
            CareerMate Admin
          </div>
          <h1 class="mt-8 text-3xl font-semibold leading-tight text-white">Welcome back to your career management workspace.</h1>
          <p class="mt-4 max-w-md text-sm leading-6 text-slate-300">Manage skills, careers, internships, and mapping efficiently with a clean dashboard experience.</p>
        </div>
        <div class="rounded-2xl border border-white/10 bg-white/10 p-5 backdrop-blur">
          <p class="text-sm font-medium text-white">“Stay organized, update faster, and keep your career data always in sync.”</p>
        </div>
      </div>

      <div class="flex w-full items-center justify-center p-6 sm:p-10 lg:w-[55%] lg:p-12">
        <div class="w-full max-w-md">
          <div class="mb-8 text-center lg:text-left">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-600 to-cyan-500 text-white shadow-lg lg:mx-0">
              <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
              </svg>
            </div>
            <h2 class="mt-5 text-3xl font-semibold text-slate-900">Sign In</h2>
            <p class="mt-2 text-sm text-slate-500">Enter your credentials to continue</p>
          </div>

          <form class="space-y-5" action="#" method="POST">
            <div class="space-y-3">
              <div>
                <label for="email-address" class="mb-2 block text-sm font-medium text-slate-700">Email</label>
                <input
                  id="email-address"
                  name="email"
                  type="email"
                  autocomplete="email"
                  required
                  class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                  placeholder="you@example.com"
                >
              </div>
              <div>
                <label for="password" class="mb-2 block text-sm font-medium text-slate-700">Password</label>
                <input
                  id="password"
                  name="password"
                  type="password"
                  autocomplete="current-password"
                  required
                  class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                  placeholder="Enter password"
                >
              </div>
            </div>

            <div class="flex items-center justify-between">
              <label class="flex items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500" />
                Remember me
              </label>
              <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-700">Forgot password?</a>
            </div>

            <button
              type="submit"
              class="flex w-full items-center justify-center rounded-xl bg-gradient-to-r from-blue-600 to-cyan-500 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:from-blue-700 hover:to-cyan-600"
            >
              Sign In
            </button>
          </form>

          <div class="mt-6 text-center text-sm text-slate-500">
            <p>Don't have an account? <a href="#" class="font-medium text-blue-600 hover:text-blue-700">Create one</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// Login page UI styled to match a modern Tailwind admin experience
</script>