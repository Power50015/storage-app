<template>
  <AppLayout title="إضافه دفعه كاش">
    <FormSection :title="formText.title" :btnTitle="formText.btnTitle" :formData="form" :formRoute="form.route"
      :toastMsg="formText.formText" :toastDescription="form.title">
      <!-- Cash Type -->
      <FormSelect v-model="form.cash_id" title="نوع الكاش" :error="errors.cash_id" :require="true" :options="cash" />
      <!-- Title -->
      <InputText v-model="form.title" title="بند الدفعه" />
      <!-- Date -->
      <InputDate v-model="form.date" title="تاريخ الدفعه" :error="errors.date" :require="true" />
      <!-- Amount -->
      <InputNumber v-model="form.amount" title="مبلغ الدفعه" :error="errors.amount" :require="true" />
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
import FormSelect from "@/Forms/FormSelect.vue";

provide("title", "دفعه كاش");
const props = defineProps(["errors", "cash", "cashPay"]);

if (props.cashPay) {
  provide(
    "breadcrumb",
    readonly([
      { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
      {
        index: 1,
        linkTitle: "الكاش",
        linkRoute: "cash.index",
      },
      {
        index: 2,
        linkTitle: "تعديل دفعه الكاش : " + props.cashPay.title,
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
        linkTitle: "الكاش",
        linkRoute: "cash.index",
      },
      {
        index: 2,
        linkTitle: "إضافه دفعه كاش",
        linkRoute: "#",
      },
    ])
  );
}


const form = reactive({
  id: props.cashPay ? props.cashPay.id : null,
  _method: props.cashPay ? "patch" : "post",
  route: props.cashPay ? "cash-pay.update" : "cash-pay.store",
  title: props.cashPay ? props.cashPay.title : null,
  amount: props.cashPay ? props.cashPay.amount : 0.0,
  cash_id: props.cashPay ? props.cashPay.cash_id : null,
  date: props.cashPay
    ? props.cashPay.date
    : new Date().toISOString(),
});

const formText = reactive({
  title: props.cashPay ? "تعديل بيانات الدفعه" : "إضافه دفعه",
  btnTitle: props.cashPay ? "تعديل البيانات" : "إضافه دفعه",
  formText: props.cashPay ? "تم تعديل الدفعه" : "تم أضافه دفعه",
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
