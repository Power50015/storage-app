<template>
  <AppLayout title="قطع الغيار">
    <SectionTemplate class="print:p-0">
      <div class="flex justify-between">
        <div class="flex justify-around flex-col w-full">
          <h2 class="font-bold mb-3 text-lg">
            {{ kit.title }}
          </h2>
          <template v-if="kit.product">
            <Link
              :href="route('product.show', kit.product.id)"
              class="font-bold hover:text-[#009ef7] mb-3 text-sm"
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
              | {{ kit.product.name }}
            </Link>
            <h2 v-if="kit.product.sku">
              SKU :
              {{ kit.product.sku }}
            </h2>
          </template>
          <div v-html="kit.description"></div>
          <h2 class="title font-bold text-lg text-[#009ef7]">
            إجمالى المتاح بالمخازن : {{ kit.total_number_of_kit }}
          </h2>
          <div class="flex print:hidden">
            <btn-info
              :element="Link"
              :to="route('kit.edit', kit.id)"
              class="mt-4"
            >
            تعديل بيانات
            </btn-info>
          </div>
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
                shadow-xl
                rounded-md
              "
              height="270"
              width="270"
          /></a>
        </div>
      </div>
    </SectionTemplate>
    <SectionTemplate class="print:p-0">
      <KitTabs :id="kit.id" />
    </SectionTemplate>
  </AppLayout>
</template>

<script setup>
import { reactive, computed, provide, readonly, ref, watch } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import BtnInfo from "@/Components/Buttons/BtnInfo.vue";
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
import KitTabs from "@/Components/Kit/KitTabs.vue";

const props = defineProps(["kit"]);

provide("title", "قطع الغيار");
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

const kit = computed(() => props.kit[0]);
const actionData = computed(() => props.actionData);
</script>