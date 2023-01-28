<template>
  <AppLayout title="الشركات">
    <SectionTemplate class="pb-0">
      <div class="grid lg:grid-cols-3  grid-cols-1 gap-1.5">
        <CardPrimary>
          <h4 class="mb-3"> الشركات</h4>
          <h4 class="text-xl font-bold">
            {{ peopleCount }}
          </h4>
        </CardPrimary>
        <CardInfo>
          <h4 class="mb-3">عدد الدائنون</h4>
          <h4 class="text-xl font-bold">
            {{ peopleCreditor }}
          </h4>
        </CardInfo>
        <CardSuccess>
          <h4 class="mb-3">عدد المدينون</h4>
          <h4 class="text-xl font-bold">
            {{ peopleDebtor }}
          </h4>
        </CardSuccess>
      </div>
    </SectionTemplate>
    <SectionTemplate>
      <div class="flex content-center items-center justify-between">
        <h2 class="title font-bold">الشركات</h2>
        <btn-info :element="Link" :to="route('people.create')">
          أضف شركه
        </btn-info>
      </div>
      <div class="w-full">
        <div
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
          <div v-for="i in people.data" :key="i.date">
            <div>
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
            </div>
          </div>
        </div>
      </div>
      <Pagination :links="people.links" v-if="people.data.length" />
    </SectionTemplate>
  </AppLayout>
</template>

<script setup>
import { computed, provide, readonly, ref, watch,onMounted } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import DataTable from "datatables.net-vue3";
import BtnInfo from "@/Components/Buttons/BtnInfo.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import InputText from "@/Forms/InputText.vue";
import Pagination from "@/Components/Tables/Pagination.vue";
import CardPrimary from "@/Components/Cards/Statistics/CardPrimary.vue";
import CardInfo from "@/Components/Cards/Statistics/CardInfo.vue";
import CardSuccess from "@/Components/Cards/Statistics/CardSuccess.vue";

provide("title", "الشركات");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "الشركات", linkRoute: "#" },
  ])
);

const props = defineProps(["people", "peopleCount", "filters","peopleCreditor","peopleDebtor"]);


const search = ref(props.filters.search);

watch(search, (value) => {
  Inertia.get(
    "/people",
    {
      search: value,
    },
    {
      preserveState: true,
      replace: true,
      preserveScroll: true,
    }
  );
});

</script>