<template>
  <div class="mb-5">
    <FromLabel :title="title" :require="require" :error="error" />
    <div class="flex">
      <v-select
        :clearable="false"
        :options="options"
        v-model="select"
        :reduce="(item) => item.index"
        @option:selected="change"
        @option:deselected="$emit('update:modelValue', null)"
        @scroll="scroll"
        dir="rtl"
        class="
          w-full
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
          py-2
          px-3
          mx-2
        "
      >
        <template v-slot:option="option">
          <div class="flex items-center">
            <img
              v-if="option['image']"
              :src="`/storage/${option['image']}`"
              alt=""
              width="100"
              height="100"
              class="mx-3"
            />
            <h6>{{ option["label"] }}</h6>
          </div>
        </template>
        <template v-slot:no-options="{ search, searching }">
          <template v-if="searching">
            لا يوجد نتائج ل<em>{{ search }}</em
            >.
          </template>
        </template>
      </v-select>
      <slot />
    </div>
  </div>
</template>
    <script setup>
import FromLabel from "@/Forms/FromLabel.vue";
import { ref } from "@vue/reactivity";
import { onMounted, onUnmounted, onUpdated } from "@vue/runtime-core";
import vSelect from "vue-select";

const props = defineProps({
  modelValue: {},
  title: { type: String, default: "" },
  error: { type: String, default: "" },
  require: { type: Boolean, default: false },
  options: { require: true },
});
const emit = defineEmits(["update:modelValue", "changeSelect"]);

const select = ref(props.modelValue);

onMounted(() => (select.value = props.modelValue));
onUpdated(() => (select.value = props.modelValue));
onUnmounted(() => (select.value = props.modelValue));
function change() {
  emit("update:modelValue", select.value);
  emit("changeSelect");
}
function scroll(IntersectionObserver) {
  console.log(213432);
}
</script>
  <style scoped>
>>> {
  --vs-selected-bg: #0095e8;
  --vs-dropdown-option--active-bg: #0095e8;
}
</style>


<template>
  <div class="mb-5" ref="scrollComponent2">
    <FromLabel :title="title" :require="require" :error="error" />
    <div class="flex relative">
      <div class="select" @click="open" v-click-out-side="close">
        <input type="text" :value="inputText" />
        <ul v-if="openState" @scroll="handleScroll" ref="scrollComponent">
          <template v-if="options.length == 0">
            <li>لا يوجد بيانات</li>
          </template>
          <template v-else>
            <li
              v-for="option in options"
              :key="option.index"
              @click="change(option.index, option.label)"
            >
              <div class="item">
                {{ option.label }}
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
import { ref } from "@vue/reactivity";
import { onMounted, onUnmounted, onUpdated, computed } from "@vue/runtime-core";
import vSelect from "vue-select";
import { clickOutSide as vClickOutSide } from "@mahdikhashan/vue3-click-outside";

const props = defineProps({
  modelValue: {},
  title: { type: String, default: "" },
  error: { type: String, default: "" },
  require: { type: Boolean, default: false },
  options: { require: true },
});
const emit = defineEmits(["update:modelValue", "changeSelect"]);

const select = ref(props.modelValue);

onMounted(() => (select.value = props.modelValue));
onUpdated(() => (select.value = props.modelValue));
onUnmounted(() => (select.value = props.modelValue));

// Select Code
const openState = ref(false);
const inputText = computed(() =>
  select.value ? props.options.find((o) => o.index === select.value).label : ""
);
function open() {
  openState.value = true;
}
function close() {
  openState.value = false;
}
function change(value, text) {
  select.value = value;
  openState.value = false;
  emit("update:modelValue", select.value);
  emit("changeSelect");
}
const scrollComponent = ref(null);
const handleScroll = (e) => {
  let element = scrollComponent.value;
  if (element.scrollTop + element.clientHeight >= element.scrollHeight - 100) {
    // console.log("element.offsetHeight");// Send an emit
    emit("loadMore");
  }
};
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
  @apply relative
            w-full
            h-48
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
            rounded-none;
}
li {
  @apply rounded-none px-2 py-3 hover:bg-[#0095e8]
                focus:bg-[#0095e8]
                active:bg-[#0095e8];
}
.item {
  @apply w-full

                
                rounded-none;
}
</style>
