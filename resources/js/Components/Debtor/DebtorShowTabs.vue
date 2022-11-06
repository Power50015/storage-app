<template>
    <div class="print:hidden">
      <div class="tabs mb-3">
        <perfect-scrollbar>
          <ul class="flex">
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
      <note-board v-if="tab == 'note'" :id="props.id" url="debtor-note" />
      <file-board
        v-if="tab == 'attachment'"
        :id="props.id"
        url="debtor-attachment"
      />
      <image-board v-if="tab == 'image'" :id="props.id" url="debtor-image" />
    </div>
  </template>
  <script setup>
  import { ref } from "@vue/runtime-core";
  import { Link } from "@inertiajs/inertia-vue3";
  import { Inertia } from "@inertiajs/inertia";
  import NoteBoard from "../Board/NoteBoard.vue";
  import FileBoard from "../Board/FileBoard.vue";
  import ImageBoard from "../Board/ImageBoard.vue";
  const tab = ref("note");
  
  const props = defineProps(["id"]);
  
  function tabClick(inputTab) {
    tab.value = inputTab;
  }
  </script>