<template>
  <AppLayout title="إضافه مخزون">
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
          <h2 class="title font-bold mb-4">إضافه مخزون</h2>
          <form action="POST" @submit.prevent="addWarehouseStock">
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
                v-model="warehouseStockAddForm.warehouses"
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
            <!--Title-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">
                 البند
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.title" class="text-red-800">
                {{ errors.title }}
              </div>
              <input
                type="text"
                v-model="warehouseStockAddForm.title"
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
                v-for="(i, index) in warehouseStockAddForm.attachment"
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
                        warehouseStockAddForm.attachment[index].attachment =
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
                          warehouseStockAddForm.attachment =
                            warehouseStockAddForm.attachment.filter(
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
                    warehouseStockAddForm.attachment.length > 1 &&
                    warehouseStockAddForm.attachment.length != index
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
            <!-- Content-->
            <div
              class="mb-10 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3"
            >
              <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">
                محتوى الفاتوره
                <span class="text-red-800 font-bold">*</span>
              </h2>
              <div
                v-for="(i, index) in warehouseStockAddForm.content"
                :key="index"
              >
                <div class="w-full my-5">
                  <h3>{{ 1 + index }}</h3>
                  <label class="px-3 dark:text-gray-300"
                    >المنتج
                    <span class="text-red-800 font-bold">*</span>
                  </label>
                  <select
                    v-model="warehouseStockAddForm.content[index].product"
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
                      v-model="warehouseStockAddForm.content[index].quantity"
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
                        warehouseStockAddForm.content =
                          warehouseStockAddForm.content.filter(
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
                    warehouseStockAddForm.content.length > 1 &&
                    warehouseStockAddForm.content.length != index
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

provide("title", "إضافه مخزون");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    {
      index: 1,
      linkTitle: "المخازن",
      linkRoute: "warehouse.index",
    },
    {
      index: 2,
      linkTitle: "إضافه مخزون",
      linkRoute: "#",
    },
  ])
);

const props = defineProps(["errors", "products", "warehouses"]);

const totalPrice = ref(0);

const warehouseStockAddForm = reactive({
  title: null,
  warehouses: null,
  content: [
    {
      id: 1,
      product: null,
      quantity: 0,
    },
  ],
  attachment: [],
});

function addWarehouseStock() {
  Inertia.post(route("warehouse-stock.store"), warehouseStockAddForm, {
    onSuccess: () => {
      createToast(
        {
          title: "تم تسجيل المخزون",
          description: " تم تسجيل المخزون ",
        },
        {
          timeout: 3000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
      warehouseStockAddForm.title = null;
      warehouseStockAddForm.warehouses = null;
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
  warehouseStockAddForm.content.push({
    id: warehouseStockAddForm.content.length + 1,
    product: null,
    quantity: 0,
  });
}

function pushToAttachment() {
  warehouseStockAddForm.attachment.push({
    id: warehouseStockAddForm.attachment.length + 1,
    attachment: null,
  });
}
</script>
