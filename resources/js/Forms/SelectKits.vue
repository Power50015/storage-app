<template>
  <div class="mb-5" ref="scrollComponent2">
    <FromLabel :title="title" :require="require" :error="error" />
    <div class="flex relative">
      <div class="select cursor-pointer" @click="open" v-click-out-side="close">
        <div class="flex items-center justify-between px-3">
          <input type="text" v-model="inputText" class="w-full cursor-pointer" @input="getKitsData"
            :placeholder="placeholderText" />
          <div class="transition-all text-gray-500" :class="{ 'rotate-180': openState }" @click="close">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="10" role="presentation"
              class="vs__open-indicator">
              <path
                d="M9.211364 7.59931l4.48338-4.867229c.407008-.441854.407008-1.158247 0-1.60046l-.73712-.80023c-.407008-.441854-1.066904-.441854-1.474243 0L7 5.198617 2.51662.33139c-.407008-.441853-1.066904-.441853-1.474243 0l-.737121.80023c-.407008.441854-.407008 1.158248 0 1.600461l4.48338 4.867228L7 10l2.211364-2.40069z">
              </path>
            </svg>
          </div>
        </div>
        <ul v-if="openState" @scroll="handleScroll" ref="scrollComponent">
          <template v-if="kits.length == 0 && !loading">
            <li>لا يوجد بيانات</li>
          </template><template v-else-if="kits.length == 0 && loading">
            جاى تحميل البيانات ....</template>
          <template v-else>
            <li v-for="option in kits" :key="option.index" @click="change(option.index, option.label)">
              <div class="item flex items-center">
                <img v-if="option['image']" :src="`/storage/${option['image']}`" alt="" width="50" height="50"
                  class="mx-3" />
                <h6 class="text-black dark:text-white">{{ option.label }}</h6>
              </div>
            </li>
          </template>
        </ul>
      </div>
      <slot />
    </div>
  </div>
</template>
<script setup>
import FromLabel from "@/Forms/FromLabel.vue";
import { reactive, ref } from "@vue/reactivity";
import { onMounted, onUnmounted, onUpdated, computed } from "@vue/runtime-core";
import { clickOutSide as vClickOutSide } from "@mahdikhashan/vue3-click-outside";
import axios from "axios";

const props = defineProps({
  modelValue: {},
  title: { type: String, default: "" },
  error: { type: String, default: "" },
  require: { type: Boolean, default: false },
});
const emit = defineEmits(["update:modelValue"]);

const select = ref(props.modelValue);
const loading = ref(true);
onMounted(() => {
  if (props.modelValue) {
    select.value = props.modelValue;
    axios
      .get("/kit-data", {
        params: {
          id: props.modelValue,
        },
      })
      .then(function (response) {
        response.data.forEach((item) => {
          let name = item.title;
          if (item.product) {
            if (item.product.product_collection) name = name + " - " + item.product.product_collection.name;
            if (item.product.product_model) name = name + " - " + item.product.product_model.name;
            if (item.product.product_brand) name = name + " - " + item.product.product_brand.name;
            if (item.product.product_category) name = name + " - " + item.product.product_category.name;
            if (item.product.product_type) name = name + " - " + item.product.product_type.name;
            if (item.product.product_color) name = name + " - " + item.product.product_color.name;
            if (item.product.product_material) name = name + " - " + item.product.product_material.name;
            if (item.product.product_country) name = name + " - " + item.product.product_country.name;
            name = name + " - " + item.product.name;
          } else {
            if (item.product_collection) name = name + " - " + item.product_collection.name;
            if (item.product_model) name = name + " - " + item.product_model.name;
            if (item.product_brand) name = name + " - " + item.product_brand.name;
            if (item.product_category) name = name + " - " + item.product_category.name;
            if (item.product_type) name = name + " - " + item.product_type.name;
            if (item.product_color) name = name + " - " + item.product_color.name;
            if (item.product_material) name = name + " - " + item.product_material.name;
            if (item.product_country) name = name + " - " + item.product_country.name;
          }
          if (props.modelValue == item.id) {
            placeholderText.value = name;
          }
          loading.value = false;
        });
      });
  }
});
onUpdated(() => {
  if (props.modelValue) {
    select.value = props.modelValue;
    axios
      .get("/kit-data", {
        params: {
          id: props.modelValue,
        },
      })
      .then(function (response) {
        response.data.forEach((item) => {
          let name = item.title;
          if (item.product) {
            if (item.product.product_collection) name = name + " - " + item.product.product_collection.name;
            if (item.product.product_model) name = name + " - " + item.product.product_model.name;
            if (item.product.product_brand) name = name + " - " + item.product.product_brand.name;
            if (item.product.product_category) name = name + " - " + item.product.product_category.name;
            if (item.product.product_type) name = name + " - " + item.product.product_type.name;
            if (item.product.product_color) name = name + " - " + item.product.product_color.name;
            if (item.product.product_material) name = name + " - " + item.product.product_material.name;
            if (item.product.product_country) name = name + " - " + item.product.product_country.name;
            name = name + " - " + item.product.name;
          } else {
            if (item.product_collection) name = name + " - " + item.product_collection.name;
            if (item.product_model) name = name + " - " + item.product_model.name;
            if (item.product_brand) name = name + " - " + item.product_brand.name;
            if (item.product_category) name = name + " - " + item.product_category.name;
            if (item.product_type) name = name + " - " + item.product_type.name;
            if (item.product_color) name = name + " - " + item.product_color.name;
            if (item.product_material) name = name + " - " + item.product_material.name;
            if (item.product_country) name = name + " - " + item.product_country.name;
          }
          if (props.modelValue == item.id) {
            placeholderText.value = name;
          }
          loading.value = false;
        });
      });
  }
});
onUnmounted(() => (select.value = props.modelValue));
// Select Code
// Get Data
const rowData = reactive([]);
const kits = reactive([]);
const inputText = ref();
function getKitsData(page = 1) {
  axios
    .get("/kit-data", {
      params: {
        page: page,
        search: inputText.value ? inputText.value : "",
      },
    })
    .then(function (response) {
      rowData.length = 0;
      if (inputText.value) kits.length = 0;
      rowData.push(response.data); // The row Data
      response.data.data.forEach((item) => {
        let name = item.title;
        if (item.product) {
          if (item.product.product_collection) name = name + " - " + item.product.product_collection.name;
          if (item.product.product_model) name = name + " - " + item.product.product_model.name;
          if (item.product.product_brand) name = name + " - " + item.product.product_brand.name;
          if (item.product.product_category) name = name + " - " + item.product.product_category.name;
          if (item.product.product_type) name = name + " - " + item.product.product_type.name;
          if (item.product.product_color) name = name + " - " + item.product.product_color.name;
          if (item.product.product_material) name = name + " - " + item.product.product_material.name;
          if (item.product.product_country) name = name + " - " + item.product.product_country.name;
          name = name + " - " + item.product.name;
        } else {
          if (item.product_collection) name = name + " - " + item.product_collection.name;
          if (item.product_model) name = name + " - " + item.product_model.name;
          if (item.product_brand) name = name + " - " + item.product_brand.name;
          if (item.product_category) name = name + " - " + item.product_category.name;
          if (item.product_type) name = name + " - " + item.product_type.name;
          if (item.product_color) name = name + " - " + item.product_color.name;
          if (item.product_material) name = name + " - " + item.product_material.name;
          if (item.product_country) name = name + " - " + item.product_country.name;
        }
        kits.push({
          label: name,
          index: item.id,
          image: item.image,
        });
        if (props.modelValue == item.id) {
          placeholderText.value = name;
        }
      });
    });
}
getKitsData();

const scrollComponent = ref(null);
const handleScroll = (e) => {
  let element = scrollComponent.value;
  if (element.scrollTop + element.clientHeight >= element.scrollHeight) {
    if (rowData[0].next_page_url != null) {
      getKitsData(rowData[0].current_page + 1);
    }
  }
};
const openState = ref(false);
const placeholderText = ref();
function open() {
  openState.value = true;
}
function close() {
  openState.value = false;
}
function change(value, text) {
  select.value = value;
  openState.value = false;
  placeholderText.value = text;
  emit("update:modelValue", select.value);
}
</script>
<style scoped>
.select {
  @apply w-full
            text-base
            dark:bg-[#1b1b29]
            bg-[#f5f8fa]
            dark:active:bg-[#1b1b29]
            active:bg-[#f5f8fa]
            dark:focus:bg-[#1b1b29]
            focus:bg-[#f5f8fa]
            text-white
            focus:ring-0
            border-0
            shadow-sm
            rounded-md
            mx-2;
}
input {
  @apply text-base
              dark:bg-[#1b1b29]
              bg-[#f5f8fa]
              dark:active:bg-[#1b1b29]
              active:bg-[#f5f8fa]
              dark:focus:bg-[#1b1b29]
              focus:bg-[#f5f8fa] focus:ring-0
              border-0
              shadow-sm
              rounded-md;
}
ul {
  @apply absolute
              w-full
              max-h-56
              overflow-y-scroll
              text-base
              dark:bg-[#1b1b29]
              bg-[#f5f8fa]
              dark:active:bg-[#1b1b29]
              active:bg-[#f5f8fa]
              dark:focus:bg-[#1b1b29]
              focus:bg-[#f5f8fa] focus:ring-0
              border-0
              shadow-sm
              cursor-pointer
              z-40
              rounded-none;
}
li {
  @apply rounded-none px-2 py-3 hover:bg-[#0095e8]
                  focus:bg-[#0095e8]
                  active:bg-[#0095e8];
}
.item {
  @apply w-full rounded-none;
}
</style>