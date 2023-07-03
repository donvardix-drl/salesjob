<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jobs Import') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('jobs.storeImport') }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf

                        <input name="jobs" type="file" accept="text/xml" />
                        <x-input-error class="mt-2" :messages="$errors->get('jobs')" />

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Import') }}</x-primary-button>

                            @if (session('status') === 'jobs-imported')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Imported.') }}</p>
                            @endif
                        </div>
                    </form>
                    <form method="post" action="{{ route('jobs.storeOptions') }}" class="space-y-6">
                        @csrf

                        <x-input-label for="xml_link" :value="__('XML Link')" />
                        <x-text-input id="xml_link" name="xml_link" type="text" class="mt-1 block w-full" :value="old('xml_link', $options['xml_link']['value'] ?? '')" />
                        <x-input-error class="mt-2" :messages="$errors->get('xml_link')" />

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'options-saved')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
