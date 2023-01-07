<template>
    <AppLayout title="المصروف">
        <SectionTemplate class="print:p-0">
            <div class="flex justify-between md:flex-row	flex-col-reverse">
                <div class="flex justify-around flex-col w-full">
                    <h2 class="font-bold mb-3 text-lg">
                        {{ expense.title }}
                    </h2>
                    <h2 class="font-bold mb-3 text-lg">
                        {{ expense.amount }}
                    </h2>
                    <Link :href="route('cash.show', expense.cash.id)">
                    <h2 class="title font-bold text-lg hover:text-[#009ef7]">
                        نوع الكاش : {{ expense.cash.title }}
                    </h2>
                    </Link>
                    <div class="flex print:hidden">
                        <btn-info :element="Link" :to="route('expense.edit', expense.id)" class="mt-4">
                            تعديل بيانات
                        </btn-info>
                    </div>
                </div>
            </div>
        </SectionTemplate>
        <SectionTemplate class="print:p-0">
            <ExpenseTabs :id="expense.id" :description="expense.description" />
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
import ExpenseTabs from "@/Components/Expense/ExpenseTabs.vue";

const props = defineProps(["expense"]);

provide("title", "المصروفات");
provide(
    "breadcrumb",
    readonly([
        { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
        { index: 1, linkTitle: "المصروفات", linkRoute: "expense.index" },
        {
            index: 2,
            linkTitle: "  " + props.expense[0].title,
            linkRoute: "#",
        },
    ])
);

const expense = computed(() => props.expense[0]);
</script>