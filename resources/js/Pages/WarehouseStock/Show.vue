<template>
  <AppLayout title="المخزن">
    <SectionTemplate class="print:p-0">
      <div class="flex justify-between md:flex-row flex-col-reverse">
        <div class="flex justify-around flex-col w-full">
          <div class="flex justify-between w-full print:hidden mb-3">
            <btn-info
              :element="Link"
              :to="route('warehouse-stock.edit', warehouseStock.id)"
              class="mt-4"
            >
              تعديل بيانات
            </btn-info>
            <btn-success @click="print" class="mt-4">
              طباعه
              <i class="fa-solid fa-print mx-3"></i>
            </btn-success>
          </div>
          <div class="flex justify-between w-full">
            <h2 class="font-bold text-sm">
              {{ warehouseStock.warehouse.name }}
            </h2>
            <h2 class="font-bold text-sm">
              {{ warehouseStock.warehouse.address }}
            </h2>
          </div>
          <div class="flex justify-between w-full">
            <h2 class="font-bold text-sm">
              {{ warehouseStock.title }}
            </h2>
            <h2 class="font-bold text-sm">
              {{
                new Date(warehouseStock.date).toLocaleDateString(
                  "ar-EG-u-nu-latn",
                  {
                    weekday: "long",
                    year: "numeric",
                    month: "short",
                    day: "numeric",
                  }
                )
              }}
            </h2>
          </div>
          <div class="mt-2">
            <div class="mt-2 hover:gray-500">
              <table
                class="border border-dashed border-slate-700 w-full text-right"
                id="xyz"
              >
                <tbody>
                  <!--incomingInvoiceContent-->
                  <tr v-if="warehouseStock.warehouse_stock_contents.length > 0">
                    <th
                      class="
                        border border-dashed border-slate-700
                        py-3
                        px-3
                        font-bold
                        s-border
                      "
                    >
                      المنتج
                    </th>
                    <th
                      class="
                        border border-dashed border-slate-700
                        py-3
                        px-3
                        font-bold
                        s-border
                      "
                    >
                      الكميه
                    </th>
                  </tr>
                  <tr
                    v-for="product in warehouseStock.warehouse_stock_contents"
                    :key="product.index"
                    class=""
                  >
                    <td
                      class="
                        border border-dashed border-slate-700
                        py-3
                        px-3
                        hover:text-[#0095e8]
                      "
                    >
                      <Link :href="route('product.show', product.product.id)">
                        <div class="flex mt-3">
                          <img
                            :src="`/storage/${product.product.image}`"
                            :alt="product.product.name"
                            class="w-[35px] h-[35px] rounded-full print:hidden"
                          />
                          <h3 class="text-sm font-bold mx-3">
                            <template> {{ product.product.name }} - </template>
                            <template v-if="product.product.product_collection">
                              {{ product.product.product_collection.name }} -
                            </template>
                            <template v-if="product.product.product_model">
                              {{ product.product.product_model.name }} -
                            </template>
                            <template v-if="product.product.product_brand">
                              {{ product.product.product_brand.name }} -
                            </template>
                            <template v-if="product.product.product_category">
                              {{ product.product.product_category.name }} -
                            </template>
                            <template v-if="product.product.product_type">
                              -{{ product.product.product_type.name }} -
                            </template>
                            <template v-if="product.product.product_color">
                              {{ product.product.product_color.name }} -
                            </template>
                            <template v-if="product.product.product_material">
                              {{ product.product.product_material.name }} -
                            </template>
                            <template v-if="product.product.product_country">
                              {{ product.product.product_country.name }}
                            </template>
                          </h3>
                        </div>
                      </Link>
                    </td>
                    <td class="border border-dashed border-slate-700 py-3 px-3">
                      {{ product.quantity }}
                    </td>
                  </tr>
                  <!--incomingInvoiceKit-->
                  <tr v-if="warehouseStock.kit_stocks.length > 0">
                    <th
                      class="
                        border border-dashed border-slate-700
                        py-3
                        px-3
                        font-bold
                        s-border
                      "
                    >
                      قطع الغيار
                    </th>
                    <th
                      class="
                        border border-dashed border-slate-700
                        py-3
                        px-3
                        font-bold
                        s-border
                      "
                    >
                      الكميه
                    </th>
                  </tr>
                  <tr
                    v-for="kit in warehouseStock.kit_stocks"
                    :key="kit.index"
                    class=""
                  >
                    <td
                      class="
                        border border-dashed border-slate-700
                        py-3
                        px-3
                        hover:text-[#0095e8]
                      "
                    >
                      <Link :href="route('kit.show', kit.kit.id)">
                        <div class="flex mt-3">
                          <img
                            :src="`/storage/${kit.kit.image}`"
                            :alt="kit.kit.title"
                            class="w-[35px] h-[35px] rounded-full print:hidden"
                          />
                          <h3 class="text-sm font-bold mx-3">
                            {{ kit.kit.title }}
                            <template v-if="kit.kit.product">
                              {{ kit.kit.product.name }} -
                              <template
                                v-if="kit.kit.product.product_collection"
                              >
                                {{ kit.kit.product.product_collection.name }} -
                              </template>
                              <template v-if="kit.kit.product.product_model">
                                {{ kit.kit.product.product_model.name }} -
                              </template>
                              <template v-if="kit.kit.product.product_brand">
                                {{ kit.kit.product.product_brand.name }} -
                              </template>
                              <template v-if="kit.kit.product.product_category">
                                {{ kit.kit.product.product_category.name }} -
                              </template>
                              <template v-if="kit.kit.product.product_type">
                                -{{ kit.kit.product.product_type.name }} -
                              </template>
                              <template v-if="kit.kit.product.product_color">
                                {{ kit.kit.product.product_color.name }} -
                              </template>
                              <template v-if="kit.kit.product.product_material">
                                {{ kit.kit.product.product_material.name }} -
                              </template>
                              <template v-if="kit.kit.product.product_country">
                                {{ kit.kit.product.product_country.name }}
                              </template>
                            </template>
                          </h3>
                        </div>
                      </Link>
                    </td>
                    <td class="border border-dashed border-slate-700 py-3 px-3">
                      {{ kit.quantity }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </SectionTemplate>
    <SectionTemplate class="print:hidden">
      <WarehouseStockTabs :id="warehouseStock.id" />
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
import WarehouseStockTabs from "@/Components/Warehouse/WarehouseStockTabs.vue";

const props = defineProps(["warehouseStock"]);

provide("title", "مخزون");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "المخازن", linkRoute: "warehouse.index" },
    {
      index: 2,
      linkTitle: "  " + props.warehouseStock[0].title,
      linkRoute: "#",
    },
  ])
);

const warehouseStock = computed(() => props.warehouseStock[0]);

function print() {
  window.print();
}
</script>