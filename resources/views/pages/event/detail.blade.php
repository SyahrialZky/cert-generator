@extends('layouts.app')

@section('content')

<div class="header mb-4">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="flex justify-between items-center">
        <div>
            <h1 id="event-name" class="text-3xl font-bold"></h1>
            <p id="event-name-paragraph" class="text-gray-400"></p>
        </div>
        <div class="flex gap-3">    
            <div class="flex gap-3">
                <button class="bg-orange-500 hover:bg-orange-700 text-white px-4 py-2 rounded flex items-center"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="modal-certificate"
                    data-hs-overlay="#modal-certificate">Buat Sertifikat</button>
                <button class="bg-orange-500 hover:bg-orange-700 text-white px-4 py-2 rounded flex items-center"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="modal-certificate"
                    data-hs-overlay="#modal-import">Import data peserta</button>
                <button class="bg-orange-500 hover:bg-orange-700 text-white px-4 py-2 rounded flex items-center"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="modal-create"
                    data-hs-overlay="#modal-create"><i class="fas fa-plus mr-2"></i> Create</button>
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

        <div id="modal-import" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="modal-import-label">
            <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
              <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                  <h3 id="modal-import-label" class="font-bold text-gray-800 dark:text-white">
                    Modal title
                  </h3>
                  <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#modal-import">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M18 6 6 18"></path>
                      <path d="m6 6 12 12"></path>
                    </svg>
                  </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <div class="max-w-sm">
                        <form id="import-form">
                            @csrf
                          <label class="block">
                            <span class="sr-only">Choose profile photo</span>
                            <input type="file" id="import-file" class="block w-full text-sm text-gray-500
                              file:me-4 file:py-2 file:px-4
                              file:rounded-lg file:border-0
                              file:text-sm file:font-semibold
                              file:bg-blue-600 file:text-white
                              hover:file:bg-blue-700
                              file:disabled:opacity-50 file:disabled:pointer-events-none
                              dark:text-neutral-500
                              dark:file:bg-blue-500
                              dark:hover:file:bg-blue-400
                            ">
                          </label>
                      </div>
                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                  <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-scale-animation-modal">
                    Close
                  </button>
                  <button type="submit" id="import-btn" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    Save changes
                  </button>
                </form>
    
                </div>
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
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Sebagai</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            let eventId = getEventIdFromUrl();

            if (!eventId) {
                alert("Event ID tidak ditemukan!");
                return;
            }
            let table = $('#pesertaTable').DataTable({
                processing: true,
                serverSide: false, 
                ajax: {
                    url: `http://127.0.0.1:8000/api/event/${eventId}/peserta`,
                    type: 'GET',
                    dataSrc: function (json) {
                        if (json.success) {
                            $('#event-name').text(`Peserta Acara: ${json.event.nama}`);
                            $('#event-name-paragraph').text(`List peserta acara ${json.event.nama}`);
                        } else {
                            $('#event-name').text("Event tidak ditemukan");
                        }
                        return json.participants;
                    }
                },
                columns: [
                    { data: null, render: (data, type, row, meta) => meta.row + 1 }, 
                    { data: 'nama', name:'nama', className:'whitespace-nowrap px-6 py-4 border-b border-gray-200' },
                    { data: 'email', name:'email', className:'whitespace-nowrap px-6 py-4 border-b border-gray-200'},
                    { data: 'sebagai', name:'sebagai', className:'whitespace-nowrap px-6 py-4 border-b border-gray-200' },
                ]
            });
        });

        function getEventIdFromUrl() {
            let pathArray = window.location.pathname.split('/');
            let eventId = pathArray[pathArray.length - 2]; 
            return eventId;
        }

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
    $("#import-btn").on("click", function(e) {
        e.preventDefault();

        let urlSegments = window.location.pathname.split('/');
        let event_id = urlSegments[urlSegments.indexOf("event") + 1];

        let formData = new FormData();

        formData.append("file", document.getElementById("import-file").files[0]);
        formData.append("event_id", event_id);

        let file = $("#import-file")[0].files[0];

        if (!file) {
            alert("Pilih file terlebih dahulu!");
            return;
        }

        formData.append("file", file);

        $.ajax({
            url: "/api/peserta/import",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert("Terjadi kesalahan saat mengunggah file.");
            }
        });
    });
});


    </script>
@endpush
