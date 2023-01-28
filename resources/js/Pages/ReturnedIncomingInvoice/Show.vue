<template>
  <AppLayout title="مرتجع الوارده">
    <SectionTemplate class="pb-0">
      <div class="header">
        <h2 class="font-bold text-xl mb-2 print:hidden">مرتجع وارده</h2>
        <h2 class="px-2 text-slate-600 mb-2">
          تاريخ الإضافه :{{ dateFormat(returned_incoming_invoice.created_at) }}
        </h2>
        <h2 class="px-2">
          تاريخ البيان : {{ dateFormat(returned_incoming_invoice.date) }}
        </h2>
        <div class="flex justify-between my-3">
          <h2 class="px-2 print:mb-3">
            رقم المرتجع : {{ returned_incoming_invoice.number }}
          </h2>
          <Link :href="route('warehouse.show', returned_incoming_invoice.people.id)" class="hover:text-[#009ef7]">
          <h2 class="px-2 print:mb-3">
            المخزن المسلم : {{ returned_incoming_invoice.warehouse.name }}
          </h2>
          </Link>
        </div>
        <div class="flex justify-between my-3">
          <Link :href="route('people.show', returned_incoming_invoice.people.id)" class="hover:text-[#009ef7]">
          <h2 class="px-2 print:mb-3">
            المورد : {{ returned_incoming_invoice.people.name }}
          </h2>
          </Link>
          <div>
            <h2 class="px-2">
              إضفيت بواسطه : {{ returned_incoming_invoice.user.name }}
            </h2>
          </div>
        </div>
        <div class="flex justify-between my-3">
          <h2 class="" v-if="returned_incoming_invoice.pay_type == 0">
            نوع الدفع : على الحساب
          </h2>
          <h2 class="" v-if="returned_incoming_invoice.pay_type == 1">
            نوع الدفع : كاش
          </h2>
          <h2 class="" v-if="returned_incoming_invoice.pay_type == 1 && returned_incoming_invoice.cash">
            نوع الكاش : {{ returned_incoming_invoice.cash.title }}
          </h2>
        </div>
      </div>
      <div class="invoice">
        <hr />
        <h2 class="font-bold text-xl my-3">محتويات الفاتورة</h2>
        <table class="border border-slate-700 w-full text-right">
          <thead>
            <tr v-if="returnedIncomingInvoiceContent.length > 0">
              <th class="border border-slate-700 py-3 px-3 font-bold s-border">
                المنتج
              </th>
              <th class="border border-slate-700 py-3 px-3 font-bold s-border">
                السعر
              </th>
              <th class="border border-slate-700 py-3 px-3 font-bold s-border">
                الكميه
              </th>
              <th class="border border-slate-700 py-3 px-3 font-bold s-border">
                الإجمالى
              </th>
            </tr>
          </thead>
          <tbody>
            <!--incomingInvoiceContent-->
            <tr v-for="product in returnedIncomingInvoiceContent" :key="product.index" class="">
              <td class="border border-slate-700 py-3 px-3 hover:text-[#0095e8]">
                <Link :href="route('product.show', product.product.id)">
                {{ ContentName(product) }}
                </Link>
              </td>
              <td class="border border-slate-700 py-3 px-3">
                {{ product.price }}
              </td>
              <td class="border border-slate-700 py-3 px-3">
                {{ product.quantity }}
              </td>
              <td class="border border-slate-700 py-3 px-3">
                {{ product.price * product.quantity }}
              </td>
            </tr>
            <!--incomingInvoiceKit-->
            <tr v-if="returnedIncomingInvoiceKit.length > 0">
              <th class="border border-slate-700 py-3 px-3 font-bold s-border">
                قطع الغيار
              </th>
              <th class="border border-slate-700 py-3 px-3 font-bold s-border">
                السعر
              </th>
              <th class="border border-slate-700 py-3 px-3 font-bold s-border">
                الكميه
              </th>
              <th class="border border-slate-700 py-3 px-3 font-bold s-border">
                الإجمالى
              </th>
            </tr>
            <tr v-for="kit in returnedIncomingInvoiceKit" :key="kit.index" class="">
              <td class="border border-slate-700 py-3 px-3 hover:text-[#0095e8]">
                <Link :href="route('kit.show', kit.kit.id)">
                {{ KitName(kit) }}
                </Link>
              </td>
              <td class="border border-slate-700 py-3 px-3">
                {{ kit.price }}
              </td>
              <td class="border border-slate-700 py-3 px-3">
                {{ kit.quantity }}
              </td>
              <td class="border border-slate-700 py-3 px-3">
                {{ kit.price * kit.quantity }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="footer my-3">
        <div class="flex justify-between">
          <h2 class="p-2 print:w-full print:mb-3">
            الإجمالى قبل الخصم :
            {{ ((returned_incoming_invoice.total * 1) + (returned_incoming_invoice.discount * 1)).toFixed(2)}}
          </h2>
          <h2 class="p-2">الخصم : {{ returned_incoming_invoice.discount }}</h2>
        </div>
        <h2 class="p-2 font-bold">
          المطلوب :
          {{ returned_incoming_invoice.total }}
        </h2>
      </div>
      <div class="btns flex justify-around print:hidden">
        <btn-primary @click="print">
          طباعه
          <i class="fa-solid fa-print mx-3"></i>
        </btn-primary>
        <btn-success :element="Link" :to="route('returned-incoming-invoice.edit', returned_incoming_invoice.id)">
          تعديل المرتجع
        </btn-success>
        <DeleteModel :id="returned_incoming_invoice.id" title=" " data="المرتجع الوارد"
          url="returned-incoming-invoice" />
      </div>
    </SectionTemplate>
    <SectionTemplate class="print:p-0 print:hidden">
      <IncomingInvoiceTabs :id="returned_incoming_invoice.id" />
    </SectionTemplate>
  </AppLayout>
</template>

<script setup>
import { reactive } from "vue";
import { computed, provide, readonly } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import BtnPrimary from "@/Components/Buttons/BtnPrimary.vue";
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
import BtnInfo from "@/Components/Buttons/BtnInfo.vue";
import BtnDanger from "@/Components/Buttons/BtnDanger.vue";
import IncomingInvoiceTabs from "@/Components/IncomingInvoice/IncomingInvoiceTabs.vue";
import DeleteModel from "@/Components/Modals/DeleteModel.vue";

const props = defineProps([
  "returnedIncomingInvoice",
  "returnedIncomingInvoiceContent",
  "returnedIncomingInvoiceKit",
]);

const returned_incoming_invoice = props.returnedIncomingInvoice[0];
const returned_incoming_invoice_content = props.returnedIncomingInvoiceContent;
const returned_incomingInvoiceKit = props.returnedIncomingInvoiceKit;

provide("title", "مرتجع الوارده");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    {
      index: 1,
      linkTitle: "مرتجع الوارده",
      linkRoute: "returned-incoming-invoice.index",
    },
    {
      index: 2,
      linkTitle: "مرتجع " + returned_incoming_invoice.id,
      linkRoute: "#",
    },
  ])
);

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

function print() {
  window.print();
}
function ContentName(item) {

var name = item.product.name;

if (item.product.product_brand) {
  name = name + "-" + item.product.product_brand.name;
}
if (item.product.product_category) {
  name = name + item.product.product_category.name + "-";
}
if (item.product.product_type) {
  name = name + item.product.product_type.name + "-";
}
if (item.product.product_collection) {
  name = name + item.product.product_collection.name + "-";
}
if (item.product.product_model) {
  name = name + item.product.product_model.name + "-";
}
if (item.product.product_color) {
  name = name + item.product.product_color.name + "-";
}
if (item.product.product_material) {
  name = name + item.product.product_material.name + "-";
}
if (item.product.product_country) {
  name = name + item.product.product_country.name + "-";
}
if (item.product.sku) {
  name = name + item.product.sku;
}
return name;
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
} else {
  if (item.kit.product_brand) {
    name = name + "-" + item.kit.product_brand.name;
  }
  if (item.kit.product_category) {
    name = name + item.kit.product_category.name + "-";
  }
  if (item.kit.product_type) {
    name = name + item.kit.product_type.name + "-";
  }
  if (item.kit.product_collection) {
    name = name + item.kit.product_collection.name + "-";
  }
  if (item.kit.product_model) {
    name = name + item.kit.product_model.name + "-";
  }
  if (item.kit.product_color) {
    name = name + item.kit.product_color.name + "-";
  }
  if (item.kit.product_material) {
    name = name + item.kit.product_material.name + "-";
  }
  if (item.kit.product_country) {
    name = name + item.kit.product_country.name + "-";
  }
}
return name;
}
</script>