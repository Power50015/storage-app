<template>
  <AppLayout title="الفواتير الوارده">
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
            <h2 class="title font-bold">فاتوره وارده</h2>
            <Link
              :href="
                route('returned-incoming-invoice.edit', incoming_invoice.id)
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
              المورد : {{ incoming_invoice.people.name }}
            </h2>
            <h2 class="px-2">رقم الفاتورة : {{ incoming_invoice.number }}</h2>
            <h2 class="px-2">
              تاريخ الفاتورة : {{ dateFormat(incoming_invoice.date) }}
            </h2>
            <h2 class="px-2">
              المخزن المستلم : {{ incoming_invoice.warehouse.name }}
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
              {{ dateFormat(incoming_invoice.created_at) }}
            </h2>
            <h2 class="px-2">
              إضفيت بواسطه : {{ incoming_invoice.user.name }}
            </h2>
          </div>
          <div class="mt-5">
            <div class="mt-2 hover:gray-500">
              <table
                class="border border-dashed border-slate-700 w-full text-right"
                id="xyz"
              >
                <thead>
                  <tr v-if="incomingInvoiceContent.length > 0">
                    <th
                      class="
                        border border-dashed border-slate-700
                        py-3
                        px-3
                        font-bold
                        s-border
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
                        s-border
                      "
                    >
                      السعر
                    </th>
                    <th
                      class="
                        border border-dashed border-slate-700
                        py-3
                        px-3
                        font-bold
                        s-border
                      "
                    >
                      الكميه
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <!--incomingInvoiceContent-->
                  <tr
                    v-for="product in incomingInvoiceContent"
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
                      <Link :href="route('product.show', product.product.id)">
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
                  <!--incomingInvoiceKit-->
                  <tr v-if="incomingInvoiceKit.length > 0">
                    <th
                      class="
                        border border-dashed border-slate-700
                        py-3
                        px-3
                        font-bold
                        s-border
                      "
                    >
                      قطع الغيار
                    </th>
                    <th
                      class="
                        border border-dashed border-slate-700
                        py-3
                        px-3
                        font-bold
                        s-border
                      "
                    >
                      السعر
                    </th>
                    <th
                      class="
                        border border-dashed border-slate-700
                        py-3
                        px-3
                        font-bold
                        s-border
                      "
                    >
                      الكميه
                    </th>
                  </tr>
                  <tr
                    v-for="kit in incomingInvoiceKit"
                    :key="kit.index"
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
                      <Link :href="route('kit.show', kit.kit.id)">
                        {{ kit.kit.title }}
                        <template v-if="kit.kit.product">
                          |
                          <template v-if="kit.kit.product.product_brand"
                            >{{
                              kit.kit.product.product_brand.name
                            }}
                            |</template
                          >
                          <template v-if="kit.kit.product.product_category">
                            {{
                              kit.kit.product.product_category.name
                            }}</template
                          >
                          <template v-if="kit.kit.product.product_type">
                            |{{ kit.kit.product.product_type.name }}
                          </template>
                          <template v-if="kit.kit.product.product_collection">
                            |{{ kit.kit.product.product_collection.name }}
                          </template>
                          <template v-if="kit.kit.product.product_model">
                            |{{ kit.kit.product.product_model.name }}
                          </template>
                          <template v-if="kit.kit.product.product_color">
                            |{{ kit.kit.product.product_color.name }}
                          </template>
                          <template v-if="kit.kit.product.product_material">
                            |{{ kit.kit.product.product_material.name }}
                          </template>
                          <template v-if="kit.kit.product.product_country">
                            |
                            {{ kit.kit.product.product_country.name }}</template
                          >
                          <template v-if="kit.kit.product.sku">
                            | {{ kit.kit.product.sku }}</template
                          >
                          | {{ kit.kit.product.name }}</template
                        >
                      </Link>
                    </td>
                    <td class="border border-dashed border-slate-700 py-3 px-3">
                      {{ kit.price }}
                    </td>
                    <td class="border border-dashed border-slate-700 py-3 px-3">
                      {{ kit.quantity }}
                    </td>
                  </tr>
                </tbody>
              </table>
              <!--returnedIncomingInvoice-->
              <div
                class="mt-5"
                v-if="
                  returnedIncomingInvoice.length > 0 ||
                  returnedIncomingInvoiceKit.length > 0
                "
              >
                <h2 class="title font-bold">المرتجع</h2>
                <table
                  class="
                    border border-dashed border-slate-700
                    w-full
                    text-right
                    mt-5
                  "
                  id="xyz"
                >
                  <tbody>
                    <!--returnedIncomingInvoice-->
                    <tr v-if="returnedIncomingInvoice.length > 0">
                      <th
                        class="
                          border border-dashed border-slate-700
                          py-3
                          px-3
                          font-bold
                          s-border
                        "
                      >
                        مرتجع المنتجات
                      </th>
                      <th
                        class="
                          border border-dashed border-slate-700
                          py-3
                          px-3
                          font-bold
                          s-border
                        "
                      >
                        الكميه
                      </th>
                    </tr>
                    <tr
                      v-for="product in returnedIncomingInvoice"
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
                        <Link :href="route('product.show', product.product.id)">
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
                      <td
                        class="border border-dashed border-slate-700 py-3 px-3"
                      >
                        {{ product.quantity }}
                      </td>
                    </tr>
                    <!--returnedIncomingInvoiceKit-->
                    <tr>
                      <th
                        class="
                          border border-dashed border-slate-700
                          py-3
                          px-3
                          font-bold
                          s-border
                        "
                        v-if="returnedIncomingInvoiceKit.length > 0"
                      >
                        مرتجع قطع الغيار
                      </th>
                      <th
                        class="
                          border border-dashed border-slate-700
                          py-3
                          px-3
                          font-bold
                          s-border
                        "
                      >
                        الكميه
                      </th>
                    </tr>
                    <tr
                      v-for="kit in returnedIncomingInvoiceKit"
                      :key="kit.index"
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
                        <Link :href="route('kit.show', kit.kit.id)">
                          {{ kit.kit.title }}
                          <template v-if="kit.kit.product">
                            |
                            <template v-if="kit.kit.product.product_brand"
                              >{{
                                kit.kit.product.product_brand.name
                              }}
                              |</template
                            >
                            <template v-if="kit.kit.product.product_category">
                              {{
                                kit.kit.product.product_category.name
                              }}</template
                            >
                            <template v-if="kit.kit.product.product_type">
                              |{{ kit.kit.product.product_type.name }}
                            </template>
                            <template v-if="kit.kit.product.product_collection">
                              |{{ kit.kit.product.product_collection.name }}
                            </template>
                            <template v-if="kit.kit.product.product_model">
                              |{{ kit.kit.product.product_model.name }}
                            </template>
                            <template v-if="kit.kit.product.product_color">
                              |{{ kit.kit.product.product_color.name }}
                            </template>
                            <template v-if="kit.kit.product.product_material">
                              |{{ kit.kit.product.product_material.name }}
                            </template>
                            <template v-if="kit.kit.product.product_country">
                              |
                              {{
                                kit.kit.product.product_country.name
                              }}</template
                            >
                            <template v-if="kit.kit.product.sku">
                              | {{ kit.kit.product.sku }}</template
                            >
                            | {{ kit.kit.product.name }}</template
                          >
                        </Link>
                      </td>
                      <td
                        class="border border-dashed border-slate-700 py-3 px-3"
                      >
                        {{ kit.quantity }}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="my-5">
                <h2 class="p-2 print:w-full print:mb-3">
                  الإجمالى قبل الخصم :
                  {{ incoming_invoice.total_before_discount }}
                </h2>
                <h2 class="p-2">الخصم : {{ incoming_invoice.discount }}</h2>
                <h2 class="p-2 font-bold">
                  الإجمالى بعد الخصم :
                  {{ incoming_invoice.total_after_discount }}
                </h2>
              </div>
              <!-- Totals Price -->
              <div class="my-5 print:hidden">
                <h2 class="p-2" v-if="incoming_invoice.pay_type == 0">
                  نوع الدفع : على الحساب
                </h2>
                <h2 class="p-2" v-if="incoming_invoice.pay_type == 1">
                  نوع الدفع : كاش
                </h2>
                <h2 class="p-2" v-if="incoming_invoice.pay_type == 1">
                  نوع الكاش : {{ incoming_invoice.cash.title }}
                </h2>
              </div>
              <!-- Btns -->
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
                  :href="route('incoming-invoice.edit', incoming_invoice.id)"
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
    <!-- Attachment-->
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
                v-for="attachment in incoming_invoice_attachment"
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
  "incomingInvoice",
  "incomingInvoiceContent",
  "incomingInvoiceAttachment",
  "returnedIncomingInvoice",
  "incomingInvoiceKit",
  "returnedIncomingInvoiceKit",
]);

const incoming_invoice = props.incomingInvoice[0];
const incoming_invoice_content = props.incomingInvoiceContent;
const incoming_invoice_attachment = props.incomingInvoiceAttachment;
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
</script>
<style scoped>
.s-border {
  border-top-style: solid;
  border-top-width: medium;
}
</style>