<script setup>
    import HomeLayout from '@Shared/Layouts/Home.vue';

    defineProps({
        response: Array
    });

    defineOptions({
        layout: HomeLayout
    });
</script>

<template>
    <main class="max-w-[1440px] mx-auto px-10 py-8">
        <div class="flex flex-wrap justify-between items-end gap-3 pb-8">
        <div class="flex flex-col gap-1">
        <div class="flex items-center gap-2 text-primary mb-1">
        <span class="material-symbols-outlined text-sm">auto_awesome</span>
        <span class="text-[10px] font-bold uppercase tracking-widest">AI-Powered Fit Engine</span>
        </div>
        <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em]">Analysis Dashboard</h1>
        <p class="text-[#9dabb9] text-base font-normal leading-normal">Precision alignment for: <span class="text-white font-medium italic">Senior Software Engineer at TechCorp Solutions</span></p>
        </div>
        <div class="flex gap-3">
        <button class="flex min-w-[84px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-[#1a232e] text-white text-sm font-bold leading-normal border border-[#283039] hover:bg-[#283039] transition-colors">
        <span class="material-symbols-outlined mr-2 text-sm">upload_file</span>
        <span class="truncate">Update Resume</span>
        </button>
        <button class="flex min-w-[84px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-[#1a232e] text-white text-sm font-bold leading-normal border border-[#283039] hover:bg-[#283039] transition-colors">
        <span class="material-symbols-outlined mr-2 text-sm">share</span>
        <span class="truncate">Share Report</span>
        </button>
        </div>
        </div>
        <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 lg:col-span-3 flex flex-col gap-6">
        <div class="bg-[#1a232e] rounded-xl p-6 border border-[#283039]">
        <h3 class="text-white text-lg font-bold mb-4 flex items-center gap-2">
        <span class="material-symbols-outlined text-primary">analytics</span>
                                Evaluation Input
                            </h3>
        <div class="space-y-6">
        <div class="flex flex-col gap-2">
        <p class="text-[#9dabb9] text-xs font-semibold uppercase tracking-wider">Candidate Source</p>
        <div class="flex items-center gap-3">
        <div class="size-10 rounded-lg bg-primary/20 flex items-center justify-center text-primary font-bold">JD</div>
        <div>
        <p class="text-white text-sm font-bold">John Doe</p>
        <p class="text-[#9dabb9] text-xs">Fullstack Developer (5 yrs)</p>
        </div>
        </div>
        <div class="mt-2 flex flex-wrap gap-1">
        <span class="bg-[#283039] text-white text-[10px] px-2 py-0.5 rounded-full">Python</span>
        <span class="bg-[#283039] text-white text-[10px] px-2 py-0.5 rounded-full">React</span>
        <span class="bg-[#283039] text-white text-[10px] px-2 py-0.5 rounded-full">PostgreSQL</span>
        </div>
        </div>
        <hr class="border-[#283039]"/>
        <div class="flex flex-col gap-2">
        <p class="text-[#9dabb9] text-xs font-semibold uppercase tracking-wider">Target Destination</p>
        <div class="flex items-center gap-3">
        <div class="size-10 rounded-lg bg-white/10 flex items-center justify-center text-white">
        <span class="material-symbols-outlined">corporate_fare</span>
        </div>
        <div>
        <p class="text-white text-sm font-bold">TechCorp Solutions</p>
        <p class="text-[#9dabb9] text-xs">Senior Backend Engineer</p>
        </div>
        </div>
        <div class="mt-2 text-[#9dabb9] text-sm italic leading-relaxed">
                                        "Seeking a lead-level Python expert to navigate complex microservice architectures..."
                                    </div>
        </div>
        </div>
        </div>
        <div class="bg-[#1a232e] rounded-xl p-6 border border-[#283039]">
        <h3 class="text-white text-lg font-bold mb-4">Analysis Meta</h3>
        <div class="space-y-4">
        <div class="flex justify-between items-center">
        <span class="text-[#9dabb9] text-sm">Timestamp</span>
        <span class="text-white text-sm">Today, 10:45 AM</span>
        </div>
        <div class="flex justify-between items-center">
        <span class="text-[#9dabb9] text-sm">Compass Engine</span>
        <span class="text-white text-sm">v4.2-Pro</span>
        </div>
        <div class="flex justify-between items-center">
        <span class="text-[#9dabb9] text-sm">Reliability</span>
        <div class="flex items-center gap-1">
        <span class="size-2 rounded-full bg-green-500"></span>
        <span class="text-green-500 text-sm font-bold">{{ response?.fit_level }}</span>
        </div>
        </div>
        </div>
        </div>
        </div>
        <div class="col-span-12 lg:col-span-6 flex flex-col gap-6">
        <div class="bg-[#1a232e] rounded-xl p-8 border border-[#283039] relative overflow-hidden">
        <div class="absolute top-0 right-0 p-4">
        <div class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold border border-primary/20 flex items-center gap-1">
        <span class="material-symbols-outlined text-xs">stars</span>
            Highly Recommended
        </div>
        </div>
        <div class="flex flex-col items-center">
        <div class="relative size-56 rounded-full radial-progress flex items-center justify-center transition-all">
        <div class="flex flex-col items-center">
        <span class="text-white text-6xl font-black">{{ response?.overall_score || 0 }}%</span>
        <span class="text-[#9dabb9] text-xs font-bold tracking-widest uppercase">Fit Score</span>
        </div>
        </div>
        <div class="mt-8 grid grid-cols-3 gap-8 w-full">
        <div class="flex flex-col items-center gap-1">
        <p class="text-[#9dabb9] text-xs font-bold uppercase tracking-tighter">Experience</p>
        <div class="w-full bg-[#283039] h-1.5 rounded-full mt-1">
        <div class="bg-primary h-1.5 rounded-full" style="width: 90%"></div>
        </div>
        <p class="text-white text-xs mt-1 font-semibold">{{ response?.scores?.experience }}% Match</p>
        </div>
        <div class="flex flex-col items-center gap-1">
        <p class="text-[#9dabb9] text-xs font-bold uppercase tracking-tighter">Education</p>
        <div class="w-full bg-[#283039] h-1.5 rounded-full mt-1">
        <div class="bg-primary h-1.5 rounded-full" style="width: 75%"></div>
        </div>
        <p class="text-white text-xs mt-1 font-semibold">{{ response?.scores?.education }}% Match</p>
        </div>
        <div class="flex flex-col items-center gap-1">
        <p class="text-[#9dabb9] text-xs font-bold uppercase tracking-tighter">Skill Density</p>
        <div class="w-full bg-[#283039] h-1.5 rounded-full mt-1">
        <div class="bg-primary h-1.5 rounded-full" style="width: 82%"></div>
        </div>
        <p class="text-white text-xs mt-1 font-semibold">{{ response?.scores?.skill_density }}% Match</p>
        </div>
        </div>
        </div>
        </div>
            <div class="bg-[#1a232e] rounded-xl p-8 border border-[#283039]">
                <div class="flex justify-between items-center mb-6">
                <h3 class="text-white text-lg font-bold flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">radar</span>
                    Skill Alignment Matrix
                </h3>
                <span class="text-[10px] text-[#9dabb9] bg-[#283039] px-2 py-1 rounded">Last scan: Just now</span>
                </div>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <p class="text-green-500 text-xs font-bold uppercase mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">task_alt</span>
                            Matched Skills ({{ response?.match_skills?.length || 0 }})
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-center justify-between bg-[#0a1118]/50 p-3 rounded-lg border border-[#283039]"
                                v-for="strength in response?.match_skills || []" :key="strength">
                                <span class="text-white text-sm">{{ strength }}</span>
                                <span class="text-green-500 material-symbols-outlined text-sm">verified</span>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <p class="text-amber-500 text-xs font-bold uppercase mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">error</span>
                            Potential Gaps ({{ response?.gap_skills?.length || 0 }})
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-center justify-between bg-[#0a1118]/50 p-3 rounded-lg border border-[#283039]"
                                v-for="gap in response?.gap_skills || []" :key="gap">
                                <span class="text-white text-sm">{{ gap }}</span>
                                <span class="text-amber-500 material-symbols-outlined text-sm">help_outline</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-3 flex flex-col gap-6">
            <div class="bg-[#1a232e] rounded-xl p-6 border border-[#283039] h-full flex flex-col">
                <h3 class="text-white text-lg font-bold mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">psychology</span>
                    Next Steps?
                </h3>
                <div class="space-y-6 flex-1">
                    <div class="p-4 bg-primary/10 rounded-lg border border-primary/20">
                        <p class="text-white text-sm font-medium leading-relaxed">
                            {{ response?.next_steps }}
                        </p>
                    </div>
                    <div class="space-y-4">
                        <h4 class="text-[#9dabb9] text-xs font-bold uppercase flex items-center gap-2">
                            <span class="material-symbols-outlined text-xs">navigation</span>
                            Strategic Advice
                        </h4>
                        <div class="flex gap-3">
                            <div class="shrink-0 size-6 rounded-full bg-primary/20 flex items-center justify-center text-primary text-[10px] font-bold">1</div>
                            <p class="text-[#9dabb9] text-sm leading-tight">Quantify your experience with <strong>high-scale traffic</strong> to match 'Senior' expectations.</p>
                        </div>
                        <div class="flex gap-3">
                            <div class="shrink-0 size-6 rounded-full bg-primary/20 flex items-center justify-center text-primary text-[10px] font-bold">2</div>
                            <p class="text-[#9dabb9] text-sm leading-tight">Highlight <strong>distributed systems</strong> experience to address infrastructure needs.</p>
                        </div>
                        <div class="flex gap-3">
                            <div class="shrink-0 size-6 rounded-full bg-primary/20 flex items-center justify-center text-primary text-[10px] font-bold">3</div>
                            <p class="text-[#9dabb9] text-sm leading-tight">Add details about <strong>mentorship</strong> to satisfy leadership criteria.</p>
                        </div>
                    </div>
                </div>
                <div class="mt-8 pt-6 border-t border-[#283039]">
                    <button class="w-full flex items-center justify-center gap-2 bg-primary py-3 rounded-lg text-sm font-bold hover:bg-blue-600 transition-all shadow-lg shadow-primary/20">
                        <span class="material-symbols-outlined text-sm">auto_fix_high</span>
                        Generate Optimized Resume
                    </button>
                </div>
            </div>
        </div>
        </div>
        <div class="mt-8 bg-[#1a232e] rounded-xl p-6 border border-[#283039]">
        <div class="flex items-center justify-between mb-6">
        <div>
        <h3 class="text-white text-lg font-bold">Optimization Trajectory</h3>
        <p class="text-[#9dabb9] text-xs">Seeing how your fit score evolves with CareerCompass refinements</p>
        </div>
        <div class="flex items-center gap-2">
        <span class="size-3 rounded-sm bg-primary"></span>
        <span class="text-[#9dabb9] text-[10px] uppercase font-bold">Current Iteration</span>
        </div>
        </div>
        <div class="flex items-end gap-3 h-24">
        <div class="flex-1 bg-[#283039] rounded-t relative group" style="height: 60%">
        <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-white text-black text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">Baseline: 60%</div>
        <div class="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
        </div>
        <div class="flex-1 bg-[#283039] rounded-t relative group" style="height: 72%">
        <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-white text-black text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">Edit 1: 72%</div>
        <div class="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
        </div>
        <div class="flex-1 bg-primary rounded-t relative group shadow-[0_-4px_12px_rgba(19,127,236,0.3)]" style="height: 85%">
        <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-white text-black text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">Current: 85%</div>
        </div>
        </div>
        <div class="flex justify-between mt-3 text-[10px] text-[#9dabb9] uppercase font-bold tracking-widest">
        <span>Initial Upload</span>
        <span>Keyword Polish</span>
        <span class="text-primary font-black underline underline-offset-4">Current Compass</span>
        </div>
        </div>
    </main>
</template>