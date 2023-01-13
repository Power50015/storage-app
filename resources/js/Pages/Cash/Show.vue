<template>
    <AppLayout title="الكاش">
        <SectionTemplate class="print:p-0">
            <div class="flex justify-between md:flex-row flex-col-reverse">
                <div class="flex justify-around flex-col w-full">
                    <h2 class="font-bold text-lg">
                        {{ cash.title }}
                    </h2>
                    <h2 class="title font-bold text-lg text-[#009ef7]">
                        إجمالى المتاح : {{ Number(cash.available).toFixed(2) }}
                    </h2>
                    <div class="flex print:hidden">
                        <btn-info :element="Link" :to="route('cash.edit', cash.id)" class="mt-4">
                            تعديل بيانات
                        </btn-info>
                    </div>
                </div>
            </div>
        </SectionTemplate>
        <SectionTemplate class="print:p-0">
            <CashTabs :id="cash.id" />
        </SectionTemplate>
    </AppLayout>
</template>

<script setup>
import { reactive, computed, provide, readonly, ref, watch } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import BtnInfo from "@/Components/Buttons/BtnInfo.vue";
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
import CashTabs from "@/Components/Cash/CashTabs.vue";

const props = defineProps(["cash"]);

provide("title", "الكاش");
provide(
    "breadcrumb",
    readonly([
        { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
        { index: 1, linkTitle: "الكاش", linkRoute: "cash.index" },
        {
            index: 2,
            linkTitle: "الكاش " + props.cash[0].title,
            linkRoute: "#",
        },
    ])
);

const cash = computed(() => props.cash[0]);
</script>
