<template>
  <AppLayout title="المخازن">
    <div class="py-6 print:py-0">
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
          <div class="title">
            <h2 class="title font-bold mb-2 text-xl">{{ warehouse.name }}</h2>
            <div v-html="warehouse.address" class="mb-4 text-sm"></div>
          </div>
          <div class="tabs print:hidden">
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
                  محتوى المخزن
                </div>
              </li>
              <li
                class="my-3 mx-5"
                :class="
                  tab == 'invoiceIncome'
                    ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                    : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
                "
              >
                <div class="px-5 py-3" @click="tabClick('invoiceIncome')">
                  الفواتير الوارده
                </div>
              </li>
              <li
                class="my-3 mx-5"
                :class="
                  tab == 'invoiceOutgoing'
                    ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                    : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
                "
              >
                <div class="px-5 py-3" @click="tabClick('invoiceOutgoing')">
                  الفواتير الصادره
                </div>
              </li>
              <li
                class="my-3 mx-5"
                :class="
                  tab == 'transferIncome'
                    ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                    : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
                "
              >
                <div class="px-5 py-3" @click="tabClick('transferIncome')">
                  نقله صادره
                </div>
              </li>
              <li
                class="my-3 mx-5"
                :class="
                  tab == 'transferOutgoing'
                    ? 'border-[#009ef7] text-[#009ef7] border-b-2 font-bold'
                    : 'hover:border-b-2 cursor-pointer hover:text-[#0095e8] hover:border-[#0095e8] transition-all'
                "
              >
                <div class="px-5 py-3" @click="tabClick('transferOutgoing')">
                  نقله وارده
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="">
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
          <stock-table
            :products="warehouse.stock_products"
            :kits="warehouse.kits"
            v-if="tab == 'stock'"
          />
          <incoming-invoice-table
            :incoming_invoices="warehouse.incoming_invoices"
            v-if="tab == 'invoiceIncome'"
          />
          <outgoing-invoice-table
            :outgoing_invoices="warehouse.outgoing_invoices"
            v-if="tab == 'invoiceOutgoing'"
          />
          <transfer-from-table
            :transfer_froms="warehouse.transfer_froms"
            v-if="tab == 'transferIncome'"
          />
          <transfer-to-table
            :transfer_tos="warehouse.transfer_tos"
            v-if="tab == 'transferOutgoing'"
          />
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { reactive, ref } from "vue";
import { computed, provide, readonly } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import StockTable from "@/Components/Warehouse/StockTable.vue";
import IncomingInvoiceTable from "@/Components/Warehouse/IncomingInvoiceTable.vue";
import OutgoingInvoiceTable from "@/Components/Warehouse/OutgoingInvoiceTable.vue";
import TransferFromTable from "@/Components/Warehouse/TransferFromTable.vue";
import TransferToTable from "@/Components/Warehouse/TransferToTable.vue";

const props = defineProps(["warehouse"]);

const warehouse = props.warehouse;

provide("title", "المخازن");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "المخازن", linkRoute: "warehouse.index" },
    { index: 2, linkTitle: warehouse.name, linkRoute: "#" },
  ])
);

const tab = ref("stock");

function tabClick(inputTab) {
  tab.value = inputTab;
}
</script>