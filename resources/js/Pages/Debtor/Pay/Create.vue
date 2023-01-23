<template>
  <AppLayout title="إضافه دفعه دين">
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
        title="بند الدفعه"
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
      <!-- Pay Type -->
      <FormSelect
        v-model="form.pay_type"
        title="نوع الدفع"
        :error="errors.pay_type"
        :require="true"
        :options="pay"
      />
      <!-- Cash Type -->
      <FormSelect
        v-model="form.cash_id"
        title="نوع الكاش"
        :error="errors.cash_id"
        :require="true"
        :options="cash"
        v-if="form.pay_type"
      />
      <!-- Kit Description-->
      <InputTextArea v-model="form.description" title="تفاصيل الدين" />
    </FormSection>
  </AppLayout>
</template>

<script setup>
import { computed, provide, readonly, ref,reactive } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import InputNumber from "@/Forms/InputNumber.vue";
import InputTextArea from "@/Forms/InputTextArea.vue";
import SelectPeople from "@/Forms/SelectPeople.vue";
import InputDate from "@/Forms/InputDate.vue";
import FormSelect from "@/Forms/FormSelect.vue";

provide("title", "دفعه دين");
const props = defineProps(["errors", "cash","debtor"]);

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
        linkTitle: "تعديل دفعه الدين : " + props.debtor.title,
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
        linkTitle: "إضافه دفعه دين",
        linkRoute: "#",
      },
    ])
  );
}


const form = reactive({
  id: props.debtor ? props.debtor.id : null,
  _method: props.debtor ? "patch" : "post",
  route: props.debtor ? "debtor-pay.update" : "debtor-pay.store",
  people_id: props.debtor ? props.debtor.people_id : null,
  title: props.debtor ? props.debtor.title : null,
  amount: props.debtor ? props.debtor.amount : 0.0,
  description: props.debtor ? props.debtor.description : "",
  pay_type: props.debtor ? props.debtor.pay_type : 0,
  cash_id: props.debtor ? props.debtor.cash_id : null,
  date: props.debtor
    ? props.debtor.date
    : new Date().toISOString(),
});

const formText = reactive({
  title: props.debtor ? "تعديل بيانات الدين" : "إضافه دفعه",
  btnTitle: props.debtor ? "تعديل البيانات" : "إضافه دفعه",
  formText: props.debtor ? "تم تعديل الدين" : "تم أضافه دفعه",
});

const pay = computed(() => {
  return [
    {
      index: 0,
      label: "إعدام",
    },
    {
      index: 1,
      label: "دفع",
    },
  ];
});
const cash = computed(() => {
  return props.cash.map((item) => {
    return {
      index: item.id,
      label: item.title,
    };
  });
});
</script>
