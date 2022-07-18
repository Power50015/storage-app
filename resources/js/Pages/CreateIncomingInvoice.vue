<template>
  <AppLayout title="فاتوره وارده">
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
          <h2 class="title font-bold mb-4">فاتوره وارده</h2>
          <form action="POST" @submit.prevent="addIncomingInvoice">
            <!--Pay Type-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">
                رقم الفاتوره
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.number" class="text-red-800">
                {{ errors.number }}
              </div>

              <input
                type="text"
                v-model="incomingInvoiceAddForm.number"
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
                v-model="incomingInvoiceAddForm.pay_type"
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
            <div class="mb-5" v-if="incomingInvoiceAddForm.pay_type">
              <label class="px-3 dark:text-gray-300"
                >نوع الكاش
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.cash_type" class="text-red-800">
                {{ errors.cash_type }}
              </div>
              <select
                v-model="incomingInvoiceAddForm.cash_type"
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
                v-model="incomingInvoiceAddForm.date"
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
            <!--Invoice Content-->
            <div
              class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3"
            >
              <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
                محتوى الفاتوره
                <span class="text-red-800 font-bold">*</span>
              </h2>
              <div v-if="errors.pay_type" class="text-red-800">
                {{ errors.pay_type }}
              </div>
              <div
                v-for="(i, index) in incomingInvoiceAddForm.content"
                :key="index"
              >
                <div class="w-full my-5">
                  <h3>{{ 1 + index }}</h3>
                  <label class="px-3 dark:text-gray-300">المنتج</label>
                  <select
                    v-model="incomingInvoiceAddForm.content[index].product"
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
                      {{ product.brand.name }} | {{ product.category.name }} |
                      {{ product.type.name }} | {{ product.collection.name }} |
                      {{ product.model.name }} | {{ product.color.name }} |
                      {{ product.material.name }} | {{ product.country.name }} |
                      {{ product.sku }} | {{ product.name }}
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
                      v-model="incomingInvoiceAddForm.content[index].price"
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
                      v-model="incomingInvoiceAddForm.content[index].quantity"
                      min="1"
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
                        incomingInvoiceAddForm.content =
                          incomingInvoiceAddForm.content.filter(
                            (item) => item.id != i.id
                          )
                      "
                    >
                      <i class="fa-solid fa-xmark"></i>
                    </div>
                  </div>
                </div>
                <hr
                  v-if="
                    incomingInvoiceAddForm.content.length > 1 &&
                    incomingInvoiceAddForm.content.length != index
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

provide("title", "فاتوره وارده");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    {
      index: 1,
      linkTitle: "فاتوره وارده",
      linkRoute: "incoming-invoice.index",
    },
    {
      index: 2,
      linkTitle: "إضافه فاتوره وارده",
      linkRoute: "#",
    },
  ])
);

const props = defineProps(["errors", "products"]);

const numberOfProduct = ref(1);

const incomingInvoiceAddForm = reactive({
  number: null,
  pay_type: false,
  cash_type: null,
  date: new Date().toISOString().slice(0, 10),
  discount: 0.0,
  total: 0,
  content: [
    {
      id: 1,
      product: null,
      price: 0.0,
      quantity: 0,
    },
  ],
});

function addIncomingInvoice() {
  Inertia.post(route("incoming-invoice.store"), incomingInvoiceAddForm, {
    onSuccess: () => {
      createToast(
        {
          title: "تم تسجيل الفاتوره",
          description: " تم تسجيل الفاتوره " + incomingInvoiceAddForm.number,
        },
        {
          timeout: 3000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
      incomingInvoiceAddForm.number = null;
      incomingInvoiceAddForm.pay_type = false;
      incomingInvoiceAddForm.cash_type = null;
      incomingInvoiceAddForm.date = new Date().toISOString().slice(0, 10);
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
  incomingInvoiceAddForm.content.push({
    id: incomingInvoiceAddForm.content.length + 1,
    product: null,
    price: 0.0,
    quantity: 0,
  });
}

</script>

<style scoped>
/*================== || Date Picker ||==============================*/

/*-------Removes the // Before dd - day------------------------*/
input[type="date"]::-webkit-datetime-edit-text {
  color: transparent;
}

/*------- DatePicker ------------------------*/
input[type="date"] {
  font-weight: 900;
}

/*------- DatePicker - Focus ------------------------*/
input[type="date"]:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(21, 156, 228, 0.4);
}

input[type="date"]::-webkit-datetime-edit,
input[type="date"]::-webkit-inner-spin-button,
input[type="date"]::-webkit-clear-button {
  color: #fff;
  position: relative;
}

/*------- Year ------------------------*/
input[type="date"]::-webkit-datetime-edit-year-field {
  @apply dark:text-gray-300 text-black;
  position: absolute !important;
  border-left: 1px solid #8c8c8c;
  padding: 2px;
  /* color: #000; */
  left: 56px;
}

/*------- Month ------------------------*/
input[type="date"]::-webkit-datetime-edit-month-field {
  @apply dark:text-gray-300 text-black;
  position: absolute !important;
  border-left: 1px solid #8c8c8c;
  padding: 2px;
  left: 26px;
}

/*------- Day ------------------------*/
input[type="date"]::-webkit-datetime-edit-day-field {
  @apply dark:text-gray-300 text-black;
  position: absolute !important;
  padding: 2px;
  left: 4px;
}
</style>