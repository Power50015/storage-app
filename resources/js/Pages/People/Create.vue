<template>
  <AppLayout title="الشركات">
    <FormSection
      title="إضافه شركه"
      btnTitle="حفظ الشركه"
      :formData="form"
      formRoute="people.store"
      toastMsg="تم تسجيل الشركه"
    >
      <!-- People Name -->
      <InputText
        v-model="form.name"
        title="أسم الشركه"
        :error="errors.name"
        :require="true"
      />
      <!-- People Type -->
      <FormSelect
        v-model="form.type"
        title="نوع الشركه"
        :error="errors.type"
        :require="true"
        :options="type"
      />
      <!-- People Phone -->
      <InputPhone
        v-model="form.phone"
        title="رقم الهاتف"
        :error="errors.phone"
      />
      <!-- People Description -->
      <InputTextArea v-model="form.address" title="عنوان الشركه" />
      <!-- People Logo -->
      <InputImage
        v-model="form.logo"
        title="شعار الشركه"
        :error="errors.logo"
      />
    </FormSection>
  </AppLayout>
</template>

<script setup>
import { provide, readonly, ref, reactive } from "@vue/runtime-core";
import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import FormSelect from "@/Forms/FormSelect.vue";
import InputPhone from "@/Forms/InputPhone.vue";
import InputTextArea from "@/Forms/InputTextArea.vue";
import InputImage from "@/Forms/InputImage.vue";

provide("title", "الشركات");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "الشركات", linkRoute: "#" },
  ])
);

const props = defineProps(["errors"]);

const form = reactive({
  name: null,
  phone: null,
  address: null,
  type: null,
  logo: null,
});

const type = [
  { label: "عميل", index: "عميل" },
  { label: "مورد", index: "مورد" },
];
</script>
