<template>
  <AppLayout title="المخزن">
    <SectionTemplate class="print:p-0">
      <div class="flex justify-between md:flex-row flex-col-reverse">
        <div class="flex justify-around flex-col w-full">
          <h2 class="font-bold mb-3 text-lg">
            {{ warehouse.name }}
          </h2>
          <h2 class="font-bold mb-3 text-lg">
            {{ warehouse.address }}
          </h2>
          <div class="flex print:hidden">
            <btn-info
              :element="Link"
              :to="route('warehouse.edit', warehouse.id)"
              class="mt-4"
            >
              تعديل بيانات
            </btn-info>
          </div>
        </div>
      </div>
    </SectionTemplate>
    <SectionTemplate class="print:p-0">
      <WarehouseTabs :id="warehouse.id" />
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
import WarehouseTabs from "@/Components/Warehouse/WarehouseTabs.vue";

const props = defineProps(["warehouse"]);

provide("title", "المخزن");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "المخازن", linkRoute: "warehouse.index" },
    {
      index: 2,
      linkTitle: "  " + props.warehouse.name,
      linkRoute: "#",
    },
  ])
);

const warehouse = computed(() => props.warehouse);
</script>