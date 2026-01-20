<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Scan Barcode Absensi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/app.css')
    <script src="https://unpkg.com/quagga@0.12.1/dist/quagga.min.js"></script>
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center text-white">

<div class="w-full max-w-md bg-gray-800 rounded-xl shadow-lg p-5">

    <h2 class="text-xl font-bold text-center mb-4">
        Scan Barcode Absensi
    </h2>

    {{-- Alert --}}
    @if (session('success'))
        <div class="bg-green-600/20 text-green-300 p-3 rounded mb-3 text-center">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-600/20 text-red-300 p-3 rounded mb-3 text-center">
            {{ session('error') }}
        </div>
    @endif

    {{-- CAMERA VIEW --}}
    <div id="scanner" class="w-full h-64 bg-black rounded-lg overflow-hidden mb-4"></div>

    {{-- HIDDEN FORM --}}
    <form id="scanForm" method="POST" action="{{ route('attendances.scan.process') }}">
        @csrf
        <input type="hidden" name="nipd" id="nipd">
    </form>

    <p class="text-sm text-gray-400 text-center mt-2">
        Arahkan kamera ke barcode siswa
    </p>

</div>

<script>
let scanned = false;

Quagga.init({
    inputStream: {
        name: "Live",
        type: "LiveStream",
        target: document.querySelector('#scanner'),
        constraints: {
            facingMode: "environment",
            width: 640,
            height: 480
        }
    },
    decoder: {
        readers: ["code_128_reader"]
    },
    locate: true
}, function (err) {
    if (err) {
        console.error(err);
        alert("Kamera tidak bisa diakses");
        return;
    }
    Quagga.start();
});

Quagga.onDetected(function (data) {
    if (scanned) return;

    if (!data || !data.codeResult || !data.codeResult.code) {
        return;
    }

    const code = data.codeResult.code.trim();

    // VALIDASI PANJANG (sesuaikan NIPD kamu)
    if (code.length < 5) {
        return;
    }

    scanned = true;

    console.log("Barcode valid:", code);

    document.getElementById('nipd').value = code;

    // Stop kamera sebelum submit
    Quagga.stop();

    setTimeout(() => {
        document.getElementById('scanForm').submit();
    }, 300);
});
setInterval(() => {
    console.log("Hidden input:", document.getElementById('nipd').value);
}, 1000);
</script>



</body>
</html>
