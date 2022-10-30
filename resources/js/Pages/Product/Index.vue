<template>
  <AppLayout title="المنتجات">
    <SectionTemplate>
      <div class="grid lg:grid-cols-6 grid-cols-2 gap-2">
        <btn-primary :element="Link" :to="route('product-category.index')">
          <div class="flex flex-col items-center justify-center text-center">
            <h4 class="mb-3">عدد الأقسام</h4>
            <h4 class="text-xl font-bold">{{ product_category_count }}</h4>
          </div>
        </btn-primary>
        <btn-warning :element="Link" :to="route('product-brand.index')">
          <div class="flex flex-col items-center justify-center text-center">
            <h4 class="mb-3">عدد الماركات</h4>
            <h4 class="text-xl font-bold">{{ product_brand_count }}</h4>
          </div>
        </btn-warning>
        <btn-success>
          <div class="flex flex-col items-center justify-center text-center">
            <h4 class="mb-3">عدد المنتجات</h4>
            <h4 class="text-xl font-bold">{{ product_count }}</h4>
          </div>
        </btn-success>
        <card-primary>
          <div class="flex flex-col items-center justify-center text-center">
            <h4 class="mb-3">المنتجات متاحه المخزون</h4>
            <h4 class="text-xl font-bold">
              {{ product_stock_count }}
            </h4>
          </div>
        </card-primary>
        <card-info>
          <div class="flex flex-col items-center justify-center text-center">
            <h4 class="mb-3">عدد المنتجات بدون المخزون</h4>
            <h4 class="text-xl font-bold">{{ product_no_stock_count }}</h4>
          </div>
        </card-info>
        <card-danger>
          <div class="flex flex-col items-center justify-center text-center">
            <h4 class="mb-3">عدد الهالك</h4>
            <h4 class="text-xl font-bold">{{ destructible_goods_count }}</h4>
          </div>
        </card-danger>
      </div>
    </SectionTemplate>
    <SectionTemplate>
      <div class="flex items-center justify-between my-3">
        <h2 class="title font-bold mb-3">المنتجات</h2>
        <btn-info :element="Link" :to="route('product.create')">
          أضف منتج
        </btn-info>
      </div>
      <div class="flex items-center justify-between my-3">
        <InputText v-model="form.search" placeholder="بحث ...." />
        <btn-success @click="filter = !filter"
          ><span class="mx-2">فلتر</span> <i class="fa-solid fa-filter"></i
        ></btn-success>
      </div>
      <div class="grid lg:grid-cols-4 grid-cols-2 gap-2 mt-5" v-if="filter">
        <!-- Product Category -->
        <FormSelect
          v-model="form.product_category_id"
          title="قسم المنتج"
          :options="category"
          @change-select="categoryChange"
        />
        <!-- Product Type -->
        <FormSelect
          v-model="form.product_type_id"
          title="نوع المنتج"
          :options="type"
        />
        <!-- Product Brand -->
        <SelectBrand
          v-model="form.product_brand_id"
          title="ماركه المنتج"
          @change-select="brandChange"
        />
        <!-- Product Collection -->
        <FormSelect
          v-model="form.product_collection_id"
          title="عائله المنتج"
          :options="collection"
          @change-select="collectionChange"
        />
        <!-- Product Model -->
        <FormSelect
          v-model="form.product_model_id"
          title="موديل المنتج"
          :options="model"
        />
        <!-- Product Price From -->
        <InputNumber
          v-model="form.price_from"
          title="السعر من"
          :options="model"
        />
        <!-- Product Price To -->
        <InputNumber
          v-model="form.price_to"
          title="السعر الى"
          :options="model"
        />
        <!-- Product Stock -->
        <FormSelect
          v-model="form.product_stock"
          title="المخزون"
          :options="product_stock"
        />
        <!-- destructible goods -->
        <FormSelect
          v-model="form.destructible_goods"
          title="الهالك"
          :options="destructible_goods"
        />
        <!-- Product color -->
        <FormSelect
          v-model="form.product_color_id"
          title="اللون"
          :options="color"
        />
        <!-- Product Matiral -->
        <FormSelect
          v-model="form.product_material_id"
          title="الخامه"
          :options="material"
        />
        <!-- Product country -->
        <FormSelect
          v-model="form.product_country_id"
          title="البلد"
          :options="country"
        />
      </div>

      <div class="products w-full">
        <div
          class="
            grid grid-cols-1
            gap-y-10
            sm:grid-cols-2
            gap-x-6
            lg:grid-cols-3
            xl:grid-cols-4 xl:gap-x-8
            mt-5
          "
        >
          <div v-for="i in products.data" :key="i.date">
            <div :value="i.total_number_of_product" class="hidden">
              {{ i.total_number_of_product }}
            </div>
            <div>
              <Link :href="route('product.show', i.id)" class="group">
                <div
                  class="
                    w-full
                    aspect-w-1 aspect-h-1
                    bg-gray-200
                    rounded-lg
                    overflow-hidden
                    xl:aspect-w-7 xl:aspect-h-8
                    hover:text-[#009ef7]
                  "
                >
                  <img
                    :src="`/storage/${i.image}`"
                    :alt="i.title"
                    class="
                      w-full
                      h-[270px]
                      object-center object-cover
                      group-hover:opacity-75
                    "
                    height="270"
                    width="270"
                  />
                </div>
                <div>
                  <h3 class="mt-1 text-md font-bold text-[#009ef7]">
                    {{ i.name }} |
                    <template v-if="i.product_collection">
                      {{ i.product_collection.name }} |
                    </template>
                    <template v-if="i.product_model">
                      {{ i.product_model.name }}
                    </template>
                  </h3>
                  <h3 class="text-sm">
                    <template v-if="i.product_brand">
                      {{ i.product_brand.name }}
                    </template>
                    <template v-if="i.product_category">
                      | {{ i.product_category.name }}
                    </template>
                    <template v-if="i.product_type">
                      | {{ i.product_type.name }}
                    </template>
                    <template v-if="i.product_color">
                      | {{ i.product_color.name }}
                    </template>
                    <template v-if="i.product_material">
                      | {{ i.product_material.name }}
                    </template>
                    <template v-if="i.product_country">
                      | {{ i.product_country.name }}
                    </template>
                  </h3>
                </div>
                <p class="mt-1 text-lg font-medium">
                  المتاح : {{ i.total_number_of_product }}
                </p>
              </Link>
            </div>
          </div>
        </div>
      </div>
      <Pagination :links="products.links" v-if="products.data.length" />
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
  ref,
  watch,
  reactive,
} from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import Pagination from "@/Components/Tables/Pagination.vue";
import InputText from "@/Forms/InputText.vue";
import InputNumber from "@/Forms/InputNumber.vue";
import FormSelect from "@/Forms/FormSelect.vue";
import SelectBrand from "@/Forms/SelectBrand.vue";
import CardInfo from "@/Components/Cards/Statistics/CardInfo.vue";
import CardPrimary from "@/Components/Cards/Statistics/CardPrimary.vue";
import CardDanger from "@/Components/Cards/Statistics/CardDanger.vue";
import BtnInfo from "@/Components/Buttons/BtnInfo.vue";
import BtnPrimary from "@/Components/Buttons/BtnPrimary.vue";
import BtnDanger from "@/Components/Buttons/BtnDanger.vue";
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
import BtnWarning from "@/Components/Buttons/BtnWarning.vue";
import axios from "axios";

provide("title", "المنتجات");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "المنتجات", linkRoute: "#" },
  ])
);

const props = defineProps([
  "product_category_count",
  "product_category",
  "product_type_count",
  "product_type",
  "product_brand_count",
  "product_brand",
  "product_category",
  "product_type",
  "product_collection",
  "product_model",
  "product_color",
  "product_country",
  "product_material",
  "product_count",
  "products",
  "filters",
]);

const products = computed(() => props.products);

const form = reactive({
  search: props.filters.search,
  product_category_id: Number(props.filters.product_category_id) || null,
  product_type_id: Number(props.filters.product_type_id) || null,
  product_brand_id: Number(props.filters.product_brand_id) || null, //nullable
  product_collection_id: Number(props.filters.product_collection_id) || null, //nullable
  product_model_id: Number(props.filters.product_model_id) || null, //nullable
  product_color_id: Number(props.filters.product_color_id) || null,
  product_material_id: Number(props.filters.product_material_id) || null,
  product_country_id: Number(props.filters.product_country_id) || null,
  price_from: Number(props.filters.price_to) || null,
  price_to: Number(props.filters.price_to) || null,
  product_stock: Number(props.filters.product_stock) || null,
  destructible_goods: Number(props.filters.destructible_goods) || null,
});

const product_stock = [
  { label: "بدون مخزون", index: 1 },
  { label: "مع مخزون", index: 2 },
];
const destructible_goods = [
  { label: "بدون هالك", index: 1 },
  { label: "هالك", index: 2 },
];

const category = computed(() => {
  return props.product_category.map((item) => {
    return { label: item.name, index: item.id };
  });
});

const type = computed(() => {
  return props.product_type
    .filter((item) => item.product_category_id == form.product_category_id)
    .map((item) => {
      return { label: item.name, index: item.id };
    });
});

const collection = computed(() => {
  return props.product_collection
    .filter((item) => item.product_brand_id == form.product_brand_id)
    .map((item) => {
      return { label: item.name, index: item.id };
    });
});

const model = computed(() => {
  return props.product_model
    .filter((item) => item.product_collection_id == form.product_collection_id)
    .map((item) => {
      return { label: item.name, index: item.id };
    });
});

const color = computed(() => {
  return props.product_color.map((item) => {
    return { label: item.name, index: item.id };
  });
});

const material = computed(() => {
  return props.product_material.map((item) => {
    return { label: item.name, index: item.id };
  });
});

const country = computed(() => {
  return props.product_country.map((item) => {
    return { label: item.name, index: item.id };
  });
});

watch(form, (value) => {
  Inertia.get(
    "/product",
    {
      search: value.search,
      product_category_id: value.product_category_id,
      product_type_id: value.product_type_id,
      product_brand_id: value.product_brand_id,
      product_collection_id: value.product_collection_id,
      product_model_id: value.product_model_id,
      product_material_id: value.product_material_id,
      product_color_id: value.product_color_id,
      product_country_id: value.product_country_id,
      price_from: value.price_from,
      price_to: value.price_to,
      product_stock: value.product_stock,
      destructible_goods: value.destructible_goods,
    },
    {
      preserveState: true,
      replace: true,
      preserveScroll: true,
    }
  );
});
const product_no_stock_count = ref();
const product_stock_count = ref();
const destructible_goods_count = ref();
const filter = ref(false);

function categoryChange() {
  form.product_type_id = null;
}
function brandChange() {
  form.product_collection_id = null;
}
function collectionChange() {
  form.product_model_id = null;
}
onMounted(() => {
  axios.get("/product-no-stock-count").then(function (response) {
    product_no_stock_count.value = response.data;
    product_stock_count.value =
      props.product_count - product_no_stock_count.value;
  });
  axios.get("/destructible-goods-count").then(function (response) {
    destructible_goods_count.value = response.data;
  });
});
</script>
<style scoped>
</style>