<template>
  <div class="flex justify-between items-center md:flex-row flex-col">
    <Link
      :href="route('warehouse.show', item.warehouse.id)"
      class="
        w-full
        cursor-pointer
        hover:text-[#0095e8]
        font-bold
        transition-all
        my-2
        py-4
        px-2
        text-right
        flex
        md:flex-row flex-col
      "
    >
      <h2 class="w-full">المخزن : {{ item.warehouse.name }}</h2>
      <h2 class="w-full">الكميه : {{ item.quantity }}</h2>
    </Link>
    <Modal v-model="form.modelToggle" customBtnAreaClass="md:w-auto w-full">
      <template #btn> <span class="mx-3">أستعمال</span></template>
      <template #default>
        <FormSection
          title="تعديل بند الأستعمال"
          btnTitle="تعديل"
          :formData="form"
          formRoute="kit-operation.store"
          toastMsg="تم التعديل "
          @FormSuccess="FormSuccess"
        >
          <h2 class="w-full mb-5">المخزن : {{ item.warehouse.name }}</h2>
          <InputText v-model="form.title" title="البند" :require="true" />

          <InputNumber
            v-model="form.quantity"
            title="الكميه"
            step="1"
            :max="item.quantity"
          />
          <FormSelect
            v-model="form.action"
            title="نوع الإستعمال"
            :require="true"
            :options="option"
          ></FormSelect>
          <!-- Date -->
          <InputDate
            v-model="form.date"
            title="تاريخ الإستعمال"
            :require="true"
          />
        </FormSection>
      </template>
    </Modal>
  </div>
</template>
<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import Modal from "@/Components/Modals/Modal.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import InputNumber from "@/Forms/InputNumber.vue";
import FormSelect from "@/Forms/FormSelect.vue";
import InputDate from "@/Forms/InputDate.vue";
import { reactive } from "@vue/reactivity";

const props = defineProps(["item", "id"]);
const emit = defineEmits(["FormSuccess"]);
const form = reactive({
  modelToggle: false,
  title: null,
  action: 0,
  quantity: props.item.quantity,
  kit_id: props.id,
  warehouse_id: props.item.warehouse.id,
  date: new Date().toISOString().slice(0, 10),
});

const option = [
  { label: "إعدام", index: 0 },
  { label: "إستعمال", index: 1 },
];

function FormSuccess() {
  emit("FormSuccess");
}
</script>