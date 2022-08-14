<template>
  <div class="model" v-if="showModel">
    <div class="model-overlay" @click="showModel = false"></div>
    <div class="model-content mx-auto sm:px-6 lg:px-8 z-10 md:w-[750px] w-full">
      <div
        class="
          dark:bg-[#1e1e2d]
          bg-white
          dark:text-white
          text-black
          overflow-hidden
          shadow-xl
          rounded-md
          p-4
        "
      >
        <h2 class="title font-bold mb-4">إضافه ملاحظه</h2>
        <div class="mb-5">
          <label class="px-3 dark:text-gray-300">وصف المنتج</label>
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
              rounded-r-md
            "
            dir="ltr"
          >
            <QuillEditor
              theme="snow"
              toolbar="minimal"
              v-model:content="form.note"
              contentType="html"
            />
          </div>
        </div>
        <div
          @click="addNote"
          class="
            mt-6
            w-full
            bg-[#009ef7]
            border border-transparent
            rounded-md
            py-3
            px-8
            flex
            items-center
            justify-center
            text-base
            font-medium
            text-white
            hover:bg-[#009ef7]
            focus:outline-none
            focus:ring-2
            focus:ring-offset-2
            focus:ring-[#009ef7]
            cursor-pointer
          "
        >
          حفظ الملاحظه
        </div>
      </div>
    </div>
  </div>
</template><script setup>
import { reactive, ref } from "vue";
import {
  computed,
  onMounted,
  onUnmounted,
  provide,
  readonly,
} from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { QuillEditor } from "@vueup/vue-quill";

const showModel = ref(false);
const form = reactive({
  note: null,
});
const closeOnEscape = (e) => {
  if (showModel.value && e.key === "Escape") {
    showModel.value = false;
  }
};

onMounted(() => document.addEventListener("keydown", closeOnEscape));
onUnmounted(() => document.removeEventListener("keydown", closeOnEscape));
function addNote() {}
</script>
<style scoped>
.model {
  width: 100%;
  height: 100%;
  min-height: 100vh;
  position: fixed;
  right: 0px;
  z-index: 82;
  display: flex;
  align-items: center;
  justify-content: center;
  align-content: center;
  top: 0;
}

.model-overlay {
  width: 100%;
  height: 100%;
  position: absolute;
  background: #eeeeee26;
  z-index: 1;
}
</style>