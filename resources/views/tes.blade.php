<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h2>Absensi</h2>

        {{-- Absen Datang --}}
        <form action="{{ route('absen.datang') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="status" value="hadir">
            <input type="hidden" name="tanggal" value="{{ now()->format('Y-m-d') }}">
            <input type="hidden" name="jam_masuk" value="{{ now()->format('H:i:s') }}">

            <div class="mb-3">
                <label for="gambar">Ambil Gambar:</label><br>
                <video id="video" width="320" height="240" autoplay></video><br>
                <canvas id="canvas" width="320" height="240" style="display: none;"></canvas>
                <input type="hidden" name="gambar" id="gambarInput">
                <button type="button" id="snap" class="btn btn-primary mt-2">Ambil Gambar</button>
            </div>

            <button type="submit" class="btn btn-success">Absen Datang</button>
        </form>

        <hr>

        {{-- Absen Pulang --}}
        <form action="{{ route('absen.pulang') }}" method="POST">
            @csrf
            <input type="hidden" name="tanggal" value="{{ now()->format('Y-m-d') }}">
            <input type="hidden" name="jam_keluar" value="{{ now()->format('H:i:s') }}">
            <button type="submit" class="btn btn-warning">Absen Pulang</button>
        </form>
    </div>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const snap = document.getElementById("snap");
        const gambarInput = document.getElementById("gambarInput");

        // Akses kamera
        navigator.mediaDevices.getUserMedia({
            video: true
        }).then(stream => {
            video.srcObject = stream;
        });

        snap.addEventListener("click", () => {
            canvas.getContext('2d').drawImage(video, 0, 0, 320, 240);
            const imageData = canvas.toDataURL("image/png");
            gambarInput.value = imageData;
            alert("Gambar diambil!");
        });
    </script>
</body>

</html>
