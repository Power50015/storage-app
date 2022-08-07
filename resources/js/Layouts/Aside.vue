<template>
  <div
    class="
      shrink-0
      lg:block
      top-[-210px]
      lg:top-auto lg:static
      absolute
      h-full
      print:hidden
    "
    :class="{
      'lg:w-[265px] ': asideOpenStateDesktop,
      'lg:w-0 ': !asideOpenStateDesktop,
    }"
  >
    <aside
      class="
        w-[265px]
        h-full
        flex-col
        bg-[#1e1e2d]
        items-center
        border-border-[#323248]
        lg:fixed
        fixed
        transition-all
        lg:block
        duration-1000
      "
      :class="{
        'lg:right-0 ': asideOpenStateDesktop,
        'lg:right-[-300px]': !asideOpenStateDesktop,
        'right-0': asideOpenStateMobile,
        'right-[-300px]': !asideOpenStateMobile,
      }"
    >
      <UserCard />
      <ul class="text-white">
        <li
          class="
            pt-5
            text-center text-xs
            border-t border-[#323248]
            text-slate-600
            block
          "
        >
          الأكثر إستخداماً
        </li>
        <li class="mx-5">
          <Link
            href="/"
            class="py-3 px-4 block rounded-lg my-3"
            :class="
              route().current('dashboard')
                ? 'bg-[#009ef7]'
                : 'hover:text-[#009ef7]'
            "
          >
            <i class="fa-solid fa-gauge-high"></i>
            <span class="mx-3">لوحه التحكم</span>
          </Link>
        </li>
        <li class="mx-5">
          <Link
            :href="route('expense.index')"
            class="py-3 px-4 block rounded-lg my-3"
            :class="
              route().current('expense.index')
                ? 'bg-[#009ef7]'
                : 'hover:text-[#009ef7]'
            "
          >
            <i class="fa-solid fa-coins"></i>
            <span class="mx-3">المصاريف</span>
          </Link>
        </li>
        <li class="mx-5">
          <Link
            :href="route('incoming-invoice.index')"
            class="py-3 px-4 block rounded-lg my-3"
            :class="
              route().current('incoming-invoice.*')
                ? 'bg-[#009ef7]'
                : 'hover:text-[#009ef7]'
            "
          >
            <i class="fa-solid fa-file-lines"></i>
            <span class="mx-3">الفاوتير الوارده</span>
          </Link>
        </li>
        <li class="mx-5">
          <Link
            :href="route('outgoing-invoice.create')"
            class="py-3 px-4 block rounded-lg my-3"
            :class="
              route().current('outgoing-invoice.create') ||
              route().current('outgoing-invoice.index')
                ? 'bg-[#009ef7]'
                : 'hover:text-[#009ef7]'
            "
          >
            <i class="fa-solid fa-file-invoice"></i>
            <span class="mx-3">الفاوتير الصادرة</span>
          </Link>
        </li>
        <li class="mx-5">
          <Link
            :href="route('debtor.create')"
            class="py-3 px-4 block rounded-lg my-3"
            :class="
              route().current('debtor.create') ||
              route().current('debtor.index')
                ? 'bg-[#009ef7]'
                : 'hover:text-[#009ef7]'
            "
          >
            <i class="fa-solid fa-hand-holding-dollar"></i>
            <span class="mx-3">مدينون</span>
          </Link>
        </li>
        <li
          class="
            pt-5
            text-center text-xs
            border-t border-[#323248]
            text-slate-600
            block
          "
        >
          الأقل إستخداماً
        </li>
        <li class="mx-5">
          <Link
            :href="route('creditor.create')"
            class="py-3 px-4 block rounded-lg my-3"
            :class="
              route().current('creditor.*')
                ? 'bg-[#009ef7]'
                : 'hover:text-[#009ef7]'
            "
          >
            <i class="fa-solid fa-money-check-dollar"></i>
            <span class="mx-3">دائنون</span>
          </Link>
        </li>
        <li class="mx-5">
          <Link
            :href="route('kit.index')"
            class="py-3 px-4 block rounded-lg my-3"
            :class="
              route().current('kit.*') ? 'bg-[#009ef7]' : 'hover:text-[#009ef7]'
            "
          >
            <i class="fa-brands fa-buffer"></i>
            <span class="mx-3">قطع الغيار</span>
          </Link>
        </li>
        <li class="mx-5">
          <Link
            :href="route('people.index')"
            class="py-3 px-4 block rounded-lg my-3"
            :class="
              route().current('people.index')
                ? 'bg-[#009ef7]'
                : 'hover:text-[#009ef7]'
            "
          >
            <i class="fas fa-user-friends"></i>
            <span class="mx-3">العملاء و الموردين</span>
          </Link>
        </li>
        <li class="mx-5">
          <Link
            :href="route('cash.index')"
            class="py-3 px-4 block rounded-lg my-3"
            :class="
              route().current('cash.index')
                ? 'bg-[#009ef7]'
                : 'hover:text-[#009ef7]'
            "
          >
            <i class="fa-solid fa-money-bill-1-wave"></i>
            <span class="mx-3">الكاش</span>
          </Link>
        </li>
        <li class="mx-5">
          <Link
            :href="route('product.index')"
            class="py-3 px-4 block rounded-lg my-3"
            :class="
              route().current('product.index')
                ? 'bg-[#009ef7]'
                : 'hover:text-[#009ef7]'
            "
          >
            <i class="fa-solid fa-box"></i>
            <span class="mx-3">المنتجات</span>
          </Link>
        </li>
        <li class="mx-5">
          <Link
            :href="route('warehouse.index')"
            class="py-3 px-4 block rounded-lg my-3"
            :class="
              route().current('warehouse.index')
                ? 'bg-[#009ef7]'
                : 'hover:text-[#009ef7]'
            "
          >
            <i class="fas fa-warehouse"></i>
            <span class="mx-3">المخازن</span>
          </Link>
        </li>
      </ul>
    </aside>
    <div
      class="aside-overlay lg:hidden"
      :class="{
        block: asideOpenStateMobile,
        hidden: !asideOpenStateMobile,
      }"
      @click="$emit('asideShowMobile')"
    ></div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import UserCard from "@/Layouts/UserCard.vue";

import { inject } from "@vue/runtime-core";

const asideOpenStateDesktop = inject("asideOpenStateDesktop");
const asideOpenStateMobile = inject("asideOpenStateMobile");
</script>

<style scoped>
aside {
  z-index: 81;
}
.aside-overlay {
  width: 100vw;
  height: 100%;
  background: #eeeeee26;
  z-index: 80;
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
}
</style>
