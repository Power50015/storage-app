<template>
  <div class="mb-5" ref="scrollComponent2">
    <FromLabel :title="title" :require="require" :error="error" />
    <div class="flex relative">
      <div class="select cursor-pointer" @click="open" v-click-out-side="close">
        <div class="flex items-center justify-between px-3">
          <input
            type="text"
            v-model="inputText"
            class="w-full cursor-pointer"
            @input="getProductsData"
            :placeholder="placeholderText"
          />
          <div
            class="transition-all text-gray-500"
            :class="{ 'rotate-180': openState }"
            @click="close"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="14"
              height="10"
              role="presentation"
              class="vs__open-indicator"
            >
              <path
                d="M9.211364 7.59931l4.48338-4.867229c.407008-.441854.407008-1.158247 0-1.60046l-.73712-.80023c-.407008-.441854-1.066904-.441854-1.474243 0L7 5.198617 2.51662.33139c-.407008-.441853-1.066904-.441853-1.474243 0l-.737121.80023c-.407008.441854-.407008 1.158248 0 1.600461l4.48338 4.867228L7 10l2.211364-2.40069z"
              ></path>
            </svg>
          </div>
        </div>
        <ul v-if="openState" @scroll="handleScroll" ref="scrollComponent">
          <template v-if="products.length == 0">
            <li>لا يوجد بيانات</li>
          </template>
          <template v-else>
            <li
              v-for="option in products"
              :key="option.index"
              @click="change(option.index, option.label)"
            >
              <div class="item flex items-center min-h-[50px]">
                <img
                  v-if="option['image']"
                  :src="`/storage/${option['image']}`"
                  alt=""
                  width="50"
                  height="50"
                  class="mx-3"
                />
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
const emit = defineEmits(["update:modelValue", "changeSelect"]);

const select = ref(props.modelValue);

onMounted(() => {
  if (select.value) {
    select.value = props.modelValue;
    axios
      .get("/people-data", {
        params: {
          id: props.modelValue,
        },
      })
      .then(function (response) {
        response.data.forEach((item) => {
          let name = item.name;
          if (props.modelValue == item.id) {
            placeholderText.value = name;
          }
        });
      });
  }
});
onUpdated(() => (select.value = props.modelValue));
onUnmounted(() => (select.value = props.modelValue));

// Select Code
// Get Data
const rowData = reactive([]);
const products = reactive([]);
const inputText = ref();
function getProductsData(page = 1) {
  axios
    .get("/people-data", {
      params: {
        page: page,
        search: inputText.value ? inputText.value : "",
      },
    })
    .then(function (response) {
      rowData.length = 0;
      if (inputText.value) products.length = 0;
      rowData.push(response.data); // The row Data
      products.push({
        label: null,
        index: null,
        image: null,
      });
      response.data.data.forEach((item) => {
        let name = item.name;
        products.push({
          label: name,
          index: item.id,
          image: item.logo,
        });
        if (props.modelValue == item.id) {
          placeholderText.value = name;
        }
      });
    });
}
getProductsData();

const scrollComponent = ref(null);
const handleScroll = (e) => {
  let element = scrollComponent.value;
  if (element.scrollTop + element.clientHeight >= element.scrollHeight) {
    if (rowData[0].next_page_url != null) {
      getProductsData(rowData[0].current_page + 1);
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
  emit("changeSelect");
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