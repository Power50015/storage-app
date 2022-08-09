<template>
  <AppLayout title="الفواتير الصادره">
    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="
            dark:bg-[#1e1e2d]
            bg-white
            dark:text-white
            text-black
            overflow-hidden
            shadow-xl
            rounded-md
            p-4
          "
        >
          <div
            class="
              flex
              content-center
              items-center
              justify-between
              mb-8
              print:hidden
            "
          >
            <h2 class="title font-bold">فاتوره صادره</h2>
            <Link
              :href="
                route('returned-outgoing-invoice.edit', outgoing_invoice.id)
              "
              class="
                bg-[#7239ea]
                border border-transparent
                rounded-md
                py-3
                px-8
                flex
                items-center
                justify-center
                text-base
                font-medium
                text-white
                hover:bg-[#7239ea]
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-[#7239ea]
                cursor-pointer
                mx-3
              "
            >
              أضف مرتجع
            </Link>
          </div>
          <div
            class="flex flex-wrap content-center items-center justify-between"
          >
            <h2 class="px-2 print:w-full print:mb-3">
              المورد : {{ outgoing_invoice.people.name }}
            </h2>
            <h2 class="px-2">رقم الفاتورة : {{ outgoing_invoice.number }}</h2>
            <h2 class="px-2">
              تاريخ الفاتورة : {{ dateFormat(outgoing_invoice.date) }}
            </h2>
            <h2 class="px-2">
              المخزن المستلم : {{ outgoing_invoice.warehouse.name }}
            </h2>
          </div>
          <div
            class="
              flex
              content-center
              items-center
              justify-between
              mt-5
              print:hidden
            "
          >
            <h2 class="px-2">
              تاريخ الإضافه :
              {{ dateFormat(outgoing_invoice.created_at) }}
            </h2>
            <h2 class="px-2">
              إضفيت بواسطه : {{ outgoing_invoice.user.name }}
            </h2>
          </div>
          <div class="mt-5">
            <div class="mt-2 hover:gray-500">
              <table
                class="border border-dashed border-slate-700 w-full text-right"
                id="xyz"
              >
                <thead>
                  <tr>
                    <th
                      class="
                        border border-dashed border-slate-700
                        py-3
                        px-3
                        font-bold
                      "
                    >
                      المنتج
                    </th>
                    <th
                      class="
                        border border-dashed border-slate-700
                        py-3
                        px-3
                        font-bold
                      "
                    >
                      لسعر
                    </th>
                    <th
                      class="
                        border border-dashed border-slate-700
                        py-3
                        px-3
                        font-bold
                      "
                    >
                      الكميه
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="product in outgoingInvoiceContent"
                    :key="product.index"
                    class=""
                  >
                    <td
                      class="
                        border border-dashed border-slate-700
                        py-3
                        px-3
                        hover:text-[#0095e8]
                      "
                    >
                      <Link :href="route('product.index')">
                        <template v-if="product.product.product_brand.name">
                          {{ product.product.product_brand.name }} |
                        </template>
                        {{ product.product.product_category.name }} |
                        {{ product.product.product_type.name }} |
                        {{ product.product.product_collection.name }} |
                        {{ product.product.product_model.name }} |
                        {{ product.product.product_color.name }} |
                        {{ product.product.product_material.name }} |
                        {{ product.product.product_country.name }} |
                        <template v-if="product.product.sku">
                          {{ product.product.sku }} |
                        </template>
                        {{ product.product.name }}
                      </Link>
                    </td>
                    <td class="border border-dashed border-slate-700 py-3 px-3">
                      {{ product.price }}
                    </td>
                    <td class="border border-dashed border-slate-700 py-3 px-3">
                      {{ product.quantity }}
                    </td>
                  </tr>
                </tbody>
              </table>
              <h2 class="m-3" v-if="returnedOutgoingInvoice.length > 0">المرتجع</h2>
              <table
                class="border border-dashed border-slate-700 w-full text-right"
                id="xyz"
                v-if="returnedOutgoingInvoice.length > 0"
              >
                <thead>
                  <tr>
                    <th
                      class="
                        border border-dashed border-slate-700
                        py-3
                        px-3
                        font-bold
                      "
                    >
                      المنتج
                    </th>
                    <th
                      class="
                        border border-dashed border-slate-700
                        py-3
                        px-3
                        font-bold
                      "
                    >
                      الكميه
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="product in returnedOutgoingInvoice"
                    :key="product.index"
                    class=""
                  >
                    <td
                      class="
                        border border-dashed border-slate-700
                        py-3
                        px-3
                        hover:text-[#0095e8]
                      "
                    >
                      <Link :href="route('product.index')">
                        <template v-if="product.product.product_brand.name">
                          {{ product.product.product_brand.name }} |
                        </template>
                        {{ product.product.product_category.name }} |
                        {{ product.product.product_type.name }} |
                        {{ product.product.product_collection.name }} |
                        {{ product.product.product_model.name }} |
                        {{ product.product.product_color.name }} |
                        {{ product.product.product_material.name }} |
                        {{ product.product.product_country.name }} |
                        <template v-if="product.product.sku">
                          {{ product.product.sku }} |
                        </template>
                        {{ product.product.name }}
                      </Link>
                    </td>
                    <td class="border border-dashed border-slate-700 py-3 px-3">
                      {{ product.quantity }}
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="my-5">
                <h2 class="p-2 print:w-full print:mb-3">
                  الإجمالى قبل الخصم :
                  {{ outgoing_invoice.total_before_discount }}
                </h2>
                <h2 class="p-2">الخصم : {{ outgoing_invoice.discount }}</h2>
                <h2 class="p-2 font-bold">
                  الإجمالى بعد الخصم :
                  {{ outgoing_invoice.total_after_discount }}
                </h2>
              </div>
              <div class="my-5 print:hidden">
                <h2 class="p-2" v-if="outgoing_invoice.pay_type == 0">
                  نوع الدفع : على الحساب
                </h2>
                <h2 class="p-2" v-if="outgoing_invoice.pay_type == 1">
                  نوع الدفع : كاش
                </h2>
                <h2 class="p-2" v-if="outgoing_invoice.pay_type == 1">
                  نوع الكاش : {{ outgoing_invoice.cash.title }}
                </h2>
              </div>
              <div class="flex mt-5 print:hidden">
                <div
                  @click="print"
                  class="
                    bg-[#009ef7]
                    border border-transparent
                    rounded-md
                    py-3
                    px-8
                    flex
                    items-center
                    justify-center
                    text-base
                    font-medium
                    text-white
                    hover:bg-[#009ef7]
                    focus:outline-none
                    focus:ring-2
                    focus:ring-offset-2
                    focus:ring-[#009ef7]
                    cursor-pointer
                    mx-3
                  "
                >
                  طباعه
                  <i class="fa-solid fa-print mx-3"></i>
                </div>
                <Link
                  :href="route('outgoing-invoice.edit', outgoing_invoice.id)"
                  class="
                    bg-[#50cd89]
                    border border-transparent
                    rounded-md
                    py-3
                    px-8
                    flex
                    items-center
                    justify-center
                    text-base
                    font-medium
                    text-white
                    hover:bg-[#50cd89]
                    focus:outline-none
                    focus:ring-2
                    focus:ring-offset-2
                    focus:ring-[#50cd89]
                    cursor-pointer
                    mx-3
                  "
                >
                  تعديل الفاتورة
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mb-5 print:hidden">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="
            dark:bg-[#1e1e2d]
            bg-white
            dark:text-white
            text-black
            overflow-hidden
            shadow-xl
            rounded-md
            p-4
          "
        >
          <h2>الملفات المرفقه</h2>
          <table
            class="border border-dashed border-slate-700 w-full text-right"
            id="xyz"
          >
            <thead>
              <tr>
                <th
                  class="
                    border border-dashed border-slate-700
                    py-3
                    px-3
                    font-bold
                  "
                >
                  الملف
                </th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="attachment in outgoing_invoice_attachment"
                :key="attachment.index"
                class=""
              >
                <td class="border border-dashed border-slate-700 py-3 px-3">
                  <a
                    :href="`/storage/${attachment.attachment}`"
                    class="hover:text-[#0095e8]"
                    target="_blank"
                  >
                    {{ attachment.attachment }}
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { reactive } from "vue";
import { computed, provide, readonly } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps([
  "outgoingInvoice",
  "outgoingInvoiceContent",
  "outgoingInvoiceAttachment",
  "returnedOutgoingInvoice",
]);

const outgoing_invoice = props.outgoingInvoice[0];
const outgoing_invoice_content = props.outgoingInvoiceContent;
const outgoing_invoice_attachment = props.outgoingInvoiceAttachment;
const returnedOutgoingInvoice = props.returnedOutgoingInvoice;

provide("title", "الفواتير الصادره");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    {
      index: 1,
      linkTitle: "الفواتير الصادره",
      linkRoute: "outgoing-invoice.index",
    },
    {
      index: 2,
      linkTitle: "فاتورة " + outgoing_invoice.id,
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
</script>
