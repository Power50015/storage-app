<template>
  <AppLayout title="إضافه دين">
    <FormSection
      :title="formText.title"
      :btnTitle="formText.btnTitle"
      :formData="form"
      :formRoute="form.route"
      :toastMsg="formText.formText"
      :toastDescription="form.title"
    >
      <!-- Companies -->
      <SelectPeople v-model="form.people_id" title="الشركه" />
      <!-- Title -->
      <InputText
        v-model="form.title"
        title="بند الدين"
        :error="errors.title"
        :require="true"
      />
      <!-- Date -->
      <InputDate
        v-model="form.date"
        title="تاريخ الدين"
        :error="errors.date"
        :require="true"
      />
      <!-- Amount -->
      <InputNumber
        v-model="form.amount"
        title="مبلغ الدين"
        :error="errors.amount"
        :require="true"
      />
      <!-- Kit Description-->
      <InputTextArea v-model="form.description" title="تفاصيل الدين" />
    </FormSection>
  </AppLayout>
</template>

<script setup>
import { computed, provide, readonly, ref, reactive } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import InputNumber from "@/Forms/InputNumber.vue";
import InputTextArea from "@/Forms/InputTextArea.vue";
import SelectPeople from "@/Forms/SelectPeople.vue";
import InputDate from "@/Forms/InputDate.vue";

provide("title", "دين");

const props = defineProps(["errors", "creditor"]);

if (props.creditor) {
  provide(
    "breadcrumb",
    readonly([
      { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
      {
        index: 1,
        linkTitle: "مدينون",
        linkRoute: "creditor.index",
      },
      {
        index: 2,
        linkTitle: "تعديل الدين : " + props.creditor.title,
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
        linkRoute: "creditor.index",
      },
      {
        index: 2,
        linkTitle: "إضافه دين",
        linkRoute: "#",
      },
    ])
  );
}

const form = reactive({
  id: props.creditor ? props.creditor.id : null,
  _method: props.creditor ? "patch" : "post",
  route: props.creditor ? "creditor.update" : "creditor.store",
  people_id: props.creditor ? props.creditor.people_id : null,
  title: props.creditor ? props.creditor.title : null,
  amount: props.creditor ? props.creditor.amount : 0.0,
  description: props.creditor ? props.creditor.description : "",
  date: props.creditor ? props.creditor.date : new Date().toISOString(),
});

const formText = reactive({
  title: props.creditor ? "تعديل بيانات الدين" : "إضافه دين",
  btnTitle: props.creditor ? "تعديل البيانات" : "إضافه دين",
  formText: props.creditor ? "تم تعديل الدين" : "تم أضافه دين",
});
</script>
