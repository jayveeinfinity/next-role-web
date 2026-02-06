<script setup>

</script>

<template>
    <div class="relative flex min-h-screen flex-col overflow-x-hidden">
        <header class="sticky top-0 z-50 w-full border-b border-solid border-slate-200 dark:border-[#283039] bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md px-4 md:px-20 lg:px-40 py-3">
            <div class="flex items-center justify-between max-w-[1200px] mx-auto">
                <div class="flex items-center gap-2 text-primary">
                    <div class="size-8 flex items-center justify-center bg-primary rounded-lg text-white">
                        <span class="material-symbols-outlined">explore</span>
                    </div>
                    <h2 class="text-slate-900 dark:text-white text-xl font-bold leading-tight tracking-tight">NextRole</h2>
                </div>
                <div class="hidden md:flex flex-1 justify-end gap-8 items-center">
                    <nav class="flex items-center gap-8">
                        <a class="text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="#">How it Works</a>
                        <a class="text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="#">Pricing</a>
                        <a class="text-slate-600 dark:text-slate-300 hover:text-primary dark:hover:text-primary text-sm font-medium transition-colors" href="#">Features</a>
                    </nav>
                    <div class="flex gap-3">
                        <button class="flex min-w-[84px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-slate-200 dark:bg-[#283039] text-slate-900 dark:text-white text-sm font-bold transition-all hover:opacity-90">
                            <span>Sign In</span>
                        </button>
                        <button class="flex min-w-[100px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold transition-all hover:brightness-110 shadow-lg shadow-primary/20">
                            <span>Get Started</span>
                        </button>
                    </div>
                </div>
                <button class="md:hidden text-slate-900 dark:text-white">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </header>
        <slot />
        <footer class="bg-slate-50 dark:bg-background-dark border-t border-slate-200 dark:border-[#283039] px-4 md:px-20 lg:px-40 py-12">
            <div class="max-w-[1200px] mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center gap-2 text-primary">
                    <div class="size-6 bg-primary rounded flex items-center justify-center text-white">
                        <span class="material-symbols-outlined text-sm">explore</span>
                    </div>
                    <span class="font-bold text-slate-900 dark:text-white">NextRole</span>
                </div>
                <div class="flex gap-8 text-sm text-slate-500 dark:text-slate-400">
                    <a class="hover:text-primary transition-colors" href="#">Privacy Policy</a>
                    <a class="hover:text-primary transition-colors" href="#">Terms of Service</a>
                    <a class="hover:text-primary transition-colors" href="#">Contact</a>
                </div>
                <div class="text-sm text-slate-500 dark:text-slate-400">
                    © 2024 NextRole. All rights reserved.
                </div>
            </div>
        </footer>
    </div>
</template>