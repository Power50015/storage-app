<template>
  <AppLayout title="قطع الغيار">
    <SectionTemplate class="pb-0">
      <h2 class="font-bold text-xl mb-5">قطع الغيار</h2>
      <div class="grid lg:grid-cols-2 grid-cols-1 gap-1.5">
        <CardPrimary>
          <h4 class="mb-3">قطع الغيار المسجله</h4>
          <h4 class="text-xl font-bold">
            {{kitCount}}
          </h4>
        </CardPrimary>
        <CardInfo>
          <h4 class="mb-3">قطع الغيار بدون مخزون</h4>
          <h4 class="text-xl font-bold">
            {{kitCountWithNoStock}}
          </h4>
        </CardInfo>
      </div>
    </SectionTemplate>
    <SectionTemplate>
      <div class="flex content-center items-center justify-between">
        <h2 class="title font-bold">قطع الغيار</h2>
        <btn-info :element="Link" :to="route('kit.create')">
          أضف قطعه غيار
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
          <div v-for="i in kits.data" :key="i.date">
            <div :value="i.total_number_of_product" class="hidden">
              {{ i.total_number_of_product }}
            </div>
            <div>
              <Link :href="route('kit.show', i.id)" class="group">
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
                  
                  <h3 class="text-[#009ef7] mt-4">{{ i.title }}</h3>
                  <h3 class="mt-1 text-sm text-[#009ef7]" v-if="i.product">
                    {{ KitName(i) }}
                  </h3>
                  
                </div>
                <p class="mt-1 mb-4 text-lg font-medium">
                  المتاح : {{ i.stock }}
                </p>
              </Link>
            </div>
          </div>
        </div>
      </div>
      <Pagination :links="kits.links" v-if="kits.data.length" />
      <div v-else>لا يوجد بيانات</div>
    </SectionTemplate>
  </AppLayout>
</template>

<script setup>
import { reactive, computed, provide, readonly, ref, watch } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import Pagination from "@/Components/Tables/Pagination.vue";
import InputText from "@/Forms/InputText.vue";
import BtnInfo from "@/Components/Buttons/BtnInfo.vue";
import CardPrimary from "@/Components/Cards/Statistics/CardPrimary.vue";
import CardInfo from "@/Components/Cards/Statistics/CardInfo.vue";

provide("title", "قطع الغيار");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "قطع الغيار", linkRoute: "#" },
  ])
);

const props = defineProps(["kits", "filters","kitCount","kitCountWithNoStock"]);

const kits = computed(() => props.kits);

const search = ref(props.filters.search);

watch(search, (value) => {
  Inertia.get(
    "/kit",
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

function KitName(item) {
  var name = item.title;
  if (item.product) {
    name = name + "-" + item.product.name;
    if (item.product.product_collection)
      name = name + "-" + item.product.product_collection.name;
    if (item.product.product_model)
      name = name + "-" + item.product.product_model.name;
    if (item.product.product_brand)
      name = name + "-" + item.product.product_brand.name;
    if (item.product.product_category)
      name = name + "-" + item.product.product_category.name;
    if (item.product.product_type)
      name = name + "-" + item.product.product_type.name;
    if (item.product.product_color)
      name = name + "-" + item.product.product_color.name;
    if (item.product.product_material)
      name = name + "-" + item.product.product_material.name;
    if (item.product.product_country)
      name = name + "-" + item.product.product_country.name;
  } else {
    if (item.product_brand) {
      name = name + "-" + item.product_brand.name;
    }
    if (item.product_category) {
      name = name + item.product_category.name + "-";
    }
    if (item.product_type) {
      name = name + item.product_type.name + "-";
    }
    if (item.product_collection) {
      name = name + item.product_collection.name + "-";
    }
    if (item.product_model) {
      name = name + item.product_model.name + "-";
    }
    if (item.product_color) {
      name = name + item.product_color.name + "-";
    }
    if (item.product_material) {
      name = name + item.product_material.name + "-";
    }
    if (item.product_country) {
      name = name + item.product_country.name + "-";
    }
  }
  return name;
}
</script>