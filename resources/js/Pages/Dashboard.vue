<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Jetstream/Welcome.vue';
import { provide, readonly } from "@vue/runtime-core";

provide("title", "لوحه التحكم");
provide(
    "breadcrumb",
    readonly([{ index: 0, linkTitle: "الرئيسية", linkRoute: "#" }])
);
</script>

<template>
    <AppLayout title="لوحه التحكم">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome />
                </div>
            </div>
        </div>
        
    </AppLayout>
</template>
