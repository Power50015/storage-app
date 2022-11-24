<template>
  <div class="flex justify-between items-start">
    <h2 class="font-bold text-2xl">الهالك</h2>
  </div>
  <div class="grid gap-x-4 gap-y-2 grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
    <div
      v-for="item in goods"
      :key="item.index"
      class="
        my-2
        dark:bg-[#151521]
        bg-[#f5f8fa]
        p-3
        rounded-md
        flex flex-col
        justify-between
      "
    >
      <destructible-goods-item :item="item" @FormSuccess="getGoodsData(true)" />
    </div>
  </div>
  <div v-if="(rowData[0] && rowData[0].next_page_url) || rowData.length == 0">
    <DotsSpinner />
  </div>
  <div v-else-if="goods.length == 0" class="mt-3">لا يوجد هالك</div>
</template>
    <script setup>
import { reactive, ref } from "@vue/reactivity";
import axios from "axios";
import { onMounted } from "@vue/runtime-core";
import DotsSpinner from "../Spinner/DotsSpinner.vue";
import DestructibleGoodsItem from "../Product/DestructibleGoodsItem.vue";

const props = defineProps(["id"]);

onMounted(() => window.addEventListener("scroll", handleScroll));

const rowData = reactive([]);
const goods = reactive([]);
const inputText = ref();
function getGoodsData(reload = false, page = 1) {
  if (reload) goods.length = 0;
  if (reload) rowData.length = 0;
  axios
    .get(route("warehouse-destructible-goods"), {
      params: {
        warehouse: props.id,
        page: page,
      },
    })
    .then(function (response) {
      rowData.length = 0;
      rowData.push(response.data.DestructibleGoodsAction);
      if (response.data.DestructibleGoodsAction)
        response.data.DestructibleGoodsAction.data.forEach((item) => {
          goods.push(item);
        });
    });
}

getGoodsData();

const handleScroll = (e) => {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    if (rowData[0])
      if (rowData[0].next_page_url != null) {
        getGoodsData(false, rowData[0].current_page + 1);
      }
  }
};
</script>