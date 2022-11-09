<template>
  <AppLayout title="تفاصيل الدين">
    <SectionTemplate class="print:p-0">
      <div class="flex justify-between md:flex-row flex-col-reverse">
        <div class="flex justify-around flex-col w-full">
          <h2 class="font-bold text-lg">
            {{ debtor.title }}
          </h2>
          <template v-if="debtor.description"
            ><div v-html="debtor.description" class="my-3"></div
          ></template>
          <h2 class="font-bold my-3 text-lg">
            {{
              new Date(debtor.date).toLocaleDateString("ar-EG-u-nu-latn", {
                weekday: "long",
                year: "numeric",
                month: "short",
                day: "numeric",
              })
            }}
          </h2>
          <h2 class="title font-bold text-lg text-[#009ef7]">
            إجمالى المبلغ : {{ Number(debtor.amount).toFixed(2) }}
          </h2>
          <div class="flex print:hidden">
            <btn-info
              :element="Link"
              :to="route('debtor.edit', debtor.id)"
              class="mt-4"
            >
              تعديل بيانات
            </btn-info>
          </div>
        </div>
        <div class="flex justify-around flex-col w-full">
          <Link
            :href="route('people.show', debtor.id)"
            class="
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
            "
          >
            <img
              :src="`/storage/${debtor.people.logo}`"
              :alt="debtor.people.name"
              class="w-[50px] h-[50px] rounded-full"
              width="50"
              height="50"
            />
            <h6 class="mx-2">{{ debtor.people.name }}</h6>
          </Link>
          <Link
            :href="route('people.show', debtor.id)"
            class="
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
            "
          >
            <img
              :src="`${debtor.user.profile_photo_url}`"
              :alt="debtor.user.name"
              class="w-[50px] h-[50px] rounded-full"
              width="50"
              height="50"
            />
            <h6 class="mx-2">{{ debtor.user.name }}</h6>
          </Link>
        </div>
      </div>
    </SectionTemplate>
    <SectionTemplate class="print:p-0">
      <DebtorShowTabs :id="debtor.id" url="debtor" />
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
import DebtorShowTabs from "@/Components/Debtor/DebtorShowTabs.vue";

const props = defineProps(["debtor"]);

provide("title", "الدين");
provide(
  "breadcrumb",
  readonly([
    { index: 0, linkTitle: "الرئيسية", linkRoute: "dashboard" },
    { index: 1, linkTitle: "الديون", linkRoute: "debtor.index" },
    {
      index: 2,
      linkTitle: "الدين " + props.debtor[0].title,
      linkRoute: "#",
    },
  ])
);

const debtor = computed(() => props.debtor[0]);
</script>