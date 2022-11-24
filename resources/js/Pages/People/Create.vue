<template>
  <AppLayout title="الشركات">
    <FormSection
      :title="formText.title"
      :btnTitle="formText.btnTitle"
      :formData="form"
      :formRoute="form.route"
      :toastMsg="formText.formText"
      :toastDescription="form.title"
    >
      <!-- People Name -->
      <InputText
        v-model="form.name"
        title="أسم الشركه"
        :error="errors.name"
        :require="true"
      />

      <!-- People Phone -->
      <InputPhone
        v-model="form.phone"
        title="رقم الهاتف"
        :error="errors.phone"
      />
      <!-- People Description -->
      <InputTextArea v-model="form.address" title="عنوان الشركه" />
      <!-- People Logo -->
      <InputImage
        v-model="form.logo"
        title="شعار الشركه"
        :error="errors.logo"
        :oldImage="form.old_image"
      />
    </FormSection>
  </AppLayout>
</template>

<script setup>
import { provide, readonly, ref, reactive } from "@vue/runtime-core";
import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import FormSelect from "@/Forms/FormSelect.vue";
import InputPhone from "@/Forms/InputPhone.vue";
import InputTextArea from "@/Forms/InputTextArea.vue";
import InputImage from "@/Forms/InputImage.vue";

provide("title", "الشركات");

const props = defineProps(["errors", "people"]);

const form = reactive({
  id: props.people ? props.people[0].id : null,
  _method: props.people ? "patch" : "post",
  route: props.people ? "people.update" : "people.store",
  name: props.people ? props.people[0].name : null,
  phone: props.people ? props.people[0].phone : null,
  address: props.people ? props.people[0].address : null,
  logo: null,
  old_image: props.people ? props.people[0].logo : null,
});

if (props.people) {
  provide(
    "breadcrumb",
    readonly([
      { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
      {
        index: 1,
        linkTitle: "الشركات",
        linkRoute: "people.index",
      },
      {
        index: 2,
        linkTitle: "تعديل  الشركه : " + props.people[0].title,
        linkRoute: "#",
      },
    ])
  );
} else {
  provide(
    "breadcrumb",
    readonly([
      { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
      {
        index: 1,
        linkTitle: "الشركه",
        linkRoute: "#",
      },
    ])
  );
}

const formText = reactive({
  title: props.people ? "تعديل بيانات  الشركه" : "إضافه شركه ",
  btnTitle: props.people ? "تعديل الشركه" : "إضافه شركه",
  formText: props.people ? "تم تعديل الشركه" : "تم أضافه الشركه",
});
</script>
