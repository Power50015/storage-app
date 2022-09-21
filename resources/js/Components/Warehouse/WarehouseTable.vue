<template>
  <div
    class="flex content-center items-center justify-between mt-6 hover:gray-500"
  >
    <Link
      :href="route('warehouse.show', props.id)"
      class="hover:text-[#009ef7]"
    >
      <h3 class="pb-3">{{ props.name }}</h3>
      <div v-html="props.address" class="text-xs"></div>
    </Link>

    <div class="action">
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
            :toastDescription="`تم تسجيل المخزن : ${form.name}`"
          >
            <InputText v-model="form.name" title="أسم المخزن" :require="true" />
            <InputTextArea v-model="form.address" title="عنوان المخزن" />
          </FormSection>
        </template>
      </Modal>
    </div>
  </div>
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
