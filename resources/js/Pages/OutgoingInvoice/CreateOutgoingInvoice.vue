<template>
  <AppLayout title="فاتوره صادره">
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
          <h2 class="title font-bold mb-4">فاتوره صادره</h2>
          <form action="POST" @submit.prevent="addOutgoingInvoice">
            <!-- Customers -->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300"
                >العميل
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.customers" class="text-red-800">
                {{ errors.customers }}
              </div>
              <select
                v-model="outgoingInvoiceAddForm.customer"
                class="
                  w-full
                  text-base
                  dark:bg-[#1b1b29]
                  bg-[#f5f8fa]
                  dark:active:bg-[#1b1b29]
                  active:bg-[#f5f8fa]
                  dark:focus:bg-[#1b1b29]
                  focus:bg-[#f5f8fa]
                  mt-3
                  focus:ring-0
                  border-0
                  shadow-sm
                  rounded-md
                  py-2
                "
              >
                <option
                  v-for="item in customers"
                  :key="item.id"
                  :value="item.id"
                >
                  {{ item.name }} | {{ item.address }} | {{ item.phone }}
                </option>
              </select>
            </div>
            <!--Warehouses-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300"
                >المخزن
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.warehouses" class="text-red-800">
                {{ errors.warehouses }}
              </div>
              <select
                v-model="outgoingInvoiceAddForm.warehouses"
                class="
                  w-full
                  text-base
                  dark:bg-[#1b1b29]
                  bg-[#f5f8fa]
                  dark:active:bg-[#1b1b29]
                  active:bg-[#f5f8fa]
                  dark:focus:bg-[#1b1b29]
                  focus:bg-[#f5f8fa]
                  mt-3
                  focus:ring-0
                  border-0
                  shadow-sm
                  rounded-md
                  py-2
                "
              >
                <option
                  v-for="item in warehouses"
                  :key="item.id"
                  :value="item.id"
                >
                  {{ item.name }} | {{ item.address }}
                </option>
              </select>
            </div>
            <!--Pay Type-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300"
                >نوع الدفع
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.pay_type" class="text-red-800">
                {{ errors.pay_type }}
              </div>
              <select
                v-model="outgoingInvoiceAddForm.pay_type"
                class="
                  w-full
                  text-base
                  dark:bg-[#1b1b29]
                  bg-[#f5f8fa]
                  dark:active:bg-[#1b1b29]
                  active:bg-[#f5f8fa]
                  dark:focus:bg-[#1b1b29]
                  focus:bg-[#f5f8fa]
                  mt-3
                  focus:ring-0
                  border-0
                  shadow-sm
                  rounded-md
                  py-2
                "
              >
                <option :value="false">على الحساب</option>
                <option :value="true">كاش</option>
              </select>
            </div>
            <!--Cash Type-->
            <div class="mb-5" v-if="outgoingInvoiceAddForm.pay_type">
              <label class="px-3 dark:text-gray-300"
                >نوع الكاش
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.cash_type" class="text-red-800">
                {{ errors.cash_type }}
              </div>
              <select
                v-model="outgoingInvoiceAddForm.cash_type"
                class="
                  w-full
                  text-base
                  dark:bg-[#1b1b29]
                  bg-[#f5f8fa]
                  dark:active:bg-[#1b1b29]
                  active:bg-[#f5f8fa]
                  dark:focus:bg-[#1b1b29]
                  focus:bg-[#f5f8fa]
                  mt-3
                  focus:ring-0
                  border-0
                  shadow-sm
                  rounded-md
                  py-2
                "
              >
                <option v-for="item in cash" :key="item.id" :value="item.id">
                  {{ item.title }}
                </option>
              </select>
            </div>
            <!--Date-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">
                تاريخ الفاتوره
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.date" class="text-red-800">
                {{ errors.date }}
              </div>
              <input
                type="date"
                v-model="outgoingInvoiceAddForm.date"
                class="
                  w-full
                  text-base
                  dark:bg-[#1b1b29]
                  bg-[#f5f8fa]
                  dark:active:bg-[#1b1b29]
                  active:bg-[#f5f8fa]
                  dark:focus:bg-[#1b1b29]
                  focus:bg-[#f5f8fa]
                  mt-3
                  focus:ring-0
                  border-0
                  shadow-sm
                  rounded-md
                  py-2
                  cursor-pointer
                "
              />
            </div>
            <!--Invoice Attach-->
            <div
              class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3"
            >
              <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
                الملفات
                <span class="text-red-800 font-bold">*</span>
              </h2>
              <div
                v-for="(i, index) in outgoingInvoiceAddForm.attachment"
                :key="index"
              >
                <div class="w-full my-5">
                  <h3>{{ 1 + index }}</h3>
                  <label class="px-3 dark:text-gray-300"
                    >الملف
                    <span class="text-red-800 font-bold">*</span>
                  </label>
                  <div class="flex">
                    <input
                      class="
                        block
                        w-full
                        text-sm text-gray-900
                        rounded-lg
                        border border-gray-300
                        cursor-pointer
                        dark:text-gray-400
                        focus:outline-none
                        dark:bg-[#1b1b29]
                        bg-[#f5f8fa]
                        dark:border-gray-600 dark:placeholder-gray-400
                        cursor-pointer
                      "
                      id="file_input"
                      type="file"
                      @change="
                        outgoingInvoiceAddForm.attachment[index].attachment =
                          $event.target.files[0]
                      "
                    />
                    <!-- Delete -->
                    <div class="mb-5">
                      <div
                        class="
                          bg-[#EF305E]
                          text-lg text-white
                          hover:bg-[#EF305E]
                          cursor-pointer
                          w-full
                          text-base
                          mt-3
                          focus:ring-0
                          border-0
                          py-3
                          w-[80px]
                          flex
                          items-center
                          justify-center
                          rounded-md
                        "
                        @click="
                          outgoingInvoiceAddForm.attachment =
                            outgoingInvoiceAddForm.attachment.filter(
                              (item) => item.id != i.id
                            )
                        "
                      >
                        <i class="fa-solid fa-xmark"></i>
                      </div>
                    </div>
                  </div>
                </div>

                <hr
                  v-if="
                    outgoingInvoiceAddForm.attachment.length > 1 &&
                    outgoingInvoiceAddForm.attachment.length != index
                  "
                />
              </div>

              <div>
                <!--New Item-->
                <div
                  class="
                    mt-10
                    w-full
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
                  "
                  @click="pushToAttachment"
                >
                  أضف ملف
                </div>
              </div>
            </div>
            <!--Invoice Content-->
            <div
              class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3"
            >
              <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
                محتوى الفاتوره
                <span class="text-red-800 font-bold">*</span>
              </h2>
              <div
                v-for="(i, index) in outgoingInvoiceAddForm.content"
                :key="index"
              >
                <div class="w-full my-5">
                  <h3>{{ 1 + index }}</h3>
                  <label class="px-3 dark:text-gray-300"
                    >المنتج
                    <span class="text-red-800 font-bold">*</span>
                  </label>
                  <select
                    v-model="outgoingInvoiceAddForm.content[index].product"
                    class="
                      w-full
                      text-base
                      dark:bg-[#1b1b29]
                      bg-[#f5f8fa]
                      dark:active:bg-[#1b1b29]
                      active:bg-[#f5f8fa]
                      dark:focus:bg-[#1b1b29]
                      focus:bg-[#f5f8fa]
                      mt-3
                      focus:ring-0
                      border-0
                      shadow-sm
                      rounded-md
                      py-2
                    "
                  >
                    <option
                      v-for="product in products"
                      :key="product.index"
                      :value="product.id"
                    >
                      {{ product.product_brand.name }} |
                      {{ product.product_category.name }} |
                      {{ product.product_type.name }} |
                      {{ product.product_collection.name }} |
                      {{ product.product_model.name }} |
                      {{ product.product_color.name }} |
                      {{ product.product_material.name }} |
                      {{ product.product_country.name }} | {{ product.sku }} |
                      {{ product.name }}
                    </option>
                  </select>
                </div>
                <div class="w-full flex items-end justify-around">
                  <div class="m-5">
                    <label class="px-3 dark:text-gray-300">
                      سعر المنتج
                      <span class="text-red-800 font-bold">*</span>
                    </label>
                    <input
                      type="number"
                      min="0.00"
                      step="0.01"
                      @change="total"
                      v-model="outgoingInvoiceAddForm.content[index].price"
                      class="
                        w-full
                        text-base
                        dark:bg-[#1b1b29]
                        bg-[#f5f8fa]
                        dark:active:bg-[#1b1b29]
                        active:bg-[#f5f8fa]
                        dark:focus:bg-[#1b1b29]
                        focus:bg-[#f5f8fa]
                        mt-3
                        focus:ring-0
                        border-0
                        shadow-sm
                        rounded-md
                        py-2
                      "
                    />
                  </div>
                  <!-- Quanty -->
                  <div class="m-5">
                    <label class="px-3 dark:text-gray-300">
                      كميه المنتج
                      <span class="text-red-800 font-bold">*</span>
                    </label>
                    <input
                      type="number"
                      v-model="outgoingInvoiceAddForm.content[index].quantity"
                      @change="total"
                      min="0"
                      step="1"
                      class="
                        w-full
                        text-base
                        dark:bg-[#1b1b29]
                        bg-[#f5f8fa]
                        dark:active:bg-[#1b1b29]
                        active:bg-[#f5f8fa]
                        dark:focus:bg-[#1b1b29]
                        focus:bg-[#f5f8fa]
                        mt-3
                        focus:ring-0
                        border-0
                        shadow-sm
                        rounded-md
                        py-2
                      "
                    />
                  </div>
                  <!-- Delete -->
                  <div class="mb-5">
                    <div
                      class="
                        bg-[#EF305E]
                        text-lg text-white
                        hover:bg-[#EF305E]
                        cursor-pointer
                        w-full
                        text-base
                        mt-3
                        focus:ring-0
                        border-0
                        py-3
                        w-[80px]
                        flex
                        items-center
                        justify-center
                        rounded-md
                      "
                      @click="
                        outgoingInvoiceAddForm.content =
                          outgoingInvoiceAddForm.content.filter(
                            (item) => item.id != i.id
                          );
                        total();
                      "
                    >
                      <i class="fa-solid fa-xmark"></i>
                    </div>
                  </div>
                </div>
                <hr
                  v-if="
                    outgoingInvoiceAddForm.content.length > 1 &&
                    outgoingInvoiceAddForm.content.length != index
                  "
                />
              </div>

              <div>
                <!--New Item-->
                <div
                  class="
                    mt-10
                    w-full
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
                  "
                  @click="pushToContent"
                >
                  أضف بند
                </div>
              </div>
            </div>

            <div
              class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3"
            >
              <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
                ختام الفاتوره
              </h2>
              <div class="flex items-end justify-around">
                <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
                  الإجمالى قبل الخصم :<br />{{ totalPrice.toFixed(2) }}
                </h2>
                <div class="">
                  <label class="px-3 dark:text-gray-300">
                    خصم على الفاتورة </label
                  ><input
                    type="number"
                    min="0.00"
                    step="0.01"
                    class="
                      w-full
                      text-base
                      dark:bg-[#1b1b29]
                      bg-[#f5f8fa]
                      dark:active:bg-[#1b1b29]
                      active:bg-[#f5f8fa]
                      dark:focus:bg-[#1b1b29]
                      focus:bg-[#f5f8fa]
                      mt-3
                      focus:ring-0
                      border-0
                      shadow-sm
                      rounded-md
                      py-2
                    "
                    v-model="outgoingInvoiceAddForm.discount"
                  />
                </div>
              </div>
              <h2
                class="
                  m-3
                  p-5
                  dark:text-gray-300
                  title
                  font-bold
                  mb-4
                  dark:bg-[#1b1b29]
                  bg-[#f5f8fa]
                "
              >
                الإجمالى بعد الخصم :<br />{{
                  (totalPrice - outgoingInvoiceAddForm.discount).toFixed(2)
                }}
              </h2>
              <!--Save Invoice-->
              <div>
                <button
                  type="submit"
                  class="
                    mt-10
                    w-full
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
                  "
                >
                  حفظ الفاتوره
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { reactive } from "vue";
import { computed, provide, readonly, ref } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";
import { createToast } from "mosha-vue-toastify";

import AppLayout from "@/Layouts/AppLayout.vue";

provide("title", "فاتوره صادره");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    {
      index: 1,
      linkTitle: "فاتوره صادره",
      linkRoute: "outgoing-invoice.index",
    },
    {
      index: 2,
      linkTitle: "إضافه فاتوره صادره",
      linkRoute: "#",
    },
  ])
);

const props = defineProps([
  "errors",
  "products",
  "cash",
  "warehouses",
  "customers",
]);

const totalPrice = ref(0);

const outgoingInvoiceAddForm = reactive({
  customer: null,
  warehouses: null,
  pay_type: false,
  cash_type: null,
  date: new Date().toISOString().slice(0, 10),
  discount: 0.0,
  content: [
    {
      id: 1,
      product: null,
      price: 0.0,
      quantity: 0,
    },
  ],
  attachment: [],
});

function addOutgoingInvoice() {
  if (outgoingInvoiceAddForm.pay_type == false)
    outgoingInvoiceAddForm.cash_type = null;
  Inertia.post(route("outgoing-invoice.store"), outgoingInvoiceAddForm, {
    onSuccess: () => {
      createToast(
        {
          title: "تم تسجيل الفاتوره",
          description: " تم تسجيل الفاتوره ",
        },
        {
          timeout: 3000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
      outgoingInvoiceAddForm.customer = null;
      outgoingInvoiceAddForm.warehouses = null;
      outgoingInvoiceAddForm.discount = 0.0;
      outgoingInvoiceAddForm.pay_type = false;
      outgoingInvoiceAddForm.cash_type = null;
      outgoingInvoiceAddForm.date = new Date().toISOString().slice(0, 10);
    },
    onError: (errors) => {
      for (const [key, value] of Object.entries(errors)) {
        createToast(
          {
            title: value,
          },
          {
            timeout: 3000,
            transition: "slide",
            type: "danger",
            showIcon: true,
          }
        );
      }
    },
  });
}

function pushToContent() {
  outgoingInvoiceAddForm.content.push({
    id: outgoingInvoiceAddForm.content.length + 1,
    product: null,
    price: 0.0,
    quantity: 0,
  });
}

function pushToAttachment() {
  outgoingInvoiceAddForm.attachment.push({
    id: outgoingInvoiceAddForm.attachment.length + 1,
    attachment: null,
  });
}

function total() {
  totalPrice.value = 0;
  for (let index = 0; index < outgoingInvoiceAddForm.content.length; index++) {
    var i =
      outgoingInvoiceAddForm.content[index].price *
      outgoingInvoiceAddForm.content[index].quantity;

    totalPrice.value = totalPrice.value + i;
  }
}
</script>
