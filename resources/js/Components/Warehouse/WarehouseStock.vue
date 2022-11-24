<template>
  <div class="flex justify-between items-start">
    <h2 class="font-bold text-2xl">المتاح فى المنتج</h2>
    <div class="flex">
      <FormSelect
        v-model="action"
        :options="actionOptions"
        @change-select="getData(true)"
      ></FormSelect>
    </div>
  </div>
  <div v-for="item in actions[0]" :key="item.index">
    <div v-if="item.dataType == 'Product'">
      <Link
        :href="route('product.show', item.id)"
        class="
          w-full
          flex
          justify-between
          items-center
          cursor-pointer
          hover:text-[#0095e8]
          transition-all
          my-2
          py-4
          px-2
          text-right
          font-bold
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>{{ item.name }}</h2>
        </div>
        <div class="w-full flex justify-center">
          <BadgeSuccess>منتج </BadgeSuccess>
        </div>
        <div class="w-full flex justify-end">
          الكميه المتاحه : {{ item.quantity }}
        </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'Kit'">
      <Link
        :href="route('kit.show', item.id)"
        class="
          w-full
          flex
          justify-between
          items-center
          cursor-pointer
          hover:text-[#0095e8]
          transition-all
          my-2
          py-4
          px-2
          text-right
          font-bold
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>{{ item.title }}</h2>
        </div>
        <div class="w-full flex justify-center">
          <BadgePrimary>قطعه غيار</BadgePrimary>
        </div>
        <div class="w-full flex justify-end">
          الكميه المتاحه : {{ item.quantity }}
        </div>
      </Link>
    </div>
  </div>
  <div v-if="(rowData[0] && rowData[0].next_page_url) || rowData.length == 0">
    <DotsSpinner />
  </div>
  <div v-if="rowData[0] && rowData[0].length == 0" class="mt-3">
    لا يوجد بيانات
  </div>
</template>
<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { reactive, ref } from "@vue/reactivity";
import axios from "axios";
import FormSelect from "@/Forms/FormSelect.vue";
import DotsSpinner from "../Spinner/DotsSpinner.vue";
import BadgeSuccess from "../Badges/BadgeSuccess.vue";
import BadgePrimary from "../Badges/BadgePrimary.vue";

const props = defineProps(["id"]);

const rowData = reactive([]);
const actions = reactive([]);
const action = ref();

const actionOptions = [
  { label: "منتجات", index: "Product" },
  { label: "قطع غيار", index: "Kit" },
];
async function getData(reload = false, page = 1) {
  if (reload) actions.length = 0;
  axios
    .get("/warehouse-data", {
      params: {
        warehouse: props.id,
        page: page,
        action: action.value,
      },
    })
    .then(function (response) {
      rowData.length = 0;
      if (reload) actions.length = 0;
      actions.push(response.data);
      rowData.push(response.data);
    });
}

getData();
</script>