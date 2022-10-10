<template>
  <AppLayout title="إضافه مخزون">
    <FormSection
      title="إضافه مخزون"
      btnTitle="حفظ المخزون"
      :formData="form"
      formRoute="warehouse-stock.store"
      toastMsg="تم تسجيل المخزون"
    >
      <FormSelect
        v-model="form.warehouses"
        title="المخزن"
        :error="errors.warehouses"
        :require="true"
        :options="options"
      />
      <InputText
        v-model="form.title"
        title="البند"
        :error="errors.title"
        :require="true"
      />
      <!-- Content-->
      <div class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3">
        <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
          محتوى المخزون من المنتجات
        </h2>
        <div v-for="(i, index) in form.content" :key="index" class="mb-3">
          <!-- product -->
          <FormSelect
            v-model="form.content[index].product_id"
            title="المنتج"
            :options="products"
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
            <BtnDanger
              @click="
                form.content = form.content.filter((item) => item.id != i.id);
                total();
              "
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
          <FormSelect
            v-model="form.kit[index].kit_id"
            title="قطعه الغيار"
            :options="kits"
          />
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
            <BtnDanger
              @click="
                form.kit = form.kit.filter((item) => item.id != i.id);
                total();
              "
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

provide("title", "إضافه مخزون");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    {
      index: 1,
      linkTitle: "المخازن",
      linkRoute: "warehouse.index",
    },
    {
      index: 2,
      linkTitle: "إضافه مخزون",
      linkRoute: "#",
    },
  ])
);

const props = defineProps(["errors", "products", "warehouses", "kits"]);

const products = computed(() => {
  return props.products.map((item) => {
    return {
      index: item.id,
      image: item.image,
      label:
        item.name +
        (item.product_collection ? " | " + item.product_collection.name : "") +
        (item.product_model ? " | " + item.product_model.name : "") +
        (item.product_brand ? " | " + item.product_brand.name : "") +
        (item.product_category ? " | " + item.product_category.name : "") +
        (item.product_type ? " | " + item.product_type.name : "") +
        (item.product_color ? " | " + item.product_color.name : "") +
        (item.product_material ? " | " + item.product_material.name : "") +
        (item.product_country ? " | " + item.product_country.name : ""),
    };
  });
});
const kits = computed(() => {
  return props.kits.map((item) => {
    return {
      index: item.id,
      image: item.image,
      label:
        item.title +
        (item.product ? " | " + item.product.name : "") +
        (item.product && item.product.product_collection
          ? " | " + item.product.product_collection.name
          : "") +
        (item.product && item.product.product_model
          ? " | " + item.product.product_model.name
          : "") +
        (item.product && item.product.product_brand
          ? " | " + item.product.product_brand.name
          : "") +
        (item.product && item.product.product_category
          ? " | " + item.product.product_category.name
          : "") +
        (item.product && item.product.product_type
          ? " | " + item.product.product_type.name
          : "") +
        (item.product && item.product.product_color
          ? " | " + item.product.product_color.name
          : "") +
        (item.product && item.product.product_material
          ? " | " + item.product.product_material.name
          : "") +
        (item.product && item.product.product_country
          ? " | " + item.product.product_country.name
          : ""),
    };
  });
});

const options = props.warehouses.map((item) => {
  return { label: item.name, index: item.id };
});

const form = reactive({
  title: null,
  warehouses: null,
  content: [],
  kit: [],
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
</script>