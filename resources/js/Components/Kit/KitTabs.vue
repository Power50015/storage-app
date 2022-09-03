<template>
  <div class="print:hidden">
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
        <div
          class="
            flex
            content-center
            items-center
            justify-between
            md:overflow-auto
            overflow-x-scroll overflow-y-hidden
          "
        >
          <div class="tabs">
            <ul class="flex">
              <li
                class="my-3 mx-5 cursor-pointer"
                v-if="warehouse.length > 0"
                :class="
                  tab == 'stock'
                    ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                    : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
                "
              >
                <div class="px-5 py-3" @click="tabClick('stock')">
                  المتاح بالمخازن
                </div>
              </li>
              <li
                class="my-3 mx-5"
                :class="
                  tab == 'incomeIvoice'
                    ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                    : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
                "
              >
                <div class="px-5 py-3" @click="tabClick('incomeIvoice')">
                  المشتريات
                </div>
              </li>
              <li
                class="my-3 mx-5"
                :class="
                  tab == 'note'
                    ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                    : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
                "
              >
                <div class="px-5 py-3" @click="tabClick('note')">الملاحظات</div>
              </li>
              <li
                class="my-3 mx-5"
                :class="
                  tab == 'attachment'
                    ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                    : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
                "
              >
                <div class="px-5 py-3" @click="tabClick('attachment')">
                  الملفات
                </div>
              </li>
              <li
                class="my-3 mx-5"
                :class="
                  tab == 'image'
                    ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                    : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
                "
              >
                <div class="px-5 py-3" @click="tabClick('image')">الصور</div>
              </li>
              <li
                class="my-3 mx-5"
                :class="
                  tab == 'Sstock'
                    ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                    : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
                "
              >
                <div class="px-5 py-3" @click="tabClick('Sstock')">مخزون</div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="my-2">
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
      <kit-warehouse
          :warehouse="warehouse"
          v-if="warehouse.length > 0 && tab == 'stock'"
        />
        <kit-income-ivoice
          :incoming_invoices="incomeIvoice"
          v-if="tab == 'incomeIvoice'"
        />
        <kit-note :note="note" v-if="tab == 'note'" :id="props.id" />
        <kit-attachment
          :attachment="attachment"
          v-if="tab == 'attachment'"
          :id="props.id"
        />
        <kit-image :image="image" v-if="tab == 'image'" :id="props.id" />
      </div>
    </div>
  </div>
</template>
<script setup>
import { computed, provide, readonly, reactive, ref } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import KitWarehouse from "./KitWarehouse.vue";
import KitIncomeIvoice from "./KitIncomeIvoice.vue";
import KitNote from "./KitNote.vue";
import KitAttachment from "./KitAttachment.vue";
import KitImage from "./KitImage.vue";
const tab = ref();

const props = defineProps([
  "warehouse",
  "stockData",
  "Sstock",
  "incomeIvoice",
  "stratStock",
  "note",
  "attachment",
  "image",
  "id",
]);
const warehouse = props.warehouse;
const stockData = props.stockData;
const incomeIvoice = props.incomeIvoice;
const stratStock = props.stratStock;
const note = computed(() => props.note);
const attachment = computed(() => props.attachment);
const image = computed(() => props.image);

if (warehouse.length > 0) {
  tab.value = "stock";
}
function tabClick(inputTab) {
  tab.value = inputTab;
}
</script>