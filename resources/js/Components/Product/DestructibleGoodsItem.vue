<template>
  <div class="flex flex-col items-start mb-3">
    <div class="flex flex-col">
      <BadgePrimary class="mb-3">{{ item.title }} </BadgePrimary>
      <BadgeSuccess class="mb-3"
        >المخزن : {{ item.destructible_goods.warehouse.name }}
      </BadgeSuccess>
    </div>
    <BadgeInfo>{{
      new Date(item.created_at).toLocaleDateString("ar-EG-u-nu-latn", {
        weekday: "long",
        year: "numeric",
        month: "short",
        day: "numeric",
      })
    }}</BadgeInfo>
  </div>
  <div v-html="item.description"></div>
  <div class="my-3">
    <div class="flex items-center">
      <img
        :src="item.user.profile_photo_url"
        :alt="item.user.name"
        class="w-[50px] h-[50px] rounded-full"
      />
      <h6 class="mx-2">{{ item.user.name }}</h6>
    </div>
  </div>
  <Modal v-model="form.modelToggle" customBtnAreaClass="md:w-auto w-full">
    <template #btn> <span class="mx-3">تعديل الحاله</span></template>
    <template #default>
      <FormSection
        title="حاله الهالك"
        btnTitle="تعديل"
        :formData="form"
        formRoute="destructible-goods-action.store"
        toastMsg="تم التعديل "
        @FormSuccess="FormSuccess"
      >
        <h2 class="w-full mb-5">
          المخزن : {{ item.destructible_goods.warehouse.name }}
        </h2>
        <InputText v-model="form.title" title="البند" :require="true" />
        <InputTextArea v-model="form.description" title="الوصف" />
        <FormSelect
          v-model="form.action"
          title="نوع الحاله"
          :require="true"
          :options="option"
        ></FormSelect>
        <!-- Date -->
        <InputDate
          v-model="form.date"
          title="تاريخ"
          :require="true"
        />
      </FormSection>
    </template>
  </Modal>
</template>
<script setup>
import { reactive, ref } from "@vue/reactivity";

import BadgePrimary from "../Badges/BadgePrimary.vue";
import BadgeInfo from "../Badges/BadgeInfo.vue";
import BadgeSuccess from "../Badges/BadgeSuccess.vue";
import Modal from "@/Components/Modals/Modal.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import InputTextArea from "@/Forms/InputTextArea.vue";
import InputDate from "@/Forms/InputDate.vue";
import FormSelect from "@/Forms/FormSelect.vue";
const props = defineProps(["item"]);
const emit = defineEmits(["FormSuccess"]);
const form = reactive({
  modelToggle: false,
  title: null,
  action: 2,
  description: "",
  date: new Date().toISOString().slice(0, 10),
  destructible_goods_id: props.item.destructible_goods_id,
});

const option = [
  { label: "إعدام", index: 1 },
  { label: "إصلاح", index: 2 },
];

function FormSuccess() {
  emit("FormSuccess");
}
</script>