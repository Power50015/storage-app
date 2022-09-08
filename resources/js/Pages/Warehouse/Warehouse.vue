<template>
  <AppLayout title="المخازن">
    <FormSection
      title="إضافه مخزن"
      btnTitle="حفظ المخزن"
      :formData="form"
      formRoute="warehouse.store"
      toastMsg="تم تسجيل المخزن"
      :toastDescription="`تم تسجيل المخزن : ${form.name}`"
    >
      <InputText
        v-model="form.name"
        title="أسم المخزن"
        :error="errors.name"
        :require="true"
      />
      <InputTextArea v-model="form.address" title="عنوان المخزن" />
    </FormSection>
    <SectionTemplate>
      <div class="flex content-center items-center justify-between">
        <h2 class="title font-bold">بيانات المخازن</h2>
        <btn-info :element="Link" :to="route('warehouse-stock.create')">
          أضف مخزون
        </btn-info>
      </div>
      <warehouse-table
        v-for="item in warehouses"
        :key="item.index"
        :name="item.name"
        :address="item.address"
        :id="item.id"
      />
    </SectionTemplate>
  </AppLayout>
</template>

<script setup>
import { reactive } from "vue";
import { computed, provide, readonly } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";

import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import InputTextArea from "@/Forms/InputTextArea.vue";
import BtnInfo from "@/Components/Buttons/BtnInfo.vue";
import WarehouseTable from "@/Components/Warehouse/WarehouseTable.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";

provide("title", "المخازن");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "المخازن", linkRoute: "#" },
  ])
);

const props = defineProps(["errors", "warehouses"]);

const warehouseData = computed(() => props.warehouse);

const form = reactive({
  name: null,
  address: null,
});
</script>