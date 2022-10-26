<template>
  <AppLayout title="المنتجات">
    <SectionTemplate class="print:p-0">
      <div class="flex justify-between xl:flex-row flex-col-reverse">
        <div class="flex justify-around flex-col w-full mx-3">
          <div class="flex xl:flex-row flex-col font-bold items-center">
            <Link
              :href="
                route('product-category.show', product.product_category.id)
              "
              class="hover:text-[#009ef7] mx-3"
              v-if="product.product_category"
            >
              {{ product.product_category.name }}
            </Link>
            <span>-</span>
            <Link
              :href="route('product-type.show', product.product_type.id)"
              class="hover:text-[#009ef7] mx-3"
              v-if="product.product_type"
            >
              {{ product.product_type.name }}
            </Link>
            <span>-</span>
            <Link
              :href="
                route('product-collection.show', product.product_collection.id)
              "
              class="hover:text-[#009ef7] mx-3"
              v-if="product.product_collection"
            >
              {{ product.product_collection.name }}
            </Link>
            <span>-</span>
            <Link
              :href="route('product-type.show', product.product_model.id)"
              class="hover:text-[#009ef7] mx-3"
              v-if="product.product_model"
            >
              {{ product.product_model.name }}
            </Link>
            <Link
              :href="route('product-color.show', product.product_color.id)"
              class="hover:text-[#009ef7] mx-3"
              v-if="product.product_color"
            >
              {{ product.product_color.name }}
            </Link>
            <span>-</span>
            <Link
              :href="
                route('product-material.show', product.product_material.id)
              "
              class="hover:text-[#009ef7] mx-3"
              v-if="product.product_material"
            >
              {{ product.product_material.name }}
            </Link>
            <span>-</span>
            <Link
              :href="route('product-country.show', product.product_country.id)"
              class="hover:text-[#009ef7] mx-3"
              v-if="product.product_country"
            >
              {{ product.product_country.name }}
            </Link>
          </div>
          <div class="flex xl:flex-row flex-col text-lg font-bold mt-3">
            <h2 class="mx-3 text-[#009ef7]">
              {{ product.name }}
            </h2>
            <span v-if="product.sku">-</span>
            <h2 class="mx-3" v-if="product.sku">SKU : {{ product.sku }}</h2>
          </div>
          <div>
            <Link
              :href="route('product-brand.show', product.product_brand.id)"
              class="
                flex
                xl:flex-row
                flex-col
                items-center
                p-5
                my-3
                hover:text-[#009ef7]
                rounded-md
              "
              v-if="product.product_brand"
            >
              <img
                :src="`/storage/${product.product_brand.logo}`"
                :alt="product.product_brandname"
                class="w-[100px] h-[100px]"
              />
              <h6 class="mx-2 text-lg font-bold">
                {{ product.product_brand.name }}
              </h6>
              -
              <h6 class="mx-2 font-bold">
                {{ product.product_brand.product_country.name }}
              </h6>
            </Link>
          </div>

          <div class="flex xl:flex-row flex-col text-lg font-bold mt-3">
            <h2 class="mx-3 text-[#009ef7]">سعر البيع : {{ product.price }}</h2>
            <span>-</span>
            <h2 class="mx-3 text-[#009ef7]">
              إجمالى مبيعات المنتج : {{ product.total_sales }}
            </h2>
            <span>-</span>
            <h2 class="mx-3 text-[#009ef7]">
              إجمالى المتاح بالمخازن مع الهالك :
              {{ product.total_number_of_product }}
            </h2>
            <span>-</span>
            <h2 class="mx-3 text-[#009ef7]">
              إجمالى الهالك : {{ product.destructible_goods }}
            </h2>
          </div>

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
        <div class="mb-3">
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
      <ProductTabs :id="product.id" :description="product.description" />
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