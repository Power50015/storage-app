<template>
  <AppLayout title="الكاش">
    <SectionTemplate class="pb-0">
      <h2 class="font-bold text-xl mb-5">بيانات الكاش</h2>
      <div class="grid grid-cols-2 gap-2">
        <div>
          <btn-info :element="Link" :to="route('cash.create')" class="mb-3">
            أضف كاش
          </btn-info>
          <btn-success :element="Link" :to="route('cash-pay.create')" >
            أضف مبلغ للكاش
          </btn-success>
        </div>
        <div class="grid grid-cols-2 gap-2">
          <CardWarning class="mx-3">
            <h4 class="mb-3">عدد طرق الكاش المتاحه</h4>
            <h4 class="text-xl font-bold">{{ totalCashesWay }}</h4>
          </CardWarning>
          <CardDanger>
            <h4 class="mb-3">إجمالى الكاش</h4>
            <h4 class="text-xl font-bold">{{ totalCashes }}</h4>
          </CardDanger>
        </div>
      </div>
    </SectionTemplate>
    <SectionTemplate>
      <h2 class="font-bold">بيانات الكاش</h2>
      <InputText v-model="search" placeholder="بحث ...." />
      <table class="min-w-max w-full table-auto mt-5">
        <tbody>
          <tr class="text-right" v-for="item in cash.data" :key="item.index">
            <td class="py-3 px-6 whitespace-nowrap text-right">
              <div class="flex items-center justify-start">
                <Link :href="route('cash.show', item.id)" class="hover:text-[#009ef7]">
                <h3 class="pb-3 font-bold">
                  {{ item.title }}
                </h3>
                </Link>
              </div>
            </td>
            <td class="py-3 px-6 text-left">
              <div class="flex items-left justify-end">
                المتاح : {{ item.available }}
              </div>
            </td>

            <td class="py-3 px-6 text-left">
              <div class="flex items-left justify-end">
                <div class="mr-2">
                  <img class="w-6 h-6 rounded-full" :src="item.user.profile_photo_url" />
                </div>
                <Link :href="route('cash.show', item.id)" class="hover:text-[#009ef7]">
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
            </td>
          </tr>
        </tbody>
      </table>
      <Pagination :links="cash.links" v-if="cash.data.length" />
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
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import InputTextArea from "@/Forms/InputTextArea.vue";
import BtnPrimary from "@/Components/Buttons/BtnPrimary.vue";
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
import BtnInfo from "@/Components/Buttons/BtnInfo.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import Modal from "@/Components/Modals/Modal.vue";
import Pagination from "@/Components/Tables/Pagination.vue";
import CardDanger from "@/Components/Cards/Statistics/CardDanger.vue";
import CardWarning from "@/Components/Cards/Statistics/CardWarning.vue";

provide("title", "الكاش");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "الكاش", linkRoute: "#" },
  ])
);

const props = defineProps(["cash","totalCashesWay", "totalCashes", "filters"]);

const cash = computed(() => props.cash);

const search = ref(props.filters.search);

watch(search, (value) => {
  Inertia.get(
    "/cash",
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
