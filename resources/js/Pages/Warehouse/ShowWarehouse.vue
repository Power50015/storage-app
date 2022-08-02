<template>
  <AppLayout title="المخازن">
    <div class="py-6">
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
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { reactive } from "vue";
import { computed, provide, readonly } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";

import AppLayout from "@/Layouts/AppLayout.vue";

provide("title", "المخازن");

const props = defineProps(["warehouse"]);

const warehouse = props.warehouse[0];
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "المخازن", linkRoute: "warehouse.index" },
    { index: 2, linkTitle: warehouse.name, linkRoute: "#" },
  ])
);
</script>