<template>
  <AppLayout title="الفواتير الوارده">
    <SectionTemplate class="pb-0">
      <div class="header">
        <h2 class="font-bold text-xl mb-2 print:hidden">فاتورة وارده</h2>
        <h2 class="px-2 text-slate-600 mb-2">
          تاريخ الإضافه :{{ dateFormat(incoming_invoice.created_at) }}
        </h2>
        <h2 class="px-2">
          تاريخ الفاتورة : {{ dateFormat(incoming_invoice.date) }}
        </h2>
        <div class="flex justify-between my-3">
          <h2 class="px-2 print:mb-3">
            رقم الفاتورة : {{ incoming_invoice.number }}
          </h2>
          <Link :href="route('warehouse.show', incoming_invoice.people.id)" class="hover:text-[#009ef7]">
          <h2 class="px-2 print:mb-3">
            المخزن المستلم : {{ incoming_invoice.warehouse.name }}
          </h2>
          </Link>
        </div>
        <div class="flex justify-between my-3">
          <Link :href="route('people.show', incoming_invoice.people.id)" class="hover:text-[#009ef7]">
          <h2 class="px-2 print:mb-3">
            المورد : {{ incoming_invoice.people.name }}
          </h2>
          </Link>
          <div>
            <h2 class="px-2">
              إضفيت بواسطه : {{ incoming_invoice.user.name }}
            </h2>
          </div>
        </div>
        <div class="flex justify-between my-3">
          <h2 class="" v-if="incoming_invoice.pay_type == 0">
            نوع الدفع : على الحساب
          </h2>
          <h2 class="" v-if="incoming_invoice.pay_type == 1">
            نوع الدفع : كاش
          </h2>
          <h2 class="" v-if="incoming_invoice.pay_type == 1 && incoming_invoice.cash">
            نوع الكاش : {{ incoming_invoice.cash.title }}
          </h2>
        </div>
      </div>
      <div class="invoice">
        <hr />
        <h2 class="font-bold text-xl my-3">محتويات الفاتورة</h2>
        <table class="border border-slate-700 w-full text-right">
          <thead>
            <tr v-if="incomingInvoiceContent.length > 0">
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
            <tr v-for="product in incomingInvoiceContent" :key="product.index" class="">
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
            <tr v-if="incomingInvoiceKit.length > 0">
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
            <tr v-for="kit in incomingInvoiceKit" :key="kit.index" class="">
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
      <div class="my-3 returned" v-if="returnedIncomingInvoice.length > 0">
        <hr />
        <h2 class="font-bold text-xl my-2">مرتجع الفاتورة</h2>
        <table class="border border-slate-700 w-full text-right mt-5" id="xyz">
          <tbody>
            <!--returnedIncomingInvoice-->
            <tr>
              <th class="border border-slate-700 py-3 px-3 font-bold s-border">
                مرتجع المنتجات
              </th>
              <th class="border border-slate-700 py-3 px-3 font-bold s-border">
                التاريخ
              </th>
              <th class="border border-slate-700 py-3 px-3 font-bold s-border">
                الكميه
              </th>
            </tr>
            <tr v-for="product in returnedIncomingInvoice" :key="product.index" class="">
              <td class="border border-slate-700 py-3 px-3 hover:text-[#0095e8]">
                <Link :href="route('product.show', product.product.id)">
                {{ ContentName(product) }}
                </Link>
              </td>
              <td class="border border-slate-700 py-3 px-3">
                {{
                  new Date(product.date).toLocaleDateString("ar-EG", {
                    year: "numeric",
                    month: "numeric",
                    day: "numeric",
                  })
                }}
              </td>
              <td class="border border-slate-700 py-3 px-3">
                {{ product.quantity }}
              </td>
            </tr>
            <!--returnedIncomingInvoiceKit-->
            <tr v-if="returnedIncomingInvoiceKit.length > 0">
              <th class="border border-slate-700 py-3 px-3 font-bold s-border">
                مرتجع قطع غيار
              </th>
              <th class="border border-slate-700 py-3 px-3 font-bold s-border">
                التاريخ
              </th>
              <th class="border border-slate-700 py-3 px-3 font-bold s-border">
                الكميه
              </th>
            </tr>
            <tr v-for="kit in returnedIncomingInvoiceKit" :key="kit.index">
              <td class="border border-slate-700 py-3 px-3 hover:text-[#0095e8]">
                <Link :href="route('kit.show', kit.kit.id)">
                {{ KitName(kit) }}
                </Link>
              </td>
              <td class="border border-slate-700 py-3 px-3">
                {{
                  new Date(kit.date).toLocaleDateString("ar-EG", {
                    year: "numeric",
                    month: "numeric",
                    day: "numeric",
                  })
                }}
              </td>
              <td class="border border-slate-700 py-3 px-3">
                {{ kit.quantity }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="footer my-3">
        <hr />
        <div class="flex justify-between">
          <h2 class="p-2 print:w-full print:mb-3">
            الإجمالى قبل الخصم :
            {{ incoming_invoice.total_before_discount }}
          </h2>
          <h2 class="p-2">الخصم : {{ incoming_invoice.discount }}</h2>
        </div>
        <h2 class="p-2 font-bold">
          المطلوب :
          {{ incoming_invoice.total_after_discount }}
        </h2>
      </div>
      <div class="btns flex justify-around print:hidden">
        <btn-primary @click="print">
          طباعه
          <i class="fa-solid fa-print mx-3"></i>
        </btn-primary>
        <btn-info :element="Link" :to="route('returned-incoming-invoice.edit', incoming_invoice.id)">
          أضف مرتجع
        </btn-info>
        <btn-success :element="Link" :to="route('incoming-invoice.edit', incoming_invoice.id)">
          تعديل الفاتورة
        </btn-success>
      </div>
    </SectionTemplate>
    <SectionTemplate class="print:p-0 print:hidden">
      <IncomingInvoiceTabs :id="incoming_invoice.id" />
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
import IncomingInvoiceTabs from "@/Components/IncomingInvoice/IncomingInvoiceTabs.vue";

const props = defineProps([
  "incomingInvoice",
  "incomingInvoiceContent",
  "returnedIncomingInvoice",
  "incomingInvoiceKit",
  "returnedIncomingInvoiceKit",
]);

const incoming_invoice = props.incomingInvoice[0];
const incoming_invoice_content = props.incomingInvoiceContent;
const returnedIncomingInvoice = props.returnedIncomingInvoice;
const incomingInvoiceKit = props.incomingInvoiceKit;
const returnedIncomingInvoiceKit = props.returnedIncomingInvoiceKit;

provide("title", "الفواتير الوارده");
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
      linkTitle: "فاتورة " + incoming_invoice.number,
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
  var name =  item.product.name;
  if (item.product.product_brand) {
    name = name + " - " + item.product.product_brand.name;
  }
  if (item.product.product_category) {
    name = name + " - " + item.product.product_category.name;
  }
  if (item.product.product_type) {
    name = name + " - " + item.product.product_type.name;
  }
  if (item.product.product_collection) {
    name = name + " - " + item.product.product_collection.name;
  }
  if (item.product.product_model) {
    name = name + " - " + item.product.product_model.name;
  }
  if (item.product.product_color) {
    name = name + " - " + item.product.product_color.name;
  }
  if (item.product.product_material) {
    name = name + " - " + item.product.product_material.name;
  }
  if (item.product.product_country) {
    name = name + " - " + item.product.product_country.name;
  }
  if (item.product.sku) {
    name = name + " - " + item.product.sku;
  }
  return name;
}

function KitName(item) {
  var name = item.kit.title;
  if (item.kit.product) {
    name = name + " - " + item.kit.product.name;
    if (item.kit.product.product_collection)
      name = name + " - " + item.kit.product.product_collection.name;
    if (item.kit.product.product_model)
      name = name + " - " + item.kit.product.product_model.name;
    if (item.kit.product.product_brand)
      name = name + " - " + item.kit.product.product_brand.name;
    if (item.kit.product.product_category)
      name = name + " - " + item.kit.product.product_category.name;
    if (item.kit.product.product_type)
      name = name + " - " + item.kit.product.product_type.name;
    if (item.kit.product.product_color)
      name = name + " - " + item.kit.product.product_color.name;
    if (item.kit.product.product_material)
      name = name + " - " + item.kit.product.product_material.name;
    if (item.kit.product.product_country)
      name = name + " - " + item.kit.product.product_country.name;
  } else {
    if (item.kit.product_brand) {
      name = name + " - " + item.kit.product_brand.name;
    }
    if (item.kit.product_category) {
      name = name + " - " + item.kit.product_category.name;
    }
    if (item.kit.product_type) {
      name = name + " - " + item.kit.product_type.name;
    }
    if (item.kit.product_collection) {
      name = name + " - " + item.kit.product_collection.name;
    }
    if (item.kit.product_model) {
      name = name + " - " + item.kit.product_model.name;
    }
    if (item.kit.product_color) {
      name = name + " - " + item.kit.product_color.name;
    }
    if (item.kit.product_material) {
      name = name + " - " + item.kit.product_material.name;
    }
    if (item.kit.product_country) {
      name = name + " - " + item.kit.product_country.name;
    }
  }
  return name;
}
</script>