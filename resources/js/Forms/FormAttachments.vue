<template>
  <!--Invoice Attach-->
  <div
    class="mb-3 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3 rounded-lg"
  >
    <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">الملفات</h2>
    <div v-for="(i, index) in attachment" :key="index">
      <div class="flex flex-col">
        <InputFile
          v-model="attachment[index].attachment"
          :title="`الملف : ${1 + index}`"
          :error="error[index]"
          :require="true"
          @change="attachmentBinding"
        />
        <!-- Delete -->
        <BtnDanger @click="test(attachment[index].id)"
          ><i class="fa-solid fa-xmark"></i
        ></BtnDanger>
      </div>

      <hr v-if="attachment.length > 1 && attachment.length != index" />
    </div>

    <!--New Item-->
    <BtnSuccess @click="pushToAttachment"> أضف ملف</BtnSuccess>
  </div>
</template>
  
<script setup>
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
import { reactive } from "@vue/reactivity";
import { computed } from "@vue/runtime-core";
import BtnDanger from "@/Components/Buttons/BtnDanger.vue";
import InputFile from "./InputFile.vue";
defineProps({
  modelValue: {},
  title: { type: String, default: "" },
  error: { type: String, default: "" },
  require: { type: Boolean, default: false },
});
const emit = defineEmits(["update:modelValue"]);

const attachment = reactive([]);

function pushToAttachment() {
  attachment.push({
    id: attachment.length + 1,
    attachment: null,
  });
}

function attachmentBinding() {
  emit("update:modelValue", attachment);
}

function test(x) {
  attachment.splice(
    attachment.findIndex(function (i) {
      console.log("i.id" + i.id);
      console.log("x" + x);
      if (i.id === x) return i.id === x;
    }),
    1
  );
}
</script>