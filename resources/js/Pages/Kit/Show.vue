<template>
  <AppLayout title="المنتجات">
    <div class="pt-6 pb-2">
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
          <div class="flex content-center items-center justify-between">
            <div class="flex w-full justify-between">
              <div class="">
                <h2 class="title font-bold mt-3">
                  {{ kit.title }}
                </h2>
                <h2 class="title font-bold mt-3 hover:text-[#009ef7] mb-5">
                  <template v-if="kit.product">
                    <Link :href="route('product.show', kit.product.id)"
                      ><template v-if="kit.product.product_brand"
                        >{{ kit.product.product_brand.name }} |</template
                      >
                      <template v-if="kit.product.product_category">
                        {{ kit.product.product_category.name }}</template
                      >
                      <template v-if="kit.product.product_type">
                        |{{ kit.product.product_type.name }}
                      </template>
                      <template v-if="kit.product.product_collection">
                        |{{ kit.product.product_collection.name }}
                      </template>
                      <template v-if="kit.product.product_model">
                        |{{ kit.product.product_model.name }}
                      </template>
                      <template v-if="kit.product.product_color">
                        |{{ kit.product.product_color.name }}
                      </template>
                      <template v-if="kit.product.product_material">
                        |{{ kit.product.product_material.name }}
                      </template>
                      <template v-if="kit.product.product_country">
                        | {{ kit.product.product_country.name }}</template
                      >
                      <template v-if="kit.product.sku">
                        | {{ kit.product.sku }}</template
                      >
                      | {{ kit.product.name }}</Link
                    ></template
                  >
                </h2>
                <div v-html="kit.description"></div>
                <h2 class="title font-bold mt-3 text-lg text-[#009ef7]">
                  إجمالى المتاح بالمخازن : {{ kit.total_number_of_kit }}
                </h2>
                <Link
                  :href="route('kit.edit', kit.id)"
                  class="
                    print:hidden
                    mt-5
                    bg-[#7239ea]
                    border border-transparent
                    rounded-md
                    py-3
                    px-3
                    inline-block
                    items-center
                    justify-center
                    text-base
                    font-medium
                    text-white
                    hover:bg-[#7239ea]
                    focus:outline-none
                    focus:ring-2
                    focus:ring-offset-2
                    focus:ring-[#7239ea]
                    cursor-pointer
                  "
                >
                  تعديل بيانات
                </Link>
              </div>
              <div>
                <a :href="`/storage/${kit.image}`" target="_blank">
                  <img
                    :src="`/storage/${kit.image}`"
                    :alt="kit.title"
                    class="
                      w-full
                      h-[270px]
                      object-center object-cover
                      group-hover:opacity-75
                    "
                    height="270"
                    width="270"
                /></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <kit-tabs
      :warehouse="kit.total_number_of_kit_warehouse"
      :stockData="stockData"
      :incomeIvoice="incomeIvoice"
      :stratStock="stratStock"
      :note="note"
      :attachment="attachment"
      :image="image"
      :id="kit.id"
    />
  </AppLayout>
</template>

<script setup>
import { reactive } from "vue";
import { computed, provide, readonly } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import KitTabs from "@/Components/Kit/KitTabs.vue";

const props = defineProps([
  "kit",
  "stockData",
  "incomeIvoice",
  "stratStock",
  "note",
  "attachment",
  "image",
  "id",
]);
const kit = computed(() => props.kit[0]);

provide("title", "المنتج");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "قطع الغيار", linkRoute: "kit.index" },
    {
      index: 2,
      linkTitle: " قطعه الغيار " + props.kit[0].title,
      linkRoute: "#",
    },
  ])
);
</script>