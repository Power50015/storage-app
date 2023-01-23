<template>
  <nav
    class="
      dark:bg-[#1e1e2d] dark:text-white
      flex flex-col
      xl:flex-row xl:h-[80px]
      h-[210px]
      items-center
      dark:border-b-1
      border-[#323248]
      fixed
      inset-0
      w-full
      xl:py-[40px]
      bg-white
      z-50
      print:hidden
    "
  >
    <div
      class="
        bg-[#1e1e2d]
        logo-section
        flex flex-row
        items-center
        justify-between
        w-full
        xl:w-[265px] xl:border-b-1
        dark:border-[#323248]
        shrink-0
        h-[80px]
        px-7
      "
    >
      <Link :href="route('dashboard')">
        <img
          src="../../image/logo.svg"
          alt="logo"
          class="h-[25px] block"
        />
      </Link>
      <button
        class="p-5 flex text-white xl:hidden"
        @click="$emit('asideShowMobile')"
      >
        <i class="fa-solid fa-bars"></i>
      </button>
      <button
        class="p-5 hidden xl:flex text-white"
        @click="$emit('asideShowDesktop')"
      >
        <i class="fa-solid fa-arrow-right-to-bracket"></i>
      </button>
    </div>
    <div
      class="
        flex flex-col
        xl:flex-row xl:justify-between
        w-full
        py-4
        xl:px-8
        px-5
      "
    >
      <div class="page-title-section">
        <div class="title font-bold">{{ title }}</div>
        <div class="rounded-md w-full">
          <ol class="list-reset flex">
            <div v-for="item in breadcrumb" :key="item['index']" class="flex">
              <li v-if="item['linkRoute'] != '#'">
                <Link
                  :href="route(item['linkRoute'])"
                  class="
                    dark:text-[#565674]
                    dark:hover:text-blue-[#009ef7]
                    dark:hover:text-[#009ef7]
                  "
                  >{{ item["linkTitle"] }}</Link
                >
              </li>
              <li class="text-slate-600" v-if="item['linkRoute'] == '#'">
                {{ item["linkTitle"] }}
              </li>
              <li v-if="breadcrumb.length > item['index'] + 1">
                <span class="dark:text-[#565674] mx-2">-</span>
              </li>
            </div>
          </ol>
        </div>
      </div>
      <div class="fast-links flex items-center">
        <h5
          class="
            xl:px-3
            flex
            items-center
            font-bold
            xl:border-r-1
            border-[#323248]
            min-h-[50px]
          "
        >
          روابط سريعه :-
        </h5>
        <Link
          :href="route('outgoing-invoice.create')"
          class="px-3 dark:text-[#565674] dark:hover:text-[#009ef7]"
          title="فاتوره صادره جديدة"
        >
          <i class="fa-solid fa-file-invoice-dollar"></i>
        </Link>
        <Link
          :href="route('debtor-pay.create')"
          class="px-3 dark:text-[#565674] dark:hover:text-[#009ef7]"
          title="دفعه مدين"
        >
          <i class="fa-solid fa-hand-holding-dollar"></i>
        </Link>
        <Link
          :href="route('expense.index')"
          class="px-3 dark:text-[#565674] dark:hover:text-[#009ef7]"
          title="مصاريف"
        >
          <i class="fa-solid fa-coins"></i>
        </Link>
        <button
          class="px-3 text-slate-600 dark:text-slate-100"
          title="الوضع المظلم"
          @click="toggleDarkMode"
        >
          <i class="fa-solid fa-circle-half-stroke"></i>
        </button>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { inject } from "@vue/runtime-core";

const title = inject("title", "");
const breadcrumb = inject("breadcrumb", {});

function toggleDarkMode() {
  document.body.classList.toggle("dark");
}
</script>

<style scoped></style>
