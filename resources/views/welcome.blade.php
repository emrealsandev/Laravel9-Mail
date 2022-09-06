<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mail</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .font-lobster{
                font-family: 'Lobster';
            }
        </style>
    </head>
    <body>

        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-[Lobster] text-gray-900 dark:text-white font-lobster">emrealsandev</h2>
                <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Laravel ile mail gönderme uygulaması - Mail class kullanımı</p>
                <form action="/contact/submit" x-on:submit.prevent="submitForm"  class="space-y-8" method="POST" x-data="{
                    formData: {
                        email: '',
                        subject: '',
                        message: '',
                    },
                    errors: {},
                    successMessage: '',

                    submitForm(event) {
                        this.successMessage = '';
                        this.errors = {};
                          fetch(`/contact/submit`, {
                            method: 'POST',
                            headers: {
                              'Content-Type': 'application/json',
                              'X-Requested-With': 'XMLHttpRequest',
                              'X-CSRF-TOKEN': document.querySelector(`meta[name='csrf-token']`).getAttribute('content')
                            },
                            body: JSON.stringify(this.formData)
                          })
                          .then(response => {
                            if (response.status === 200) {
                              return response.json();
                            }
                            throw response;
                          })
                          .then(result => {
                            this.formData = {
                              email: '',
                              subject: '',
                              message: '',
                            };
                            this.successMessage = 'Mail gönderme işleminiz başarılı. Teşekkürler -emrealsandev';
                          })
                          .catch(async (response) => {
                            const res = await response.json();
                            if (response.status === 422) {
                              this.errors = res.errors;
                            }
                          })
                      }

                }">
                <template x-if="successMessage">
                    <div x-text="successMessage" class="py-4 text-white rounded px-6 bg-green-600 text-grey-100 mb-4"></div>
                </template>
                @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 ">Mail</label>
                        <input x-model="formData.email" type="email" id="email" ::class="errors.email ? 'border-red-500 focus:border-red-500' : ''" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="mailiniz@mail.com" >
                        <template x-if="errors.email">
                            <div x-text="errors.email[0]" class="text-red-500"></div>
                        </template>
                    </div>
                    <div>
                        <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Konu</label>
                        <input x-model="formData.subject" type="text" id="subject" ::class="errors.subject ? 'border-red-500 focus:border-red-500' : ''" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="Size nasıl yardımcı olabiliriz?" >
                        <template x-if="errors.subject">
                            <div x-text="errors.subject[0]" class="text-red-500"></div>
                        </template>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Mesaj</label>
                        <textarea x-model="formData.message" id="message" rows="6" ;::class="errors.message ? 'border-red-500 focus:border-red-500' : ''" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Eklemek istedikleriniz..."></textarea>
                        <template x-if="errors.message">
                            <div x-text="errors.message[0]" class="text-red-500"></div>
                        </template>
                    </div>
                    <p x-text="formData.message"></p>
                    <button type="submit" class="py-3 px-5 text-sm font-medium text-center text-white rounded-lg bg-sky-700 sm:w-fit hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Mail Gönder</button>
                </form>
            </div>
          </section>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </body>
</html>
