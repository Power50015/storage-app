<template>
  <AppLayout title="المنتجات">
    <FormSection
      title="إضافه منتج"
      btnTitle="حفظ المنتج"
      :formData="form"
      formRoute="product.store"
      toastMsg="تم تسجيل المنتج"
    >
      <!-- Product Category -->
      <FormSelect
        v-model="form.product_category_id"
        title="قسم المنتج"
        :error="errors.product_category_id"
        :require="true"
        :options="category"
        @change-select="categoryChange"
      >
        <Modal v-model="categoryForm.modelToggle">
          <template #btn> <i class="fa-solid fa-plus"></i> </template>
          <template #default>
            <FormSection
              title="حفظ قسم"
              btnTitle="حفظ القسم"
              :formData="categoryForm"
              formRoute="product-category.store"
              toastMsg="تم حفظ القسم"
              :toastDescription="`تم تسجيل القسم : ${categoryForm.name}`"
            >
              <InputText
                v-model="categoryForm.name"
                title="أسم القسم"
                :require="true"
              />
            </FormSection>
          </template>
        </Modal>
      </FormSelect>
      <!-- Product Type -->
      <FormSelect
        v-model="form.product_type_id"
        title="نوع المنتج"
        :error="errors.product_type_id"
        :require="true"
        :options="type"
      >
        <Modal
          v-model="typeForm.modelToggle"
          :disabledClass="form.product_category_id == null"
        >
          <template #btn> <i class="fa-solid fa-plus"></i> </template>
          <template #default>
            <FormSection
              title="حفظ نوع منتجات"
              btnTitle="حفظ نوع منتجات"
              :formData="typeForm"
              formRoute="product-type.store"
              toastMsg="تم حفظ نوع منتجات"
              :toastDescription="`تم تسجيل نوع منتجات : ${typeForm.name}`"
            >
              <InputText
                v-model="typeForm.name"
                title="نوع منتجات"
                :require="true"
              />
            </FormSection>
          </template>
        </Modal>
      </FormSelect>
      <!-- Product Brand -->
      <SelectBrand
        v-model="form.product_brand_id"
        title="ماركه المنتج"
        @change-select="brandChange"
      >
        <Modal v-model="brandForm.modelToggle">
          <template #btn> <i class="fa-solid fa-plus"></i> </template>
          <template #default>
            <FormSection
              title="حفظ الماركه"
              btnTitle="حفظ الماركه"
              :formData="brandForm"
              formRoute="product-brand.store"
              toastMsg="تم حفظ الماركه"
              :toastDescription="`تم تسجيل الماركه : ${brandForm.name}`"
            >
              <InputText
                v-model="brandForm.name"
                title="أسم الماركه"
                :error="errors.name"
                :require="true"
              />
              <FormSelect
                v-model="brandForm.product_country_id"
                title="بلد الماركه"
                :error="errors.product_country_id"
                :require="true"
                :options="country"
              />
              <InputImage v-model="brandForm.image" title="شعار الماركه" />
            </FormSection>
          </template>
        </Modal>
      </SelectBrand>
      <!-- Product Collection -->
      <FormSelect
        v-model="form.product_collection_id"
        title="عائله المنتج"
        :options="collection"
        @change-select="collectionChange"
      >
        <Modal
          v-model="collectionForm.modelToggle"
          :disabledClass="form.product_brand_id == null"
        >
          <template #btn> <i class="fa-solid fa-plus"></i> </template>
          <template #default>
            <FormSection
              title="حفظ عائله منتج"
              btnTitle="حفظ عائله منتج "
              :formData="collectionForm"
              formRoute="product-collection.store"
              toastMsg="تم حفظ  عائله منتج"
              :toastDescription="`تم تسجيل  عائله منتج : ${collectionForm.name}`"
            >
              <InputText
                v-model="collectionForm.name"
                title="عائله منتج"
                :require="true"
              />
            </FormSection>
          </template>
        </Modal>
      </FormSelect>
      <!-- Product Model -->
      <FormSelect
        v-model="form.product_model_id"
        title="موديل المنتج"
        :options="model"
      >
        <Modal
          v-model="modelForm.modelToggle"
          :disabledClass="form.product_collection_id == null"
        >
          <template #btn> <i class="fa-solid fa-plus"></i> </template>
          <template #default>
            <FormSection
              title="حفظ موديل منتج"
              btnTitle="حفظ موديل منتج "
              :formData="modelForm"
              formRoute="product-model.store"
              toastMsg="تم حفظ  موديل المنتج"
              :toastDescription="`تم تسجيل موديل منتج : ${modelForm.name}`"
            >
              <InputText
                v-model="modelForm.name"
                title="موديل المنتج"
                :require="true"
              />
            </FormSection>
          </template>
        </Modal>
      </FormSelect>
      <!-- Product Name -->
      <InputText
        v-model="form.name"
        title="أسم المنتج"
        :error="errors.name"
        :require="true"
      />
      <!-- Product Color -->
      <FormSelect
        v-model="form.product_color_id"
        title="لون المنتج"
        :error="errors.product_color_id"
        :require="true"
        :options="color"
      >
        <Modal v-model="colorForm.modelToggle">
          <template #btn> <i class="fa-solid fa-plus"></i> </template>
          <template #default>
            <FormSection
              title="حفظ اللون"
              btnTitle="حفظ اللون"
              :formData="colorForm"
              formRoute="product-color.store"
              toastMsg="تم حفظ اللون"
              :toastDescription="`تم تسجيل اللون : ${colorForm.name}`"
            >
              <InputText
                v-model="colorForm.name"
                title="أسم اللون"
                :require="true"
              />
            </FormSection>
          </template>
        </Modal>
      </FormSelect>
      <!-- Product Material -->
      <FormSelect
        v-model="form.product_material_id"
        title="خامه المنتج"
        :error="errors.product_material_id"
        :require="true"
        :options="material"
      >
        <Modal v-model="materialForm.modelToggle">
          <template #btn> <i class="fa-solid fa-plus"></i> </template>
          <template #default>
            <FormSection
              title="حفظ الخامه"
              btnTitle="حفظ الخامه"
              :formData="materialForm"
              formRoute="product-material.store"
              toastMsg="تم حفظ الخامه"
              :toastDescription="`تم تسجيل الخامه : ${materialForm.name}`"
            >
              <InputText
                v-model="materialForm.name"
                title="أسم الخامه"
                :require="true"
              />
            </FormSection>
          </template>
        </Modal>
      </FormSelect>
      <!-- Product Country -->
      <FormSelect
        v-model="form.product_country_id"
        title="بلد التصنيع للمنتج"
        :error="errors.product_country_id"
        :require="true"
        :options="country"
      >
        <Modal v-model="countryForm.modelToggle">
          <template #btn> <i class="fa-solid fa-plus"></i> </template>
          <template #default>
            <FormSection
              title="حفظ البلد"
              btnTitle="حفظ البلد"
              :formData="countryForm"
              formRoute="product-country.store"
              toastMsg="تم حفظ البلد"
              :toastDescription="`تم تسجيل البلد : ${countryForm.name}`"
            >
              <InputText
                v-model="countryForm.name"
                title="أسم البلد"
                :require="true"
              />
            </FormSection>
          </template>
        </Modal>
      </FormSelect>
      <!-- Product Description -->
      <InputTextArea v-model="form.description" title="وصف المنتج" />
      <!-- Product Price -->
      <InputNumber
        v-model="form.price"
        title="سعر البيع المتوقع للمنتج"
        step="0.01"
      />
      <!--ProductSKU-->
      <InputText v-model="form.sku" title="sku" />
      <!--ProductImages-->
      <InputImage
        v-model="form.image"
        title="الصوره الرئيسيه للمنتج"
        :error="errors.image"
        :require="true"
      />
    </FormSection>
  </AppLayout>
</template>

<script setup>
import { computed, provide, readonly, reactive } from "@vue/runtime-core";
import AppLayout from "@/Layouts/AppLayout.vue";
import FormSection from "@/Forms/FormSection.vue";
import FormSelect from "@/Forms/FormSelect.vue";
import InputText from "@/Forms/InputText.vue";
import InputTextArea from "@/Forms/InputTextArea.vue";
import InputNumber from "@/Forms/InputNumber.vue";
import InputImage from "@/Forms/InputImage.vue";
import Modal from "@/Components/Modals/Modal.vue";
import SelectBrand from "../../Forms/SelectBrand.vue";

provide("title", "المنتجات");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "المنتجات", linkRoute: "product.index" },
    { index: 2, linkTitle: "إضافه منتج", linkRoute: "#" },
  ])
);

const props = defineProps([
  "errors",
  "ProductCategory",
  "ProductType",
  "ProductBrand",
  "ProductCollection",
  "ProductModel",
  "ProductColor",
  "ProductMaterial",
  "ProductCountry",
]);
const form = reactive({
  product_category_id: null,
  product_type_id: null,
  product_brand_id: null, //nullable
  product_collection_id: null, //nullable
  product_model_id: null, //nullable
  name: null,
  product_color_id: null,
  product_material_id: null,
  description: null, //nullable
  sku: null, //nullable
  price: 0.0, //nullable
  product_country_id: null,
  image: null,
});

const categoryForm = reactive({
  modelToggle: false,
  name: null,
});
const category = computed(() => {
  return props.ProductCategory.map((item) => {
    return { label: item.name, index: item.id };
  });
});

const typeForm = reactive({
  modelToggle: false,
  name: null,
  product_category_id: null,
});
const type = computed(() => {
  return props.ProductType.filter(
    (item) => item.product_category_id == form.product_category_id
  ).map((item) => {
    return { label: item.name, index: item.id };
  });
});

const brandForm = reactive({
  modelToggle: false,
  name: null,
  product_country_id: null,
});

const brand = computed(() => {
  return props.ProductBrand.map((item) => {
    return { label: item.name, index: item.id, image: item.logo };
  });
});

const collectionForm = reactive({
  modelToggle: false,
  name: null,
  product_brand_id: null,
});
const collection = computed(() => {
  return props.ProductCollection.filter(
    (item) => item.product_brand_id == form.product_brand_id
  ).map((item) => {
    return { label: item.name, index: item.id };
  });
});

const modelForm = reactive({
  modelToggle: false,
  name: null,
  product_collection_id: null,
});
const model = computed(() => {
  return props.ProductModel.filter(
    (item) => item.product_collection_id == form.product_collection_id
  ).map((item) => {
    return { label: item.name, index: item.id };
  });
});

const colorForm = reactive({
  modelToggle: false,
  name: null,
});
const color = computed(() => {
  return props.ProductColor.map((item) => {
    return { label: item.name, index: item.id };
  });
});

const materialForm = reactive({
  modelToggle: false,
  name: null,
});
const material = computed(() => {
  return props.ProductMaterial.map((item) => {
    return { label: item.name, index: item.id };
  });
});

const countryForm = reactive({
  modelToggle: false,
  name: null,
});
const country = computed(() => {
  return props.ProductCountry.map((item) => {
    return { label: item.name, index: item.id };
  });
});

function categoryChange() {
  form.product_type_id = null;
  typeForm.product_category_id = form.product_category_id;
}
function brandChange() {
  form.product_collection_id = null;
  collectionForm.product_brand_id = form.product_brand_id;
}
function collectionChange() {
  form.product_model_id = null;
  modelForm.product_collection_id = form.product_collection_id;
}
</script>
