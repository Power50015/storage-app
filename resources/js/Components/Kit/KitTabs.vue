<template>
  <div class="print:hidden">
    <div class="tabs mb-3">
      <perfect-scrollbar>
        <ul class="flex">
          <li class="my-3 mx-5 cursor-pointer" :class="
            tab == 'des'
              ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
              : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
          " v-if="description != null ">
            <div class="px-5 py-3" @click="tabClick('des')">الوصف</div>
          </li>
          <li class="my-3 mx-5 cursor-pointer" :class="
            tab == 'stock'
              ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
              : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
          ">
            <div class="px-5 py-3" @click="tabClick('stock')">
              المتاح بالمخازن
            </div>
          </li>
          <li class="my-3 mx-5" :class="
            tab == 'actionData'
              ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
              : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
          ">
            <div class="px-5 py-3" @click="tabClick('actionData')">
              بيانات التحركات
            </div>
          </li>
          <li class="my-3 mx-5" :class="
            tab == 'note'
              ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
              : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
          ">
            <div class="px-5 py-3" @click="tabClick('note')">الملاحظات</div>
          </li>
          <li class="my-3 mx-5" :class="
            tab == 'attachment'
              ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
              : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
          ">
            <div class="px-5 py-3" @click="tabClick('attachment')">الملفات</div>
          </li>
          <li class="my-3 mx-5" :class="
            tab == 'image'
              ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
              : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
          ">
            <div class="px-5 py-3" @click="tabClick('image')">الصور</div>
          </li>
        </ul>
      </perfect-scrollbar>
    </div>
  </div>
  <div>
    <div v-if="tab == 'des'" v-html="description"></div>
    <kit-stock :kit="id" v-if="tab == 'stock'" />
    <kit-action :kit="id" v-if="tab == 'actionData'" />
    <note-board v-if="tab == 'note'" :id="props.id" url="kit-note" />
    <file-board v-if="tab == 'attachment'" :id="props.id" url="kit-attachment" />
    <image-board v-if="tab == 'image'" :id="props.id" url="kit-image" />
  </div>
</template>
<script setup>
import { ref } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import KitAction from "./KitAction.vue";
import NoteBoard from "../Board/NoteBoard.vue";
import KitStock from "./KitStock.vue";
import FileBoard from "../Board/FileBoard.vue";
import ImageBoard from "../Board/ImageBoard.vue";
const tab = ref("actionData");

const props = defineProps(["id", "description"]);

function tabClick(inputTab) {
  tab.value = inputTab;
}
</script>