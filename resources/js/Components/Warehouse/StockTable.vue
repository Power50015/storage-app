<template>
  <div>
    <div class="flex justify-between">
      <h2 class="font-bold text-2xl my-3">محتوى المخزن</h2>
      <div
        @click="print"
        class="
          print:hidden
          bg-[#009ef7]
          border border-transparent
          rounded-md
          px-3
          flex
          items-center
          justify-center
          text-base text-white
          hover:bg-[#009ef7]
          focus:outline-none
          focus:ring-2
          focus:ring-offset-2
          focus:ring-[#009ef7]
          cursor-pointer
        "
      >
      طباعه 
        <i class="fa-solid fa-print mx-3"></i>
      </div>
    </div>
    <h2 class="font-bold text-md my-3">الرئيسي</h2>
    <div class="mt-6 hover:gray-500">
      <table
        class="border border-dashed border-slate-700 w-full text-right"
        id="xyz"
      >
        <thead>
          <tr>
            <th
              class="border border-dashed border-slate-700 py-3 px-3 font-bold"
            >
              المنتج
            </th>
            <th
              class="border border-dashed border-slate-700 py-3 px-3 font-bold"
            >
              الكميه
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.index" class="">
            <td
              class="
                border border-dashed border-slate-700
                py-3
                px-3
                hover:text-[#0095e8]
              "
            >
              <Link :href="route('kit.index')">
                <template v-if="product.product_brand">
                  {{ product.product_brand }} |
                </template>
                {{ product.product_category }} | {{ product.product_type }} |
                {{ product.product_collection }} | {{ product.product_model }} |
                {{ product.product_color }} | {{ product.product_material }} |
                {{ product.product_country }} |
                <template v-if="product.sku"> {{ product.sku }} | </template>
                {{ product.product_name }}
              </Link>
            </td>
            <td class="border border-dashed border-slate-700 py-3 px-3">
              {{ product.product_quantity }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { onMounted, onUnmounted, reactive, ref } from "@vue/runtime-core";

const props = defineProps(["products"]);

const products = props.products;

function print() {
  window.print();
}
</script>
<style scoped>
</style>
