<template>
  <AppLayout title="النقلات">
    <SectionTemplate class="pb-0">
      <div class="header">
        <h2 class="font-bold text-xl mb-2 print:hidden">نقله</h2>
        <h2 class="px-2 text-slate-600 mb-2">
          تاريخ الإضافه :{{ dateFormat(transfer_data.created_at) }}
        </h2>
        <h2 class="px-2">
          تاريخ النقله : {{ dateFormat(transfer_data.date) }}
        </h2>
        <div class="flex justify-between my-3">
          <h2 class="px-2 print:mb-3">رقم النقله : {{ transfer_data.id }}</h2>
          <Link :href="route('warehouse.show', transfer_data.warehouse_from.id)" class="hover:text-[#009ef7]">
          <h2 class="px-2 print:mb-3">
            المخزن المسلم : {{ transfer_data.warehouse_from.name }}
          </h2>
          </Link>
          <Link :href="route('warehouse.show', transfer_data.warehouse_to.id)" class="hover:text-[#009ef7]">
          <h2 class="px-2 print:mb-3">
            المخزن المستلم : {{ transfer_data.warehouse_to.name }}
          </h2>
          </Link>
        </div>
        <div class="flex justify-between my-3">
          <div v-if="transfer_data.driver">
            <h2 class="px-2 print:mb-3">
              السائق : {{ transfer_data.driver.name }}
            </h2>
            <h2 class="px-2 print:mb-3">
              الهاتف : {{ transfer_data.driver.phone }}
            </h2>
          </div>
          <div>
            <h2 class="px-2">إضفيت بواسطه : {{ transfer_data.user.name }}</h2>
          </div>
        </div>
      </div>
      <div class="invoice">
        <hr />
        <h2 class="font-bold text-xl my-3">محتويات النقله</h2>
        <table class="border border-slate-700 w-full text-right">
          <thead>
            <tr v-if="transferContent.length > 0">
              <th class="border border-slate-700 py-3 px-3 font-bold s-border">
                المنتج
              </th>
              <th class="border border-slate-700 py-3 px-3 font-bold s-border">
                الكميه
              </th>
            </tr>
          </thead>
          <tbody>
            <!--transferContent-->
            <tr v-for="product in transferContent" :key="product.index" class="">
              <td class="border border-slate-700 py-3 px-3 hover:text-[#0095e8]">
                <Link :href="route('product.show', product.product.id)">
                {{ ContentName(product) }}
                </Link>
              </td>
              <td class="border border-slate-700 py-3 px-3">
                {{ product.quantity }}
              </td>
            </tr>
            <!--transferKit-->
            <tr v-if="transferKit.length > 0">
              <th class="border border-slate-700 py-3 px-3 font-bold s-border">
                قطع الغيار
              </th>

              <th class="border border-slate-700 py-3 px-3 font-bold s-border">
                الكميه
              </th>
            </tr>
            <tr v-for="kit in transferKit" :key="kit.index" class="">
              <td class="border border-slate-700 py-3 px-3 hover:text-[#0095e8]">
                <Link :href="route('kit.show', kit.kit.id)">
                {{ KitName(kit) }}
                </Link>
              </td>

              <td class="border border-slate-700 py-3 px-3">
                {{ kit.quantity }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="btns flex justify-around print:hidden mt-4">
        <btn-primary @click="print">
          طباعه
          <i class="fa-solid fa-print mx-3"></i>
        </btn-primary>
        <btn-success :element="Link" :to="route('transfer.edit', transfer_data.id)">
          تعديل النقله
        </btn-success>
      </div>
    </SectionTemplate>
    <SectionTemplate class="print:p-0 print:hidden">
      <TransferTabs :id="transfer_data.id" />
    </SectionTemplate>
  </AppLayout>
</template>
  
<script setup>
import { reactive } from "vue";
import { computed, provide, readonly } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import BtnPrimary from "@/Components/Buttons/BtnPrimary.vue";
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
import BtnInfo from "@/Components/Buttons/BtnInfo.vue";
import TransferTabs from "@/Components/Transfer/TransferTabs.vue";

const props = defineProps(["transfer", "transferContent", "transferKit"]);

const transfer_data = props.transfer[0];
const transferContent = props.transferContent;
const transferKit = props.transferKit;

provide("title", "النقلات");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    {
      index: 1,
      linkTitle: "النقلات",
      linkRoute: "transfer.index",
    },
    {
      index: 2,
      linkTitle: "نقله " + transfer_data.id,
      linkRoute: "#",
    },
  ])
);

function dateFormat(x) {
  var options = {
    weekday: "long",
    year: "numeric",
    month: "long",
    day: "numeric",
  };
  var today = new Date(x);
  return today.toLocaleDateString("ar-EG", options);
}

function print() {
  window.print();
}
function ContentName(item) {

  var name = item.product.name;

  if (item.product.product_brand) {
    name = name + "-" + item.product.product_brand.name;
  }
  if (item.product.product_category) {
    name = name + item.product.product_category.name + "-";
  }
  if (item.product.product_type) {
    name = name + item.product.product_type.name + "-";
  }
  if (item.product.product_collection) {
    name = name + item.product.product_collection.name + "-";
  }
  if (item.product.product_model) {
    name = name + item.product.product_model.name + "-";
  }
  if (item.product.product_color) {
    name = name + item.product.product_color.name + "-";
  }
  if (item.product.product_material) {
    name = name + item.product.product_material.name + "-";
  }
  if (item.product.product_country) {
    name = name + item.product.product_country.name + "-";
  }
  if (item.product.sku) {
    name = name + item.product.sku;
  }
  return name;
}
function KitName(item) {
  var name = item.kit.title;
  if (item.kit.product) {
    name = name + "-" + item.kit.product.name;
    if (item.kit.product.product_collection)
      name = name + "-" + item.kit.product.product_collection.name;
    if (item.kit.product.product_model)
      name = name + "-" + item.kit.product.product_model.name;
    if (item.kit.product.product_brand)
      name = name + "-" + item.kit.product.product_brand.name;
    if (item.kit.product.product_category)
      name = name + "-" + item.kit.product.product_category.name;
    if (item.kit.product.product_type)
      name = name + "-" + item.kit.product.product_type.name;
    if (item.kit.product.product_color)
      name = name + "-" + item.kit.product.product_color.name;
    if (item.kit.product.product_material)
      name = name + "-" + item.kit.product.product_material.name;
    if (item.kit.product.product_country)
      name = name + "-" + item.kit.product.product_country.name;
  } else {
    if (item.kit.product_brand) {
      name = name + "-" + item.kit.product_brand.name;
    }
    if (item.kit.product_category) {
      name = name + item.kit.product_category.name + "-";
    }
    if (item.kit.product_type) {
      name = name + item.kit.product_type.name + "-";
    }
    if (item.kit.product_collection) {
      name = name + item.kit.product_collection.name + "-";
    }
    if (item.kit.product_model) {
      name = name + item.kit.product_model.name + "-";
    }
    if (item.kit.product_color) {
      name = name + item.kit.product_color.name + "-";
    }
    if (item.kit.product_material) {
      name = name + item.kit.product_material.name + "-";
    }
    if (item.kit.product_country) {
      name = name + item.kit.product_country.name + "-";
    }
  }
  return name;
}
</script>