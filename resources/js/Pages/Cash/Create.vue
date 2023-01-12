<template>
  <AppLayout title="إضافه كاش">
    <FormSection
      :title="formText.title"
      :btnTitle="formText.btnTitle"
      :formData="form"
      :formRoute="form.route"
      :toastMsg="formText.formText"
      :toastDescription="form.title"
    >
      <!-- Title -->
      <InputText
        v-model="form.title"
        title="الكاش"
        :error="errors.title"
        :require="true"
      />
    </FormSection>
  </AppLayout>
</template>

<script setup>
import { computed, provide, readonly, ref, reactive } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";

provide("title", "الكاش");

const props = defineProps(["errors", "cash"]);

if (props.cash) {
  provide(
    "breadcrumb",
    readonly([
      { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
      {
        index: 1,
        linkTitle: "الكاش",
        linkRoute: "creditor.index",
      },
      {
        index: 2,
        linkTitle: "تعديل الكاش : " + props.cash.title,
        linkRoute: "#",
      },
    ])
  );
} else {
  provide(
    "breadcrumb",
    readonly([
      { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
      {
        index: 1,
        linkTitle: "دائنون",
        linkRoute: "cash.index",
      },
      {
        index: 2,
        linkTitle: "إضافه الكاش",
        linkRoute: "#",
      },
    ])
  );
}

const form = reactive({
  id: props.cash ? props.cash.id : null,
  _method: props.cash ? "patch" : "post",
  route: props.cash ? "cash.update" : "cash.store",
  title: props.cash ? props.cash.title : null,
  });

const formText = reactive({
  title: props.cash ? "تعديل بيانات الكاش" : "إضافه الكاش",
  btnTitle: props.cash ? "تعديل البيانات" : "إضافه الكاش",
  formText: props.cash ? "تم تعديل الكاش" : "تم أضافه الكاش",
});
</script>
