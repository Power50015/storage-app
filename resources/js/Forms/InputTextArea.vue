<template>
  <div class="mb-5">
    <FromLabel :title="title" :require="require" :error="error" />
    <div
      class="
        w-full
        text-base
        dark:bg-[#1b1b29]
        bg-[#f5f8fa]
        dark:active:bg-[#1b1b29]
        active:bg-[#f5f8fa]
        dark:focus:bg-[#1b1b29]
        focus:bg-[#f5f8fa]
        mt-3
        focus:ring-0
        border-0
        shadow-sm
        py-2
        min-h-[100px]
      "
    >
      <QuillEditor
        theme="snow"
        toolbar="minimal"
        contentType="html"
        v-model:content="textArea"
        @update:content="$emit('update:modelValue', textArea)"
      />
    </div>
  </div>
</template>

<script setup>
import { QuillEditor } from "@vueup/vue-quill";
import FromLabel from "@/Forms/FromLabel.vue";
import { ref } from "@vue/reactivity";
import { computed } from "@vue/runtime-core";

const props = defineProps({
  modelValue: { default: "" },
  title: { type: String, default: "" },
  error: { type: String, default: "" },
  require: { default: false },
});
defineEmits(["update:modelValue"]);

const textArea = ref(props.modelValue);

// const textArea = computed(() => props.modelValue);
</script>
  