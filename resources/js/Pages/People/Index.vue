<template>
  <AppLayout title="الشركات">
    <SectionTemplate>
      <div class="flex content-center items-center justify-between">
        <h2 class="title font-bold">الشركات</h2>
        <btn-info :element="Link" :to="route('people.create')">
          أضف شركه
        </btn-info>
      </div>
      <DataTable class="w-full" :options="options">
        <thead>
          <tr>
            <th></th>
          </tr>
        </thead>
        <tbody
          class="
            grid grid-cols-2
            gap-y-10
            sm:grid-cols-4
            gap-x-6
            lg:grid-cols-6
            xl:grid-cols-8 xl:gap-x-8
            mt-5
          "
        >
          <tr v-for="i in people" :key="i.date">
            <td>
              <Link :href="route('people.show', i.id)" class="group">
                <div
                  class="
                    w-full
                    aspect-w-1 aspect-h-1
                    bg-gray-200
                    rounded-lg
                    overflow-hidden
                    xl:aspect-w-7 xl:aspect-h-8
                    hover:text-[#009ef7]
                  "
                >
                  <img
                    :src="`/storage/${i.logo}`"
                    :alt="i.title"
                    class="
                      w-full
                      h-[118px]
                      object-center object-cover
                      group-hover:opacity-75
                    "
                    height="118"
                    width="118"
                  />
                </div>
                <div>
                  <h3 class="mt-1 text-md font-bold text-[#009ef7]">
                    {{ i.name }}
                  </h3>
                  <h3 class="text-sm">
                    <template v-if="i.type"> {{ i.type }} </template>
                  </h3>
                </div>
              </Link>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr></tr>
        </tfoot>
      </DataTable>
    </SectionTemplate>
  </AppLayout>
</template>

<script setup>
import { provide, readonly } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";

import DataTable from "datatables.net-vue3";
import BtnInfo from "@/Components/Buttons/BtnInfo.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";

provide("title", "الشركات");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "الشركات", linkRoute: "#" },
  ])
);

const options = {
  pageLength: 48,
  lengthChange: false,
  info: false,
  language: {
    search: "بحث : ",
    paginate: {
      next: "التالى",
      previous: "السابق",
    },
    emptyTable: "الجدول فارغ",
    zeroRecords: "لا يوجد نتائج",
  },
  order: [0],
};

const props = defineProps(["people"]);
</script>