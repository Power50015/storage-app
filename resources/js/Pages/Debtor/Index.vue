<template>
  <AppLayout title="مدينون">
    <SectionTemplate class="pb-0">
      <h2 class="font-bold text-xl mb-5">مدينون</h2>
      <div class="grid lg:grid-cols-2 grid-cols-1 gap-1.5">
        <CardPrimary>
          <h4 class="mb-3">إجمالى الديون</h4>
          <h4 class="text-xl font-bold">
            {{ props.debtor_total.toFixed(2) *-1}}
          </h4>
        </CardPrimary>
        <CardInfo>
          <h4 class="mb-3">عدد المدينون</h4>
          <h4 class="text-xl font-bold">
            {{ props.debtor_count }}
          </h4>
        </CardInfo>
        <btn-success :element="Link" :to="route('debtor.create')"
          >أضف دين جديد</btn-success
        >
        <btn-warning :element="Link" :to="route('debtor-pay.create')"
          >سداد دفعه</btn-warning
        >
      </div>
    </SectionTemplate>
    <SectionTemplate class="print:p-0">
      <DebtorTabs />
    </SectionTemplate>
  </AppLayout>
</template>
  
  <script setup>
import { onMounted, provide, readonly, ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import CardPrimary from "@/Components/Cards/Statistics/CardPrimary.vue";
import CardInfo from "@/Components/Cards/Statistics/CardInfo.vue";
import DebtorTabs from "@/Components/Debtor/DebtorTabs.vue";
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
import BtnWarning from "@/Components/Buttons/BtnWarning.vue";

provide("title", "مدينون");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "المدينون", linkRoute: "#" },
  ])
);

const props = defineProps(["debtor_count","debtor_total"]);
</script>