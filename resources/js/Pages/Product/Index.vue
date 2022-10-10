<template>
  <AppLayout title="المنتجات">
    <SectionTemplate>
      <div class="flex content-center items-center justify-between">
        <h2 class="title font-bold">المنتجات</h2>
        <btn-info :element="Link" :to="route('product.create')">
          أضف منتج
        </btn-info>
      </div>
      <InputText v-model="search" placeholder="بحث ...." />
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
import { computed, provide, readonly, ref, watch } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import BtnInfo from "@/Components/Buttons/BtnInfo.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import Pagination from "@/Components/Tables/Pagination.vue";
import InputText from "@/Forms/InputText.vue";

provide("title", "المنتجات");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "المنتجات", linkRoute: "#" },
  ])
);

const props = defineProps(["products", "filters"]);

const products = computed(() => props.products);

const search = ref(props.filters.search);

watch(search, (value) => {
  Inertia.get(
    "/product",
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
<style scoped>

</style>