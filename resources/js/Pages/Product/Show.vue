<template>
  <AppLayout title="المنتجات">
    <SectionTemplate class="print:p-0">
      <div class="flex justify-between">
        <div class="flex justify-around flex-col w-full">
          <h2 class="text-lg font-bold mt-3">
            {{ product.name }}
            <template v-if="product.product_collection">
              | {{ product.product_collection.name }}
            </template>
            <template v-if="product.product_model">
              | {{ product.product_model.name }}
            </template>
          </h2>
          <h2 class="text-lg font-bold mt-3">
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
          <h2 class="mt-3">SKU : {{ product.sku }}</h2>
          <h2 class="text-lg font-bold mt-3 text-[#009ef7]">
            سعر البيع : {{ product.price }}
          </h2>
          <h2 class="text-lg font-bold mt-3 text-[#009ef7]">
            إجمالى مبيعات المنتج : {{ product.total_sales }}
          </h2>
          <h2 class="text-lg font-bold mt-3 text-[#009ef7]">
            إجمالى المتاح بالمخازن : {{ product.total_number_of_product }}
          </h2>
          <div class="flex print:hidden">
            <btn-info
              :element="Link"
              :to="route('product.edit', product.id)"
              class="mt-4"
            >
              تعديل بيانات
            </btn-info>
          </div>
        </div>
        <div>
          <a :href="`/storage/${product.image}`" target="_blank">
            <img
              :src="`/storage/${product.image}`"
              :alt="product.name"
              class="
                w-full
                h-[270px]
                object-center object-cover
                group-hover:opacity-75
                shadow-xl
                rounded-md
              "
              height="270"
              width="270"
          /></a>
        </div>
      </div>
    </SectionTemplate>
    <SectionTemplate class="print:p-0">
      <ProductTabs :id="product.id" />
    </SectionTemplate>
  </AppLayout>
</template>

<script setup>
import { reactive } from "vue";
import { computed, provide, readonly } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import ProductTabs from "@/Components/Product/ProductTabs.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import BtnInfo from "@/Components/Buttons/BtnInfo.vue";

const props = defineProps(["product"]);
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