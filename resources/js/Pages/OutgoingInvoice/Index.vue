<template>
  <AppLayout title="الفواتير الصادره">
    <SectionTemplate class="pb-0">
      <h2 class="font-bold text-xl mb-5">الفواتير الصادره</h2>
      <div class="grid lg:grid-cols-5 grid-cols-1 gap-1.5">
        <CardPrimary>
          <h4 class="mb-3">الفواتير اليوم</h4>
          <h4 class="text-xl font-bold">
            {{ totalOutgoingInvoiceThisDay }}
          </h4>
        </CardPrimary>
        <CardInfo>
          <h4 class="mb-3">الفواتير الأسبوع</h4>
          <h4 class="text-xl font-bold">
            {{ totalOutgoingInvoiceThisWeek }}
          </h4>
        </CardInfo>
        <CardDanger>
          <h4 class="mb-3">الفواتير الشهر</h4>
          <h4 class="text-xl font-bold">
            {{ totalOutgoingInvoiceThisMonth }}
          </h4>
        </CardDanger>
        <CardSuccess>
          <h4 class="mb-3">الفواتير السنه</h4>
          <h4 class="text-xl font-bold">
            {{ totalOutgoingInvoiceThisYear }}
          </h4>
        </CardSuccess>
        <CardWarning>
          <h4 class="mb-3">الفواتير على النظام</h4>
          <h4 class="text-xl font-bold">
            {{ totalOutgoingInvoice }}
          </h4>
        </CardWarning>
      </div>
    </SectionTemplate>
    <SectionTemplate>
      <div class="flex content-center items-center justify-between mb-2">
        <h2 class="font-bold">بيانات الفواتير الصادره</h2>
        <btn-info :element="Link" :to="route('outgoing-invoice.create')">
          فاتوره جديده
        </btn-info>
      </div>
      <InputText v-model="search" placeholder="بحث ...." />
      <table class="min-w-max w-full table-auto mt-5">
        <tbody>
          <tr
            class="text-right flex flex-col lg:flex-row items-start lg:items-center"
            v-for="item in outgoing_invoices.data"
            :key="item.index"
          >
            <td class="py-3 px-6 whitespace-nowrap text-right">
              <Link
                :href="route('outgoing-invoice.show', item.id)"
                class="data hover:text-[#009ef7]"
              >
                <h3 class="pb-2">رقم الفاتوره : {{ item.id }}</h3>
                <div class="text-sm pb-3">
                  {{
                    new Date(item.date).toLocaleDateString("ar-EG-u-nu-latn", {
                      weekday: "long",
                      year: "numeric",
                      month: "short",
                      day: "numeric",
                    })
                  }}
                </div>
              </Link>
            </td>
            <td class="py-3 px-6 text-center">
              <Link
                :href="route('people.show', item.people.id)"
                class="data hover:text-[#009ef7]"
              >
                <div class="pb-2">{{ item.people.name }}</div>
                <div class="text-sm">
                  نوع الدفع :
                  <span v-if="item.pay_type == 0">على الحساب</span>
                  <span v-if="item.pay_type == 1">كاش</span>
                </div>
              </Link>
            </td>
            <td class="py-3 px-6 text-center">
              <div class="text-md text-[#50cd89] text-center">
                <div class="pb-2">إجمالى بعد الخصم</div>
                {{ item.total }}
              </div>
            </td>

            <td class="py-3 px-6 text-left">
              <div class="flex items-left justify-end">
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
            </td>
          </tr>
        </tbody>
      </table>
      <Pagination
        :links="outgoing_invoices.links"
        v-if="outgoing_invoices.data.length"
      />
      <div v-else>لا يوجد بيانات</div>
    </SectionTemplate>
  </AppLayout>
</template>

<script setup>
import { reactive, computed, provide, readonly, ref, watch } from "vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionTemplate from "@/Components/SectionTemplate.vue";
import Pagination from "@/Components/Tables/Pagination.vue";
import BtnInfo from "@/Components/Buttons/BtnInfo.vue";
import InputText from "@/Forms/InputText.vue";
import CardPrimary from "@/Components/Cards/Statistics/CardPrimary.vue";
import CardInfo from "@/Components/Cards/Statistics/CardInfo.vue";
import CardDanger from "@/Components/Cards/Statistics/CardDanger.vue";
import CardSuccess from "@/Components/Cards/Statistics/CardSuccess.vue";
import CardWarning from "@/Components/Cards/Statistics/CardWarning.vue";

provide("title", "الفواتير الصادره");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "الفواتير الصادره", linkRoute: "#" },
  ])
);

const props = defineProps([
  "filters",
  "outgoingInvoice",
  "totalOutgoingInvoice",
  "totalOutgoingInvoiceThisDay",
  "totalOutgoingInvoiceThisWeek",
  "totalOutgoingInvoiceThisMonth",
  "totalOutgoingInvoiceThisYear",
]);

const outgoing_invoices = computed(() => props.outgoingInvoice);

const search = ref(props.filters.search);

watch(search, (value) => {
  Inertia.get(
    "/outgoing-invoice",
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
