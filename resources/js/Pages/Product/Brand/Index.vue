<template>
  <AppLayout title="الأقسام">
    <SectionTemplate class="pb-0">
      <h2 class="font-bold text-xl mb-5">عدد الماركات</h2>
      <card-primary class="mx-3">
        <h4 class="mb-3">عدد الماركات</h4>
        <h4 class="text-xl font-bold">{{ product_brand_count }}</h4>
      </card-primary>
    </SectionTemplate>
    <SectionTemplate>
      <div class="flex justify-between">
        <h2 class="font-bold">بيانات الماركات</h2>
        <Modal v-model="form.modelToggle">
          <template #btn> أضف ماركه </template>
          <template #default>
            <FormSection
              title="حفظ الماركه"
              btnTitle="حفظ الماركه"
              :formData="form"
              formRoute="product-brand.store"
              toastMsg="تم حفظ الماركه"
              :toastDescription="`تم تسجيل الماركه : ${form.name}`"
            >
            <FormSelect
                v-model="form.product_country_id"
                title="بلد الماركه"
                :require="true"
                :options="country"
              />
              <br/>
              <InputText
                v-model="form.name"
                title="أسم الماركه"
                :require="true"
              />
              <br/><br/>
              <InputImage v-model="form.image" title="شعار الماركه" />
              <br/><br/>
            </FormSection>
          </template>
        </Modal>
      </div>
      <InputText v-model="search" placeholder="بحث ...." />
      <div
        v-for="item in product_brand.data"
        :key="item.index"
        class="flex justify-between items-center my-5"
      >
        <Link
          :href="route('product-brand.show', item.id)"
          class="flex items-left justify-end items-center hover:text-[#009ef7]"
        >
          <div class="mr-2">
            <img
              class="rounded-full"
              :src="`/storage/${item['logo']}`"
              width="100"
              height="100"
            />
          </div>
          <div>
            <h6 class="mx-2">{{ item.name }}</h6>
            <h6 class="mx-2">{{ item.product_country.name }}</h6>
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
        :links="product_brand.links"
        v-if="product_brand.data.length"
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
import InputImage from "@/Forms/InputImage.vue";
import FormSelect from "@/Forms/FormSelect.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import Pagination from "@/Components/Tables/Pagination.vue";
import CardPrimary from "@/Components/Cards/Statistics/CardPrimary.vue";
import Modal from "@/Components/Modals/Modal.vue";

provide("title", "ماركات المنتجات");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "الماركات", linkRoute: "#" },
  ])
);

const props = defineProps(["product_brand", "product_brand_count", "filters","ProductCountry"]);

const product_brand = computed(() => props.product_brand);

const form = reactive({
  name: null,
  modelToggle: false,
  product_country_id: null,
  image: null,
});

const search = ref(props.filters.search);

const country = computed(() => {
  return props.ProductCountry.map((item) => {
    return { label: item.name, index: item.id };
  });
});


watch(search, (value) => {
  Inertia.get(
    "/product-brand",
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
    