<template>
  <AppLayout title="إضافه مخزن">
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
      <InputTextArea v-model.lazy="form.address" title="عنوان المخزن" />
    </FormSection>
  </AppLayout>
</template>
  
  <script setup>
import {  provide, readonly, reactive} from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
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

const props = defineProps(["errors"]);

const form = reactive({
  name: null,
  address: null,
});
</script>
  