<template>
  <div>
    <div class="flex justify-between">
      <h2 class="font-bold text-2xl my-3">المتاح بالمخازن</h2>
      <div
        @click="print"
        class="
          print:hidden
          bg-[#009ef7]
          border border-transparent
          rounded-md
          py-3
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
              المخزن
            </th>
            <th
              class="border border-dashed border-slate-700 py-3 px-3 font-bold"
            >
              الكميه
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in warehouse" :key="product.index" class="">
            <td
              class="
                border border-dashed border-slate-700
                py-3
                px-3
                hover:text-[#0095e8]
              "
            >
              <Link
                :href="route('warehouse.show', product.warehouse.id)"
                class="data hover:text-[#009ef7]"
              >
                {{ product.warehouse.name }}
              </Link>
            </td>
            <td class="border border-dashed border-slate-700 py-3 px-3">
              {{ product.quantity }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script setup>
import { computed, provide, readonly, reactive, ref } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import ProductWarehouse from "./ProductWarehouse.vue";

const tab = ref("stock");

const props = defineProps(["warehouse"]);
const warehouse = props.warehouse;

function tabClick(inputTab) {
  tab.value = inputTab;
}

function print() {
  window.print();
}
</script>