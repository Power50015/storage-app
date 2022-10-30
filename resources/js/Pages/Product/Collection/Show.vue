<template>
  <AppLayout title="المخازن">
    <SectionTemplate class="pb-0">
      <div class="grid grid-cols-2 gap-2">
        <div class="flex flex-col justify-between">
          <h2 class="font-bold text-xl mb-5 text-[#009ef7]">
            {{ product_collection.name }}
          </h2>
          <div class="flex my-3">
            <div class="mr-2">
              <img
                class="rounded-full"
                width="50"
                height="50"
                :src="product_collection.user.profile_photo_url"
              />
            </div>
            <Link
              :href="route('product-collection.show', product_collection.id)"
              class="hover:text-[#009ef7]"
            >
              <h6 class="mx-2">{{ product_collection.user.name }}</h6>
              <h6 class="mx-2">
                {{
                  new Date(product_collection.created_at).toLocaleDateString(
                    "ar-EG-u-nu-latn",
                    {
                      weekday: "long",
                      year: "numeric",
                      month: "short",
                      day: "numeric",
                    }
                  )
                }}
              </h6>
            </Link>
          </div>
          <Modal v-model="form.modelToggle">
            <template #btn> تعديل </template>
            <template #default>
              <FormSection
                title="تعديل "
                btnTitle="تعديل "
                :formData="form"
                formRoute="product-collection.update"
                toastMsg="تم تعديل "
                :toastDescription="`تم تعديل  : ${form.name}`"
              >
                <InputText v-model="form.name" title="أسم " :require="true" />
              </FormSection>
            </template>
          </Modal>
        </div>
        <div class="flex flex-col justify-between">
          <div class="flex my-3 items-center">
            <div class="mr-2">
              <img
                class="rounded-full"
                :src="`/storage/${product_brand[0]['logo']}`"
                width="100"
                height="100"
              />
            </div>
            <Link
              :href="route('product-brand.show', product_brand[0].id)"
              class="hover:text-[#009ef7]"
            >
              <h6 class="mx-2">{{ product_brand[0].name }} - {{ product_brand[0].product_country.name }}</h6>
            </Link>
          </div>
          <card-primary
            class="mx-3 flex items-center flex-col justify-center"
          >
            <h4 class="mb-3">عدد الموديلات</h4>
            <h4 class="text-xl font-bold">{{ product_model_count }}</h4>
          </card-primary>
        </div>
      </div>
    </SectionTemplate>
    <SectionTemplate>
      <div class="flex justify-between">
        <h2 class="font-bold">بيانات الموديلات</h2>
        <Modal v-model="form2.modelToggle">
          <template #btn> أضف موديل </template>
          <template #default>
            <FormSection
              title="أضف موديل"
              btnTitle="حفظ موديل"
              :formData="form2"
              formRoute="product-model.store"
              toastMsg="تم حفظ موديل"
              :toastDescription="`تم حفظ موديل : ${form2.name}`"
            >
              <InputText
                v-model="form2.name"
                title="أسم موديل"
                :require="true"
              />
            </FormSection>
          </template>
        </Modal>
      </div>
      <InputText v-model="search" placeholder="بحث ...." />
      <div
        v-for="item in product_model.data"
        :key="item.index"
        class="flex justify-between items-center my-3"
      >
        <Item :item="item" />
      </div>
      <Pagination
        :links="product_model.links"
        v-if="product_model.data.length"
      />
      <div v-else>لا يوجد بيانات</div>
    </SectionTemplate>
  </AppLayout>
</template>
      
      <script setup>
import { computed, provide, readonly, watch, reactive, ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import CardPrimary from "@/Components/Cards/Statistics/CardPrimary.vue";
import Modal from "@/Components/Modals/Modal.vue";
import Pagination from "@/Components/Tables/Pagination.vue";
import Item from "../Model/Item.vue";

const props = defineProps([
  "product_brand",
  "product_collection",
  "product_model_count",
  "product_model",
  "filters",
]);

const product_collection = computed(() => props.product_collection[0]);

const form = reactive({
  _method: "PATCH",
  id: props.product_collection[0].id,
  name: props.product_collection[0].name,
  modelToggle: false,
});

const form2 = reactive({
  product_collection_id: props.product_collection[0].id,
  name: null,
  modelToggle: false,
});

const search = ref(props.filters.search);

watch(search, (value) => {
  Inertia.get(
    "/product-collection/" + props.product_collection[0].id,
    {
      search: value,
    },
    {
      preserveState: true,
      replace: true,
      preserveScroll: true,
    }
  );
});

provide("title", "عائلات المنتجات");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    {
      index: 1,
      linkTitle: "عائلات المنتجات",
      linkRoute: "product-brand.index",
    },
    {
      index: 2,
      linkTitle: props.product_collection[0].name,
      linkRoute: "#",
    },
  ])
);
</script>  