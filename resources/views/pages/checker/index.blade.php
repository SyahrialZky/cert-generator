<html>

<head>
    <title>
        Cek Sertifikat
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600;700&amp;display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: 'Nunito Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="relative bg-gradient-to-r from-orange-400 to-orange-500 text-white text-center py-16 mx-2 mt-2 rounded-lg overflow-hidden"
        style="height: 92vh">
        <img alt="Background buildings" class="absolute inset-0 w-full h-full object-cover opacity-20" height="1080"
            src="{{ asset('images/background-building.jpg') }}" width="1920" />
        <div class="relative z-10">
            <img alt="Radnext logo" class="mx-auto mb-6" height="50" src="{{ asset('images/radnet-logo2.png') }}"
                width="100" />
            <h1 class="text-4xl sm:text-5xl font-bold">
                Cek Sertifikat
            </h1>
            <p class="text-sm sm:text-xl mt-4">
                Cek validitas dan keaslian Certificate yang diterbitkan oleh PT Radnet Digital Indonesia
            </p>
            <div
                class="mt-10 flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                <input
                id="searchValue"
                    class="rounded-full py-3 px-6 text-gray-700 w-3/4 sm:w-1/2 max-w-md shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="tulis nomor sertifikat" type="text" />
                <button id="searchSertif"
                    class="bg-blue-600 text-white rounded-full py-3 px-8 shadow-lg hover:bg-blue-700 transition duration-300">
                    Search
                </button>
            </div>
        </div>
    </div>
    {{-- <div class="bg-white rounded-lg p-10 mx-auto mt-12 max-w-4xl mx-2">
   <h2 class="text-3xl font-semibold mb-6">
    Berikut data sertifikat untuk
   </h2>
   <div class="flex items-center">
    <img alt="Certificate logo" class="w-24 h-24 mr-8 rounded-full shadow-lg" height="100" src="https://storage.googleapis.com/a1aa/image/WxkXiZyYZFmI70zM_aNlBZUcIYM_EiuGj9Dlx6pw68E.jpg" width="100"/>
    <div>
     <p class="text-xl mb-2">
      <span class="font-semibold">
       Nama :
      </span>
      Rivco Mamoto, S.T.
     </p>
     <p class="text-xl mb-2">
      <span class="font-semibold">
       Serial Number :
      </span>
      ISD.25-03.FMEA.0026688E
     </p>
     <p class="text-xl mb-2">
      <span class="font-semibold">
       Nama Event :
      </span>
      Failure Mode &amp; Effect Analysis (FMEA)
     </p>
     <p class="text-xl">
      <span class="font-semibold">
       Sertifikat pertama kali diterbitkan tanggal :
      </span>
      2 Maret 2025
     </p>
    </div>
   </div>
  </div> --}}
    <footer class="bg-gray-800 text-white text-center py-6">
        <p class="text-sm">
            © 2025 PT Radnet Digital Indonesia. All rights reserved.
        </p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchSertif').click(function() {
                let searchValue = $('#searchValue').val();
                $.ajax({
                    url: '/api/check-certificate-number',
                    type: 'POST',
                    data: JSON.stringify({
                        certificate_number : searchValue,
                    }),
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert("Certificate valid");
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        })
    </script>
</body>

</html>
