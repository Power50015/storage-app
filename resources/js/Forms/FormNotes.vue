<template>
  <!--Invoice Note-->
  <div
    class="mb-3 dark:bg-[#fefefe0d] dark:border-0 border py-7 px-3 rounded-lg"
  >
    <h2 class="px-3 dark:text-gray-300 title font-bold mb-4">الملاحظات</h2>
    <div v-for="(i, index) in form.note" :key="index">
      <div class="flex flex-col">
        <InputTextArea
          v-model="form.note[index].note"
          :title="`الملاحظه : ${1 + index}`"
          :error="error[index]"
          :require="true"
          @input="noteBinding"
        />
        <!-- Delete -->
        <BtnDanger @click="remove(index)"
          ><i class="fa-solid fa-xmark"></i
        ></BtnDanger>
      </div>

      <hr v-if="form.note.length > 1 && form.note.length != index" />
    </div>

    <!--New Item-->
    <BtnSuccess @click="pushToNote"> أضف ملاحظه</BtnSuccess>
  </div>
</template>
    
  <script setup>
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
import { reactive } from "@vue/reactivity";
import { computed, onMounted, onUnmounted, onUpdated } from "@vue/runtime-core";
import BtnDanger from "@/Components/Buttons/BtnDanger.vue";
import InputTextArea from "./InputTextArea.vue";
const props = defineProps({
  modelValue: {},
  title: { type: String, default: "" },
  error: { type: String, default: "" },
  require: { type: Boolean, default: false },
});
const emit = defineEmits(["update:modelValue"]);

const form = reactive({
  note: [],
});

onMounted(() => (form.note = props.modelValue));
onUpdated(() => (form.note = props.modelValue));
onUnmounted(() => (form.note = props.modelValue));

function pushToNote() {
  form.note[Number(Object.keys(form.note).length)] = {
    note: null,
  };
}

function noteBinding() {
  emit("update:modelValue", form.note);
}

function remove(x) {
  delete form.note[x];
  const array = form.note;
  form.note = {};
  for (let index = 0; index < Object.keys(array).length; index++) {
    form.note[index] = array;
  }
}
</script>