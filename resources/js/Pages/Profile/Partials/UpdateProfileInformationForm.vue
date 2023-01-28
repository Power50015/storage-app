<template>
    <JetFormSection @submitted="updateProfileInformation">
        <template #title>
            المعلومات الأساسيه
        </template>

        <template #description>
            تعديل البريد الإلكترونى و الأسم و الصوره الشخصيه
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input ref="photoInput" type="file" class="hidden" @change="updatePhotoPreview">
                <JetLabel for="photo" value="الصوره" />
                <!-- Current Profile Photo -->
                <div v-show="!photoPreview" class="mt-2">
                    <img :src="user.profile_photo_url" :alt="user.name"
                        class="rounded-full w-[150px] h-[150px] object-cover">
                </div>
                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span class="block rounded-full w-[150px] h-[150px] bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + photoPreview + '\');'" />
                </div>
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-1.5 mt-5">
                    <btn-primary @click.prevent="selectNewPhoto">أختر صوره جديده</btn-primary>
                    <btn-success v-if="user.profile_photo_path" @click.prevent="deletePhoto">إحذف الصوره</btn-success>
                </div>

                <JetInputError :message="form.errors.photo" class="mt-2" />
            </div>
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <InputText id="name" v-model="form.name" title="الإسم" :error="form.errors.name" :require="true" />
            </div>
            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <InputText id="email" v-model="form.email" title="البريد الإلكترونى" :error="form.errors.email"
                    :require="true" />
            </div>
        </template>

        <template #actions>
            <JetActionMessage :on="form.recentlySuccessful" class="mr-3">
                تم الحفظ
            </JetActionMessage>

            <JetButton :class="{ 'opacity-25': form.processing }"
                class="btn text-white bg-[#009ef7] hover:bg-[#0095e8] focus:bg-[#0095e8]" :disabled="form.processing">
                أحفظ
            </JetButton>
        </template>
    </JetFormSection>
</template>

<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Link, useForm } from '@inertiajs/inertia-vue3';
import JetButton from '@/Jetstream/Button.vue';
import JetFormSection from '@/Jetstream/FormSection.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetActionMessage from '@/Jetstream/ActionMessage.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';
import BtnPrimary from "@/Components/Buttons/BtnPrimary.vue";
import BtnSuccess from "@/Components/Buttons/BtnSuccess.vue";
import InputText from "@/Forms/InputText.vue";

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'PUT',
    name: props.user.name,
    email: props.user.email,
    photo: null,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    Inertia.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>
