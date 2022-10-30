<template>
  <AppLayout title="الأقسام">
    <SectionTemplate class="pb-0">
      <h2 class="font-bold text-xl mb-5">عدد الأقسام</h2>
      <card-primary class="mx-3">
        <h4 class="mb-3">عدد الأقسام</h4>
        <h4 class="text-xl font-bold">{{ product_category_count }}</h4>
      </card-primary>
    </SectionTemplate>
    <SectionTemplate>
      <div class="flex justify-between">
        <h2 class="font-bold">بيانات الأقسام</h2>
        <Modal v-model="form.modelToggle">
          <template #btn> أضف قسم </template>
          <template #default>
            <FormSection
              title="حفظ قسم"
              btnTitle="حفظ القسم"
              :formData="form"
              formRoute="product-category.store"
              toastMsg="تم حفظ القسم"
              :toastDescription="`تم تسجيل القسم : ${form.name}`"
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
      <InputText v-model="search" placeholder="بحث ...." />
      <div v-for="item in product_category.data" :key="item.index" class="flex justify-between items-center my-3">
        <Link
          class="pb-3 font-bold hover:text-[#009ef7]"
          :href="route('product-category.show', item.id)"
        >
          {{ item.name }}
        </Link>
        <div class="flex items-left justify-end">
          <div class="mr-2">
            <img
              class="w-6 h-6 rounded-full"
              :src="item.user.profile_photo_url"
            />
          </div>
          <Link
            :href="route('warehouse.show', item.id)"
            class="hover:text-[#009ef7]"
          >
            <h6 class="mx-2">{{ item.user.name }}</h6>
            <h6 class="mx-2">
              {{
                new Date(item.created_at).toLocaleDateString(
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
      </div>
      <Pagination
        :links="product_category.links"
        v-if="product_category.data.length"
      />
      <div v-else>لا يوجد بيانات</div>
    </SectionTemplate>
  </AppLayout>
</template>
  
  <script setup>
import {
  computed,
  onMounted,
  provide,
  readonly,
  watch,
  reactive,
  ref,
} from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import Pagination from "@/Components/Tables/Pagination.vue";
import CardPrimary from "@/Components/Cards/Statistics/CardPrimary.vue";
import Modal from "@/Components/Modals/Modal.vue";

provide("title", "أقسام المنتجات");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "أقسام المنتجات", linkRoute: "#" },
  ])
);

const props = defineProps([
  "product_category",
  "product_category_count",
  "filters",
]);

const product_category = computed(() => props.product_category);

const form = reactive({
  name: null,
  modelToggle: false,
});

const search = ref(props.filters.search);

watch(search, (value) => {
  Inertia.get(
    "/product-category",
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
</script>
  