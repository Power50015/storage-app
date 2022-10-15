<template>
  <div class="flex justify-between items-start">
    <h2 class="font-bold text-2xl">الملفات</h2>
    <InputText
      v-model="inputText"
      placeholder="بحث ...."
      @input="getAttachmentData((reload = true))"
    />
  </div>
  <div class="grid gap-x-4 gap-y-2 grid-cols-1 lg:grid-cols-2 xl:grid-cols-3">
    <div class="mt-3">
      <Modal v-model="form.modelToggle">
        <template #btn
          ><i class="fa-solid fa-pen-to-square"></i>
          <span class="mx-3">إضافه ملف</span></template
        >
        <template #default>
          <FormSection
            title="إضافه بيانات ملف"
            btnTitle="إضافه ملف"
            :formData="form"
            :formRoute="`${url}.store`"
            toastMsg="تم إضافه الملف"
            :toastDescription="`تم الملف   : ${form.title}`"
            @FormSuccess="getAttachmentData((reload = true))"
          >
            <InputText v-model="form.title" title="عنوان" />
            <InputFile
              v-model="form.attachment"
              title="الملف : "
              :require="true"
            />
          </FormSection>
        </template>
      </Modal>
    </div>
    <div
      v-for="item in attachments"
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
      <div class="flex flex-col items-start mb-3">
        <div class="w-full flex justify-between">
          <BadgePrimary class="mb-3">{{ item.title }}</BadgePrimary>
          <DeleteModel
            :id="item.id"
            :title="` الملف   : ${item.title}`"
            :url="url"
            @DeleteSuccess="getAttachmentData((reload = true))"
          />
        </div>
        <BadgeInfo>{{
          new Date(item.created_at).toLocaleDateString("ar-EG-u-nu-latn", {
            weekday: "long",
            year: "numeric",
            month: "short",
            day: "numeric",
          })
        }}</BadgeInfo>
      </div>
      <div class="my-3 flex justify-between items-center">
        <div class="flex items-center">
          <img
            :src="item.user.profile_photo_url"
            :alt="item.user.name"
            class="w-[50px] h-[50px] rounded-full"
          />
          <h6 class="mx-2">{{ item.user.name }}</h6>
        </div>
        <div>
          <btn-primary
            :to="`/storage/${item.attachment}`"
            target="_blank"
            element="a"
            download
          >
            <i
              class="fa-solid fa-file-pdf"
              v-if="getExtension(item.attachment) == 'pdf'"
            ></i>
            <i
              class="fa-solid fa-file-word"
              v-else-if="
                getExtension(item.attachment) == 'word' ||
                getExtension(item.attachment) == 'doc' ||
                getExtension(item.attachment) == 'txt' ||
                getExtension(item.attachment) == 'docx'
              "
            ></i>
            <i
              class="fa-solid fa-file-csv"
              v-else-if="
                getExtension(item.attachment) == 'csv' ||
                getExtension(item.attachment) == 'excel' ||
                getExtension(item.attachment) == 'xlsx' ||
                getExtension(item.attachment) == 'xlsm'
              "
            ></i>

            <i
              class="fa-solid fa-file-image"
              v-else-if="
                getExtension(item.attachment) == 'jpg' ||
                getExtension(item.attachment) == 'jpge' ||
                getExtension(item.attachment) == 'png' ||
                getExtension(item.attachment) == 'svg'
              "
            ></i>
            <i class="fa-regular fa-file" v-else></i>
          </btn-primary>
        </div>
      </div>
    </div>
  </div>
  <div v-if="(rowData[0] && rowData[0].next_page_url) || rowData.length == 0">
    <DotsSpinner />
  </div>
  <div v-if="rowData[0] && rowData[0].data.length == 0" class="mt-3">
    لا يوجد ملفات
  </div>
</template>
  <script setup>
import { reactive, ref } from "@vue/reactivity";
import axios from "axios";
import { onMounted } from "@vue/runtime-core";
import DotsSpinner from "../Spinner/DotsSpinner.vue";
import BadgePrimary from "../Badges/BadgePrimary.vue";
import BadgeInfo from "../Badges/BadgeInfo.vue";
import FormSection from "@/Forms/FormSection.vue";
import InputText from "@/Forms/InputText.vue";
import InputFile from "@/Forms/InputFile.vue";
import Modal from "@/Components/Modals/Modal.vue";
import DeleteModel from "../Modals/DeleteModel.vue";
import BtnPrimary from "@/Components/Buttons/BtnPrimary.vue";

const props = defineProps(["url", "id"]);

onMounted(() => window.addEventListener("scroll", handleScroll));

const form = reactive({
  id: props.id,
  title: "",
  attachment: "",
  modelToggle: false,
});
const rowData = reactive([]);
const attachments = reactive([]);
const inputText = ref();
function getAttachmentData(reload = false, page = 1) {
  axios
    .get(route(props.url + ".index"), {
      params: {
        id: props.id,
        page: page,
        search: inputText.value,
      },
    })
    .then(function (response) {
      rowData.length = 0;
      if (reload) attachments.length = 0;
      rowData.push(response.data.attachment);
      response.data.attachment.data.forEach((item) => {
        attachments.push(item);
      });
    });
}

getAttachmentData();

const handleScroll = (e) => {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    if (rowData[0])
      if (rowData[0].next_page_url != null) {
        getAttachmentData(false, rowData[0].current_page + 1);
      }
  }
};

function getExtension(file) {
  file = file.split(".");
  return file[file.length - 1];
}
</script>