<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import JetActionMessage from '@/Jetstream/ActionMessage.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetFormSection from '@/Jetstream/FormSection.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetLabel from '@/Jetstream/Label.vue';
import InputText from "@/Forms/InputText.vue";

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('user-password.update'), {
        errorBag: 'updatePassword',
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }

            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <JetFormSection @submitted="updatePassword">
        <template #title>
            تحديث كلمه المرور
        </template>

        <template #description>
            تأكد من أن حسابك يستخدم كلمة مرور طويلة وعشوائية للبقاء آمنًا.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <InputText type="password" id="name" v-model="form.current_password" title="كلمه المرور الحاليه"
                    :error="form.errors.current_password" :require="true" />

            </div>
            <div class="col-span-6 sm:col-span-4">

                <InputText type="password" id="name" v-model="form.password" title="كلمه المرور الجديده"
                    :error="form.errors.password" :require="true" />

            </div>
            <div class="col-span-6 sm:col-span-4">
                <InputText type="password" id="name" v-model="form.password_confirmation"
                    title="اعاده كتابه كلمه المرور الجديده" :error="form.errors.password" :require="true" />
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
