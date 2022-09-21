<template>
  <!--Invoice Attach-->
  <div
    class="mb-3 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3 rounded-lg"
  >
    <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">الصور</h2>
    <div v-for="(i, index) in form.images" :key="index">
      <div class="flex flex-col">
        <InputImage
          v-model="form.images[index].image"
          :title="`الصوره : ${1 + index}`"
          :error="error[index]"
          :require="true"
          @change="imageBinding"
        />
        <!-- Delete -->
        <BtnDanger
          @click="
            form.images = form.images.filter(
              (item) => item.id != form.images[index].id
            )
          "
          ><i class="fa-solid fa-xmark"></i
        ></BtnDanger>
      </div>

      <hr v-if="form.images.length > 1 && form.images.length != index" />
    </div>

    <!--New Item-->
    <BtnSuccess @click="pushToImage"> أضف صوره</BtnSuccess>
  </div>
</template>
    
  <script setup>
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
import { reactive } from "@vue/reactivity";
import { computed } from "@vue/runtime-core";
import BtnDanger from "@/Components/Buttons/BtnDanger.vue";
import InputImage from "./InputImage.vue";
defineProps({
  modelValue: {},
  title: { type: String, default: "" },
  error: { type: String, default: "" },
  require: { type: Boolean, default: false },
});
const emit = defineEmits(["update:modelValue"]);

const form = reactive({
  images: [],
});
function pushToImage() {
  form.images.push({
    id: form.images.length + 1,
    image: null,
  });
}

function imageBinding() {
  emit("update:modelValue",  form.images);
}

function test(x) {
  images.splice(
    attachment.findIndex(function (i) {
      console.log("i.id" + i.id);
      console.log("x" + x);
      if (i.id === x) return i.id === x;
    }),
    1
  );
}
</script>