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
      <InputTextArea
        v-model="form.address"
        title="عنوان المخزن"
        :error="errors.address"
        :require="true"
      />
    </FormSection>
    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="
            dark:bg-[#1e1e2d]
            bg-white
            dark:text-white
            text-black
            overflow-hidden
            shadow-xl
            rounded-md
            p-4
          "
        >
          <div class="flex content-center items-center justify-between">
            <h2 class="title font-bold">بيانات المخازن</h2>
            <Link
              :href="route('warehouse-stock.create')"
              class="
                bg-[#7239ea]
                border border-transparent
                rounded-md
                py-3
                px-8
                flex
                items-center
                justify-center
                text-base
                font-medium
                text-white
                hover:bg-[#7239ea]
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-[#7239ea]
                cursor-pointer
              "
            >
              أضف مخزون
            </Link>
          </div>
          <warehouse-table
            v-for="item in warehouses"
            :key="item.index"
            :name="item.name"
            :address="item.address"
            :id="item.id"
          />
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { reactive } from "vue";
import { computed, provide, readonly } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { QuillEditor } from "@vueup/vue-quill";

import AppLayout from "@/Layouts/AppLayout.vue";
import WarehouseTable from "@/Components/Warehouse/WarehouseTable.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import InputTextArea from "@/Forms/InputTextArea.vue";

provide("title", "المخازن");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "المخازن", linkRoute: "#" },
  ])
);

const props = defineProps(["errors", "warehouses"]);
const warehouseData = computed(() => {
  return props.warehouse;
});
const form = reactive({
  name: null,
  address: "",
});

</script>