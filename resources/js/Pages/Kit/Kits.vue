<template>
  <AppLayout title="قطع الغيار">
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
          <div class="flex content-center items-center justify-between">
            <h2 class="title font-bold">قطع الغيار</h2>
            <Link
              :href="route('kit.create')"
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
              "
            >
              أضف قطعه غيار
            </Link>
          </div>
          <DataTable class="products w-full" :options="options">
            <thead>
              <tr>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody
              class="
                grid grid-cols-1
                gap-y-10
                sm:grid-cols-2
                gap-x-6
                lg:grid-cols-3
                xl:grid-cols-4 xl:gap-x-8
                mt-5
              "
            >
              <tr v-for="i in kits" :key="i.date">
                <td :value="i.total_number_of_product" class="hidden">
                  {{ i.total_number_of_product }}
                </td>
                <td>
                  <Link :href="route('kit.show', i.id)" class="group">
                    <div
                      class="
                        w-full
                        aspect-w-1 aspect-h-1
                        bg-gray-200
                        rounded-lg
                        overflow-hidden
                        xl:aspect-w-7 xl:aspect-h-8
                        hover:text-[#009ef7]
                      "
                    >
                      <img
                        :src="`/storage/${i.image}`"
                        :alt="i.title"
                        class="
                          w-full
                          h-[270px]
                          object-center object-cover
                          group-hover:opacity-75
                        "
                        height="270"
                        width="270"
                      />
                    </div>
                    <div>
                      <h3 class="text-[#009ef7] mt-4">{{ i.title }}</h3>
                      <h3 class="mt-1 text-sm text-[#009ef7]" v-if="i.product">
                        {{ i.product.name }} |
                        <template v-if="i.product.product_collection">
                          {{ i.product.product_collection.name }} |
                        </template>
                        <template v-if="i.product_model">
                          {{ i.product.product_model.name }}
                        </template>
                        <template v-if="i.product.product_brand">
                          {{ i.product.product_brand.name }} |
                        </template>
                        <template v-if="i.product.product_category">
                          {{ i.product.product_category.name }} |
                        </template>
                        <template v-if="i.product.product_type">
                          {{ i.product.product_type.name }} |
                        </template>
                        <template v-if="i.product.product_color">
                          {{ i.product.product_color.name }} |
                        </template>
                        <template v-if="i.product.product_material">
                          {{ i.product.product_material.name }} |
                        </template>
                        <template v-if="i.product.product_country">
                          {{ i.product.product_country.name }}
                        </template>
                      </h3>
                    </div>
                    <p class="mt-1 mb-4 text-lg font-medium">
                      المتاح : {{ i.total_number_of_kit }}
                    </p>
                  </Link>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr></tr>
            </tfoot>
          </DataTable>
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

import DataTable from "datatables.net-vue3";

provide("title", "قطع الغيار");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "قطع الغيار", linkRoute: "#" },
  ])
);

const options = {
  pageLength: 12,
  lengthChange: false,
  info: false,
  language: {
    search: "بحث : ",
    paginate: {
      next: "التالى",
      previous: "السابق",
    },
  },
  order: [0],
};

const props = defineProps(["kits"]);
const kits = props.kits;
</script>
<style>
.kits {
  margin-top: 10px;
  width: 100% !important;
  text-align: right !important;
}
.dataTables_filter input {
  @apply text-sm text-gray-900 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-[#1b1b29] bg-[#f5f8fa] dark:border-gray-600 dark:placeholder-gray-400 mx-2;
}
.dataTables_paginate {
  @apply my-3 flex;
  justify-content: flex-start;
}
.dataTables_paginate span {
  @apply flex;
}
.paginate_button {
  @apply mx-2 bg-[#009ef7] border border-transparent rounded-md py-3 px-5 flex items-center justify-center text-base  text-sm text-white hover:bg-[#009ef7] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#009ef7] cursor-pointer;
}
.disabled,
.disabled:hover,
.current,
.current:hover {
  background: #151521;
  cursor: auto;
  outline: none;
  outline-offset: 0;
  box-shadow: none;
}
</style>