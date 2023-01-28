<template>
  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="
          dark:bg-[#1e1e2d]
          bg-white
          dark:text-white
          text-black
          overflow-hidden
          shadow-xl
          rounded-md
          p-4
        ">
        <h2 class="title font-bold mb-4" v-if="title">{{ title }}</h2>
        <form @submit.prevent="submit" autocomplete="off" enctype="multipart/form-data">
          <slot />
          <btn-primary element="button" type="submit" customClass="w-full" v-if="!loading">{{
            btnTitle
          }}</btn-primary>
          <div v-else>
            <div class="w-full bg-gray-200 max-w-sm my-12 mx-auto rounded-lg overflow-hidden border border-gray-300">
              <div class="bg-[#0095E8] text-xs leading-none py-1" :style="`width: ${loadingProgress}%`"></div>
            </div>
          </div>
          <slot name="footer" />
        </form>
      </div>
    </div>
  </div>
</template>
<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { createToast } from "mosha-vue-toastify";
import BtnPrimary from "@/Components/Buttons/BtnPrimary.vue";
import { reactive, ref } from "@vue/reactivity";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  formRoute: {
    required: true,
  },
  formData: {
    type: Object,
    required: true,
  },
  toastMsg: {
    type: String,
    required: true,
  },
  toastDescription: {
    type: String,
    default: "",
  },
  btnTitle: {
    type: String,
    default: "حفظ",
  },
});

const emit = defineEmits(["FormSuccess"]);

const loading = ref(false);
const loadingProgress = ref(0);

const submit = () => {

  loading.value = true;
  const form = useForm(props.formData);
  form.post(
    form.id ? route(props.formRoute, form.id) : route(props.formRoute),
    {
      onProgress: (progress) => {
        loadingProgress.value = progress.percentage;
        console.log(loadingProgress.value);
      },
      onSuccess: () => {
        createToast(
          {
            title: props.toastMsg,
            description: props.toastDescription,
          },
          {
            timeout: 3000,
            transition: "slide",
            type: "success",
            showIcon: true,
          }
        );
        form.reset();
        if (form.scroll) window.scrollTo(0, document.body.scrollHeight);
        // Reset Any Editor
        if (!form._method) {
          if (document.getElementsByClassName("ql-editor")[0])
            document.getElementsByClassName("ql-editor")[0].innerHTML = null;
          // for (const [key, value] of Object.entries(props.formData)) {
          //   props.formData[key] = null;
          // }
          loading.value = false;
        }
        // Reset Any Model
        if (props.formData["modelToggle"])
          props.formData["modelToggle"] = false;
        emit("FormSuccess");
      },
      onError: (errors) => {
        for (const key in errors) {
          createToast(
            {
              title: errors[key],
            },
            {
              timeout: 3000,
              transition: "slide",
              type: "danger",
              showIcon: true,
            }
          );
        }
        loading.value = false;
        loadingProgress.value = 0;
      },
      onFinish: () => {
        loading.value = false;
        loadingProgress.value = 0;
      },
    }
  );
};
</script>