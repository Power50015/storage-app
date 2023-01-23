<template>
  <div class="flex justify-between items-start">
    <h2 class="font-bold text-2xl">تفاصيل الكاش</h2>
    <div class="flex">
      <FormSelect v-model="action" :options="actionOptions" @change-select="getCashData(true)"></FormSelect>
    </div>
  </div>
  <div v-for="item in cash" :key="item.index">
    <div v-if="item.dataType == 'IncomingInvoice'">
      <Link :href="route('incoming-invoice.show', item.id)" class="
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
        ">
      <div class="w-full">
        <h2>رقم الفاتوره : {{ item.number }}</h2>
        <div class="flex mt-3">
          <img :src="`/storage/${item.people.logo}`" :alt="item.people.name" class="w-[35px] h-[35px] rounded-full" />
          <h6 class="mx-2">{{ item.people.name }}</h6>
        </div>
      </div>
      <div class="w-full flex justify-center">
        <BadgePrimary>فاتورة وارده</BadgePrimary>
      </div>
      <div class="w-full">
        المبلغ : {{ item.total }}
      </div>
      <div class="w-full">
        <h2>
          {{
            new Date(item.date).toLocaleDateString(
              "ar-EG-u-nu-latn",
              {
                weekday: "long",
                year: "numeric",
                month: "short",
                day: "numeric",
              }
            )
          }}
        </h2>
        <div class="flex mt-3">
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'OutgoingInvoice'">
      <Link :href="route('outgoing-invoice.show', item.id)" class="
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
        ">
      <div class="w-full">
        <h2>رقم الفاتوره : {{ item.id }}</h2>
        <div class="flex mt-3">
          <img :src="`/storage/${item.people.logo}`" :alt="item.people.name" class="w-[35px] h-[35px] rounded-full" />
          <h6 class="mx-2">{{ item.people.name }}</h6>
        </div>
      </div>
      <div class="w-full flex justify-center">
        <BadgeSuccess>فاتورة صادره</BadgeSuccess>
      </div>
      <div class="w-full">
        المبلغ : {{ item.total }}
      </div>
      <div class="w-full">
        <h2>
          {{
            new Date(item.date).toLocaleDateString(
              "ar-EG-u-nu-latn",
              {
                weekday: "long",
                year: "numeric",
                month: "short",
                day: "numeric",
              }
            )
          }}
        </h2>
        <div class="flex mt-3">
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'ReturnedIncomingInvoice'">
      <Link :href="route('returned-outgoing-invoice.show', item.id)" class="
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
        ">
      <div class="w-full">
        <h2>رقم بيان المرتجع : {{ item.id }}</h2>
        <div class="flex mt-3">
          <img :src="`/storage/${item.people.logo}`" :alt="item.people.name" class="w-[35px] h-[35px] rounded-full" />
          <h6 class="mx-2">{{ item.people.name }}</h6>
        </div>
      </div>
      <div class="w-full flex justify-center">
        <BadgeSuccess>مرتجع فاتوره وارده </BadgeSuccess>
      </div>
      <div class="w-full">
        المبلغ : {{ item.total }}
      </div>
      <div class="w-full">
        <h2>
          {{
            new Date(item.date).toLocaleDateString(
              "ar-EG-u-nu-latn",
              {
                weekday: "long",
                year: "numeric",
                month: "short",
                day: "numeric",
              }
            )
          }}
        </h2>
        <div class="flex mt-3">
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'ReturnedOutgoingInvoice'">
      <Link :href="route('returned-incoming-invoice.show', item.id)" class="
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
        ">
      <div class="w-full">
        <h2>رقم البيان : {{ item.id }}</h2>
        <div class="flex mt-3">
          <img :src="`/storage/${item.people.logo}`" :alt="item.people.name" class="w-[35px] h-[35px] rounded-full" />
          <h6 class="mx-2">{{ item.people.name }}</h6>
        </div>
      </div>
      <div class="w-full flex justify-center">
        <BadgePrimary>مرتجع صادر</BadgePrimary>
      </div>
      <div class="w-full">
        المبلغ : {{ item.total }}
      </div>
      <div class="w-full">
        <h2>
          {{
            new Date(item.date).toLocaleDateString(
              "ar-EG-u-nu-latn",
              {
                weekday: "long",
                year: "numeric",
                month: "short",
                day: "numeric",
              }
            )
          }}
        </h2>
        <div class="flex mt-3">
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'CreditorPay'">
      <Link :href="route('creditor-pay.show', item.id)" class="
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
        ">

      <div class="w-full">
        <h2>{{ item.title }}</h2>
        <div class="flex mt-3">
          <img :src="`/storage/${item.people.logo}`" :alt="item.people.name" class="w-[35px] h-[35px] rounded-full" />
          <h6 class="mx-2">{{ item.people.name }}</h6>
        </div>
      </div>
      <div class="w-full flex justify-center">
        <BadgeInfo>دفعه دائن</BadgeInfo>
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
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'DebtorPay'">
      <Link :href="route('debtor-pay.show', item.id)" class="
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
        ">

      <div class="w-full">
        <h2>{{ item.title }}</h2>
        <div class="flex mt-3">
          <img :src="`/storage/${item.people.logo}`" :alt="item.people.name" class="w-[35px] h-[35px] rounded-full" />
          <h6 class="mx-2">{{ item.people.name }}</h6>
        </div>
      </div>
      <div class="w-full flex justify-center">
        <BadgeWarning>دفعه مدين</BadgeWarning>
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
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'CashPay'">
      <Link :href="route('cash-pay.show', item.id)" class="
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
        ">

      <div class="w-full">
        <h2>{{ item.title }}</h2>
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
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
      </Link>
    </div>
    <div v-if="item.dataType == 'Expense'">
      <Link :href="route('cash-pay.show', item.id)" class="
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
        ">

      <div class="w-full">
        <h2>{{ item.title }}</h2>
      </div>
      <div class="w-full flex justify-center">
        <BadgeLight>مصروف</BadgeLight>
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
          <img :src="item.user.profile_photo_url" :alt="item.user.name" class="w-[25px] h-[25px] rounded-full" />
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
const cash = reactive([]);
const inputText = ref();
const action = ref("all");

const actionOptions = [
  { label: "الكل", index: "all" },
  { label: "فواتير وراده", index: "IncomingInvoice" },
  { label: "مرتجع  وارد", index: "ReturnedIncomingInvoice" },
  { label: "فواتير صادره", index: "OutgoingInvoice" },
  { label: "مرتجع صادر", index: "ReturnedOutgoingInvoice" },
  { label: "مبلغ مضاف", index: "CashPay" },
  { label: "دفعه دائن", index: "CreditorPay" },
  { label: "دفعه مدين", index: "DebtorPay" },
  { label: "مصروف", index: "Expense" },
];
function getCashData(reload = false, page = 1) {
  axios
    .get("/cash-data", {
      params: {
        cash: props.id,
        page: page,
        action: action.value,
      },
    })
    .then(function (response) {
      rowData.length = 0;
      if (reload) cash.length = 0;
      rowData.push(response.data);
      response.data.data.forEach((item) => {
        cash.push(item);
      });
    });
}

getCashData();

const handleScroll = (e) => {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    if (rowData[0])
      if (rowData[0].next_page_url != null) {
        getCashData(false, rowData[0].current_page + 1);
      }
  }
};
</script>