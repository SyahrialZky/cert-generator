@extends('layouts.app')

@section('content')

<div class="header mb-4">
    <div class="flex justify-between items-center">
        <div>
            <h1 id="event-name" class="text-3xl font-bold"></h1>
            <p id="event-name-paragraph" class="text-gray-400"></p>
        </div>
        <div class="flex gap-3">
            <button class="bg-orange-500 hidden hover:bg-orange-700 text-white px-4 py-2 rounded flex items-center"
                aria-haspopup="dialog" aria-expanded="false" aria-controls="modal-create"
                data-hs-overlay="#modal-create"><i class="fas fa-plus mr-2"></i> Create</button>
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


    </script>
@endpush
