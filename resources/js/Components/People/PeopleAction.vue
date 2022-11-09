<template>
  <div class="flex justify-between items-start">
    <h2 class="font-bold text-2xl"></h2>
    <div class="flex">
      <FormSelect
        v-model="action"
        :options="actionOptions"
        @change-select="getPeopleData(true)"
      ></FormSelect>
    </div>
  </div>
  <div v-for="item in actions" :key="item.index">
    <div v-if="item.dataType == 'OutgoingInvoice'">
      <Link
        :href="route('outgoing-invoice.show', item.id)"
        class="
          w-full
          flex
          justify-between
          items-center
          cursor-pointer
          hover:text-[#0095e8]
          transition-all
          my-2
          py-4
          px-2
          text-right
          font-bold
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>رقم الفاتوره : {{ item.id }}</h2>
        </div>
        <div class="w-full flex justify-center">
          <BadgeSuccess>فاتورة صادره</BadgeSuccess>
        </div>
        <div class="w-full">
          المبلغ : {{ item.total_after_discount.toFixed(2) }}
        </div>
        <div class="w-full">
          <h2>
            {{
              new Date(item.date).toLocaleDateString("ar-EG-u-nu-latn", {
                weekday: "long",
                year: "numeric",
                month: "short",
                day: "numeric",
              })
            }}
          </h2>
          <div class="flex mt-3">
            <img
              :src="item.user.profile_photo_url"
              :alt="item.user.name"
              class="w-[25px] h-[25px] rounded-full"
            />
            <h6 class="mx-2">{{ item.user.name }}</h6>
          </div>
        </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'Debtor'">
      <Link
        :href="route('debtor.show', item.id)"
        class="
          w-full
          flex
          justify-between
          items-center
          cursor-pointer
          hover:text-[#0095e8]
          font-bold
          transition-all
          my-2
          py-4
          px-2
          text-right
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>{{ item.title }}</h2>
        </div>
        <div class="w-full flex justify-center">
          <BadgeWarning>دين مضاف</BadgeWarning>
        </div>
        <h2 class="w-full">المبلغ : {{ item.amount }}</h2>

        <div class="w-full">
          <h2>
            {{
              new Date(item.date).toLocaleDateString("ar-EG-u-nu-latn", {
                weekday: "long",
                year: "numeric",
                month: "short",
                day: "numeric",
              })
            }}
          </h2>
          <div class="flex mt-3">
            <img
              :src="item.user.profile_photo_url"
              :alt="item.user.name"
              class="w-[25px] h-[25px] rounded-full"
            />
            <h6 class="mx-2">{{ item.user.name }}</h6>
          </div>
        </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'DebtorPay'">
      <Link
        :href="route('debtor-pay.show', item.id)"
        class="
          w-full
          flex
          justify-between
          items-center
          cursor-pointer
          hover:text-[#0095e8]
          transition-all
          my-2
          py-4
          px-2
          text-right
          font-bold
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>{{ item.title }}</h2>
          <h2>{{ item.cash.title }}</h2>
        </div>
        <div class="w-full flex justify-center">
          <BadgeSecondary>دفعه مدفوعه</BadgeSecondary>
        </div>
        <h2 class="w-full">المبلغ : {{ item.amount }}</h2>

        <div class="w-full">
          <h2>
            {{
              new Date(item.date).toLocaleDateString("ar-EG-u-nu-latn", {
                weekday: "long",
                year: "numeric",
                month: "short",
                day: "numeric",
              })
            }}
          </h2>
          <div class="flex mt-3">
            <img
              :src="item.user.profile_photo_url"
              :alt="item.user.name"
              class="w-[25px] h-[25px] rounded-full"
            />
            <h6 class="mx-2">{{ item.user.name }}</h6>
          </div>
        </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'DebtorKilled'">
      <Link
        :href="route('debtor-pay.show', item.id)"
        class="
          w-full
          flex
          justify-between
          items-center
          cursor-pointer
          hover:text-[#0095e8]
          transition-all
          my-2
          py-4
          px-2
          text-right
          font-bold
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>{{ item.title }}</h2>
        </div>
        <div class="w-full flex justify-center">
          <BadgeDanger>دين مدين معدم</BadgeDanger>
        </div>
        <h2 class="w-full">المبلغ : {{ item.amount }}</h2>

        <div class="w-full">
          <h2>
            {{
              new Date(item.date).toLocaleDateString("ar-EG-u-nu-latn", {
                weekday: "long",
                year: "numeric",
                month: "short",
                day: "numeric",
              })
            }}
          </h2>
          <div class="flex mt-3">
            <img
              :src="item.user.profile_photo_url"
              :alt="item.user.name"
              class="w-[25px] h-[25px] rounded-full"
            />
            <h6 class="mx-2">{{ item.user.name }}</h6>
          </div>
        </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'IncomingInvoice'">
      <Link
        :href="route('incoming-invoice.show', item.id)"
        class="
          w-full
          flex
          justify-between
          items-center
          cursor-pointer
          hover:text-[#0095e8]
          transition-all
          my-2
          py-4
          px-2
          text-right
          font-bold
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>رقم الفاتوره : {{ item.number }}</h2>
        </div>
        <div class="w-full flex justify-center">
          <BadgeSuccess>فاتورة وارده</BadgeSuccess>
        </div>
        <div class="w-full">
          المبلغ : {{ item.total_after_discount.toFixed(2) }}
        </div>
        <div class="w-full">
          <h2>
            {{
              new Date(item.date).toLocaleDateString("ar-EG-u-nu-latn", {
                weekday: "long",
                year: "numeric",
                month: "short",
                day: "numeric",
              })
            }}
          </h2>
          <div class="flex mt-3">
            <img
              :src="item.user.profile_photo_url"
              :alt="item.user.name"
              class="w-[25px] h-[25px] rounded-full"
            />
            <h6 class="mx-2">{{ item.user.name }}</h6>
          </div>
        </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'Creditor'">
      <Link
        :href="route('creditor.show', item.id)"
        class="
          w-full
          flex
          justify-between
          items-center
          cursor-pointer
          hover:text-[#0095e8]
          font-bold
          transition-all
          my-2
          py-4
          px-2
          text-right
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>{{ item.title }}</h2>
        </div>
        <div class="w-full flex justify-center">
          <BadgeWarning>دين مضاف</BadgeWarning>
        </div>
        <h2 class="w-full">المبلغ : {{ item.amount }}</h2>

        <div class="w-full">
          <h2>
            {{
              new Date(item.date).toLocaleDateString("ar-EG-u-nu-latn", {
                weekday: "long",
                year: "numeric",
                month: "short",
                day: "numeric",
              })
            }}
          </h2>
          <div class="flex mt-3">
            <img
              :src="item.user.profile_photo_url"
              :alt="item.user.name"
              class="w-[25px] h-[25px] rounded-full"
            />
            <h6 class="mx-2">{{ item.user.name }}</h6>
          </div>
        </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'CreditorPay'">
      <Link
        :href="route('creditor-pay.show', item.id)"
        class="
          w-full
          flex
          justify-between
          items-center
          cursor-pointer
          hover:text-[#0095e8]
          transition-all
          my-2
          py-4
          px-2
          text-right
          font-bold
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>{{ item.title }}</h2>
          <h2>{{ item.cash.title }}</h2>
        </div>
        <div class="w-full flex justify-center">
          <BadgeSecondary>دفعه مستلمه</BadgeSecondary>
        </div>
        <h2 class="w-full">المبلغ : {{ item.amount }}</h2>

        <div class="w-full">
          <h2>
            {{
              new Date(item.date).toLocaleDateString("ar-EG-u-nu-latn", {
                weekday: "long",
                year: "numeric",
                month: "short",
                day: "numeric",
              })
            }}
          </h2>
          <div class="flex mt-3">
            <img
              :src="item.user.profile_photo_url"
              :alt="item.user.name"
              class="w-[25px] h-[25px] rounded-full"
            />
            <h6 class="mx-2">{{ item.user.name }}</h6>
          </div>
        </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'CreditorKilled'">
      <Link
        :href="route('creditor-pay.show', item.id)"
        class="
          w-full
          flex
          justify-between
          items-center
          cursor-pointer
          hover:text-[#0095e8]
          transition-all
          my-2
          py-4
          px-2
          text-right
          font-bold
          lg:flex-row
          flex-col
        "
      >
        <div class="w-full">
          <h2>{{ item.title }}</h2>
        </div>
        <div class="w-full flex justify-center">
          <BadgeDanger>دين دائن معدم</BadgeDanger>
        </div>
        <h2 class="w-full">المبلغ : {{ item.amount }}</h2>

        <div class="w-full">
          <h2>
            {{
              new Date(item.date).toLocaleDateString("ar-EG-u-nu-latn", {
                weekday: "long",
                year: "numeric",
                month: "short",
                day: "numeric",
              })
            }}
          </h2>
          <div class="flex mt-3">
            <img
              :src="item.user.profile_photo_url"
              :alt="item.user.name"
              class="w-[25px] h-[25px] rounded-full"
            />
            <h6 class="mx-2">{{ item.user.name }}</h6>
          </div>
        </div>
      </Link>
    </div>
  </div>
  <div v-if="(rowData[0] && rowData[0].next_page_url) || rowData.length == 0">
    <DotsSpinner />
  </div>
  <div v-if="rowData[0] && rowData[0].data.length == 0" class="mt-3">
    لا يوجد بيانات
  </div>
</template>
    <script setup>
import { Link } from "@inertiajs/inertia-vue3";
import BadgePrimary from "@/Components/Badges/BadgePrimary.vue";
import BadgeSuccess from "@/Components/Badges/BadgeSuccess.vue";
import BadgeInfo from "@/Components/Badges/BadgeInfo.vue";
import BadgeDanger from "@/Components/Badges/BadgeDanger.vue";
import BadgeWarning from "@/Components/Badges/BadgeWarning.vue";
import BadgeSecondary from "@/Components/Badges/BadgeSecondary.vue";
import BadgeLight from "@/Components/Badges/BadgeLight.vue";
import { reactive, ref } from "@vue/reactivity";
import axios from "axios";
import { onMounted } from "@vue/runtime-core";
import FormSelect from "@/Forms/FormSelect.vue";
import DotsSpinner from "../Spinner/DotsSpinner.vue";

const props = defineProps(["id"]);

onMounted(() => window.addEventListener("scroll", handleScroll));

const rowData = reactive([]);
const actions = reactive([]);
const inputText = ref();
const action = ref();

const actionOptions = [
  { label: "فواتير صادره", index: "OutgoingInvoice" },
  { label: "دين مدين", index: "Debtor" },
  { label: "دفعه وارده", index: "DebtorPay" },
  { label: "دين مدين معدم", index: "DebtorKilled" },
  { label: "فواتير وارده", index: "IncomingInvoice" },
  { label: "دين دائن", index: "Creditor" },
  { label: "دفعه صادره", index: "CreditorPay" },
  { label: "دين دائن معدم", index: "CreditorKilled" },
];
function getPeopleData(reload = false, page = 1) {
  axios
    .get("/people-action", {
      params: {
        people: props.id,
        page: page,
        action: action.value,
      },
    })
    .then(function (response) {
      rowData.length = 0;
      if (reload) actions.length = 0;
      rowData.push(response.data);
      response.data.data.forEach((item) => {
        actions.push(item);
      });
    });
}

getPeopleData();

const handleScroll = (e) => {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    if (rowData[0])
      if (rowData[0].next_page_url != null) {
        getPeopleData(false, rowData[0].current_page + 1);
      }
  }
};
</script>