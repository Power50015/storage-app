<template>
  <AppLayout title="قطع غيار">
    <FormSection
      title="إضافه قطع غيار"
      btnTitle="حفظ  قطعه غيار"
      :formData="form"
      formRoute="kit.store"
      toastMsg="تم أضافه قطعه الغيار"
      :toastDescription="form.title"
    >
      <!-- Kit Title -->
      <InputText
        v-model="form.title"
        title="أسم قطعه غيار"
        :error="errors.title"
        :require="true"
      />
      <!-- Kit Product -->
      <SelectProduct v-model="form.product_id" title=" المنتج" />
      <!-- Kit Description-->
      <InputTextArea v-model="form.description" title="تفاصيل قطعه الغيار" />
      <!-- Kit Images-->
      <InputImage
        v-model="form.image"
        title="صوره القطعه"
        :error="errors.image"
      />
    </FormSection>
  </AppLayout>
</template>

<script setup>
import { reactive } from "vue";
import { computed, provide, readonly, ref } from "@vue/runtime-core";
import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Forms/FormSection.vue";
import FormSelect from "@/Forms/FormSelect.vue";
import InputText from "@/Forms/InputText.vue";
import InputTextArea from "@/Forms/InputTextArea.vue";
import InputImage from "@/Forms/InputImage.vue";
import SelectProduct from "@/Forms/SelectProduct.vue";

provide("title", "قطع غيار");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    {
      index: 1,
      linkTitle: "قطع غيار",
      linkRoute: "#",
    },
  ])
);

const props = defineProps(["errors"]);

const products = computed(() => {
  return props.products.map((item) => {
    let name = item.name;
    if (item.product_collection)
      name = name + " | " + item.product_collection.name;
    if (item.product_model) name = name + " | " + item.product_model.name;
    if (item.product_brand) name = name + " | " + item.product_brand.name;
    if (item.product_category) name = name + " | " + item.product_category.name;
    if (item.product_type) name = name + " | " + item.product_type.name;
    if (item.product_color) name = name + " | " + item.product_color.name;
    if (item.product_material) name = name + " | " + item.product_material.name;
    if (item.product_country) name = name + " | " + item.product_country.name;
    return {
      label: name,
      index: item.id,
      image: item.image,
    };
  });
});

const form = reactive({
  title: null,
  product_id: null,
  description: null,
  image: null,
});
</script>