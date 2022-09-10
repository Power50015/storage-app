<template>
  <div class="mb-5">
    <FromLabel :title="title" :require="require" :error="error" />
    <v-select
      :clearable="false"
      :options="options"
      v-model="select"
      :reduce="(item) => item.index"
      @option:selected="$emit('update:modelValue', select)"
      @option:deselected="$emit('update:modelValue', null)"
      dir="rtl"
      class="
        w-full
        mt-3
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
      "
    >
      <template v-slot:no-options="{ search, searching }">
        <template v-if="searching">
          لا يوجد نتائج ل<em>{{ search }}</em
          >.
        </template>
      </template>
    </v-select>
  </div>
</template>
  <script setup>
import FromLabel from "@/Forms/FromLabel.vue";
import { ref } from "@vue/reactivity";
import vSelect from "vue-select";

const props = defineProps({
  modelValue: {},
  title: { type: String, default: "" },
  error: { type: String, default: "" },
  require: { type: Boolean, default: false },
  options: { require: true },
});
defineEmits(["update:modelValue"]);

const select = ref(props.modelValue);
</script>
<style scoped>
</style>