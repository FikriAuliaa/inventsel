<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-zinc-100">
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-zinc-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm transition transform active:scale-95 shadow-none">{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white dark:bg-[#1e1f20]">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-zinc-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-zinc-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                <x-text-input id="password" name="password" type="password"
                    class="mt-1 block w-3/4 dark:bg-[#131314] dark:border-zinc-700 text-gray-900 dark:text-zinc-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50"
                    placeholder="{{ __('Password') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')"
                    class="rounded-xl border border-gray-300 dark:border-zinc-700 text-gray-700 dark:text-zinc-300 bg-white dark:bg-[#1e1f20] hover:bg-gray-50 dark:hover:bg-zinc-800">
                    {{ __('Cancel') }}
                </x-secondary-button>
                <x-danger-button
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-xl text-sm transition transform active:scale-95 shadow-none">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>