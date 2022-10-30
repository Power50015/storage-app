<template>
    <custom-model v-model="form.modelToggle">
      <template #btn>
        <div class="pb-3 font-bold hover:text-[#009ef7]">
          {{ item.name }}
        </div>
      </template>
      <template #default>
        <FormSection
          title="تعديل النوع"
          btnTitle="تعديل النوع"
          :formData="form"
          formRoute="product-model.update"
          toastMsg="تم تعديل النوع"
          :toastDescription="`تم تعديل النوع : ${form.name}`"
        >
          <InputText v-model="form.name" title="أسم النوع" :require="true" />
        </FormSection>
      </template>
    </custom-model>
    <div class="flex items-left justify-end">
      <div class="mr-2">
        <img class="w-6 h-6 rounded-full" :src="item.user.profile_photo_url" />
      </div>
      <Link :href="route('warehouse.show', item.id)" class="hover:text-[#009ef7]">
        <h6 class="mx-2">{{ item.user.name }}</h6>
        <h6 class="mx-2">
          {{
            new Date(item.created_at).toLocaleDateString("ar-EG-u-nu-latn", {
              weekday: "long",
              year: "numeric",
              month: "short",
              day: "numeric",
            })
          }}
        </h6>
      </Link>
    </div>
  </template>
  <script setup>
  import CustomModel from "@/Components/Modals/CustomModel.vue";
  import { Link } from "@inertiajs/inertia-vue3";
  import { reactive } from "@vue/reactivity";
  import FormSection from "@/Forms/FormSection.vue";
  import InputText from "@/Forms/InputText.vue";
  
  
  const props = defineProps(["item"]);
  
  const form = reactive({
    _method: "PATCH",
    id: props.item.id,
    product_collection_id: props.item.product_collection_id,
    name: props.item.name,
    modelToggle: false,
  });
  </script>