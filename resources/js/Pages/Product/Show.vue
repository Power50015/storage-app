<template>
  <AppLayout title="المنتجات">
    <div class="pt-6 pb-2">
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
            <div class="flex w-full justify-between">
              <div class="">
                <h2 class="title font-bold mt-3">
                  {{ product.name }}
                  <template v-if="product.product_collection">
                    | {{ product.product_collection.name }}
                  </template>
                  <template v-if="product.product_model">
                    | {{ product.product_model.name }}
                  </template>
                </h2>
                <h2 class="title font-bold mt-3">
                  <template v-if="product.product_brand">
                    {{ product.product_brand.name }}
                  </template>
                  <template v-if="product.product_category">
                    | {{ product.product_category.name }}
                  </template>
                  <template v-if="product.product_type">
                    | {{ product.product_type.name }}
                  </template>
                  <template v-if="product.product_color">
                    | {{ product.product_color.name }}
                  </template>
                  <template v-if="product.product_material">
                    | {{ product.product_material.name }}
                  </template>
                  <template v-if="product.product_country">
                    | {{ product.product_country.name }}
                  </template>
                </h2>
                <h2 class="title font-bold mt-3 text-[#009ef7]">
                  سعر البيع : {{ product.price }}
                </h2>
                <h2 class="title font-bold mt-3 text-[#009ef7]">
                  إجمالى مبيعات المنتج : {{ product.total_sales }}
                </h2>
                <h2 class="title font-bold mt-3 text-lg text-[#009ef7]">
                  إجمالى المتاح بالمخازن : {{ product.total_number_of_product }}
                </h2>
                <Link
                  :href="route('product.edit', product.id)"
                  class="
                    print:hidden
                    mt-5
                    bg-[#7239ea]
                    border border-transparent
                    rounded-md
                    py-3
                    px-3
                    inline-block
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
                  تعديل بيانات
                </Link>
              </div>
              <div>
                <a :href="`/storage/${product.image}`" target="_blank">
                  <img
                    :src="`/storage/${product.image}`"
                    :alt="product.title"
                    class="
                      w-full
                      h-[270px]
                      object-center object-cover
                      group-hover:opacity-75
                    "
                    height="270"
                    width="270"
                /></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <product-tabs
      :warehouse="product.total_number_of_product_warehouse"
      :stockData="stockData"
      :incomeIvoice="incomeIvoice"
      :outgoingIvoice="outgoingIvoice"
      :stratStock="stratStock"
      :transfer="transfer"
      :note="note"
      :attachment="attachment"
      :image="image"
      :id="product.id"
    />
  </AppLayout>
</template>

<script setup>
import { reactive } from "vue";
import { computed, provide, readonly } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import ProductTabs from "@/Components/Product/ProductTabs.vue";

const props = defineProps([
  "product",
  "stockData",
  "incomeIvoice",
  "outgoingIvoice",
  "stratStock",
  "transfer",
  "note",
  "attachment",
  "image",
]);
const product = computed(() => props.product[0]);

provide("title", "المنتج");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "المنتجات", linkRoute: "product.index" },
    { index: 2, linkTitle: " المنتج " + props.product[0].name, linkRoute: "#" },
  ])
);
</script>