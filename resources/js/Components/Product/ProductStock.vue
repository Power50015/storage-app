<template>
  <div class="flex justify-between items-start">
    <h2 class="font-bold text-2xl">تفاصيل المخزون</h2>
    <InputText
      v-model="inputText"
      placeholder="بحث ...."
      @input="getProductsData((reload = true))"
    />
  </div>
  <div v-for="item in products" :key="item.index">
    <ProductStockItem
      :item="item"
      :id="product"
      @FormSuccess="getProductsData((reload = true))"
    />
  </div>
  <div v-if="(rowData[0] && rowData[0].next_page_url) || rowData.length == 0">
    <DotsSpinner />
  </div>
  <div v-if="rowData[0] && rowData[0].data.length == 0" class="mt-3">
    لا يوجد بيانات
  </div>
</template>
    <script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { reactive, ref } from "@vue/reactivity";
import axios from "axios";
import { onMounted } from "@vue/runtime-core";
import DotsSpinner from "../Spinner/DotsSpinner.vue";
import InputText from "@/Forms/InputText.vue";
import ProductStockItem from "./ProductStockItem.vue";

const props = defineProps(["product"]);

onMounted(() => window.addEventListener("scroll", handleScroll));

const rowData = reactive([]);
const products = reactive([]);
const inputText = ref();
function getProductsData(reload = false, page = 1) {
  if (reload) products.length = 0;
  axios
    .get("/product-stock", {
      params: {
        product: props.product,
        page: page,
        search: inputText.value,
      },
    })
    .then(function (response) {
      rowData.length = 0;
      rowData.push(response.data);
      response.data.data.forEach((item) => {
        products.push(item);
      });
    });
}

getProductsData();

const handleScroll = (e) => {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    if (rowData[0])
      if (rowData[0].next_page_url != null) {
        getProductsData(false, rowData[0].current_page + 1);
      }
  }
};
</script>