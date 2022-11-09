<template>
    <AppLayout title="دائنون">
      <SectionTemplate class="pb-0">
        <h2 class="font-bold text-xl mb-5">دائنون</h2>
        <div class="grid grid-cols-2 gap-2">
          <CardPrimary>
            <h4 class="mb-3">إجمالى الديون</h4>
            <h4 class="text-xl font-bold">
              {{ creditor_total *-1}}
            </h4>
          </CardPrimary>
          <CardInfo>
            <h4 class="mb-3">عدد الدائنون</h4>
            <h4 class="text-xl font-bold">
              {{ creditor_count }}
            </h4>
          </CardInfo>
          <btn-success :element="Link" :to="route('creditor.create')"
            >أضف دين جديد</btn-success
          >
          <btn-warning :element="Link" :to="route('creditor-pay.create')"
            >سداد دفعه</btn-warning
          >
        </div>
      </SectionTemplate>
      <SectionTemplate class="print:p-0">
        <CreditorTabs />
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
  import CreditorTabs from "@/Components/Creditor/CreditorTabs.vue";
  import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
  import BtnWarning from "@/Components/Buttons/BtnWarning.vue";
  
  provide("title", "دائنون");
  provide(
    "breadcrumb",
    readonly([
      { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
      { index: 1, linkTitle: "الدائنون", linkRoute: "#" },
    ])
  );
  const creditor_count = ref();
  const creditor_total = ref();
  
  onMounted(() => {
    axios.get("/creditor-count").then(function (response) {
        creditor_count.value = response.data;
    });
    axios.get("/creditor-total").then(function (response) {
        creditor_total.value = Number(response.data).toFixed(2);
    });
  });
  </script>