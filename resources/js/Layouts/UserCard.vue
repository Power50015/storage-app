<template>
    <div class="w-full flex py-5 px-5 border-b-[1px] border-[#323248]">
        <div class="profile-img w-full flex flex-row">
            <img :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name"
                class="w-[50px] h-[50px] rounded-lg" />
            <div class="flex flex-col px-3">
                <Link class="text-slate-600 hover:text-blue-700" :href="route('myProfile')">{{
                    $page.props.user.name
                }}</Link>
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <i class="fa-solid fa-gear animate-spin hover:animate-none text-slate-600 hover:text-blue-700 h-fit cursor-pointer"
                @click="open = !open"></i>
        </div>
    </div>
    <div class="flex-col dark:bg-[#1e1e2d] bg-white items-center min-w-[300px] px-2 rounded absolute top-[50px] right-[150px] z-50 shadow-2xl dark:text-white"
        v-if="open">
        <ul class="w-full py-1">
            <li class="w-full py-5 px-3 border-b-[1px] border-slate-500">
                <div class="profile-img w-full flex flex-row">
                    <img :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name"
                        class="w-[50px] h-[50px] rounded-lg" />
                    <div class="flex flex-col px-3">
                        <h6 class="text-slate-600">
                            {{ $page.props.user.name }}
                        </h6>
                        <h6 class="text-slate-600 text-xs">
                            {{ $page.props.user.email }}
                        </h6>
                    </div>
                </div>
            </li>
            <li class="w-full my-1">
                <Link class="hover:bg-slate-900 rounded px-4 py-2 hover:text-blue-700 block w-full text-right"
                    :href="route('myProfile')">{{ $page.props.user.name }}</Link>
            </li>
            <li class="w-full my-1">
                <Link class="hover:bg-slate-900 rounded px-4 py-2 hover:text-blue-700 block w-full text-right"
                    :href="route('profile.show')">تعديل البيانات</Link>
            </li>
            <li class="w-full my-1">
                <Link class="hover:bg-slate-900 rounded px-4 py-2 hover:text-blue-700 block w-full text-right"
                    :href="route('myProfile')">تعديل البرنامج</Link>
            </li>

            <li class="w-full my-1">
                <Link class="hover:bg-slate-900 rounded px-4 py-2 hover:text-blue-700 block w-full text-right"
                    :href="route('myProfile')">البرامج</Link>
            </li>
            <li class="w-full border-t-[1px] border-slate-500 pt-2">
                <Link class="hover:bg-slate-900 rounded px-4 py-2 hover:text-blue-700 block w-full text-right"
                    href="/logout" method="post" as="button" type="button">تسجيل الخروج</Link>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { ref } from "@vue/reactivity";
import { onMounted, onUnmounted } from "@vue/runtime-core";
const open = ref(false);
const closeOnEscape = (e) => {
    if (open.value && e.key === "Escape") {
        open.value = false;
    }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));
onUnmounted(() => document.removeEventListener("keydown", closeOnEscape));
</script>

<style>
aside {
    width: 250px;
}
</style>
