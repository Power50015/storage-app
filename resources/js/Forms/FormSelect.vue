<template>
  <div class="mb-5 w-full">
    <FromLabel :title="title" :require="require" :error="error" v-if="title" />
    <div class="flex w-full">
      <v-select
        :clearable="false"
        :options="optionSelected"
        :closeOnSelect="true"
        v-model="select"
        :reduce="(item) => item.index"
        @option:selected="change"
        @option:deselected="$emit('update:modelValue', null)"
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
            <h6 class="text-black dark:text-white">{{ option["label"] }}</h6>
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
import { computed, onMounted, onUnmounted, onUpdated } from "@vue/runtime-core";
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

const optionSelected = computed(() => {
  return [{ label: "", index: null }, ...props.options];
});

onMounted(() => (select.value = props.modelValue));
onUpdated(() => (select.value = props.modelValue));
onUnmounted(() => (select.value = props.modelValue));
function change() {
  emit("update:modelValue", select.value);
  emit("changeSelect");
}

</script>
<style scoped>
>>> {
  --vs-selected-bg: #0095e8;
  --vs-dropdown-option--active-bg: #0095e8;
}
</style>