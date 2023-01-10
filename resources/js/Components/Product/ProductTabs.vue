<template>
  <div class="print:hidden">
    <div class="tabs mb-3">
      <perfect-scrollbar>
        <ul class="flex">
          <li
            class="my-3 mx-5 cursor-pointer"
            :class="
              tab == 'des'
                ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
            "
            v-if="description != null "
          >
            <div class="px-5 py-3" @click="tabClick('des')">الوصف</div>
          </li>
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
              tab == 'destructibleGoods'
                ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
            "
          >
            <div class="px-5 py-3" @click="tabClick('destructibleGoods')">
              الهالك
            </div>
          </li>
          <li
            class="my-3 mx-5"
            :class="
              tab == 'kits'
                ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
            "
          >
            <div class="px-5 py-3" @click="tabClick('kits')">قطع الغيار</div>
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
    <div v-if="tab == 'des'" v-html="description"></div>
    <product-stock :product="id" v-if="tab == 'stock'" />
    <destructible-goods :product="id" v-if="tab == 'destructibleGoods'" />
    <product-action :product="id" v-if="tab == 'actionData'" />
    <product-kits :product="props.id" v-if="tab == 'kits'" />
    <note-board v-if="tab == 'note'" :id="props.id" url="product-note" />
    <file-board
      v-if="tab == 'attachment'"
      :id="props.id"
      url="product-attachment"
    />
    <image-board v-if="tab == 'image'" :id="props.id" url="product-image" />
  </div>
</template>
<script setup>
import { ref } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import ProductAction from "./ProductAction.vue";
import ProductStock from "./ProductStock.vue";
import DestructibleGoods from "./DestructibleGoods.vue";
import ProductKits from "./ProductKits.vue";
import NoteBoard from "../Board/NoteBoard.vue";
import FileBoard from "../Board/FileBoard.vue";
import ImageBoard from "../Board/ImageBoard.vue";

const tab = ref("stock");

const props = defineProps(["id", "description"]);

function tabClick(inputTab) {
  tab.value = inputTab;
}
</script>