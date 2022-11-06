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

const props = defineProps(["errors", "debtor"]);

if (props.debtor) {
  provide(
    "breadcrumb",
    readonly([
      { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
      {
        index: 1,
        linkTitle: "مدينون",
        linkRoute: "debtor.index",
      },
      {
        index: 2,
        linkTitle: "تعديل الدين : " + props.debtor.title,
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
        linkTitle: "مدينون",
        linkRoute: "debtor.index",
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
  id: props.debtor ? props.debtor.id : null,
  _method: props.debtor ? "patch" : "post",
  route: props.debtor ? "debtor.update" : "debtor.store",
  people_id: props.debtor ? props.debtor.people_id : null,
  title: props.debtor ? props.debtor.title : null,
  amount: props.debtor ? props.debtor.amount : 0.0,
  description: props.debtor ? props.debtor.description : "",
  date: props.debtor ? props.debtor.date : new Date().toISOString(),
});

const formText = reactive({
  title: props.debtor ? "تعديل بيانات الدين" : "إضافه دين",
  btnTitle: props.debtor ? "تعديل البيانات" : "إضافه دين",
  formText: props.debtor ? "تم تعديل الدين" : "تم أضافه دين",
});
</script>
