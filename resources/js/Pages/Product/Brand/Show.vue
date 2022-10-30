<template>
  <AppLayout title="الماركه">
    <SectionTemplate class="pb-0">
      <h2 class="font-bold text-xl mb-5">بيانات الماركه</h2>
      <div class="grid grid-cols-2 gap-2">
        <div class="my-3">
          <div class="flex my-3 items-center">
            <div class="mr-2">
              <img
                class="rounded-full"
                :src="`/storage/${product_brand['logo']}`"
                width="100"
                height="100"
              />
            </div>
            <Link
              :href="route('product-brand.show', product_brand.id)"
              class="hover:text-[#009ef7]"
            >
              <h6 class="mx-2">{{ product_brand.name }} - {{ product_brand.product_country.name }}</h6>
            </Link>
          </div>
          <div class="flex my-3">
            <div class="mr-2">
              <img
                class="rounded-full"
                width="50"
                height="50"
                :src="product_brand.user.profile_photo_url"
              />
            </div>
            <Link
              :href="route('product-brand.show', product_brand.id)"
              class="hover:text-[#009ef7]"
            >
              <h6 class="mx-2">{{ product_brand.user.name }}</h6>
              <h6 class="mx-2">
                {{
                  new Date(product_brand.created_at).toLocaleDateString(
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
                title="حفظ الماركه"
                btnTitle="حفظ الماركه"
                :formData="form"
                formRoute="product-brand.update"
                toastMsg="تم حفظ الماركه"
                :toastDescription="`تم تسجيل الماركه : ${form.name}`"
              >
                <FormSelect
                  v-model="form.product_country_id"
                  title="بلد الماركه"
                  :require="true"
                  :options="country"
                />
                <br />
                <InputText
                  v-model="form.name"
                  title="أسم الماركه"
                  :require="true"
                />
                <br /><br />
                <InputImage
                  v-model="form.image"
                  :oldImage="form.old_image"
                  title="شعار الماركه"
                />
                <br /><br />
              </FormSection>
            </template>
          </Modal>
        </div>
        <div class="">
          <card-primary
            class="mx-3 mb-3 h-full flex items-center flex-col justify-center"
          >
            <h4 class="mb-3">عدد عائلات المنتج</h4>
            <h4 class="text-xl font-bold">{{ product_collections_count }}</h4>
          </card-primary>
        </div>
      </div>
    </SectionTemplate>
    <SectionTemplate>
      <div class="flex justify-between">
        <h2 class="font-bold">بيانات عائلات المنتج</h2>
      </div>
      <InputText v-model="search" placeholder="بحث ...." />
      <div
        v-for="item in product_collections.data"
        :key="item.index"
        class="flex justify-between items-center my-3"
      >
        <Link
          :href="route('product-collection.show', item.id)"
          class="flex items-left justify-end items-center hover:text-[#009ef7]"
        >
          <div>
            <h6 class="mx-2">{{ item.name }}</h6>
          </div>
        </Link>

        <div class="flex items-left justify-end">
          <div class="mr-2">
            <img
              class="w-6 h-6 rounded-full"
              :src="item.user.profile_photo_url"
            />
          </div>
          <Link
            :href="route('product-brand.show', item.id)"
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
        :links="product_collections.links"
        v-if="product_collections.data.length"
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
import InputImage from "@/Forms/InputImage.vue";
import FormSelect from "@/Forms/FormSelect.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import CardPrimary from "@/Components/Cards/Statistics/CardPrimary.vue";
import Modal from "@/Components/Modals/Modal.vue";
import Pagination from "@/Components/Tables/Pagination.vue";
import Item from "../Type/Item.vue";

const props = defineProps([
  "product_brand",
  "product_collections_count",
  "product_collections",
  "filters"
  ,"ProductCountry"
]);

const product_brand = computed(() => props.product_brand[0]);
const country = computed(() => {
  return props.ProductCountry.map((item) => {
    return { label: item.name, index: item.id };
  });
});
const form = reactive({
  _method: "PATCH",
  id: props.product_brand[0].id,
  name: props.product_brand[0].name,
  modelToggle: false,
  product_country_id: props.product_brand[0].product_country_id,
  image: null,
  old_image: props.product_brand[0].logo,
});

const search = ref(props.filters.search);

watch(search, (value) => {
  Inertia.get(
    "/product-brand/" + props.product_brand[0].id,
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

provide("title", "ماركه المنتجات");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    {
      index: 1,
      linkTitle: "ماركات المنتجات",
      linkRoute: "product-brand.index",
    },
    {
      index: 2,
      linkTitle: " الماركه " + props.product_brand[0].name,
      linkRoute: "#",
    },
  ])
);
</script>
      