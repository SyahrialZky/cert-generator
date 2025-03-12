@extends('layouts.app')
@section('title', 'Peserta')
@section('content')
    <div class="header mb-4">

        {{-- @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                <span class="font-medium">Berhasil!</span> {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                <span class="font-medium">Terjadi kesalahan!</span>
                <ul class="mt-1 ml-4 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">List Peserta</h1>
                <p class="text-gray-400">Complete Collection of Peserta</p>
            </div>
            <div class="flex gap-3">
                <button class="bg-orange-500 hover:bg-orange-700 text-white px-4 py-2 rounded flex items-center"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="modal-certificate"
                    data-hs-overlay="#modal-certificate">Buat Sertifikat</button>
                <button class="bg-orange-500 hover:bg-orange-700 text-white px-4 py-2 rounded flex items-center"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="modal-create"
                    data-hs-overlay="#modal-create"><i class="fas fa-plus mr-2"></i> Create</button>
            </div>
        </div>

        <div id="modal-certificate"
            class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
            role="dialog" tabindex="-1" aria-labelledby="modal-certificate-label">
            <div
                class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                    <div class="flex justify-between items-center py-3 px-4 border-b">
                        <h3 id="modal-certificate-label" class="font-bold text-gray-800">
                            Buat Sertifikat
                        </h3>
                        <button type="button"
                            class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none"
                            aria-label="Close" data-hs-overlay="#modal-certificate">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                    {{-- <form action=" {{ route('peserta.sertificate') }} " method="POST">
                        @csrf --}}
                    <div class="p-4 overflow-y-auto">
                        <div class="max-w-sm space-y-3">
                            <div>
                                <label for="hs-inline-leading-select-label" class="block text-sm font-medium mb-2">Pilih
                                    Acara</label>
                                <div class="relative">
                                    <select name="events" id="events"
                                        class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="">-- Pilih Event --</option>
                                        @foreach ($events as $event)
                                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="max-w-sm space-y-3">
                            <div>
                                <label for="hs-inline-leading-select-label" class="block text-sm font-medium mb-2">Pilih
                                    Template</label>
                                <div class="relative">
                                    <select name="template" id="template"
                                        class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="">-- Pilih Template --</option>
                                        @foreach ($template as $i)
                                            <option value="{{ $i->id }}">{{ $i->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="max-w-sm space-y-3">
                            <div>
                                <label for="hs-inline-leading-select-label" class="block text-sm font-medium mb-2">Tanggal
                                    Acara</label>
                                <div class="relative">
                                    <input type="date" id="date" name="date"
                                        class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
                        <button type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                            data-hs-overlay="#modal-certificate">
                            Close
                        </button>
                        <button type="button" id="generateSertificate"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="importModal"
            class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
            role="dialog" tabindex="-1" aria-labelledby="importModal-label">
            <div
                class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                    <div class="flex justify-between items-center py-3 px-4 border-b">
                        <h3 id="importModal-label" class="font-bold text-gray-800">
                            Modal title
                        </h3>
                        <button type="button"
                            class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none"
                            aria-label="Close" data-hs-overlay="#importModal">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-4 overflow-y-auto">
                        <label for="file" class="block text-sm font-medium text-gray-700">File</label>
                        <input type="file" id="fileInput" name="file"
                            class="block w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Choose file" required>
                    </div>
                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
                        <button type="button" id="closeModalImport"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                            data-hs-overlay="#importModal">
                            Close
                        </button>
                        <button id="importFile" type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{-- 
        <input type="file" id="fileInput" />
        <button class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-700" id="importFile">oke Client</button> --}}

        <div id="hs-scale-animation-modal"
            class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
            role="dialog" tabindex="-1" aria-labelledby="hs-scale-animation-modal-label">
            <div
                class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                    <div class="flex justify-between items-center py-3 px-4 border-b">
                        <h3 id="hs-scale-animation-modal-label" class="font-bold text-gray-800">
                            Modal title
                        </h3>
                        <button type="button"
                            class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none"
                            aria-label="Close" data-hs-overlay="#hs-scale-animation-modal">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-4 overflow-y-auto">
                        <h1>Pilih Wilayah</h1>
                        <select name="wilayah" id="wilayah"
                            class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-2">
                            <option value="surabaya">Surabaya</option>
                            <option value="jakarta">Jakarta</option>
                            <option value="bandung">Bandung</option>
                        </select>

                        {{-- <h1>Pilih Template</h1> --}}
                    </div>
                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
                        <button type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                            data-hs-overlay="#hs-scale-animation-modal">
                            Close
                        </button>
                        <button type="button" id="sendEmailBtn"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            Save changes
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-create"
            class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
            role="dialog" tabindex="-1" aria-labelledby="modal-create-label">
            <div
                class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                    <div class="flex justify-between items-center py-3 px-4 border-b">
                        <h3 id="modal-create-label" class="font-bold text-gray-800">
                            Tambah Peserta
                        </h3>
                        <button type="button"
                            class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none"
                            aria-label="Close" data-hs-overlay="#modal-create">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form id="create-peserta-form" method="POST">
                        @csrf
                        <div class="p-4 overflow-y-auto space-y-3">
                            <div>
                                <label for="nama" class="block text-sm font-medium">Nama</label>
                                <input type="text" id="nama" name="nama" required
                                    class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan Nama">
                            </div>
                    
                            <div>
                                <label for="email" class="block text-sm font-medium">Email</label>
                                <input type="email" id="email" name="email" required
                                    class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan Email">
                            </div>
                    
                            <div>
                                <label for="event_id" class="block text-sm font-medium">Acara</label>
                                <select id="event_id" name="event_id" required
                                    class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">-- Pilih Acara --</option>
                                    @foreach($events as $event)
                                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <div>
                                <label for="sebagai" class="block text-sm font-medium">Sebagai</label>
                                <input type="text" id="sebagai" name="sebagai" required
                                    class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Masukkan Peran (Contoh: Peserta, Pembicara, Moderator)">
                            </div>
                        </div>
                    
                        <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
                            <button type="button"
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none"
                                data-hs-overlay="#modal-create">Close</button>
                            <button type="submit"
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-blue-500 text-white hover:bg-blue-600 focus:outline-none">Create</button>
                    

                </div>
            </form>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 pb-6">
        <div class="col-span-12 xl:col-span-6">
            <div class="card">
                <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4">
                    <table id="pesertaTable" class="min-w-full overflow-hidden divide-y divide-gray-200 rounded-t-lg">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    <input type="checkbox" id="checkAll">
                                </th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    ID</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Nama</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Email</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Acara</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Sebagai</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div id="template-modal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="template-modal-label">
        <div
            class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div
                class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                    <h3 id="template-modal-label" class="font-bold text-gray-800 dark:text-white">
                        Pilih Template
                    </h3>
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#template-modal">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="p-4 overflow-y-auto">
                    <label for="template" class="block text-sm font-medium text-gray-700 mb-2">Pilih Template</label>
                    <select id="template" name="template"
                        class="block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">-- Pilih Template --</option>

                    </select>
                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        data-hs-overlay="#template-modal">
                        Close
                    </button>
                    <button type="button" id="sendEmailBtn"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <button class="bg-orange-500 hidden hover:bg-orange-700 text-white px-4 py-2 rounded flex items-center"
        id="updateModal" aria-haspopup="dialog" aria-expanded="false" aria-controls="modal-update"
        data-hs-overlay="#modal-update"><i class="fas fa-plus mr-2"></i> update</button>

    <div id="modal-update"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="modal-update-label">
        <div
            class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b">
                    <h3 id="modal-update-label" class="font-bold text-gray-800">
                        Update Peserta
                    </h3>
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none"
                        aria-label="Close" data-hs-overlay="#modal-update">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <form id="update-peserta-form">
                    @csrf
                    <input type="hidden" id="update_id">
                    <div class="p-4 overflow-y-auto space-y-3">
                        <div>
                            <label for="nama" class="block text-sm font-medium">Nama</label>
                            <input type="text" id="update_nama" name="nama" required
                                class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan Nama">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium">Email</label>
                            <input type="email" id="update_email" name="email" required
                                class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan Email">
                        </div>
                        <div>
                            <label for="update_event_id" class="block text-sm font-medium">Acara</label>
                            <select id="update_event_id" name="update_event_id" required
                                class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Pilih Acara --</option>
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="sebagai" class="block text-sm font-medium">Sebagai</label>
                            <input type="text" id="update_sebagai" name="sebagai" required
                                class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan Peran (Contoh: Peserta, Pembicara, Moderator)">
                        </div>
                    </div>    
                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
                        <button type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none"
                            data-hs-overlay="#modal-create">Close</button>
                        <button type="submit"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-blue-500 text-white hover:bg-blue-600 focus:outline-none">Update</button>
            </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#pesertaTable').DataTable({
                deferRender: true,
                processing: true,
                serverSide: true,
                responsive: true,
                "initComplete": function(settings, json) {
                    $('.dataTables_scrollBody thead tr').css({
                        visibility: 'collapse'
                    });
                },
                ajax: "{{ url('/api/peserta/data') }}",
                columns: [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        className: 'text-left whitespace-nowrap px-6 py-4 border-b border-gray-200',
                        render(data) {
                            return `<input type="checkbox" name="id[]" class="user-checkbox" value="${data.id}">`;
                        }
                    },
                    {
                        data: 'DT_RowIndex',
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        className: 'whitespace-nowrap px-6 py-4 border-b border-gray-200'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        className: 'whitespace-nowrap px-6 py-4 border-b border-gray-200'
                    },
                    {
                        data: 'event_nama',
                        name: 'event_nama',
                        className: 'whitespace-nowrap px-6 py-4 border-b border-gray-200'
                    },
                    {
                        data: 'sebagai',
                        name: 'sebagai',
                        className: 'whitespace-nowrap px-6 py-4 border-b border-gray-200'
                    },
                    {
                        data: null,
                        className: 'whitespace-nowrap px-6 py-4 border-b border-gray-200',
                        render(data) {
                            return `
                                <button onclick="updatePeserta(${data.id})" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-700">Update</button>
                                <button onclick="deletePeserta(${data.id})" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-700 ml-2">Delete</button>
                            `;
                        }
                    }
                ],
                "language": {
                    "paginate": {
                        "previous": "&laquo;",
                        "next": "&raquo;"
                    }
                },
                "pagingType": "simple_numbers",
                "drawCallback": function(settings) {
                    var paginateLinks = $('.paginate_button a');
                    var paginateButton = $('.paginate_button');
                    paginateLinks.each(function() {
                        $(this).addClass('bg-transparent p-2');
                    });
                    paginateButton.each(function() {
                        $(this).addClass('p-2');
                    });
                    $('.paginate_button.active a').addClass('bg-blue-600 text-white');

                    $('.dataTables_scrollBody thead tr').css({
                        visibility: 'collapse'
                    });
                },

                "rowCallback": function(row, data, index) {
                    $(row).find('.check-for-delete').on('click', function() {
                        if ($(this).is(':checked')) {
                            $(row).addClass('bg-blue-100');
                        } else {
                            $(row).removeClass('bg-blue-100');
                        }
                    });

                    $('.btn-delete-data').addClass('hidden');
                }
            });

            $('#generateSertificate').click(function() {
                let event = $('#events').val();
                let template = $('#template').val();
                let tanggal = $('#tanggal').val();

                $.ajax({
                    url: '/api/generate-certificate',
                    type: 'POST',
                    data: JSON.stringify({
                        event: event,
                        template: template,
                        tanggal: tanggal
                    }),
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);

                        if (response.success && response.zipUrl) {
                            $('#downloadContainer').html(
                                '<a href="' + response.zipUrl +
                                '" class="btn btn-primary" download>' +
                                '<i class="fa fa-download"></i> Download All Certificates (ZIP)' +
                                '</a>'
                            );
                            window.location.href = response.zipUrl;
                        } else {
                            alert("error generate sertificate")
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        let errorMsg = 'Error generating certificates';
                        try {
                            const errorObj = JSON.parse(xhr.responseText);
                            if (errorObj.message) {
                                errorMsg = errorObj.message;
                            }
                        } catch (e) {}
                        $('#generateStatus').html('<div class="alert alert-danger">' +
                            errorMsg + '</div>');
                    }
                });
            });

            $(document).ready(function() {
            $("#create-peserta-form").submit(function(event) {
                event.preventDefault(); 

                let formData = {
                    nama: $("#nama").val(),
                    email: $("#email").val(),
                    event_id: $("#event_id").val(),
                    sebagai: $("#sebagai").val(),
                    _token: "{{ csrf_token() }}"
                };

                $.ajax({
                    url: "/api/peserta/store", 
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        alert("Peserta berhasil ditambahkan!");
                        location.reload(); 
                    },
                    error: function(xhr) {
                        console.error("Gagal menambahkan peserta:", xhr.responseText);
                        alert("Terjadi kesalahan, coba lagi.");
                    }
                });
            });
        });

        });

        function updatePeserta(id) {
            console.log("Update Peserta ID:", id);

            $.ajax({
                url: `/api/peserta/${id}`, 
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log("Data peserta:", data);

                    $("#update_id").val(data.id);
                    $("#update_nama").val(data.nama);
                    $("#update_email").val(data.email);
                    $("#update_sebagai").val(data.sebagai);

                    $("#update_event_id").val(data.event_id).trigger("change");
                    $("#updateModal").trigger("click");

                },
                error: function(xhr) {
                    console.error("Error fetching peserta:", xhr.responseText);
                    alert("Gagal mengambil data peserta.");
                }
            });
        }

        $("#update-peserta-form").submit(function(event) {
            event.preventDefault(); 

            let pesertaId = $("#update_id").val();
            let formData = {
                nama: $("#update_nama").val(),
                email: $("#update_email").val(),
                event_id: $("#update_event_id").val(),
                sebagai: $("#update_sebagai").val(),
                _token: "{{ csrf_token() }}"
            };

            $.ajax({
                url: `/api/peserta/${pesertaId}`,
                type: "PUT",
                data: formData,
                success: function(response) {
                    alert("Peserta berhasil diperbarui!");
                    location.reload(); 
                },
                error: function(xhr) {
                    console.error("Gagal memperbarui peserta:", xhr.responseText);
                    alert("Terjadi kesalahan saat update peserta.");
                }
            });
        });

        function deletePeserta(id) {
            if (!confirm("Apakah Anda yakin ingin menghapus peserta ini?")) return;

            $.ajax({
                url: `/api/peserta/${id}`,
                type: "DELETE",
                data: { _token: "{{ csrf_token() }}" },
                success: function(response) {
                    alert("Peserta berhasil dihapus!");
                    location.reload(); 
                },
                error: function(xhr) {
                    console.error("Error deleting peserta:", xhr.responseText);
                    alert("Gagal menghapus peserta.");
                }
            });
        }
    </script>
@endpush
