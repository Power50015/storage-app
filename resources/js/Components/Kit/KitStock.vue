<template>
  <div class="flex justify-between items-start">
    <h2 class="font-bold text-2xl">تفاصيل المخزون</h2>
    <InputText
      v-model="inputText"
      placeholder="بحث ...."
      @input="getKitsData((reload = true))"
    />
  </div>
  <div v-for="item in kits" :key="item.index">
    <Link
      :href="route('warehouse.show', item.warehouse.id)"
      class="
        w-full
        flex
        justify-between
        cursor-pointer
        hover:text-[#0095e8]
        font-bold
        transition-all
        my-2
        py-4
        px-2
        text-right
      "
    >
      <h2 class="w-full">المخزن : {{ item.warehouse.name }}</h2>
      <h2 class="w-full text-left">الكميه : {{ item.quantity }}</h2>
    </Link>
  </div>
  <div
    v-if="(rowData[0] && rowData[0].next_page_url) || rowData.length == 0"
  >
    <DotsSpinner />
  </div>
  <div v-if="rowData[0] && rowData[0].data.length == 0" class="mt-3">لا يوجد بيانات</div>
</template>
  <script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { reactive, ref } from "@vue/reactivity";
import axios from "axios";
import { onMounted } from "@vue/runtime-core";
import DotsSpinner from "../Spinner/DotsSpinner.vue";
import InputText from "@/Forms/InputText.vue";

const props = defineProps(["kit"]);

onMounted(() => window.addEventListener("scroll", handleScroll));

const rowData = reactive([]);
const kits = reactive([]);
const inputText = ref();
function getKitsData(reload = false, page = 1) {
  axios
    .get("/kit-stock", {
      params: {
        kit: props.kit,
        page: page,
        search: inputText.value,
      },
    })
    .then(function (response) {
      rowData.length = 0;
      if (reload) kits.length = 0;
      rowData.push(response.data);
      response.data.data.forEach((item) => {
        kits.push(item);
      });
    });
}

getKitsData();

const handleScroll = (e) => {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    if (rowData[0])
      if (rowData[0].next_page_url != null) {
        getKitsData(false, rowData[0].current_page + 1);
      }
  }
};
</script>