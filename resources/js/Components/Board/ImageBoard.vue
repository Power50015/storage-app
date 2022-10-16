<template>
  <div class="flex justify-between items-start">
    <h2 class="font-bold text-2xl">الصور</h2>
  </div>
  <div class="grid gap-x-4 gap-y-2 grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
    <div class="mt-3">
      <Modal v-model="form.modelToggle">
        <template #btn
          ><i class="fa-solid fa-pen-to-square"></i>
          <span class="mx-3">إضافه صوره</span></template
        >
        <template #default>
          <FormSection
            title="إضافه بيانات صوره"
            btnTitle="إضافه صوره"
            :formData="form"
            :formRoute="`${url}.store`"
            toastMsg="تم إضافه الصوره"
            @FormSuccess="getImageData((reload = true))"
          >
            <InputImage v-model="form.image" title="الملف : " :require="true" />
          </FormSection>
        </template>
      </Modal>
    </div>
    <div
      v-for="item in images"
      :key="item.index"
      class="
        my-2
        dark:bg-[#151521]
        bg-[#f5f8fa]
        p-3
        rounded-md
        flex flex-col
        justify-between
      "
    >
      <div class="w-full flex justify-between items-center">
        <BadgeInfo>{{
          new Date(item.created_at).toLocaleDateString("ar-EG-u-nu-latn", {
            weekday: "long",
            year: "numeric",
            month: "short",
            day: "numeric",
          })
        }}</BadgeInfo>
        <DeleteModel
          :id="item.id"
          title=" الصور "
          :url="url"
          @DeleteSuccess="getImageData((reload = true))"
        >
          <img
            :src="`/storage/${item.image}`"
            :alt="`/storage/${item.image}`"
            class="w-96"
            width="500"
        /></DeleteModel>
      </div>
      <div class="my-3">
        <a :href="`/storage/${item.image}`" target="_blank" download>
          <img
            :src="`/storage/${item.image}`"
            :alt="`/storage/${item.image}`"
            class="w-full"
          />
        </a>
        <div class="flex items-center mt-3">
          <img
            :src="item.user.profile_photo_url"
            :alt="item.user.name"
            class="w-[50px] h-[50px] rounded-full"
          />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
      </div>
    </div>
  </div>
  <div v-if="(rowData[0] && rowData[0].next_page_url) || rowData.length == 0">
    <DotsSpinner />
  </div>
  <div v-if="rowData[0] && rowData[0].data.length == 0" class="mt-3">
    لا يوجد صور
  </div>
</template>
    <script setup>
import { reactive, ref } from "@vue/reactivity";
import axios from "axios";
import { onMounted } from "@vue/runtime-core";
import DotsSpinner from "../Spinner/DotsSpinner.vue";
import BadgeInfo from "../Badges/BadgeInfo.vue";
import FormSection from "@/Forms/FormSection.vue";
import Modal from "@/Components/Modals/Modal.vue";
import DeleteModel from "../Modals/DeleteModel.vue";
import BtnPrimary from "@/Components/Buttons/BtnPrimary.vue";
import InputImage from "@/Forms/InputImage.vue";

const props = defineProps(["url", "id"]);

onMounted(() => window.addEventListener("scroll", handleScroll));

const form = reactive({
  id: props.id,
  image: "",
  modelToggle: false,
});
const rowData = reactive([]);
const images = reactive([]);
function getImageData(reload = false, page = 1) {
  form.id = props.id;
  if (reload) images.length = 0;
  if (reload) rowData.length = 0;
  axios
    .get(route(props.url + ".index"), {
      params: {
        id: props.id,
        page: page,
      },
    })
    .then(function (response) {
      rowData.length = 0;
      rowData.push(response.data.image);
      response.data.image.data.forEach((item) => {
        images.push(item);
      });
    });
}

getImageData();

const handleScroll = (e) => {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    if (rowData[0])
      if (rowData[0].next_page_url != null) {
        getImageData(false, rowData[0].current_page + 1);
      }
  }
};
</script>