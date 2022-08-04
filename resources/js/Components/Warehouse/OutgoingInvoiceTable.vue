<template>
  <DataTable class="outgoing_invoices" :options="options">
    <thead>
      <tr>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="i in outgoing_invoices" :key="i.number">
        <td>
          <div
            class="
              flex
              content-center
              items-center
              justify-between
              hover:gray-500
              item
              py-3
              border-b
            "
          >
            <Link
              :href="route('warehouse.index')"
              class="data hover:text-[#009ef7]"
            >
              <h3 class="">رقم الفاتوره : {{ i.id }}</h3>
              <div class="text-sm pb-3">{{ i.date }}</div>
              <div class="text-sm">{{ i.people.name }}</div>
              <div class="text-sm">
                نوع الدفع : <span v-if="i.pay_type == 0">على الحساب</span>
                <span v-if="i.pay_type == 1">كاش</span>
              </div>
            </Link>
          </div>
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr></tr>
    </tfoot>
  </DataTable>
</template>
<script setup>
import { reactive, ref } from "vue";
import { computed, provide, readonly } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import DataTable from "datatables.net-vue3";

const options = {
  pageLength: 10,
  lengthChange: false,
  info: false,
  language: {
    search: "بحث : ",
    paginate: {
      next: "التالى",
      previous: "السابق",
    },
  },
};
const props = defineProps(["outgoing_invoices"]);
const outgoing_invoices = props.outgoing_invoices;
</script>
<style>
/* @import "datatables.net-dt"; */
.outgoing_invoices {
  margin-top: 10px;
  width: 100% !important;
  text-align: right !important;
}
.dataTables_filter input {
  @apply text-sm text-gray-900 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-[#1b1b29] bg-[#f5f8fa] dark:border-gray-600 dark:placeholder-gray-400 mx-2;
}
.dataTables_paginate {
  @apply my-3 flex;
  justify-content: flex-start;
}
.dataTables_paginate span {
  @apply flex;
}
.paginate_button {
  @apply mx-2 bg-[#009ef7] border border-transparent rounded-md py-3 px-5 flex items-center justify-center text-base  text-sm text-white hover:bg-[#009ef7] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#009ef7] cursor-pointer;
}
.disabled,
.disabled:hover,
.current,
.current:hover {
  background: #151521;
  cursor: auto;
  outline: none;
  outline-offset: 0;
  box-shadow: none;
}
</style>