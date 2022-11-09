<template>
  <div class="print:hidden">
    <div class="tabs mb-3">
      <perfect-scrollbar>
        <ul class="flex">
          <li
            class="my-3 mx-5 cursor-pointer"
            :class="
              tab == 'creditorPepole'
                ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
            "
          >
            <div class="px-5 py-3" @click="tabClick('creditorPepole')">
              الدائنون
            </div>
          </li>
          <li
            class="my-3 mx-5"
            :class="
              tab == 'creditorAction'
                ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
            "
          >
            <div class="px-5 py-3" @click="tabClick('creditorAction')">
              بيانات التحركات
            </div>
          </li>
        </ul>
      </perfect-scrollbar>
    </div>
  </div>
  <div>
    <creditor-pepole v-if="tab == 'creditorPepole'" />
    <creditor-action v-if="tab == 'creditorAction'" />
  </div>
</template>
  <script setup>
import { ref } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import CreditorPepole from "./CreditorPepole.vue";
import CreditorAction from "./CreditorAction.vue";
const tab = ref("creditorPepole");

function tabClick(inputTab) {
  tab.value = inputTab;
}
</script>