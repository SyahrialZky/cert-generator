@extends('layouts.app')
@section('title', 'Event')
@section('content')
    <div class="header mb-4">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Master Acara</h1>
                <p class="text-gray-400">Complete Collection of Acara</p>
            </div>
            <button class="bg-orange-500 hover:bg-orange-700 text-white px-4 py-2 rounded flex items-center"
                aria-haspopup="dialog" aria-expanded="false" aria-controls="modal-create" data-hs-overlay="#modal-create">
                <i class="fas fa-plus mr-2"></i> Create
            </button>
        </div>

        {{-- Pesan Sukses --}}
        @if (session('success'))
            <div id="success-message" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                <span class="font-medium">Berhasil!</span> {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 pb-6">
        <div class="col-span-12 xl:col-span-6">
            <div class="card">
                <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4">
                    <table id="eventTable" class="min-w-full overflow-hidden divide-y divide-gray-200 rounded-t-lg">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Acara</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Create --}}
    <div id="modal-create" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="modal-create-label">
        <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b">
                    <h3 id="modal-create-label" class="font-bold text-gray-800">Tambah Event</h3>
                    <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#modal-create">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <form id="create-form"  method="POST">
                    @csrf
                    <div class="p-4 overflow-y-auto">
                        <div class="space-y-3">
                            <div>
                                <label for="nama" class="block text-sm font-medium mb-">Nama Acara</label>
                                <input type="text" name="nama" class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-lg" required>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
                        <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#modal-create">Close</button>
                        <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Update --}}
    <button class="bg-orange-500 hidden hover:bg-orange-700 text-white px-4 py-2 rounded flex items-center"
        id="updateModal" aria-haspopup="dialog" aria-expanded="false" aria-controls="modal-update"
        data-hs-overlay="#modal-update"><i class="fas fa-plus mr-2"></i> update</button>

    <div id="modal-update" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="modal-update-label">
        <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
            <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b">
                    <h3 id="modal-update-label" class="font-bold text-gray-800">Update Event</h3>
                    <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#modal-update">
                        <span class="sr-only">Close</span>
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                </div>
                <form id="update-form" method="POST">
                    @csrf
                    <input type="hidden" id="update_id" name="id">
                    <div class="p-4 overflow-y-auto">
                        <div class="space-y-3">
                            <div>
                                <label for="nama" class="block text-sm font-medium mb-">Nama Acara</label>
                                <input type="text" name="nama" id="update-nama" class="py-3 px-4 block w-full border-gray-200 shadow-sm rounded-lg" required>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
                        <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#updateModal">Close</button>
                        <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#eventTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('/api/event/data') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'nama', name: 'nama' },
                    { data: null, render: function(data) {
                        return `
                            <button onclick="updateEvent(${data.id})" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-700">Update</button>
                            <button onclick="detailEvent(${data.id})" class="bg-yellow-500 text-white px-3 py-1 rounded-lg hover:bg-yellow-700 ml-2">Detail</button>
                            <button onclick="deleteEvent(${data.id})" class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-700 ml-2">Delete</button>
                        `;
                    }}
                ]
            });

            setTimeout(function() {
                $('#success-message').fadeOut('slow');
            }, 2000);
        });

        $(document).ready(function() {
        $("#create-form").submit(function(e) {
                e.preventDefault(); 

                let formData = new FormData(this); 

                $.ajax({
                    url: "/api/event/store", 
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") 
                    },
                    success: function(response) {
                        alert("Template berhasil dibuat!");
                        location.reload(); 
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON?.errors;
                        if (errors) {
                            alert("Gagal menyimpan template: " + JSON.stringify(errors));
                        } else {
                            alert("Terjadi kesalahan, coba lagi.");
                        }
                    }
                });
            });
        });

        function updateEvent(eventId) {
            console.log("Fetching data for event ID:", eventId);

            $.ajax({
                url: `/api/event/${eventId}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log("Data event diterima:", data);

                    $("#update_id").val(data.id);
                    $("#update-nama").val(data.nama);
                    
                    
                    $("#updateModal").trigger("click");
                },
                error: function(xhr) {
                    console.error("Error fetching event:", xhr.responseText);
                    alert("Gagal mengambil data event!");
                }
            });
        }

        $(document).ready(function() {
        $("#update-form").submit(function(e) {
            e.preventDefault(); 

            let eventId = $("#update_id").val(); 
            let formData = new FormData(this);

            $.ajax({
                url: `/api/event/${eventId}`, 
                type: "POST", 
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    "X-HTTP-Method-Override": "PUT"
                },
                success: function(response) {
                    alert("Event berhasil diperbarui!");
                    location.reload();
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON?.errors;
                    if (errors) {
                        alert("Gagal mengupdate event: " + JSON.stringify(errors));
                    } else {
                        alert("Terjadi kesalahan, coba lagi.");
                    }
                }
            });
        });
    });



        function deleteEvent(id) {
            if (confirm('Are you sure you want to delete this event?')) {
                $.ajax({
                    url: `api/event/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        location.reload();
                    },
                });
            }
        }
    </script>
@endpush