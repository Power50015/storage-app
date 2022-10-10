<template>
  <Modal v-model="form.modelToggle">
    <template #btn
      ><i class="fa-solid fa-pen-to-square"></i>
      <span class="mx-3">تعديل</span></template
    >
    <template #default>
      <FormSection
        title="تعديل بيانات الكاش"
        btnTitle="تعديل الكاش"
        :formData="form"
        formRoute="cash.update"
        toastMsg="تم تعديل الكاش"
        :toastDescription="`تم تعديل بيانات الكاش : ${form.title}`"
      >
        <InputText v-model="form.title" title="الأسم" :require="true" />
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
const props = defineProps({
  id: {
    required: true,
  },
  title: {
    required: true,
    type: String,
  },
});

const form = reactive({
  _method: "PATCH",
  id: props.id,
  title: props.title,
  modelToggle: false,
});
</script>
