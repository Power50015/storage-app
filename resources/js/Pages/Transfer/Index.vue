<template>
  <AppLayout title="النقلات">
    <SectionTemplate class="pb-0">
      <h2 class="font-bold text-xl mb-5">النقلات</h2>
      <div class="grid grid-cols-5 gap-3">
        <CardPrimary>
          <h4 class="mb-3">النقلات اليوم</h4>
          <h4 class="text-xl font-bold">
            {{ totalTransferThisDay }}
          </h4>
        </CardPrimary>
        <CardInfo>
          <h4 class="mb-3">النقلات الأسبوع</h4>
          <h4 class="text-xl font-bold">
            {{ totalTransferThisWeek }}
          </h4>
        </CardInfo>
        <CardDanger>
          <h4 class="mb-3">النقلات الشهر</h4>
          <h4 class="text-xl font-bold">
            {{ totalTransferThisMonth }}
          </h4>
        </CardDanger>
        <CardSuccess>
          <h4 class="mb-3">النقلات السنه</h4>
          <h4 class="text-xl font-bold">
            {{ totalTransferThisYear }}
          </h4>
        </CardSuccess>
        <CardWarning>
          <h4 class="mb-3">النقلات على النظام</h4>
          <h4 class="text-xl font-bold">
            {{ totalTransfer }}
          </h4>
        </CardWarning>
      </div>
    </SectionTemplate>
    <SectionTemplate>
      <div class="flex content-center items-center justify-between mb-2">
        <h2 class="font-bold">بيانات النقله</h2>
        <btn-info :element="Link" :to="route('transfer.create')">
          نقله جديده
        </btn-info>
      </div>
      <InputText v-model="search" placeholder="بحث ...." />
      <table class="min-w-max w-full table-auto mt-5">
        <tbody>
          <tr
            class="text-right"
            v-for="item in transfer_data.data"
            :key="item.index"
          >
            <td class="py-3 px-6 whitespace-nowrap text-right">
              <Link
                :href="route('transfer.show', item.id)"
                class="data hover:text-[#009ef7]"
              >
                <h3 class="pb-2">رقم النقله : {{ item.id }}</h3>
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
              <div>
                <Link
                  :href="route('warehouse.show', item.warehouse_from_id)"
                  class="data hover:text-[#009ef7]"
                >
                  <div class="pb-2">
                    المخزن المسلم : {{ item.warehouse_from.name }}
                  </div>
                </Link>
              </div>
              <div v-if="item.driver">
                <div>
                  <div class="pb-2">السائق : {{ item.driver.name }}</div>
                </div>
              </div>
            </td>
            <td class="py-3 px-6 text-center">
                <div>
                <Link
                  :href="route('warehouse.show', item.warehouse_to_id)"
                  class="data hover:text-[#009ef7]"
                >
                  <div class="pb-2">
                    المخزن المستلم : {{ item.warehouse_to.name }}
                  </div>
                </Link>
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
        :links="transfer_data.links"
        v-if="transfer_data.data.length"
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

provide("title", "النقلات");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "النقلات", linkRoute: "#" },
  ])
);

const props = defineProps([
  "filters",
  "transfer",
  "totalTransfer",
  "totalTransferThisDay",
  "totalTransferThisWeek",
  "totalTransferThisMonth",
  "totalTransferThisYear",
]);

const transfer_data = computed(() => props.transfer);

const search = ref(props.filters.search);

watch(search, (value) => {
  Inertia.get(
    "/transfer",
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
  