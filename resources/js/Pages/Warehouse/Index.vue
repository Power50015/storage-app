<template>
  <AppLayout title="المخازن">
    <SectionTemplate class="pb-0">
      <h2 class="font-bold text-xl mb-5">بيانات المخازن</h2>
      <div class="grid lg:grid-cols-2 grid-cols-1 gap-1.5">
        <div>
          <btn-info
            :element="Link"
            :to="route('warehouse.create')"
            class="mb-2"
          >
            أضف مخزن
          </btn-info>
          <btn-primary :element="Link" :to="route('warehouse-stock.create')">
            أضف مخزون
          </btn-primary>
        </div>
        <div class="grid lg:grid-cols-2 grid-cols-1 gap-1.5">
          <CardWarning >
            <h4 class="mb-3">عدد المخازن</h4>
            <h4 class="text-xl font-bold">{{ totalWarehouse }}</h4>
          </CardWarning>
          <CardDanger>
            <h4 class="mb-3">عدد المخازن الفارغه</h4>
            <h4 class="text-xl font-bold">{{ totalEmptyWarehouse }}</h4>
          </CardDanger>
        </div>
      </div>
    </SectionTemplate>
    <SectionTemplate>
      <h2 class="font-bold">بيانات المخازن</h2>
      <InputText v-model="search" placeholder="بحث ...." />
      <div class="min-w-max w-full mt-5">
        <div
          class="flex flex-col lg:flex-row justify-between items-center my-3"
          v-for="item in warehouses.data"
          :key="item.index"
        >
          <div class="whitespace-nowrap w-full">
            <div class="flex items-center justify-start">
              <Link
                :href="route('warehouse.show', item.id)"
                class="hover:text-[#009ef7]"
              >
                <h3 class="pb-3 font-bold">
                  {{ item.name }}
                </h3>
                <div v-html="item.address" class="text-xs"></div>
              </Link>
            </div>
          </div>
          <div class="py-3 px-6 lg:text-left w-full">
            <div class="flex lg:items-left lg:justify-end">
              <div class="mr-2">
                <img
                  class="w-6 h-6 rounded-full"
                  :src="item.user.profile_photo_url"
                />
              </div>
              <Link
                :href="route('myProfile', item.user.id)"
                class="hover:text-[#009ef7]"
              >
                <h6 class="mx-2">{{ item.user.name }}</h6>
                <h6 class="mx-2">
                  {{
                    new Date(item.created_at).toLocaleDateString(
                      "ar-EG-u-nu-latn",
                      {
                        weekday: "long",
                        year: "numeric",
                        month: "short",
                        day: "numeric",
                      }
                    )
                  }}
                </h6>
              </Link>
            </div>
          </div>
        </div>
      </div>
      <Pagination :links="warehouses.links" v-if="warehouses.data.length" />
      <div v-else>لا يوجد بيانات</div>
    </SectionTemplate>
  </AppLayout>
</template>

<script setup>
import {
  computed,
  onMounted,
  provide,
  readonly,
  watch,
  reactive,
  ref,
} from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import InputText from "@/Forms/InputText.vue";
import BtnPrimary from "@/Components/Buttons/BtnPrimary.vue";
import BtnInfo from "@/Components/Buttons/BtnInfo.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import Modal from "@/Components/Modals/Modal.vue";
import Pagination from "@/Components/Tables/Pagination.vue";
import CardDanger from "@/Components/Cards/Statistics/CardDanger.vue";
import CardWarning from "@/Components/Cards/Statistics/CardWarning.vue";

provide("title", "المخازن");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "المخازن", linkRoute: "#" },
  ])
);

const props = defineProps([
  "warehouses",
  "filters",
  "totalWarehouse",
]);

const warehouses = computed(() => props.warehouses);


const search = ref(props.filters.search);
const totalEmptyWarehouse = ref();

onMounted(() => {
  axios.get("/warehouse-empty-total").then(function (response) {
    totalEmptyWarehouse.value = response.data;
  });
});

watch(search, (value) => {
  Inertia.get(
    "/warehouse",
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
