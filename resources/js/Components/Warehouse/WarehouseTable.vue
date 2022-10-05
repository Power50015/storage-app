<template>
  <Modal v-model="form.modelToggle">
    <template #btn
      ><i class="fa-solid fa-pen-to-square"></i>
      <span class="mx-3">تعديل</span></template
    >
    <template #default>
      <FormSection
        title="تعديل بيانات المخزن"
        btnTitle="تعديل المخزن"
        :formData="form"
        formRoute="warehouse.update"
        toastMsg="تم تعديل المخزن"
        :toastDescription="`تم تعديل المخزن : ${form.name}`"
      >
        <InputText v-model="form.name" title="أسم المخزن" :require="true" />
        <InputTextArea v-model="form.address" title="عنوان المخزن" />
      </FormSection>
    </template>
  </Modal>
</template>

<script setup >
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { reactive } from "@vue/runtime-core";
import Modal from "@/Components/Modals/Modal.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import InputTextArea from "@/Forms/InputTextArea.vue";
const props = defineProps({
  id: {
    required: true,
  },
  name: {
    required: true,
    type: String,
  },
  address: {
    default: null,
    type: String,
  },
});

const form = reactive({
  _method: "PATCH",
  id: props.id,
  name: props.name,
  address: props.address,
  modelToggle: false,
});
</script>
