<script lang="ts" setup>
import {userRand} from '~/composables/useGlobal'
import {useAuthRegister} from '~/composables/auth/regirster'
useSeoMeta({
    title: 'ثبت نام - ',
    description:'ثبت نام در سایت جی مدرن (gmodern)'
})
interface RegisterForm {
  loading: boolean
  error?: {
    status: boolean
    message: string
  }
  form: {
    name: string | null
    email: string | null
    password: string | null
    password_confirm: string | null
  }
  result?: any
}

let register_form = ref<RegisterForm>({
  loading: false,
  result: {
    data: null,
    status: null,
  },
  form: {
    name: null,
    email: null,
    password: null,
    password_confirm: null,
  },
})

const submit_register_form = async () => {
  register_form.value.loading = true

  const register_response = await useAuthRegister(register_form.value.form)

  register_form.value.loading = false
  register_form.value.result = {
    status: register_response.success,
    data: register_response.message,
  }
  if (register_response.success) {
    register_form.value.loading = true
    await navigateTo({
      path: '/',
    })
  }
}

const greetings = [
  'پدر منو ندیدی ؟',
  'سلام داداش دختری ؟',
  'یالااااا',
  'یام یام .. بخورمت',
  'داداشمی هاااا',
]
const random_index = await userRand(0, greetings.length - 1)
</script>
<template>
  <div class="flex flex-col justify-center w-full">
    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <img
          class="mx-auto h-12 w-auto"
          src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"
          alt="Workflow" />
        <span class="flex justify-center mt-6">
          {{ greetings[random_index] }}
        </span>
        <h2 class="mt-6 text-center text-3xl font-extrabold">
 واسه ثبت نام فقط اسمو ایمیلو رمزت نیازه.
           <span class="text-sm mt-3 flex flex-wrap justify-center"> (میدونم خیلی هم فرقی نداره با بقیه😁)</span>
        </h2>
        <p class="mt-2 text-center text-sm text-base">
          یا
          <nuxt-link
            to="/login"
            class="font-medium text-primary hover:text-indigo-500">
            وارد شو
          </nuxt-link>
        </p>
      </div>

      <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-base-100 py-8 px-4 shadow sm:rounded-lg sm:px-10">
          <form class="space-y-6" @submit.prevent="submit_register_form">

              <div class="relative">
                  <input
                      type="text"
                      id="name"
                      required
                      autocomplete="name"
                      v-model="register_form.form.name"
                      class="block input px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary focus:outline-none focus:ring-0 focus:border-primary peer"
                      placeholder="" />
                  <label
                      for="email"
                      class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 top-2 z-10 origin-[0] bg-base-100 px-2 peer-focus:px-2 peer-focus:text-primary peer-focus:dark:text-blue-500 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-3 peer-focus:text-xs peer-focus:-translate-y-4 right-1"
                  >نام</label
                  >
              </div>
            <div class="relative">
              <input
                type="email"
                id="email"
                required
                autocomplete="email"
                v-model="register_form.form.email"
                class="block input px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary focus:outline-none focus:ring-0 focus:border-primary peer"
                placeholder=" " />
              <label
                for="email"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 top-2 z-10 origin-[0] bg-base-100 px-2 peer-focus:px-2 peer-focus:text-primary peer-focus:dark:text-blue-500 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-3 peer-focus:text-xs peer-focus:-translate-y-4 right-1"
                >ایمیل</label
              >
            </div>

            <div class="relative">
              <input
                type="password"
                id="password"
                required
                autocomplete="current-password"
                v-model="register_form.form.password"
                class="block input px-2.5 pb-2.5 pt-4 w-full text-sm bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-primary focus:outline-none focus:ring-0 focus:border-primary peer"
                placeholder=" " />
              <label
                for="password"
                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 top-2 z-10 origin-[0] bg-base-100 px-2 peer-focus:px-2 peer-focus:text-primary peer-focus:dark:text-blue-500 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-3 peer-focus:text-xs peer-focus:-translate-y-4 right-1"
                >رمز</label
              >
            </div>


            <div
              v-if="register_form.result && register_form.result.status === false"
              class="p-4 mb-4 rounded-lg bg-base-300"
              role="alert">
              <div class="flex items-center">
                <svg
                  aria-hidden="true"
                  class="w-5 h-5 ml-2 text-error"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                    fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <h3 class="text-base font-medium text-error">
                  {{ register_form.result.data }}
                </h3>
              </div>
            </div>



            <div>
              <button
                :disabled="register_form.loading"
                :class="[
                  {skeleton: register_form.loading},
                  {
                    'btn-success': register_form.result.status === true,
                  },
                ]"
                type="submit"
                class="btn btn-primary w-full flex flex-wrap">
                <app-loading-svg v-if="register_form.loading" />
                <span
                  class="text-success-content"
                  v-if="register_form.result.status === true">
                  خوش اومدی
                </span>
                <span v-else> ثبت نام </span>
              </button>
            </div>
          </form>

          <div class="mt-6">
            <div class="relative">
              <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-base-200" />
              </div>
              <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-base-200 p-2 rounded"
                  >یه جور دیگه ثبت نام کن 😊</span
                >
              </div>
            </div>

            <div class="mt-6 grid grid-cols-3 gap-3">
              <div>
                <a
                  href="#"
                  class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                  <span class="sr-only">Sign in with Facebook</span>
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                      fill-rule="evenodd"
                      d="M20 10c0-5.523-4.477-10-10-10S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z"
                      clip-rule="evenodd" />
                  </svg>
                </a>
              </div>

              <div>
                <a
                  href="#"
                  class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                  <span class="sr-only">Sign in with Twitter</span>
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                      d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84" />
                  </svg>
                </a>
              </div>

              <div>
                <a
                  href="#"
                  class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                  <span class="sr-only">Sign in with GitHub</span>
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                      fill-rule="evenodd"
                      d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z"
                      clip-rule="evenodd" />
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
