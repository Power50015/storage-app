<template>
  <div class="flex justify-between items-start">
    <h2 class="font-bold text-2xl">قطع الغيار</h2>
    <InputText
      v-model="inputText"
      placeholder="بحث ...."
      @input="getKitData((reload = true))"
    />
  </div>
  <div class="grid gap-x-4 gap-y-2 grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
    <div
      v-for="item in images"
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
      <div class="w-full flex justify-between items-center">
        <BadgeInfo>{{ item.title }}</BadgeInfo>
      </div>
      <div class="my-3">
        <Link :href="route('kit.show', item.id)">
          <img
            :src="`/storage/${item.image}`"
            :alt="`/storage/${item.image}`"
            class="w-full"
          />
        </Link>
        <div class="flex items-center mt-3">
          <img
            :src="item.user.profile_photo_url"
            :alt="item.user.name"
            class="w-[50px] h-[50px] rounded-full"
          />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
    </div>
  </div>
  <div v-if="(rowData[0] && rowData[0].next_page_url) || rowData.length == 0">
    <DotsSpinner />
  </div>
  <div v-if="rowData[0] && rowData[0].data.length == 0" class="mt-3">
    لا يوجد قطع غيار
  </div>
</template>
<script setup>
import { reactive, ref } from "@vue/reactivity";
import { Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { onMounted } from "@vue/runtime-core";
import DotsSpinner from "../Spinner/DotsSpinner.vue";
import BadgeInfo from "../Badges/BadgeInfo.vue";
import InputText from "@/Forms/InputText.vue";

const props = defineProps(["product"]);

onMounted(() => window.addEventListener("scroll", handleScroll));

const rowData = reactive([]);
const images = reactive([]);
const inputText = ref();

function getKitData(reload = false, page = 1) {
  if (reload) images.length = 0;
  if (reload) rowData.length = 0;
  axios
    .get("/product-kits", {
      params: {
        product: props.product,
        page: page,
        search: inputText.value,
      },
    })
    .then(function (response) {
      rowData.length = 0;
      rowData.push(response.data.kit);
      response.data.kit.data.forEach((item) => {
        images.push(item);
      });
    });
}

getKitData();

const handleScroll = (e) => {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    if (rowData[0])
      if (rowData[0].next_page_url != null) {
        getKitData(false, rowData[0].current_page + 1);
      }
  }
};
</script>