<template>
  <AppLayout title="المخازن">
    <SectionTemplate class="pb-0">
      <h2 class="font-bold text-xl mb-5">بيانات القسم</h2>
      <div class="grid grid-cols-2 gap-2">
        <div class="">
          <h2 class="font-bold text-xl mb-5 text-[#009ef7]">
            {{ product_category.name }}
          </h2>
          <div class="flex my-3">
            <div class="mr-2">
              <img
                class="rounded-full"
                width="50"
                height="50"
                :src="product_category.user.profile_photo_url"
              />
            </div>
            <Link
              :href="route('product-category.show', product_category.id)"
              class="hover:text-[#009ef7]"
            >
              <h6 class="mx-2">{{ product_category.user.name }}</h6>
              <h6 class="mx-2">
                {{
                  new Date(product_category.created_at).toLocaleDateString(
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
            <template #btn> تعديل القسم </template>
            <template #default>
              <FormSection
                title="تعديل قسم"
                btnTitle="تعديل القسم"
                :formData="form"
                formRoute="product-category.update"
                toastMsg="تم تعديل القسم"
                :toastDescription="`تم تعديل القسم : ${form.name}`"
              >
                <InputText
                  v-model="form.name"
                  title="أسم القسم"
                  :require="true"
                />
              </FormSection>
            </template>
          </Modal>
        </div>
        <div class="">
          <card-primary
            class="mx-3 mb-3 h-full flex items-center flex-col justify-center"
          >
            <h4 class="mb-3">عدد الأنواع</h4>
            <h4 class="text-xl font-bold">{{ product_type_count }}</h4>
          </card-primary>
        </div>
      </div>
    </SectionTemplate>
    <SectionTemplate>
      <div class="flex justify-between">
        <h2 class="font-bold">بيانات الأنواع</h2>
        <Modal v-model="form2.modelToggle">
          <template #btn> أضف نوع  </template>
          <template #default>
            <FormSection
              title="أضف النوع"
              btnTitle="حفظ النوع"
              :formData="form2"
              formRoute="product-type.store"
              toastMsg="تم حفظ النوع"
              :toastDescription="`تم حفظ النوع : ${form2.name}`"
            >
              <InputText
                v-model="form2.name"
                title="أسم النوع"
                :require="true"
              />
            </FormSection>
          </template>
        </Modal>
      </div>
      <InputText v-model="search" placeholder="بحث ...." />
      <div
        v-for="item in product_type.data"
        :key="item.index"
        class="flex justify-between items-center my-3"
      >
        <Item :item="item" />
      </div>
      <Pagination :links="product_type.links" v-if="product_type.data.length" />
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
import Item from "../Type/Item.vue";

const props = defineProps([
  "product_category",
  "product_type",
  "product_type_count",
  "filters",
]);

const product_category = computed(() => props.product_category[0]);

const form = reactive({
  _method: "PATCH",
  id: props.product_category[0].id,
  name: props.product_category[0].name,
  modelToggle: false,
});

const form2 = reactive({
  'product_category_id': props.product_category[0].id,
  name: null,
  modelToggle: false,
});

const search = ref(props.filters.search);

watch(search, (value) => {
  Inertia.get(
    "/product-category/" + props.product_category[0].id,
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

provide("title", "أقسام المنتجات");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    {
      index: 1,
      linkTitle: "أقسام المنتجات",
      linkRoute: "product-category.index",
    },
    {
      index: 2,
      linkTitle: " القسم " + props.product_category[0].name,
      linkRoute: "#",
    },
  ])
);
</script>
    