<template>
  <div class="mb-5">
    <FromLabel :title="title" :require="require" :error="error" />
    <Datepicker
      textInput
      :textInputOptions="textInputOptions"
      :previewFormat="format"
      :format="format"
      :dayNames="dayNames"
      :enableTimePicker="false"
      :monthChangeOnArrows="false"
      arrowNavigation
      inputClassName="dp-custom-input"
      menuClassName="dp-custom-menu"
      calendarClassName="dp-custom-calendar"
      calendarCellClassName="dp-custom-cell"
      selectText="أختار"
      cancelText="إغلاق"
      :modelValue="date"
      @update:modelValue="handleDate"
    />
  </div>
</template>
<script setup>
import { ref } from "@vue/reactivity";
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
import FromLabel from "@/Forms/FromLabel.vue";
import BtnInfo from "@/Components/Buttons/BtnInfo.vue";

const props = defineProps({
  modelValue: { default: new Date().toISOString().slice(0, 10) },
  title: { type: String, default: "" },
  error: { type: String, default: "" },
  require: { type: Boolean, default: false },
});
const emit = defineEmits(["update:modelValue"]);
const date = ref(props.modelValue);

const textInputOptions = ref({
  format: "dd.MM.yyyy",
});

const format = (date) => {
  const day = date.getDate();
  const month = date.getMonth() + 1;
  const year = date.getFullYear();

  return `${day}/${month}/${year}`;
};

const dayNames = [
  "الإثنين",
  "الثلاثاء",
  "الأربعاء",
  "الخميس",
  "الجمعه",
  "السبت",
  "الأحد",
];

const handleDate = (modelData) => {
  date.value = modelData;
  emit("update:modelValue", date.value);
};
</script>
<style>
.dp-custom-input {
  @apply w-full
        mt-3
        text-base focus:ring-0
        border-0
        shadow-sm
        rounded-md
        py-2 flex;
}
.dp-custom-input,
.dp__overlay,
.dp__overlay_action,
.dp-custom-menu,
.dp-custom-calendar,
.dp-custom-cell,
.dp__calendar_header_item,
.dp__month_year_select,
.dp__action_row {
  @apply dark:bg-[#1b1b29]
        bg-[#f5f8fa]
        dark:active:bg-[#1b1b29]
        active:bg-[#f5f8fa]
        dark:focus:bg-[#1b1b29]
        focus:bg-[#f5f8fa] focus:ring-0
        dark:text-gray-300 text-black border-0 outline-0;
  direction: ltr;
}
.dp__cell_offset {
  @apply dark:bg-[#11111a]
        bg-[#f7fcff]
        dark:active:bg-[#11111a]
        active:bg-[#f7fcff]
        dark:focus:bg-[#11111a]
        focus:bg-[#f7fcff] focus:ring-0
        dark:text-gray-200 text-gray-500;
}
.dp__active_date {
  @apply bg-[#009ef7] dark:bg-[#009ef7]
        dark:text-white text-white border-0;
}
.dp__calendar_header_item {
  width: auto !important;
  direction: ltr;
}
.dp-custom-cell {
  width: 50px;
  margin: auto 2px;
  direction: ltr;
}

.dp__selection_preview {
  @apply dark:text-white;
}
.dp__today {
  @apply border border-[#009ef7];
}
.dp__action_buttons {
  display: flex;
  flex-direction: column-reverse;
  align-items: flex-end;
}
.dp__select {
  @apply text-white bg-[#50cd89] hover:bg-[#47be7d] focus:bg-[#47be7d] border border-transparent rounded-md
    py-3 px-8 items-center justify-center text-base
    font-medium focus:outline-none focus:ring-0 focus:ring-offset-0 cursor-pointer w-full;
}
.dp__cancel {
  @apply text-white bg-[#f1416c] hover:bg-[#f1416c] focus:bg-[#f1416c] border border-transparent rounded-md
    py-3 px-8 items-center justify-center text-base
    font-medium focus:outline-none focus:ring-0 focus:ring-offset-0 cursor-pointer my-3 w-full;
}
</style>
    