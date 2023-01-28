<template>
    <AppLayout title="لوحه التحكم">
        <SectionTemplate class="pb-0">
            <div class="flex justify-between xl:flex-row flex-col-reverse">
                <div class="flex flex-col w-full mx-3">
                    <div class="text-lg font-bold mt-3">
                        <h2 class="mx-3 text-[#009ef7]">
                            {{ user.name }}
                        </h2>
                        <h2 class="mx-3 text-[#009ef7]">
                            {{ user.email }}
                        </h2>
                    </div>
                </div>
                <div class="mb-3">
                    <a :href="user.profile_photo_url" target="_blank">
                        <img :src="user.profile_photo_url" :alt="user.name" class="
                w-full
                h-[270px]
                object-center object-cover
                group-hover:opacity-75
                shadow-xl
                rounded-md
              " height="270" width="270" /></a>
                </div>
            </div>
        </SectionTemplate>

    </AppLayout>
</template>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SectionTemplate from "@/Components/SectionTemplate.vue";
import { provide, readonly } from "@vue/runtime-core";

provide("title", "المستخدم");
provide(
    "breadcrumb",
    readonly([{ index: 0, linkTitle: "الرئيسية", linkRoute: "#" }])
);

const props = defineProps([
    "user",
]);
</script>
