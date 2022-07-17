<template>
  <div>
    <Head :title="title" />
    <div class="min-h-screen dark:bg-[#151521] bg-[#f5f8fa] overflow-hidden">
      <Navbar
        @aside-show-desktop="asideShowDesktop"
        @aside-show-mobile="asideStateMobile"
      />

      <!-- Page Content -->
      <main class="flex h-full">
        <div class="relative lg:top-[80px] top-[210px]">
          <Aside @aside-show-mobile="asideStateMobile" />
        </div>
        <div class="w-full lg:mt-[80px] mt-[210px]"><slot /></div>
      </main>
    </div>
  </div>
</template>
<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Navbar from "@/Layouts/Navbar.vue";
import Aside from "@/Layouts/Aside.vue";
import { provide } from "@vue/runtime-core";

const asideOpenStateMobile = ref(false);
const asideOpenStateDesktop = ref(true);

defineProps({
  title: String,
});

function asideShowDesktop() {
  asideOpenStateDesktop.value = !asideOpenStateDesktop.value;
}
provide("asideOpenStateDesktop", asideOpenStateDesktop);

function asideStateMobile() {
  asideOpenStateMobile.value = !asideOpenStateMobile.value;
}
provide("asideOpenStateMobile", asideOpenStateMobile);
</script>
