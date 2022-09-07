<template>
  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div
        class="
          dark:bg-[#1e1e2d]
          bg-white
          dark:text-white
          text-black
          overflow-hidden
          shadow-xl
          rounded-md
          p-4
        "
      >
        <h2 class="title font-bold mb-4" v-if="title">{{ title }}</h2>
        <form @submit.prevent="submit" autocomplete="off">
          <slot />
          <btn-primary type="submit" :title="btnTitle" />
        </form>
      </div>
    </div>
  </div>
</template>
<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { createToast } from "mosha-vue-toastify";
import BtnPrimary from "@/Components/Buttons/BtnPrimary.vue";
import { ref } from "@vue/reactivity";

const props = defineProps({
  title: {
    type: String,
    required: true,
  },
  formRoute: {
    type: String,
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

const submit = () => {
  const form = useForm(props.formData);
  form.post(route(props.formRoute), {
    onProgress: (progress) => {},
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
    },
    onError: (errors) => {
      for (const [key, value] of Object.entries(errors)) {
        for (const key in errors) {
          createToast(
            {
              title: value,
            },
            {
              timeout: 3000,
              transition: "slide",
              type: "danger",
              showIcon: true,
            }
          );
        }
      }
    },
    onFinish: () => {
      form.reset();
    },
  });
};

defineEmits(["submitted"]);
</script>