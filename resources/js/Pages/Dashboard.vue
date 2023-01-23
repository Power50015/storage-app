<template>
    <AppLayout title="لوحه التحكم">
        <SectionTemplate class="pb-0">
            <h2 class="font-bold text-xl mb-5">بيانات الكاش</h2>
            <div class="grid grid-cols-2 gap-2">
                <CardWarning class="mx-3">
                    <h4 class="mb-3">عدد طرق الكاش المتاحه</h4>
                    <h4 class="text-xl font-bold">{{ totalCashesWay }}</h4>
                </CardWarning>
                <CardDanger>
                    <h4 class="mb-3">إجمالى الكاش</h4>
                    <h4 class="text-xl font-bold">{{ totalCashes }}</h4>
                </CardDanger>
            </div>
        </SectionTemplate>
        <SectionTemplate class="pb-0">
            <h2 class="font-bold text-xl mb-5">الفواتير الصادره</h2>
            <div class="grid grid-cols-5 gap-3">
                <CardPrimary>
                    <h4 class="mb-3">الفواتير اليوم</h4>
                    <h4 class="text-xl font-bold">
                        {{ totalOutgoingInvoiceThisDay }}
                    </h4>
                </CardPrimary>
                <CardInfo>
                    <h4 class="mb-3">الفواتير الأسبوع</h4>
                    <h4 class="text-xl font-bold">
                        {{ totalOutgoingInvoiceThisWeek }}
                    </h4>
                </CardInfo>
                <CardDanger>
                    <h4 class="mb-3">الفواتير الشهر</h4>
                    <h4 class="text-xl font-bold">
                        {{ totalOutgoingInvoiceThisMonth }}
                    </h4>
                </CardDanger>
                <CardSuccess>
                    <h4 class="mb-3">الفواتير السنه</h4>
                    <h4 class="text-xl font-bold">
                        {{ totalOutgoingInvoiceThisYear }}
                    </h4>
                </CardSuccess>
                <CardWarning>
                    <h4 class="mb-3">الفواتير على النظام</h4>
                    <h4 class="text-xl font-bold">
                        {{ totalOutgoingInvoice }}
                    </h4>
                </CardWarning>
            </div>
        </SectionTemplate>
        <SectionTemplate class="pb-0">

            <h2 class="font-bold text-xl mb-5">الفواتير الوارده</h2>
            <div class="grid grid-cols-5 gap-3">
                <CardPrimary>
                    <h4 class="mb-3">الفواتير اليوم</h4>
                    <h4 class="text-xl font-bold">
                        {{ totalIncomingInvoiceThisDay }}
                    </h4>
                </CardPrimary>
                <CardInfo>
                    <h4 class="mb-3">الفواتير الأسبوع</h4>
                    <h4 class="text-xl font-bold">
                        {{ totalIncomingInvoiceThisWeek }}
                    </h4>
                </CardInfo>
                <CardDanger>
                    <h4 class="mb-3">الفواتير الشهر</h4>
                    <h4 class="text-xl font-bold">
                        {{ totalIncomingInvoiceThisMonth }}
                    </h4>
                </CardDanger>
                <CardSuccess>
                    <h4 class="mb-3">الفواتير السنه</h4>
                    <h4 class="text-xl font-bold">
                        {{ totalIncomingInvoiceThisYear }}
                    </h4>
                </CardSuccess>
                <CardWarning>
                    <h4 class="mb-3">الفواتير على النظام</h4>
                    <h4 class="text-xl font-bold">
                        {{ totalIncomingInvoice }}
                    </h4>
                </CardWarning>
            </div>
        </SectionTemplate>
        <SectionTemplate class="pb-0">
            <h2 class="font-bold text-xl mb-5">المصروفات</h2>
            <div class="grid grid-cols-5 gap-3">
                <CardPrimary>
                    <h4 class="mb-3">مصروفات اليوم</h4>
                    <h4 class="text-xl font-bold">
                        {{ totalExpenseThisDay }}
                    </h4>
                </CardPrimary>
                <CardInfo>
                    <h4 class="mb-3">مصروفات الأسبوع</h4>
                    <h4 class="text-xl font-bold">
                        {{ totalExpenseThisWeek }}
                    </h4>
                </CardInfo>
                <CardDanger>
                    <h4 class="mb-3">مصروفات الشهر</h4>
                    <h4 class="text-xl font-bold">
                        {{ totalExpenseThisMonth }}
                    </h4>
                </CardDanger>
                <CardSuccess>
                    <h4 class="mb-3">مصروفات السنه</h4>
                    <h4 class="text-xl font-bold">
                        {{ totalExpenseThisYear }}
                    </h4>
                </CardSuccess>
                <CardWarning>
                    <h4 class="mb-3">المصروفات على النظام</h4>
                    <h4 class="text-xl font-bold">
                        {{ totalExpense }}
                    </h4>
                </CardWarning>
            </div>
        </SectionTemplate>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SectionTemplate from "@/Components/SectionTemplate.vue";
import CardPrimary from "@/Components/Cards/Statistics/CardPrimary.vue";
import CardInfo from "@/Components/Cards/Statistics/CardInfo.vue";
import CardDanger from "@/Components/Cards/Statistics/CardDanger.vue";
import CardSuccess from "@/Components/Cards/Statistics/CardSuccess.vue";
import CardWarning from "@/Components/Cards/Statistics/CardWarning.vue";
import { provide, readonly } from "@vue/runtime-core";

provide("title", "لوحه التحكم");
provide(
    "breadcrumb",
    readonly([{ index: 0, linkTitle: "الرئيسية", linkRoute: "#" }])
);

const props = defineProps([
    "totalIncomingInvoice",
    "totalIncomingInvoiceThisDay",
    "totalIncomingInvoiceThisWeek",
    "totalIncomingInvoiceThisMonth",
    "totalIncomingInvoiceThisYear",
    "totalOutgoingInvoice",
    "totalOutgoingInvoiceThisDay",
    "totalOutgoingInvoiceThisWeek",
    "totalOutgoingInvoiceThisMonth",
    "totalOutgoingInvoiceThisYear",
    "totalCashesWay",
    "totalCashes",
    "totalExpense",
    "totalExpenseThisDay",
    "totalExpenseThisWeek",
    "totalExpenseThisMonth",
    "totalExpenseThisYear",
]);
</script>
