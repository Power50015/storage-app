<template>
  <AppLayout title="مرتجع فاتوره وارده">
    <SectionTemplate class="pb-0">
      <h2 class="font-bold text-xl mb-5">مرتجع الفاتورة الوارده</h2>
      <div class="flex justify-between">
        <h2 class="px-2 print:w-full print:mb-3">
          المورد : {{ incomingInvoice.people.name }}
        </h2>
        <h2 class="px-2">رقم الفاتورة : {{ incomingInvoice.number }}</h2>
        <h2 class="px-2">
          تاريخ الفاتورة : {{ dateFormat(incomingInvoice.date) }}
        </h2>
        <h2 class="px-2">
          المخزن المستلم : {{ incomingInvoice.warehouse.name }}
        </h2>
      </div>
      <div class="flex justify-between mt-3">
        <h2 class="px-2">
          تاريخ الإضافه :
          {{ dateFormat(incomingInvoice.created_at) }}
        </h2>
        <h2 class="px-2">إضفيت بواسطه : {{ incomingInvoice.user.name }}</h2>
      </div>
    </SectionTemplate>
    <FormSection
      title="المرتجع"
      btnTitle="حفظ المرتجع"
      :formData="form"
      formRoute="returned-incoming-invoice.update"
      toastMsg="تم تسجيل مرتجع الفاتوره"
      :toastDescription="`تم تسجيل مرتجع الفاتوره ${incomingInvoice.number}`"
    >
      <!-- Date -->
      <InputDate
        v-model="form.date"
        title="تاريخ مرتجع الفاتوره"
        :error="errors.date"
        :require="true"
      />
      <!--Content-->
      <h2 class="font-bold text-xl mb-5" v-if="form.content.length > 0">
        منتجات الفاتورة المرتجع
      </h2>
      <div
        v-for="(i, index) in form.content"
        :key="index"
        class="w-full my-5 dark:bg-[#151521] p-2 bg-[#F5F8FA]"
      >
        <h4 class="px-3 dark:text-gray-300 my-3">
          {{ ContentName(form.content[index]) }}
        </h4>
        <!-- Price -->
        <InputNumber
          v-model="form.content[index].quantity"
          title=" كميه المرتجع من المنتج"
          :step="1"
          :min="0"
          :require="true"
          @changeData="total"
        />
      </div>
      <!--Kit-->
      <h2 class="font-bold text-xl mb-5" v-if="form.kit.length > 0">
        قطع غيار الفاتورة المرتجع
      </h2>
      <div
        v-for="(item, index) in form.kit"
        :key="index"
        class="w-full my-5 dark:bg-[#151521] p-2 bg-[#F5F8FA]"
      >
        <h4 class="px-3 dark:text-gray-300 my-3">
          {{ KitName(item) }}
        </h4>
        <!-- Price -->
        <InputNumber
          v-model="form.kit[index].quantity"
          title=" كميه المرتجع من المنتج"
          :step="1"
          :min="0"
          :require="true"
          @changeData="total"
        />
      </div>
      <div class="w-full my-5 dark:bg-[#151521] p-2 bg-[#F5F8FA]">
        <h2 class="font-bold mb-5" v-if="form.kit.length > 0">ختام الفاتورة</h2>
        <div class="flex justify-between">
          <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
            الإجمالى  :<br />{{  (totalPrice - incomingInvoice.discount).toFixed(2) }}
          </h2>
          <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
            الإجمالى قبل الخصم :<br />{{ totalPrice.toFixed(2) }}
          </h2>
          <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
            الخصم :<br />{{ incomingInvoice.discount }}
          </h2>
        </div>
      </div>
    </FormSection>    
  </AppLayout>
</template>

<script setup>
import { computed, provide, readonly, ref, reactive } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";
import { createToast } from "mosha-vue-toastify";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputDate from "@/Forms/InputDate.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import InputNumber from "@/Forms/InputNumber.vue";

provide("title", "مرتجع فاتوره وارده");

const props = defineProps([
  "errors",
  "incomingInvoice",
  "incomingInvoiceContent",
  "incomingInvoiceKit",
]);
const incomingInvoice = props.incomingInvoice[0];

const form = reactive({
  _method: "patch",
  id: incomingInvoice.id,
  date: new Date().toISOString().slice(0, 10),
  content: props.incomingInvoiceContent,
  kit: props.incomingInvoiceKit,
  people_id: incomingInvoice.people_id,
  incoming_invoice_id: incomingInvoice.id,
});


const totalPrice = ref(0);
total();

provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    {
      index: 1,
      linkTitle: "الفواتير الوارده",
      linkRoute: "incoming-invoice.index",
    },
    {
      index: 2,
      linkTitle: "مرتجع فاتوره وارده رقم : " + incomingInvoice.number,
      linkRoute: "#",
    },
  ])
);

function total() {
  totalPrice.value = 0;
  for (let index = 0; index < form.content.length; index++) {
    var i = form.content[index].price * form.content[index].quantity;
    totalPrice.value = totalPrice.value + i;
  }
  for (let index = 0; index < form.kit.length; index++) {
    var i = form.kit[index].price * form.kit[index].quantity;
    totalPrice.value = totalPrice.value + i;
  }
  totalPrice.value =
    incomingInvoice.total_before_discount - totalPrice.value;
}

function dateFormat(x) {
  var options = {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  };
  var today = new Date(x);
  return today.toLocaleDateString("ar-EG", options);
}

function ContentName(item) {
  return (
    item.product.product_brand.name +
    "-" +
    item.product.product_category.name +
    "-" +
    item.product.product_type.name +
    "-" +
    item.product.product_collection.name +
    "-" +
    item.product.product_model.name +
    "-" +
    item.product.product_color.name +
    "-" +
    item.product.product_material.name +
    "-" +
    item.product.product_country.name +
    "-" +
    item.product.sku +
    "-" +
    item.product.name
  );
}
function KitName(item) {
  var name = item.kit.title;
  if (item.kit.product) {
    name = name + "-" + item.kit.product.name;
    if (item.kit.product.product_collection)
      name = name + "-" + item.kit.product.product_collection.name;
    if (item.kit.product.product_model)
      name = name + "-" + item.kit.product.product_model.name;
    if (item.kit.product.product_brand)
      name = name + "-" + item.kit.product.product_brand.name;
    if (item.kit.product.product_category)
      name = name + "-" + item.kit.product.product_category.name;
    if (item.kit.product.product_type)
      name = name + "-" + item.kit.product.product_type.name;
    if (item.kit.product.product_color)
      name = name + "-" + item.kit.product.product_color.name;
    if (item.kit.product.product_material)
      name = name + "-" + item.kit.product.product_material.name;
    if (item.kit.product.product_country)
      name = name + "-" + item.kit.product.product_country.name;
  }
  return name;
}
</script>
<style>
</style>