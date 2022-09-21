<template>
  <div class="mb-5">
    <FromLabel :title="title" :require="require" :error="error" />
    <template v-if="imgPreview">
      <img :src="imgPreview" class="img-fluid" height="300" width="300" />
      <p class="mb-0">أسم الملف: {{ imgData.value.name }}</p>
      <p class="mb-0">
        حجم الملف: {{ Math.round(imgData.value.size / 1024) }}KB
      </p>
    </template>
    <input
      class="
        block
        w-full
        text-sm text-gray-900
        rounded-lg
        border border-gray-300
        dark:text-gray-400
        focus:outline-none
        dark:bg-[#1b1b29]
        bg-[#f5f8fa]
        dark:border-gray-600 dark:placeholder-gray-400
        cursor-pointer
      "
      type="file"
      @change="DetectFiles($event.target.files)"
    />
  </div>
</template>
    <script setup>
import FromLabel from "@/Forms/FromLabel.vue";
import { reactive, ref } from "@vue/reactivity";
defineProps({
  modelValue: {},
  title: { type: String, default: "" },
  error: { type: String, default: "" },
  require: { type: Boolean, default: false },
});
const emit = defineEmits(["update:modelValue"]);

const imgData = reactive([]);
const imgPreview = ref();

function DetectFiles(input) {
  imgData.value = input[0];
  imgPreview.value = input[0];
  if (input) {
    var reader = new FileReader();
    reader.onload = (e) => {
      imgPreview.value = e.target.result;
      emit("update:modelValue", imgData.value);
    };
    reader.readAsDataURL(input[0]);
  }
}
</script>
    