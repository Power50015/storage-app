<template>
  <AppLayout title="إضافه مخزون">
    <FormSection
      :title="formText.title"
      :btnTitle="formText.btnTitle"
      :formData="form"
      :formRoute="form.route"
      :toastMsg="formText.formText"
      :toastDescription="form.title"
    >
      <FormSelect
        v-model="form.warehouse_id"
        title="المخزن"
        :error="errors.warehouse_id"
        :require="true"
        :options="options"
      />
      <InputText
        v-model="form.title"
        title="البند"
        :error="errors.title"
        :require="true"
      />
      <!-- Date -->
      <InputDate
        v-model="form.date"
        title="تاريخ الفاتوره"
        :error="errors.date"
        :require="true"
      />
      <!-- Content-->
      <div class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3">
        <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
          محتوى المخزون من المنتجات
        </h2>
        <div
          v-for="(i, index) in form.content"
          :key="index"
          class="mb-3"
          :id="`product-${index}`"
        >
          <!-- product -->
          <select-product
            v-model="form.content[index].product_id"
            title=" المنتج"
          />
          <div class="w-full flex items-end justify-around">
            <!-- Quanty -->
            <InputNumber
              v-model="form.content[index].quantity"
              title="كميه المنتج"
              :step="1"
              :min="1"
              :require="true"
            />
            <!-- Delete -->
            <BtnDanger @click="remove(i, index, 'content')"
              ><i class="fa-solid fa-xmark"></i
            ></BtnDanger>
          </div>
        </div>
        <!--New Item-->
        <BtnSuccess @click="pushToContent"> أضف بند</BtnSuccess>
      </div>
      <!-- Kits -->
      <div class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3">
        <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
          قطع الغيار
          <span class="text-red-800 font-bold">*</span>
        </h2>
        <div v-for="(i, index) in form.kit" :key="index" class="mb-3">
          <!-- kit -->
          <select-kits v-model="form.kit[index].kit_id" title=" قطعه الغيار" />
          <div class="w-full flex items-end justify-around">
            <!-- Quanty -->
            <InputNumber
              v-model="form.kit[index].quantity"
              title="كميه القطعه"
              :step="1"
              :min="1"
              :require="true"
            />
            <!-- Delete -->
            <BtnDanger @click="remove(i, index, 'kit')"
              ><i class="fa-solid fa-xmark"></i
            ></BtnDanger>
          </div>
        </div>
        <!--New Item-->
        <BtnSuccess @click="pushToKit"> أضف بند</BtnSuccess>
      </div>
    </FormSection>
  </AppLayout>
</template>

<script setup>
import { reactive, ref } from "vue";
import { computed, provide, readonly } from "@vue/runtime-core";

import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import FormSelect from "@/Forms/FormSelect.vue";
import InputNumber from "@/Forms/InputNumber.vue";
import BtnDanger from "@/Components/Buttons/BtnDanger.vue";
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
import SelectProduct from "@/Forms/SelectProduct.vue";
import SelectKits from "@/Forms/SelectKits.vue";
import InputDate from "@/Forms/InputDate.vue";


const props = defineProps([
  "errors",
  "warehouses",
  "warehouseStock",
  "warehouseStockContent",
  "kitStock",
]);

const options = props.warehouses.map((item) => {
  return { label: item.name, index: item.id };
});

const form = reactive({
  id: props.warehouseStock ? props.warehouseStock.id : null,
  _method: props.warehouseStock ? "patch" : "post",
  route: props.warehouseStock
    ? "warehouse-stock.update"
    : "warehouse-stock.store",
  title: props.warehouseStock ? props.warehouseStock.title : null,
  warehouse_id: props.warehouseStock ? props.warehouseStock.warehouse_id : null,
  content: props.warehouseStock ? props.warehouseStockContent : [],
  kit: props.warehouseStock ? props.kitStock : [],
  date: props.warehouseStock
    ? new Date(props.warehouseStock.date).toISOString().slice(0, 10)
    : new Date().toISOString().slice(0, 10),
});

function pushToContent() {
  form.content.push({
    id: form.content.length + 1,
    product_id: null,
    quantity: 1,
  });
}

function pushToKit() {
  form.kit.push({
    id: form.kit.length + 1,
    kit_id: null,
    quantity: 1,
  });
}

if (props.warehouse) {
  provide(
    "breadcrumb",
    readonly([
      { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
      {
        index: 1,
        linkTitle: "المخزون",
        linkRoute: "warehouse.index",
      },
      {
        index: 2,
        linkTitle: "تعديل المخزون : " + props.warehouseStock.title,
        linkRoute: "#",
      },
    ])
  );
} else {
  provide(
    "breadcrumb",
    readonly([
      { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
      { index: 1, linkTitle: "المخزون", linkRoute: "#" },
    ])
  );
}

const formText = reactive({
  title: props.warehouseStock ? "تعديل بيانات  المخزون" : "إضافه مخزون ",
  btnTitle: props.warehouseStock ? "تعديل المخزون" : "إضافه مخزون",
  formText: props.warehouseStock ? "تم تعديل المخزون" : "تم أضافه مخزون",
});

function remove(i, index, content) {
  let x = form[content];
  x = form[content].filter((item) => item.id != i.id);
  form[content] = x;
}
</script>