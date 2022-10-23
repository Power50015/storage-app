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
        md:flex-row
        flex-col
      "
    >
      <h2 class="w-full">المخزن : {{ item.warehouse.name }}</h2>
      <h2 class="w-full">الكميه دون الهالك : {{ item.quantity }}</h2>
      <h2 class="w-full">كميه الهالك : {{ item.destructibleGoods }}</h2>
    </Link>
    <CustomModel
      v-model="form.modelToggle"
      customBtnAreaClass="md:w-1/3 w-full"
    >
      <template #btn>
        <btn-danger>أضف وحده للهالك</btn-danger>
      </template>
      <template #default>
        <FormSection
          title=" بند اهلاك"
          btnTitle="اهلاك"
          :formData="form"
          formRoute="destructible-goods.store"
          toastMsg="تم الاهلاك "
          @FormSuccess="FormSuccess"
        >
          <h2 class="w-full mb-5">المخزن : {{ item.warehouse.name }}</h2>
          <h2 class="w-full mb-5">الكميه : 1</h2>
          <InputText v-model="form.title" title="البند" :require="true" />
          <InputTextArea v-model="form.description" title="الوصف" />
          <!-- Date -->
          <InputDate
            v-model="form.date"
            title="تاريخ الإهلاك"
            :require="true"
          />
        </FormSection>
      </template>
    </CustomModel>
  </div>
</template>
  <script setup>
import { Link } from "@inertiajs/inertia-vue3";
import CustomModel from "@/Components/Modals/CustomModel.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import InputTextArea from "@/Forms/InputTextArea.vue";
import InputDate from "@/Forms/InputDate.vue";
import { reactive } from "@vue/reactivity";
import BtnDanger from "@/Components/Buttons/BtnDanger.vue";

const props = defineProps(["item", "id"]);
const emit = defineEmits(["FormSuccess"]);
const form = reactive({
  modelToggle: false,
  title: null,
  quantity: props.item.quantity,
  product_id: props.id,
  warehouse_id: props.item.warehouse.id,
  date: new Date().toISOString().slice(0, 10),
  description: null,
});

function FormSuccess() {
  emit("FormSuccess");
}
</script>