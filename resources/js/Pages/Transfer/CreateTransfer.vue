<template>
  <AppLayout title="إضافه نقله">
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
          <h2 class="title font-bold mb-4">إضافه نقله</h2>
          <form action="POST" @submit.prevent="addTransfer">
            <!--Driver-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300"> السائق </label>
              <div v-if="errors.driver" class="text-red-800">
                {{ errors.driver }}
              </div>
              <div class="flex">
                <select
                  class="
                    w-full
                    text-base
                    dark:bg-[#1b1b29]
                    bg-[#f5f8fa]
                    dark:active:bg-[#1b1b29]
                    active:bg-[#f5f8fa]
                    dark:focus:bg-[#1b1b29]
                    focus:bg-[#f5f8fa] focus:ring-0
                    border-0
                    shadow-sm
                    rounded-r-md
                    py-2
                  "
                  v-model="transferAddForm.driver"
                >
                  <option disabled selected>اختار السائق</option>
                  <option
                    v-for="item in drivers"
                    :value="item.id"
                    :key="item.id"
                  >
                    {{ item.name }} | {{ item.phone }}
                  </option>
                </select>
                <add-transfer-driver-model />
              </div>
            </div>
            <!--Warehouses From-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300"
                >المخزن الراسل
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.warehouseFrom" class="text-red-800">
                {{ errors.warehouseFrom }}
              </div>
              <select
                v-model="transferAddForm.warehouseFrom"
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
                <template v-for="item in warehouses" :key="item.id">
                  <option
                    v-if="item.id != transferAddForm.warehouseTo"
                    :value="item.id"
                  >
                    {{ item.name }} | {{ item.address }}
                  </option>
                </template>
              </select>
            </div>
            <!--warehouse To-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300"
                >المخزن المستقبل
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.warehouseTo" class="text-red-800">
                {{ errors.warehouseTo }}
              </div>
              <select
                v-model="transferAddForm.warehouseTo"
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
                <template v-for="item in warehouses" :key="item.id">
                  <option
                    v-if="item.id != transferAddForm.warehouseFrom"
                    :value="item.id"
                  >
                    {{ item.name }} | {{ item.address }}
                  </option>
                </template>
              </select>
            </div>
            <!--Date-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">
                تاريخ النقله
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.date" class="text-red-800">
                {{ errors.date }}
              </div>
              <input
                type="date"
                v-model="transferAddForm.date"
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
            <!-- Attach -->
            <div
              class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3"
            >
              <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
                الملفات
                <span class="text-red-800 font-bold">*</span>
              </h2>
              <div
                v-for="(i, index) in transferAddForm.attachment"
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
                        transferAddForm.attachment[index].attachment =
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
                          transferAddForm.attachment =
                            transferAddForm.attachment.filter(
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
                    transferAddForm.attachment.length > 1 &&
                    transferAddForm.attachment.length != index
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
            <!-- Content -->
            <div
              class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3"
            >
              <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
                محتوى النقله
                <span class="text-red-800 font-bold">*</span>
              </h2>
              <div v-for="(i, index) in transferAddForm.content" :key="index">
                <div class="w-full my-5">
                  <h3>{{ 1 + index }}</h3>
                  <label class="px-3 dark:text-gray-300"
                    >المنتج
                    <span class="text-red-800 font-bold">*</span>
                  </label>
                  <select
                    v-model="transferAddForm.content[index].product"
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
                  <!-- Quanty -->
                  <div class="m-5">
                    <label class="px-3 dark:text-gray-300">
                      كميه المنتج
                      <span class="text-red-800 font-bold">*</span>
                    </label>
                    <input
                      type="number"
                      v-model="transferAddForm.content[index].quantity"
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
                        transferAddForm.content =
                          transferAddForm.content.filter(
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
                    transferAddForm.content.length > 1 &&
                    transferAddForm.content.length != index
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
              <!-- Save -->
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
                  حفظ النقله
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
import AddTransferDriverModel from "@/Components/Transfer/AddTransferDriverModel.vue";

provide("title", "إضافه نقله");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    {
      index: 1,
      linkTitle: "النقله",
      linkRoute: "transfer.index",
    },
    {
      index: 2,
      linkTitle: "إضافه نقله",
      linkRoute: "#",
    },
  ])
);

const props = defineProps(["errors", "products", "drivers", "warehouses"]);

const transferAddForm = reactive({
  driver: null,
  warehouseFrom: null,
  warehouseTo: null,
  date: new Date().toISOString().slice(0, 10),
  content: [
    {
      id: 1,
      product: null,
      quantity: 0,
    },
  ],
  attachment: [],
});

function addTransfer() {
  Inertia.post(route("transfer.store"), transferAddForm, {
    onSuccess: () => {
      createToast(
        {
          title: "تم تسجيل النقله",
          description: " تم تسجيل النقله ",
        },
        {
          timeout: 3000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
      transferAddForm.driver = null;
      transferAddForm.warehouseFrom = false;
      transferAddForm.warehouseTo = null;
      transferAddForm.date = new Date().toISOString().slice(0, 10);
      transferAddForm.content = [
        {
          id: 1,
          product: null,
          quantity: 0,
        },
      ];
      transferAddForm.attachment.length = 0;
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
  transferAddForm.content.push({
    id: transferAddForm.content.length + 1,
    product: null,
    quantity: 0,
  });
}

function pushToAttachment() {
  transferAddForm.attachment.push({
    id: transferAddForm.attachment.length + 1,
    attachment: null,
  });
}
</script>
<style>
</style>