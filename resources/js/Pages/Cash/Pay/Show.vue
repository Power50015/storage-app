<template>
  <AppLayout title="تفاصيل الكاش">
    <SectionTemplate class="print:p-0">
      <div class="flex justify-between md:flex-row flex-col-reverse">
        <div class="flex justify-around flex-col w-full">
          <h2 class="font-bold text-lg">
            {{ cashPay.title }}
          </h2>
          <h2 class="font-bold my-3 text-lg">
            {{
              new Date(cashPay.date).toLocaleDateString("ar-EG-u-nu-latn", {
                weekday: "long",
                year: "numeric",
                month: "short",
                day: "numeric",
              })
            }}
          </h2>
          <h2 class="title font-bold text-lg text-[#009ef7]">
            إجمالى المبلغ : {{ Number(cashPay.amount).toFixed(2) }}
          </h2>
          <div>
            <h2 class="title font-bold text-lg text-[#50cd89] my-3" v-if="cashPay.pay_type == 1">
              نوع الكاش : {{ cashPay.cash.title }}
            </h2>
          </div>
          <div class="flex print:hidden">
            <btn-info :element="Link" :to="route('cash-pay.edit', cashPay.id)" class="mt-4">
              تعديل بيانات
            </btn-info>
          </div>
        </div>
        <div class="flex justify-around flex-col w-full">
          <Link :href="route('people.show', cashPay.id)" class="
              w-full
              cursor-pointer
              hover:text-[#0095e8]
              font-bold
              transition-all
              my-2
              py-4
              px-2
              text-right
              flex
              items-center
              justify-end
            ">
          <img :src="`${cashPay.user.profile_photo_url}`" :alt="cashPay.user.name"
            class="w-[50px] h-[50px] rounded-full" width="50" height="50" />
          <h6 class="mx-2">{{ cashPay.user.name }}</h6>
          </Link>
        </div>
      </div>
    </SectionTemplate>
    <SectionTemplate class="print:p-0">
      <CreditorShowTabs :id="cashPay.id" url="creditor-pay" />
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
import CreditorShowTabs from "@/Components/Creditor/CreditorShowTabs.vue";

const props = defineProps(["cashPay"]);

provide("title", "دفعه الكاش");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "الكاش", linkRoute: "cash.index" },
    {
      index: 2,
      linkTitle: "دفعه الكاش " + props.cashPay[0].title,
      linkRoute: "#",
    },
  ])
);

const cashPay = computed(() => props.cashPay[0]);
</script>