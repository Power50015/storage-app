<template>
  <div class="print:hidden">
    <div class="tabs mb-3">
      <perfect-scrollbar>
        <ul class="flex">
          <li
            class="my-3 mx-5 cursor-pointer"
            :class="
              tab == 'debtorPepole'
                ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
            "
          >
            <div class="px-5 py-3" @click="tabClick('debtorPepole')">
              المدينون
            </div>
          </li>
          <li
            class="my-3 mx-5"
            :class="
              tab == 'debtorAction'
                ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
            "
          >
            <div class="px-5 py-3" @click="tabClick('debtorAction')">
              بيانات التحركات
            </div>
          </li>
        </ul>
      </perfect-scrollbar>
    </div>
  </div>
  <div>
    <debtor-pepole v-if="tab == 'debtorPepole'" />
    <debtor-action v-if="tab == 'debtorAction'" />
  </div>
</template>
  <script setup>
import { ref } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import DebtorPepole from "./DebtorPepole.vue";
import DebtorAction from "./DebtorAction.vue";
const tab = ref("debtorPepole");

function tabClick(inputTab) {
  tab.value = inputTab;
}
</script>