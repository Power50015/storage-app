<template>
  <div class="print:hidden">
    <div class="tabs mb-3">
      <ul class="flex">
        <li
          class="my-3 mx-5 cursor-pointer"
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
            tab == 'actionData'
              ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
              : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
          "
        >
          <div class="px-5 py-3" @click="tabClick('actionData')">
            بيانات التحركات
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
          <div class="px-5 py-3" @click="tabClick('attachment')">الملفات</div>
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
      </ul>
    </div>
  </div>
  <div>
    <kit-stock :kit="id" v-if="tab == 'stock'"/>
    <!-- <kit-warehouse
      :warehouse="warehouse"
      v-if="warehouse.length > 0 && tab == 'stock'"
    /> -->
    <kit-action :kit="id" v-if="tab == 'actionData'" />
    <kit-note :note="note" v-if="tab == 'note'" :id="props.id" />
    <kit-attachment
      :attachment="attachment"
      v-if="tab == 'attachment'"
      :id="props.id"
    />
    <kit-image :image="image" v-if="tab == 'image'" :id="props.id" />
  </div>
</template>
<script setup>
import { computed, provide, readonly, reactive, ref } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import KitWarehouse from "./KitWarehouse.vue";
import KitAction from "./KitAction.vue";
import KitIncomeIvoice from "./KitIncomeIvoice.vue";
import KitNote from "./KitNote.vue";
import KitAttachment from "./KitAttachment.vue";
import KitImage from "./KitImage.vue";
import KitStock from "./KitStock.vue";
const tab = ref("stock");

const props = defineProps([
  "note",
  "attachment",
  "image",
  "id",
]);
const warehouse = props.warehouse;
const note = computed(() => props.note);
const attachment = computed(() => props.attachment);
const image = computed(() => props.image);

function tabClick(inputTab) {
  tab.value = inputTab;
}
</script>