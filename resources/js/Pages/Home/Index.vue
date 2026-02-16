<script setup>
    import { ref } from 'vue'
    import { useForm } from '@inertiajs/vue3';
    import HomeLayout from '@Shared/Layouts/Home.vue';
    import api from '@/axios.js';
 
    defineOptions({
        layout: HomeLayout
    });

    const form = useForm({
        portfolio: '',
        jobDescription: ''
    });

    const analyzeFitScore = () => {
        if (!form.jobDescription) {
            alert('Please enter a job description to analyze.');
            return;
        }

        form.post('/api/analyze', {
            preserveScroll: true
        });
    }
    
    const fileInput = ref(null);
    const fileRef = ref(null);
    const uploading = ref(false);
    const uploadProgress = ref(0);
    const error = ref(null);

    let controller = null
        
    const triggerFileInput = () => {
        fileInput.value.click()
    }

    const handleFileSelect = (event) => {
        const file = event.target.files[0];
        if (file) {
            fileRef.value = file;
            uploadFile(file)
        }
    }

    const uploadFile = async (file) => {
        error.value = null

        const allowedTypes = [
            'application/pdf'
        ]

        if (!allowedTypes.includes(file.type)) {
            error.value = 'Only PDF or DOCX files are allowed.'
            return
        }

        const formData = new FormData()
        formData.append('portfolio', file)

        try {
            uploading.value = true;
            uploadProgress.value = 0;
            error.value = null;

            controller = new AbortController();

            const response = await api.post('/api/portfolio/upload', formData, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'multipart/form-data'
                },
                signal: controller.signal,
                onUploadProgress: (progressEvent) => {
                    if (progressEvent.total) {
                        uploadProgress.value = Math.round(
                            (progressEvent.loaded * 100) / progressEvent.total
                        );
                        console.log(`Upload progress: ${uploadProgress.value}%`);
                    }
                }
            });

            form.portfolio = response.data.extracted_text;

        } catch (err) {
            if (err.name === 'CanceledError' || err.code === 'ERR_CANCELED') {
                error.value = 'Upload canceled.';
            } else {
                error.value = 'Upload failed. Please try again.';
            }
        } finally {
            uploading.value = false;
            controller = null;
        }
    }

    const cancelUpload = () => {
        if (controller) {
            controller.abort()
        }
    }
</script>

<template>
    <main class="flex-1">
        <section class="px-4 md:px-20 lg:px-40 py-12 lg:py-20">
            <div class="max-w-[1200px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="flex flex-col gap-8">
                    <div class="flex flex-col gap-4">
                        <div class="inline-flex items-center gap-2 bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold w-fit uppercase tracking-wider">
                            <span class="material-symbols-outlined text-sm">navigation</span>
                            Guided Career Search
                        </div>
                        <h1 class="text-slate-900 dark:text-white text-4xl md:text-5xl lg:text-6xl font-black leading-tight tracking-tight">
                            Navigate your career <span class="text-primary">with clarity.</span>
                        </h1>
                        <p class="text-slate-600 dark:text-slate-400 text-lg md:text-xl font-normal leading-relaxed max-w-[540px]">
                            Go beyond keywords. Our AI understands your professional journey and matches it to job requirements with explainable precision scoring.
                        </p>
                    </div>
                    <div class="flex gap-4">
                        <button class="flex h-14 px-8 items-center justify-center rounded-xl bg-primary text-white text-lg font-bold hover:brightness-110 transition-all shadow-xl shadow-primary/25">
                            Start Free Analysis
                        </button>
                        <button class="flex h-14 px-8 items-center justify-center rounded-xl border-2 border-slate-200 dark:border-slate-700 text-slate-900 dark:text-white text-lg font-bold hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">
                            View Sample
                        </button>
                    </div>
                    <div class="flex items-center gap-4 text-slate-500 text-sm">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full border-2 border-background-dark bg-slate-300 overflow-hidden">
                                <img alt="User avatar" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDtAQdZ7CRCIfeRU-KoxzQexkcW2SqyOfaEVQ1gv4qYpdQhU2LGa4Z5v-yP9JvhNEvYq3ffqBatMlZhL3a9j6oGbNJHXEnJICTeCGUOEwJa_NH4t4bpZz9UP6sfdQ-WCQ97pFheCGplsVDsJACDosWvazTaFBocrtXgT8QKMEFxmc2XLmr5gzdnZmrp2RjfWlGby0pjgsxXxq6uw-3fAPr6bf1bM0bObYLQoQgz0LQg6G1WEE6jzEak6qgVi3ND8ZfeS9K6YpqalTg"/>
                            </div>
                            <div class="w-8 h-8 rounded-full border-2 border-background-dark bg-slate-400 overflow-hidden">
                                <img alt="User avatar" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDM-Q-MjsGUJFnF40e7bFce7-vfn4tPZW5VBpeF3OodaCR6VkZVVv910_CsIkVHub9WxbFjojz0TwyRnF4itJHdV2kJSdO1H3HwTDwpSkKptBxkyTYspEhz8ALQqQaAjfImI5A4acf86vLN9OTVUYga6RcTcRgMofWY4d1q0TTUM9ucEW3b1Rzb1hV0l4OBjsHn2MjCNJQt1AWkhlxC-pzpMHnOZAhVHgpXhnhNryt8Mk28BdESKFwIqlFVrC6t53EaBjpjT9X33iQ"/>
                            </div>
                            <div class="w-8 h-8 rounded-full border-2 border-background-dark bg-slate-500 overflow-hidden">
                                <img alt="User avatar" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQmE298388AnX4piNpxaex2v8pU8ncm_FKdCEe-WJSK4F8VTEBsXU51Mi5gD7Tz5KY3ksDgqfIwiD8QC1YiFf8ol55EWyHzVDvbULTvg_q_NoYbvR4lqmcGWpo91vdnUJ_PqnfF33kJaoL2jp5SGWAPxdD7RuoLHBk4eSTczy-OIVCw3QJ_p9V252VF0Z_70Ke0xpvqKPqibDkcSO8Ol78vThDDixC0KegFo61ZvfddL3x3ssQbMJIx1Lmen-X9CzzicFFthv8Z8o"/>
                            </div>
                        </div>
                        <span>Trusted by 5,000+ candidates this month</span>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -inset-4 bg-primary/20 blur-3xl rounded-full"></div>
                    <div class="relative bg-white dark:bg-[#1c2127] border border-slate-200 dark:border-[#3b4754] rounded-2xl shadow-2xl p-6 flex flex-col gap-6">
                        <div class="flex items-center gap-2 border-b border-slate-100 dark:border-[#3b4754] pb-4">
                            <span class="material-symbols-outlined text-primary">explore</span>
                            <span class="font-bold text-slate-900 dark:text-white">Analysis Compass</span>
                        </div>
                        <div class="flex flex-col items-center gap-4 rounded-xl border-2 border-dashed border-slate-300 dark:border-[#3b4754] px-6 py-10 hover:border-primary transition-colors cursor-pointer group bg-slate-50/50 dark:bg-transparent">
                            <div v-show="!form.portfolio && !uploading" @click="triggerFileInput" class="flex flex-col items-center gap-4">
                                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-3xl">cloud_upload</span>
                                </div>
                                <div class="text-center">
                                    <p class="text-slate-900 dark:text-white text-base font-bold">Upload Resume</p>
                                    <p class="text-slate-500 dark:text-slate-400 text-sm">Drag &amp; drop your PDF or Docx here</p>
                                </div>
                                <button class="mt-2 px-4 py-2 bg-slate-200 dark:bg-[#283039] text-slate-900 dark:text-white text-xs font-bold rounded-lg hover:bg-primary hover:text-white transition-colors">
                                    Browse Files
                                </button>
                            </div>

                            <!-- Hidden File Input -->
                                <input
                                ref="fileInput"
                                type="file"
                                class="hidden"
                                accept=".pdf"
                                @change="handleFileSelect"
                                />
                            
                            <div v-show="form.portfolio || uploading" class="flex flex-col items-center gap-4">
                                <div class="w-16 h-16 bg-primary/20 rounded-xl flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-4xl">description</span>
                                </div>
                                <div class="text-center">
                                    <p class="text-slate-900 dark:text-white text-base font-bold">{{ fileRef?.value?.name }}</p>
                                    <p v-show="!uploading" class="text-emerald-500 dark:text-emerald-400 text-sm flex items-center justify-center gap-1">
                                        <span class="material-symbols-outlined text-sm">check_circle</span>
                                        File uploaded successfully
                                    </p>
                                    <p v-show="uploading" class="text-primary text-sm font-medium italic">Uploading Resume...</p>
                                    <div v-show="uploading" class="flex items-center gap-4 px-4 md:px-10 min-w-60">
                                        <div class="flex-1 h-2 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                                            <div class="h-full bg-primary rounded-full" :style="{ width: uploadProgress + '%' }"></div>
                                        </div>
                                        <span class="text-xs font-bold text-slate-500 dark:text-slate-400">{{ uploadProgress }}%</span>
                                        <button @click="cancelUpload" class="text-slate-400 hover:text-red-500 transition-colors flex items-center">
                                            <span class="material-symbols-outlined text-lg">close</span>
                                        </button>
                                    </div>
                                </div>
                                <button @click="triggerFileInput" class="px-4 text-slate-500 dark:text-slate-400 text-xs font-bold rounded-lg hover:text-primary transition-colors flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">edit</span>
                                    Change File
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-slate-900 dark:text-white text-sm font-semibold">Job Description</label>
                            <textarea v-model="form.jobDescription" class="w-full min-h-[120px] rounded-xl border border-slate-300 dark:border-[#3b4754] bg-white dark:bg-[#1c2127] p-4 text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent resize-none placeholder:text-slate-400 dark:placeholder:text-[#9dabb9]" placeholder="Paste the job requirements here..."></textarea>
                        </div>
                        <button @click="analyzeFitScore" :disabled="!form.portfolio || !form.jobDescription" type="button" class="w-full py-4 bg-primary text-white rounded-xl font-bold flex items-center justify-center gap-2 hover:brightness-110 transition-all">
                            <span class="material-symbols-outlined">auto_fix_high</span>
                                Analyze Fit Score
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <section class="px-4 md:px-20 lg:px-40 py-20 bg-slate-100/50 dark:bg-slate-900/30">
            <div class="max-w-[1200px] mx-auto">
                <div class="flex flex-col items-center text-center gap-4 mb-16">
                    <h2 class="text-slate-900 dark:text-white text-3xl md:text-4xl font-black">Powered by Next-Gen AI</h2>
                    <div class="h-1.5 w-20 bg-primary rounded-full"></div>
                    <p class="text-slate-600 dark:text-slate-400 max-w-[600px]">NextRole uses proprietary LLMs to navigate the context of your professional journey and find your true north.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white dark:bg-[#1c2127] p-8 rounded-2xl border border-slate-200 dark:border-[#283039] hover:shadow-xl transition-all group">
                        <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/30 text-primary rounded-xl flex items-center justify-center mb-6 group-hover:rotate-6 transition-transform">
                            <span class="material-symbols-outlined text-3xl">psychology</span>
                        </div>
                        <h3 class="text-slate-900 dark:text-white text-xl font-bold mb-4">Deep Skill Extraction</h3>
                        <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                            We identify latent skills and soft strengths hidden in your experience that traditional ATS might miss.
                        </p>
                    </div>
                    <div class="bg-white dark:bg-[#1c2127] p-8 rounded-2xl border border-slate-200 dark:border-[#283039] hover:shadow-xl transition-all group">
                        <div class="w-14 h-14 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-xl flex items-center justify-center mb-6 group-hover:rotate-6 transition-transform">
                            <span class="material-symbols-outlined text-3xl">target</span>
                        </div>
                        <h3 class="text-slate-900 dark:text-white text-xl font-bold mb-4">Alignment Scoring</h3>
                        <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                            Get a precise 0-100 score based on semantic matching between your resume and specific role requirements.
                        </p>
                    </div>
                    <div class="bg-white dark:bg-[#1c2127] p-8 rounded-2xl border border-slate-200 dark:border-[#283039] hover:shadow-xl transition-all group">
                        <div class="w-14 h-14 bg-teal-100 dark:bg-teal-900/30 text-teal-600 dark:text-teal-400 rounded-xl flex items-center justify-center mb-6 group-hover:rotate-6 transition-transform">
                            <span class="material-symbols-outlined text-3xl">comment_bank</span>
                        </div>
                        <h3 class="text-slate-900 dark:text-white text-xl font-bold mb-4">Explainable Insights</h3>
                        <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                            Don't just get a score—get feedback. We explain exactly where you match and where your profile needs more detail.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="px-4 md:px-20 lg:px-40 py-16 border-t border-slate-200 dark:border-[#283039]">
            <div class="max-w-[1200px] mx-auto text-center">
                <p class="text-slate-400 dark:text-slate-500 uppercase tracking-widest text-xs font-bold mb-10">Candidates hired at leading companies using NextRole</p>
                <div class="flex flex-wrap justify-center items-center gap-12 opacity-50 grayscale hover:grayscale-0 transition-all">
                    <span class="text-2xl font-black text-slate-800 dark:text-white">Google</span>
                    <span class="text-2xl font-black text-slate-800 dark:text-white">Amazon</span>
                    <span class="text-2xl font-black text-slate-800 dark:text-white">Microsoft</span>
                    <span class="text-2xl font-black text-slate-800 dark:text-white">Stripe</span>
                    <span class="text-2xl font-black text-slate-800 dark:text-white">Airbnb</span>
                </div>
            </div>
        </section>
        <section class="px-4 md:px-20 lg:px-40 py-24">
            <div class="max-w-[1000px] mx-auto bg-primary rounded-3xl p-12 relative overflow-hidden text-center text-white">
                <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-64 h-64 bg-black/10 rounded-full blur-3xl"></div>
                <div class="relative z-10 flex flex-col items-center gap-6">
                    <h2 class="text-3xl md:text-5xl font-black">Ready to land your dream job?</h2>
                    <p class="text-white/80 text-lg md:text-xl max-w-[600px] mx-auto">
                        Stop guessing. Start applying with confidence knowing your resume is optimized for the roles you want.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 mt-4">
                        <button class="px-10 py-4 bg-white text-primary rounded-xl font-black text-lg shadow-xl hover:scale-105 transition-transform">
                            Start Free Analysis
                        </button>
                        <button class="px-10 py-4 bg-primary border border-white/30 text-white rounded-xl font-black text-lg hover:bg-white/10 transition-colors">
                            Get Started
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>