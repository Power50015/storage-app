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
      <Modal>
        <FormSection
          title="تعديل بيانات المخزن"
          btnTitle="تعديل المخزن"
          :formData="form"
          formRoute="warehouse.update"
          toastMsg="تم تعديل المخزن"
          :toastDescription="`تم تعديل المخزن : `"
        >
          <InputText v-model="form.name" title="أسم المخزن" :require="true" />
          <InputTextArea v-model="form.address" title="عنوان المخزن" />
        </FormSection>
      </Modal>
    </div>
  </div>
</template>

<script setup >
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { reactive } from "@vue/runtime-core";
import Modal from "@/Components/Modal.vue";
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
});
</script>
