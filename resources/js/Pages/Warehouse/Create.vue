<template>
  <AppLayout title="إضافه مخزن">
    <FormSection
      :title="formText.title"
      :btnTitle="formText.btnTitle"
      :formData="form"
      :formRoute="form.route"
      :toastMsg="formText.formText"
      :toastDescription="form.title"
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
import { provide, readonly, reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import InputTextArea from "@/Forms/InputTextArea.vue";

provide("title", "المخازن");

const props = defineProps(["errors", "warehouse"]);

const form = reactive({
  id: props.warehouse ? props.warehouse.id : null,
  _method: props.warehouse ? "patch" : "post",
  route: props.warehouse ? "warehouse.update" : "warehouse.store",
  name: props.warehouse ? props.warehouse.name : null,
  address: props.warehouse ? props.warehouse.address : null,
});

if (props.warehouse) {
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
        linkTitle: "تعديل  المخزن : " + props.warehouse.name,
        linkRoute: "#",
      },
    ])
  );
} else {
  provide(
    "breadcrumb",
    readonly([
      { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
      { index: 1, linkTitle: "المخازن", linkRoute: "#" },
    ])
  );
}

const formText = reactive({
  title: props.warehouse ? "تعديل بيانات  مخزن" : "إضافه مخزن ",
  btnTitle: props.warehouse ? "تعديل مخزن" : "إضافه مخزن",
  formText: props.warehouse ? "تم تعديل مخزن" : "تم أضافه مخزن",
});
</script>
  