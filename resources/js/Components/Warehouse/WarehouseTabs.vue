<template>
  <div class="print:hidden">
    <div class="tabs mb-3">
      <perfect-scrollbar>
        <ul class="flex">
          <li
            class="my-3 mx-5"
            :class="
              tab == 'stockData'
                ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
            "
          >
            <div class="px-5 py-3" @click="tabClick('stockData')">
              محتوى المخزن
            </div>
          </li>
          <li
            class="my-3 mx-5"
            :class="
              tab == 'WarehouseDestructibleGoods'
                ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
            "
          >
            <div class="px-5 py-3" @click="tabClick('WarehouseDestructibleGoods')">
               الهالك
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
              tab == 'warehouseActionDetails'
                ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
            "
          >
            <div class="px-5 py-3" @click="tabClick('warehouseActionDetails')">
              بيانات تحركات تفصيليه
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
      </perfect-scrollbar>
    </div>
  </div>
  <div>
    <warehouse-stock :id="id" v-if="tab == 'stockData'" />
    <warehouse-action :id="id" v-if="tab == 'actionData'" />
    <warehouse-action-details :id="id" v-if="tab == 'warehouseActionDetails'" />
    <warehouse-destructible-goods :id="id" v-if="tab == 'WarehouseDestructibleGoods'" />
    <note-board v-if="tab == 'note'" :id="props.id" url="warehouse-note" />
    <file-board
      v-if="tab == 'attachment'"
      :id="props.id"
      url="warehouse-attachment"
    />
    <image-board v-if="tab == 'image'" :id="props.id" url="warehouse-image" />
  </div>
</template>
  <script setup>
import { ref } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import WarehouseStock from "./WarehouseStock.vue";
import WarehouseAction from "./WarehouseAction.vue";
import WarehouseActionDetails from "./WarehouseActionDetails.vue";
import NoteBoard from "../Board/NoteBoard.vue";
import FileBoard from "../Board/FileBoard.vue";
import ImageBoard from "../Board/ImageBoard.vue";
import WarehouseDestructibleGoods from "./WarehouseDestructibleGoods.vue";

const tab = ref("stockData");

const props = defineProps(["id"]);

function tabClick(inputTab) {
  tab.value = inputTab;
}
</script>