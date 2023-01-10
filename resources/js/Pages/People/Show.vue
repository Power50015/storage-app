<template>
    <AppLayout title="قطع الغيار">
      <SectionTemplate class="print:p-0">
        <div class="flex justify-between md:flex-row	flex-col-reverse">
          <div class="flex justify-around flex-col w-full">
            <h2 class="font-bold mb-3 text-lg">
              {{ people.name }}
            </h2>
            <h2 class="font-bold mb-3 text-lg">
              {{ people.phone }}
            </h2>
            <h2 class="font-bold mb-3 text-lg">
              {{ people.address }}
            </h2>
            <h2 class="title font-bold text-lg text-[#009ef7]">
                الرصيد : ( {{ people.balance }} )
            </h2>
            <div class="flex print:hidden">
              <btn-info
                :element="Link"
                :to="route('people.edit', people.id)"
                class="mt-4"
              >
              تعديل بيانات
              </btn-info>
              <btn-success
                element="a"
                :href="`/people-excel/${people.id}`"
                class="mt-4 mx-3"
              >
               تحميل كشف حساب
              </btn-success>
            </div>
          </div>
          <div>
            <a :href="`/storage/${people.logo}`" target="_blank">
              <img
                :src="`/storage/${people.logo}`"
                :alt="people.name"
                class="
                  w-[270px]
                  h-[270px]
                  object-center object-cover
                  group-hover:opacity-75
                  shadow-xl
                  rounded-md
                "
                height="270"
                width="270"
            /></a>
          </div>
        </div>
      </SectionTemplate>
      <SectionTemplate class="print:p-0">
         <PeopleTabs :id="people.id" />
      </SectionTemplate>
    </AppLayout>
  </template>
  
  <script setup>
  import { reactive, computed, provide, readonly, ref, watch } from "vue";
  import { Link } from "@inertiajs/inertia-vue3";
  import { Inertia } from "@inertiajs/inertia";
  import AppLayout from "@/Layouts/AppLayout.vue";
  import SectionTemplate from "@/Components/SectionTemplate.vue";
  import BtnInfo from "@/Components/Buttons/BtnInfo.vue";
  import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
  import PeopleTabs from "@/Components/People/PeopleTabs.vue";
  
  const props = defineProps(["people"]);
  
  provide("title", "قطع الغيار");
  provide(
    "breadcrumb",
    readonly([
      { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
      { index: 1, linkTitle: "الشركات", linkRoute: "people.index" },
      {
        index: 2,
        linkTitle: "  " + props.people[0].name,
        linkRoute: "#",
      },
    ])
  );
  
  const people = computed(() => props.people[0]);
  </script>