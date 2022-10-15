<template>
  <AppLayout title="قطع غيار">
    <FormSection
      :title="formText.title"
      :btnTitle="formText.btnTitle"
      :formData="form"
      :formRoute="form.route"
      :toastMsg="formText.toastMsg"
      :toastDescription="form.title"
    >
      <!-- Kit Title -->
      <InputText
        v-model="form.title"
        title="أسم قطعه غيار"
        :error="errors.title"
        :require="true"
      />
      <!-- Kit Product -->
      <SelectProduct v-model="form.product_id" title=" المنتج" />
      <!-- Kit Description-->
      <InputTextArea v-model="form.description" title="تفاصيل قطعه الغيار" />
      <!-- Kit Images-->
      <InputImage
        v-model="form.image"
        :oldImage="form.old_image"
        title="صوره القطعه"
        :error="errors.image"
      />
    </FormSection>
  </AppLayout>
</template>

<script setup>
import { reactive } from "vue";
import { computed, provide, readonly, ref } from "@vue/runtime-core";
import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Forms/FormSection.vue";
import FormSelect from "@/Forms/FormSelect.vue";
import InputText from "@/Forms/InputText.vue";
import InputTextArea from "@/Forms/InputTextArea.vue";
import InputImage from "@/Forms/InputImage.vue";
import SelectProduct from "@/Forms/SelectProduct.vue";

provide("title", "قطع غيار");

const props = defineProps(["errors", "kit"]);

if (props.kit) {
  provide(
    "breadcrumb",
    readonly([
      { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
      {
        index: 1,
        linkTitle: "قطع غيار",
        linkRoute: "kit.index",
      },
      { index: 2, linkTitle: "تعديل قطع غيار : " + props.kit[0].title, linkRoute: "#" },
    ])
  );
} else {
  provide(
    "breadcrumb",
    readonly([
      { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
      {
        index: 1,
        linkTitle: "قطع غيار",
        linkRoute: "#",
      },
    ])
  );
}

const form = reactive({
  id: props.kit ? props.kit[0].id : null,
  _method: props.kit ? "patch" : "post",
  route: props.kit ? "kit.update" : "kit.store",
  title: props.kit ? props.kit[0].title : null,
  product_id:
    props.kit && props.kit[0].product ? props.kit[0].product.id : null,
  description: props.kit ? props.kit[0].description : null,
  image: null,
  old_image: props.kit ? props.kit[0].image : null,
});

const formText = reactive({
  title: props.kit ? "تعديل بيانات قطع غيار" : "إضافه قطع غيار",
  btnTitle: props.kit ? "تعديل البيانات" : "إضافه قطع غيار",
  formText: props.kit ? "تم تعديل قطعه الغيار" : "تم أضافه قطعه الغيار",
});
</script>