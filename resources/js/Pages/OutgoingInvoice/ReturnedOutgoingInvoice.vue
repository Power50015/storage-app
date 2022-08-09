<template>
  <AppLayout title="مرتجع فاتوره صادره">
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
          </div>
          <div
            class="flex flex-wrap content-center items-center justify-between"
          >
            <h2 class="px-2 print:w-full print:mb-3">
              العميل : {{ outgoingInvoice.people.name }}
            </h2>
            <h2 class="px-2">رقم الفاتورة : {{ outgoingInvoice.id }}</h2>
            <h2 class="px-2">
              تاريخ الفاتورة : {{ dateFormat(outgoingInvoice.date) }}
            </h2>
            <h2 class="px-2">
              المخزن المستلم : {{ outgoingInvoice.warehouse.name }}
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
              {{ dateFormat(outgoingInvoice.created_at) }}
            </h2>
            <h2 class="px-2">إضفيت بواسطه : {{ outgoingInvoice.user.name }}</h2>
          </div>

          <form action="POST" @submit.prevent="addOutgoingInvoice">
            <!--Invoice Attach-->
            <div
              class="
                mb-10
                dark:bg-[#fefefe0d] dark:border-0
                border
                py-7
                px-3
                mt-4
              "
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
                محتوى مرتجع الفاتوره
                <span class="text-red-800 font-bold">*</span>
              </h2>
              <!--Date-->
              <div class="mb-5">
                <label class="px-3 dark:text-gray-300">
                  تاريخ المرتجع
                  <span class="text-red-800 font-bold">*</span>
                </label>
                <div v-if="errors.Rdate" class="text-red-800">
                  {{ errors.date }}
                </div>
                <input
                  type="date"
                  v-model="outgoingInvoiceAddForm.Rdate"
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
              <div
                v-for="(i, index) in outgoingInvoiceAddForm.content"
                :key="index"
              >
                <div class="w-full my-5">
                  <h3>{{ 1 + index }}</h3>
                  <label class="px-3 dark:text-gray-300">
                    {{
                      outgoingInvoiceAddForm.content[index].product
                        .product_brand.name
                    }}
                    |
                    {{
                      outgoingInvoiceAddForm.content[index].product
                        .product_category.name
                    }}
                    |
                    {{
                      outgoingInvoiceAddForm.content[index].product.product_type
                        .name
                    }}
                    |
                    {{
                      outgoingInvoiceAddForm.content[index].product
                        .product_collection.name
                    }}
                    |
                    {{
                      outgoingInvoiceAddForm.content[index].product
                        .product_model.name
                    }}
                    |
                    {{
                      outgoingInvoiceAddForm.content[index].product
                        .product_color.name
                    }}
                    |
                    {{
                      outgoingInvoiceAddForm.content[index].product
                        .product_material.name
                    }}
                    |
                    {{
                      outgoingInvoiceAddForm.content[index].product
                        .product_country.name
                    }}
                    | {{ outgoingInvoiceAddForm.content[index].product.sku }} |
                    {{ outgoingInvoiceAddForm.content[index].product.name }}
                  </label>
                </div>
                <div class="w-full flex items-end justify-around">
                  <!-- Quanty -->
                  <div class="m-5">
                    <label class="px-3 dark:text-gray-300">
                      كميه المرتجع من المنتج
                      <span class="text-red-800 font-bold">*</span>
                    </label>
                    <input
                      type="number"
                      v-model="outgoingInvoiceAddForm.content[index].quantity"
                      @change="total()"
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
                </div>
                <hr
                  v-if="
                    outgoingInvoiceAddForm.content.length > 1 &&
                    outgoingInvoiceAddForm.content.length != index
                  "
                />
              </div>
            </div>
            <!-- Invoice Footer -->
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
                <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
                  الخصم :<br />{{ outgoingInvoiceAddForm.discount }}
                </h2>
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
                    disabled:bg-gray-2600
                  "
                  :disabled="totalPrice <= 0"
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
import { computed, provide, readonly, ref, reactive } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";
import { createToast } from "mosha-vue-toastify";

import AppLayout from "@/Layouts/AppLayout.vue";

provide("title", "مرتجع فاتوره صادره");

const props = defineProps([
  "errors",
  "outgoingInvoice",
  "outgoingInvoiceContent",
  "outgoingInvoiceAttachment",
  "returnedOutgoingInvoice",
  "products",
]);

const outgoingInvoice = props.outgoingInvoice[0];

const outgoingInvoiceAddForm = reactive({
  _method: "patch",
  id: outgoingInvoice.id,
  people: outgoingInvoice.people_id,
  warehouses: outgoingInvoice.warehouse_id,
  pay_type: Boolean(outgoingInvoice.pay_type),
  cash_type: outgoingInvoice.cash_id,
  date: new Date(outgoingInvoice.date).toISOString().slice(0, 10),
  Rdate: new Date().toISOString().slice(0, 10),
  discount: outgoingInvoice.discount,
  content: props.outgoingInvoiceContent,
  attachment: [],
});

const totalPrice = ref(outgoingInvoice.total_before_discount);
total();

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
      linkTitle: "مرتجع فاتوره صادره رقم : " + outgoingInvoiceAddForm.id,
      linkRoute: "#",
    },
  ])
);

function addOutgoingInvoice() {
  /**
   * PUT/PATCH/DELETE method
   * https://github.com/inertiajs/inertia/issues/495
   *
   */
  Inertia.post(
    route("returned-outgoing-invoice.update", outgoingInvoice.id),
    outgoingInvoiceAddForm,
    {
      onSuccess: () => {
        createToast(
          {
            title: "تم تسجيل مرتجع الفاتوره",
            description:
              " تم تسجيل مرتجع الفاتوره " + outgoingInvoiceAddForm.number,
          },
          {
            timeout: 3000,
            transition: "slide",
            type: "success",
            showIcon: true,
          }
        );
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
    }
  );
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

    totalPrice.value =
      outgoingInvoice.total_before_discount - (totalPrice.value + i);
  }
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
</script>
<style>
</style>