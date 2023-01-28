<script setup>
import { computed, useSlots } from "vue";
import JetSectionTitle from "./SectionTitle.vue";

defineEmits(["submitted"]);

const hasActions = computed(() => !!useSlots().actions);
</script>

<template>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent="$emit('submitted')">
            <div class="px-4 py-5 dark:bg-[#1e1e2d] bg-white dark:text-white text-black" :class="
                hasActions
                    ? 'sm:rounded-tl-md sm:rounded-tr-md'
                    : 'sm:rounded-md'
            ">
                <JetSectionTitle class="mb-4">
                    <template #title>
                        <slot name="title" />
                    </template>
                    <template #description>
                        <slot name="description" />
                    </template>
                </JetSectionTitle>
                <div class="grid grid-cols-6 gap-6">
                    <slot name="form" />
                </div>
            </div>

            <div v-if="hasActions"
                class=" dark:bg-[#1e1e2d] bg-white dark:text-white text-black py-4 px-3">
                <slot name="actions" />
            </div>
        </form>
    </div>
</template>
