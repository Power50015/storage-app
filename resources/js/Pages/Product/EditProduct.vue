<template>
  <AppLayout title="المنتجات">
    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="
            dark:bg-[#1e1e2d]
            bg-white
            dark:text-white
            text-black
            overflow-hidden
            shadow-xl
            rounded-md
            p-4
          "
        >
          <h2 class="title font-bold mb-4">تعديل منتج</h2>
          <form action="POST" @submit.prevent="addProduct">
            <!--ProductCategory-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">
                قسم المنتج
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.category" class="text-red-800">
                {{ errors.category }}
              </div>
              <div class="flex">
                <select
                  class="
                    w-full
                    text-base
                    dark:bg-[#1b1b29]
                    bg-[#f5f8fa]
                    dark:active:bg-[#1b1b29]
                    active:bg-[#f5f8fa]
                    dark:focus:bg-[#1b1b29]
                    focus:bg-[#f5f8fa] focus:ring-0
                    border-0
                    shadow-sm
                    rounded-r-md
                    py-2
                  "
                  v-model="productAddForm.category"
                  @change="getProductType"
                >
                  <option disabled selected>اختار قسم المنتج</option>
                  <option
                    v-for="item in ProductCategory"
                    :value="item.id"
                    :key="item.id"
                  >
                    {{ item.name }}
                  </option>
                </select>
                <add-product-category-model />
              </div>
            </div>
            <!--ProductType-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">
                نوع المنتج
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.type" class="text-red-800">
                {{ errors.type }}
              </div>
              <div class="flex">
                <select
                  class="
                    w-full
                    text-base
                    dark:bg-[#1b1b29]
                    bg-[#f5f8fa]
                    dark:active:bg-[#1b1b29]
                    active:bg-[#f5f8fa]
                    dark:focus:bg-[#1b1b29]
                    focus:bg-[#f5f8fa] focus:ring-0
                    border-0
                    shadow-sm
                    rounded-r-md
                    py-2
                  "
                  v-model="productAddForm.type"
                >
                  <option disabled selected>اختار نوع المنتج</option>
                  <option
                    v-for="item in ProductTypeData[0]"
                    :value="item.id"
                    :key="item.id"
                  >
                    {{ item.name }}
                  </option>
                </select>
                <add-product-type-model
                  :productType="productAddForm.category"
                  @product-type-save-success="getProductType"
                />
              </div>
            </div>
            <!--ProductBrand-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300"> الماركه </label>
              <div class="flex">
                <select
                  class="
                    w-full
                    text-base
                    dark:bg-[#1b1b29]
                    bg-[#f5f8fa]
                    dark:active:bg-[#1b1b29]
                    active:bg-[#f5f8fa]
                    dark:focus:bg-[#1b1b29]
                    focus:bg-[#f5f8fa] focus:ring-0
                    border-0
                    shadow-sm
                    rounded-r-md
                    py-2
                  "
                  v-model="productAddForm.brand"
                  @change="getProductCollection"
                >
                  <option selected>اختار ماركه المنتج</option>
                  <option
                    v-for="item in ProductBrand"
                    :value="item.id"
                    :key="item.id"
                  >
                    {{ item.name }}
                  </option>
                </select>
                <add-product-brand-model
                  :productCountry="props.ProductCountry"
                />
              </div>
            </div>
            <!--ProductCollection-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300"> عائله المنتج </label>
              <div class="flex">
                <select
                  class="
                    w-full
                    text-base
                    dark:bg-[#1b1b29]
                    bg-[#f5f8fa]
                    dark:active:bg-[#1b1b29]
                    active:bg-[#f5f8fa]
                    dark:focus:bg-[#1b1b29]
                    focus:bg-[#f5f8fa] focus:ring-0
                    border-0
                    shadow-sm
                    rounded-r-md
                    py-2
                  "
                  v-model="productAddForm.collection"
                  @change="getProductModel"
                >
                  <option selected>اختار نوع المنتج</option>
                  <option
                    v-for="item in ProductCollectionData[0]"
                    :value="item.id"
                    :key="item.id"
                  >
                    {{ item.name }}
                  </option>
                </select>
                <add-product-collection-model
                  :productBrand="productAddForm.brand"
                  @product-collection-save-success="getProductCollection"
                />
              </div>
            </div>
            <!--ProductModel-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300"> موديل المنتج </label>
              <div class="flex">
                <select
                  class="
                    w-full
                    text-base
                    dark:bg-[#1b1b29]
                    bg-[#f5f8fa]
                    dark:active:bg-[#1b1b29]
                    active:bg-[#f5f8fa]
                    dark:focus:bg-[#1b1b29]
                    focus:bg-[#f5f8fa] focus:ring-0
                    border-0
                    shadow-sm
                    rounded-r-md
                    py-2
                  "
                  v-model="productAddForm.model"
                >
                  <option selected>اختار موديل المنتج</option>
                  <option
                    v-for="item in ProductModelData[0]"
                    :value="item.id"
                    :key="item.id"
                  >
                    {{ item.name }}
                  </option>
                </select>
                <add-product-model-model
                  :productCollection="productAddForm.collection"
                  @product-model-save-success="getProductModel"
                />
              </div>
            </div>
            <!--ProductName-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">
                أسم المنتج
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.name" class="text-red-800">
                {{ errors.name }}
              </div>
              <input
                type="text"
                v-model="productAddForm.name"
                class="
                  w-full
                  text-base
                  dark:bg-[#1b1b29]
                  bg-[#f5f8fa]
                  dark:active:bg-[#1b1b29]
                  active:bg-[#f5f8fa]
                  dark:focus:bg-[#1b1b29]
                  focus:bg-[#f5f8fa]
                  mt-3
                  focus:ring-0
                  border-0
                  shadow-sm
                  rounded-md
                  py-2
                "
              />
            </div>
            <!--ProductColor-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">
                لون المنتج
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.color" class="text-red-800">
                {{ errors.color }}
              </div>
              <div class="flex">
                <select
                  class="
                    w-full
                    text-base
                    dark:bg-[#1b1b29]
                    bg-[#f5f8fa]
                    dark:active:bg-[#1b1b29]
                    active:bg-[#f5f8fa]
                    dark:focus:bg-[#1b1b29]
                    focus:bg-[#f5f8fa] focus:ring-0
                    border-0
                    shadow-sm
                    rounded-r-md
                    py-2
                  "
                  v-model="productAddForm.color"
                >
                  <option disabled selected>اختار لون المنتج</option>
                  <option
                    v-for="item in ProductColor"
                    :value="item.id"
                    :key="item.id"
                  >
                    {{ item.name }}
                  </option>
                </select>
                <add-product-color-model />
              </div>
            </div>
            <!--ProductMaterial-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">
                خامه المنتج
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.material" class="text-red-800">
                {{ errors.material }}
              </div>
              <div class="flex">
                <select
                  class="
                    w-full
                    text-base
                    dark:bg-[#1b1b29]
                    bg-[#f5f8fa]
                    dark:active:bg-[#1b1b29]
                    active:bg-[#f5f8fa]
                    dark:focus:bg-[#1b1b29]
                    focus:bg-[#f5f8fa] focus:ring-0
                    border-0
                    shadow-sm
                    rounded-r-md
                    py-2
                  "
                  v-model="productAddForm.material"
                >
                  <option disabled selected>اختار خامه المنتج</option>
                  <option
                    v-for="item in ProductMaterial"
                    :value="item.id"
                    :key="item.id"
                  >
                    {{ item.name }}
                  </option>
                </select>
                <add-product-material-model />
              </div>
            </div>
            <!--ProductCountry-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">
                بلد التصنيع للمنتج
                <span class="text-red-800 font-bold">*</span>
              </label>
              <div v-if="errors.country" class="text-red-800">
                {{ errors.country }}
              </div>
              <div class="flex">
                <select
                  class="
                    w-full
                    text-base
                    dark:bg-[#1b1b29]
                    bg-[#f5f8fa]
                    dark:active:bg-[#1b1b29]
                    active:bg-[#f5f8fa]
                    dark:focus:bg-[#1b1b29]
                    focus:bg-[#f5f8fa] focus:ring-0
                    border-0
                    shadow-sm
                    rounded-r-md
                    py-2
                  "
                  v-model="productAddForm.country"
                >
                  <option disabled selected>اختار بلد المنتج</option>
                  <option
                    v-for="item in ProductCountry"
                    :value="item.id"
                    :key="item.id"
                  >
                    {{ item.name }}
                  </option>
                </select>
                <add-product-country-model />
              </div>
            </div>
            <!--ProductDescription-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">وصف المنتج</label>
              <div
                class="
                  w-full
                  text-base
                  dark:bg-[#1b1b29]
                  bg-[#f5f8fa]
                  dark:active:bg-[#1b1b29]
                  active:bg-[#f5f8fa]
                  dark:focus:bg-[#1b1b29]
                  focus:bg-[#f5f8fa]
                  mt-3
                  focus:ring-0
                  border-0
                  shadow-sm
                  py-2
                  min-h-[100px]
                  rounded-r-md
                "
                dir="ltr"
              >
                <QuillEditor
                  theme="snow"
                  toolbar="minimal"
                  v-model:content="productAddForm.description"
                  contentType="html"
                />
              </div>
            </div>
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300">
                سعر البيع المتوقع للمنتج
              </label>
              <input
                type="number"
                min="0.00"
                step="0.01"
                v-model="productAddForm.price"
                class="
                  w-full
                  text-base
                  dark:bg-[#1b1b29]
                  bg-[#f5f8fa]
                  dark:active:bg-[#1b1b29]
                  active:bg-[#f5f8fa]
                  dark:focus:bg-[#1b1b29]
                  focus:bg-[#f5f8fa]
                  mt-3
                  focus:ring-0
                  border-0
                  shadow-sm
                  rounded-md
                  py-2
                "
              />
            </div>
            <!--ProductSKU-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300"> SKU </label>
              <input
                type="text"
                v-model="productAddForm.sku"
                class="
                  w-full
                  text-base
                  dark:bg-[#1b1b29]
                  bg-[#f5f8fa]
                  dark:active:bg-[#1b1b29]
                  active:bg-[#f5f8fa]
                  dark:focus:bg-[#1b1b29]
                  focus:bg-[#f5f8fa]
                  mt-3
                  focus:ring-0
                  border-0
                  shadow-sm
                  rounded-md
                  py-2
                "
              />
            </div>
            <!--ProductImages-->
            <div class="mb-5">
              <label class="px-3 dark:text-gray-300" for="file_input"
                >الصوره الرئيسيه للمنتج<span class="text-red-800 font-bold"
                  >*</span
                >
              </label>
              <img
                :src="`/storage/${props.Product[0].image}`"
                width="300"
                class="mb-3"
              />
              <template v-if="imgPreview" class="mt-2">
                <img
                  :src="imgPreview"
                  class="img-fluid"
                  height="300"
                  width="300"
                />
                <p class="mb-0">أسم الملف: {{ imgData.value.name }}</p>
                <p class="mb-0">
                  حجم الملف: {{ Math.round(imgData.value.size / 1024) }}KB
                </p>
              </template>
              <input
                class="
                  block
                  w-full
                  text-sm text-gray-900
                  rounded-lg
                  border border-gray-300
                  dark:text-gray-400
                  focus:outline-none
                  dark:bg-[#1b1b29]
                  bg-[#f5f8fa]
                  dark:border-gray-600 dark:placeholder-gray-400
                  cursor-pointer
                "
                id="file_input"
                type="file"
                @change="DetectFiles($event.target.files)"
              />
            </div>

            <!--Button-->
            <div>
              <button
                type="submit"
                class="
                  mt-6
                  w-full
                  bg-[#009ef7]
                  border border-transparent
                  rounded-md
                  py-3
                  px-8
                  flex
                  items-center
                  justify-center
                  text-base
                  font-medium
                  text-white
                  hover:bg-[#009ef7]
                  focus:outline-none
                  focus:ring-2
                  focus:ring-offset-2
                  focus:ring-[#009ef7]
                "
              >
                حفظ المنتج
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import axios from "axios";
import { computed, provide, readonly, ref, reactive } from "@vue/runtime-core";
import { Inertia } from "@inertiajs/inertia";
import { createToast } from "mosha-vue-toastify";
import { QuillEditor } from "@vueup/vue-quill";

import AppLayout from "@/Layouts/AppLayout.vue";
import AddProductCategoryModel from "@/Components/Product/AddProductCategoryModel.vue";
import AddProductBrandModel from "@/Components/Product/AddProductBrandModel.vue";
import AddProductCollectionModel from "@/Components/Product/AddProductCollectionModel.vue";
import AddProductModelModel from "@/Components/Product/AddProductModelModel.vue";
import AddProductTypeModel from "@/Components/Product/AddProductTypeModel.vue";
import AddProductColorModel from "@/Components/Product/AddProductColorModel.vue";
import AddProductMaterialModel from "@/Components/Product/AddProductMaterialModel.vue";
import AddProductCountryModel from "@/Components/Product/AddProductCountryModel.vue";

provide("title", "المنتجات");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "المنتجات", linkRoute: "product.index" },
    { index: 2, linkTitle: "تعديل منتج", linkRoute: "#" },
  ])
);

const props = defineProps([
  "errors",
  "Product",
  "ProductCategory",
  "ProductBrand",
  "ProductColor",
  "ProductMaterial",
  "ProductCountry",
]);
const imgData = reactive([]);
const imgPreview = ref();

const productAddForm = reactive({
  _method: "patch",
  category: props.Product[0].product_category_id,
  type: props.Product[0].product_type_id,
  brand: props.Product[0].product_brand_id,
  collection: props.Product[0].product_collection_id,
  model: props.Product[0].product_model_id,
  name: props.Product[0].name,
  color: props.Product[0].product_color_id,
  material: props.Product[0].product_material_id,
  description: props.Product[0].description,
  sku: props.Product[0].sku,
  price: props.Product[0].price,
  country: props.Product[0].product_country_id,
  oldImage: props.Product[0].image,
  image: null,
});

function addProduct() {
  productAddForm.image = imgData.value;
  Inertia.post(route("product.update", props.Product[0].id), productAddForm, {
    onSuccess: () => {
      createToast(
        {
          title: "تم تسجيل المنتج",
          description: `تم تسجيل المنتج ${productAddForm.type} ${productAddForm.model} ${productAddForm.name}`,
        },
        {
          timeout: 3000,
          transition: "slide",
          type: "success",
          showIcon: true,
        }
      );
      getProductType();
      getProductCollection();
      getProductModel();
    },
    onError: (errors) => {
      for (const [key, value] of Object.entries(errors)) {
        createToast(
          {
            title: value,
          },
          {
            timeout: 3000,
            transition: "slide",
            type: "danger",
            showIcon: true,
          }
        );
      }
    },
  });
}

const ProductTypeData = reactive([]);
const ProductCollectionData = reactive([]);
const ProductModelData = reactive([]);

function getProductType() {
  ProductTypeData.length = 0;
  axios
    .get("/product-type/" + productAddForm.category)
    .then((data) => ProductTypeData.push(data.data));
}

function getProductCollection() {
  ProductCollectionData.length = 0;
  axios
    .get("/product-collection/" + productAddForm.brand)
    .then((data) => ProductCollectionData.push(data.data));
}

function getProductModel() {
  ProductModelData.length = 0;
  axios
    .get("/product-model/" + productAddForm.collection)
    .then((data) => ProductModelData.push(data.data));
}

function DetectFiles(input) {
  imgData.value = input[0];

  imgPreview.value = input[0];
  if (input) {
    var reader = new FileReader();
    reader.onload = (e) => {
      imgPreview.value = e.target.result;
    };
    reader.readAsDataURL(input[0]);
  }
}
getProductType();
getProductCollection();
getProductModel();
</script>
