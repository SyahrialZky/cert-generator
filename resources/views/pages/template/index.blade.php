@extends('layouts.app')
@section('title', 'template')
@section('content')
    <div class="header mb-4">
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
                <h1 class="text-3xl font-bold">List template</h1>
                <p class="text-gray-400">Complete Collection of template</p>
            </div>
            <div class="flex gap-3">
                <button class="bg-orange-500 hover:bg-orange-700 text-white px-4 py-2 rounded flex items-center"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="modal-create"
                    data-hs-overlay="#modal-create"><i class="fas fa-plus mr-2"></i> Create</button>
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


        <div id="modal-create"
            class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none"
            role="dialog" tabindex="-1" aria-labelledby="modal-create-label">
            <div
                class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                    <div class="flex justify-between items-center py-3 px-4 border-b">
                        <h3 id="modal-create-label" class="font-bold text-gray-800">
                            Tambah Template Sertifikat
                        </h3>
                        <button type="button"
                            class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none"
                            aria-label="Close" data-hs-overlay="#modal-create">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <form id="createTemplateForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="p-4 overflow-y-auto">
                            <div class="space-y-3">
                                <div>
                                    <label for="template-name" class="block text-sm font-medium">Nama Template</label>
                                    <input type="text" id="template-name" name="name"
                                        class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="Masukkan nama template" required>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <label for="template-file" class="block text-sm font-medium">Upload Template</label>
                                    <input type="file" id="template-file" name="file"
                                        class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500"
                                        accept=".png,.jpg,.jpeg,.pdf" required>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
                            <button type="button"
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50"
                                data-hs-overlay="#modal-create">
                                Close
                            </button>
                            <button type="submit"
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 pb-6">
        <div class="col-span-12 xl:col-span-6">
            <div class="card">
                <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4">
                    <table id="templateTable" class="min-w-full overflow-hidden divide-y divide-gray-200 rounded-t-lg"
                        data-storage-url="{{ asset('storage') }}">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    <input type="checkbox" id="checkAll">
                                </th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    No</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Nama</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Preview</th>

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
                        Update Template
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
                <form id="updateTemplateForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="update_id">

                    <div class="p-4 overflow-y-auto">
                        <div class="space-y-3">
                            <label for="update_name" class="block text-sm font-medium">Nama Template</label>
                            <input type="text" id="update_name" name="name"
                                class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-lg text-sm">
                        </div>

                        <div class="space-y-3">
                            <label for="update_file" class="block text-sm font-medium">File Template</label>
                            <input type="file" id="update_file" name="file"
                                class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-lg text-sm">
                        </div>
                    </div>

                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
                        <button type="button"
                            class="py-2 px-3 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50"
                            data-hs-overlay="#modal-update">
                            Close
                        </button>
                        <button type="submit"
                            class="py-2 px-3 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700">
                            Update
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
@push('js')
    <script>
        $(document).ready(function() {
            const assetBaseUrl = "{{ request()->getSchemeAndHttpHost() }}/storage";
            $('#templateTable').DataTable({
                deferRender: true,
                processing: true,
                serverSide: true,
                responsive: true,
                "initComplete": function(settings, json) {
                    $('.dataTables_scrollBody thead tr').css({
                        visibility: 'collapse'
                    });
                },
                ajax: "{{ url('/api/template/data') }}",
                columns: [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        className: 'text-left whitespace-nowrap px-6 py-4 border-b border-gray-200',
                        render: function(data) {
                            return `<input type="checkbox" name="id[]" class="user-checkbox" value="${data.id}">`;
                        }
                    },
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'name',
                        name: 'name',
                        className: 'whitespace-nowrap px-6 py-4 border-b border-gray-200'
                    },
                    {
                        data: 'file_path',
                        name: 'file_path',
                        className: 'whitespace-nowrap px-6 py-4 border-b border-gray-200',
                        render: function(data) {
                            if (!data) {
                                return "No Preview";
                            }

                            const storageUrl = `${assetBaseUrl}/${data}`;
                            const imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
                            const fileExt = data.split('.').pop().toLowerCase();

                            if (imageExtensions.includes(fileExt)) {
                                return `<a href="${storageUrl}" target="_blank">
                                        <img src="${storageUrl}" alt="Preview" width="100" class="rounded-lg shadow-sm">
                                    </a>`;
                            } else {
                                // return `<a href="${storageUrl}" target="_blank" class="text-blue-500 underline">View File</a>`;
                                return `<p class="text-gray-500">Image not available</p>`;
                            }
                        }
                    },

                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        className: 'whitespace-nowrap px-6 py-4 border-b border-gray-200',
                        render: function(data) {
                            return `
                        <button onclick="updateTemplate(${data.id})" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-700">Update</button>
                        <button onclick="deleteTemplate(${data.id})" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-700 ml-2">Delete</button>
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
                    $(row).find('.user-checkbox').on('click', function() {
                        if ($(this).is(':checked')) {
                            $(row).addClass('bg-blue-100');
                        } else {
                            $(row).removeClass('bg-blue-100');
                        }
                    });

                    $('.btn-delete-data').addClass('hidden');
                }
            });
        });

        $(document).ready(function() {
            $("#createTemplateForm").submit(function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: "/api/template/store",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Template berhasil dibuat!",
                            confirmButtonColor: "#3085d6"
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON?.errors;
                        if (errors) {
                            alert("Gagal menyimpan template: " + JSON.stringify(errors));
                        } else {
                            alert("Terjadi kesalahan, coba lagi.");
                        }
                        Swal.fire({
                            icon: "error",
                            title: "Error!",
                            text: response.message || "Something went wrong!"
                        });
                    }
                });
            });
        });

        function deleteTemplate(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');

                    if (!csrfToken) {
                        console.error(
                            "CSRF token tidak ditemukan. Pastikan ada <meta name='csrf-token' content='{{ csrf_token() }}'> di <head>."
                        );
                        return;
                    }

                    $.ajax({
                        url: `/api/template/${id}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: "success",
                                title: "Success!",
                                text: "Template berhasil dihapus!",
                                confirmButtonColor: "#3085d6"
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", xhr.responseText);
                            Swal.fire({
                                icon: "error",
                                title: "Error!",
                                text: response.message || "Something went wrong!"
                            });
                        }
                    });
                }
            });
        }

        function updateTemplate(templateId) {
            console.log("Fungsi updateTemplate dipanggil untuk ID:", templateId);

            $.ajax({
                url: `/api/template/${templateId}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log("Data diterima:", data);


                    $("#update_id").val(data.id);
                    $("#update_name").val(data.name);


                    $("#updateModal").trigger("click");
                },
                error: function(xhr) {
                    console.error("Error fetching template:", xhr.responseText);
                    alert("Gagal mengambil data template!");
                }
            });
        }

        $(document).ready(function() {
            $("#updateTemplateForm").submit(function(e) {
                e.preventDefault();

                let templateId = $("#update_id").val();
                let formData = new FormData(this);

                $.ajax({
                    url: `/api/template/${templateId}`,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        "X-HTTP-Method-Override": "PUT"
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            title: "Success!",
                            text: "Template berhasil diupdate!",
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON?.errors;
                        if (errors) {
                            alert("Gagal mengupdate template: " + JSON.stringify(errors));
                        } else {
                            alert("Terjadi kesalahan, coba lagi.");
                        }
                        Swal.fire({
                            icon: "error",
                            title: "Error!",
                            text: response.message || "Something went wrong!"
                        });
                    }
                });
            });
        });
    </script>
@endpush
