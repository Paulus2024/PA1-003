@extends('dashboard.masyarakat.component.main')

@section('masyarakat_content')
    <div class="page-title dark-background" style="background-image: url({{ asset('assets/img/hero-carousel/5.jpg') }});">
        <div class="container position-relative">
            <h1>Histori Pemesanan Alat</h1>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.masyarakat">Home</a></li>
                    <li class="current">Form Pengembalian</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Detail Peminjaman & Pengembalian Alat</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <h5>Informasi Peminjaman</h5>
                <p><strong>Nama Alat:</strong> {{ $peminjaman->alat->nama_alat_pertanian ?? 'N/A' }}</p>
                {{-- Menggunakan relasi 'alat' --}}
                <p><strong>Peminjam:</strong> {{ $peminjaman->nama_peminjam }}</p>
                <p><strong>Tanggal Pinjam:</strong>
                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</p>
                <p><strong>Rencana Kembali:</strong>
                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y') }}</p>
                <p><strong>Status Peminjaman:</strong> <span
                        class="status-badge status-{{ strtolower($peminjaman->status_peminjaman) }}">{{ ucfirst(str_replace('_', ' ', $peminjaman->status_peminjaman)) }}</span>
                </p>
                <p><strong>Status Pengembalian:</strong>
                    @if ($peminjaman->status_pengembalian)
                        <span
                            class="status-badge status-{{ strtolower(str_replace('menunggu_verifikasi', 'menunggu', $peminjaman->status_pengembalian)) }}">
                            {{ ucfirst(str_replace('_', ' ', $peminjaman->status_pengembalian)) }}
                        </span>
                    @else
                        <span class="status-badge status-belumdiajukan">Belum Diajukan</span>
                    @endif
                </p>

                @if (
                    $peminjaman->bukti_pengembalian &&
                        ($peminjaman->status_pengembalian == 'menunggu_verifikasi' || $peminjaman->status_pengembalian == 'disetujui'))
                    <div class="mt-3">
                        <h5>Bukti Pengembalian Anda:</h5>
                        <img src="{{ Storage::url($peminjaman->bukti_pengembalian) }}" alt="Bukti Pengembalian Anda"
                            style="max-width: 250px; border-radius: 8px; margin-bottom:15px;">
                        @if ($peminjaman->status_pengembalian == 'menunggu_verifikasi')
                            <p class="alert alert-info py-2">Menunggu verifikasi BUMDes.</p>
                        @elseif($peminjaman->status_pengembalian == 'disetujui')
                            <p class="alert alert-success py-2">Pengembalian Anda sudah disetujui pada
                                {{ $peminjaman->tanggal_kembali_aktual ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali_aktual)->format('d M Y H:i') : '' }}.
                            </p>
                        @endif
                    </div>
                @endif

                @if ($peminjaman->status_pengembalian == 'ditolak')
                    <div class="alert alert-danger mt-3">
                        Pengembalian Anda sebelumnya ditolak.
                        @if ($peminjaman->catatan_admin)
                            <br><strong>Alasan dari BUMDes:</strong> {{ $peminjaman->catatan_admin }}
                        @endif
                        <br>Silakan ajukan kembali dengan bukti yang sesuai.
                    </div>
                @endif

                @if (
                    (($peminjaman->status_peminjaman == 'disetujui' || $peminjaman->status_peminjaman == 'dipinjam') &&
                        ($peminjaman->status_pengembalian != 'menunggu_verifikasi' &&
                            $peminjaman->status_pengembalian != 'disetujui')) ||
                        $peminjaman->status_pengembalian == 'ditolak')
                    <hr class="my-4">
                    <h5 class="mb-3">Formulir Pengajuan Pengembalian</h5>
                    <style>
                        #cameraFeed,
                        #snapshotCanvas {
                            display: none;
                            max-width: 100%;
                            margin-top: 10px;
                            border-radius: 8px;
                        }

                        video,
                        canvas {
                            max-width: 100%;
                            height: auto;
                        }
                    </style>

                    <form action="{{ route('pengembalian.ajukan', $peminjaman->id) }}" method="POST"
                        enctype="multipart/form-data" id="formPengembalian">
                        @csrf
                        <div class="mb-3">
                            <label for="bukti_pengembalian_file" class="form-label">Unggah Foto Bukti Pengembalian (Max:
                                2MB):</label>
                            <input type="file" name="bukti_pengembalian" id="bukti_pengembalian_file" accept="image/*"
                                class="form-control" required>
                        </div>

                        <button type="button" id="useCameraBtn" class="btn btn-outline-primary mb-2"><i
                                class="bi bi-camera-fill"></i> Gunakan Kamera</button>

                        <div id="cameraContainer" style="display:none;" class="text-center">
                            <video id="cameraFeed" autoplay playsinline
                                style="display: block !important;
                                       width: 320px !important;
                                       height: 240px !important;
                                       border: 5px solid limegreen !important; /* Warna yang sangat mencolok */
                                       background-color: transparent !important;">
                            </video>
                            <button type="button" id="takeSnapshotBtn" class="btn btn-warning"><i class="bi bi-camera"></i>
                                Ambil Foto</button>
                        </div>
                        <canvas id="snapshotCanvas"></canvas>

                        <div class="mt-3">
                            <label class="form-label">Preview Bukti:</label>
                            <img id="preview"
                                style="max-width: 100%; max-height:300px; margin-top: 10px; border:1px solid #ccc; border-radius: 8px; display:block;"
                                alt="Preview Bukti Pengembalian">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 w-100"><i class="bi bi-send-check"></i> Ajukan
                            Pengembalian</button>
                    </form>

                    <script>
                        const formPengembalian = document.getElementById('formPengembalian');
                        const useCameraBtn = document.getElementById('useCameraBtn');
                        const cameraContainer = document.getElementById('cameraContainer');
                        const videoElement = document.getElementById('cameraFeed');
                        const takeSnapshotBtn = document.getElementById('takeSnapshotBtn');
                        const canvasElement = document.getElementById('snapshotCanvas');
                        const previewImg = document.getElementById('preview');
                        const fileInputElement = document.getElementById('bukti_pengembalian_file');
                        let stream;

                        fileInputElement.addEventListener('change', function(e) {
                            const file = e.target.files[0];
                            if (file) {
                                previewImg.src = URL.createObjectURL(file);
                                previewImg.style.display = 'block';
                                if (stream) {
                                    stopCameraStream();
                                }
                                cameraContainer.style.display = 'none';
                                useCameraBtn.textContent = 'Gunakan Kamera';
                                useCameraBtn.classList.remove('btn-danger');
                                useCameraBtn.classList.add('btn-outline-primary');
                            } else {
                                previewImg.src = "";
                                previewImg.style.display = 'none';
                            }
                        });

                        useCameraBtn.addEventListener('click', async () => {
                            if (stream) {
                                stopCameraStream();
                                cameraContainer.style.display = 'none';
                                useCameraBtn.innerHTML = '<i class="bi bi-camera-fill"></i> Gunakan Kamera';
                                useCameraBtn.classList.remove('btn-danger');
                                useCameraBtn.classList.add('btn-outline-primary');
                                return;
                            }
                            try {
                                stream = await navigator.mediaDevices.getUserMedia({
                                    video: {
                                        facingMode: 'environment'
                                    }
                                });

                                console.log('Objek stream kamera:', stream);
                                if (stream && stream.getTracks().length > 0) {
                                    console.log('Track video aktif:', stream.getVideoTracks()[0].label, stream.getVideoTracks()[
                                        0].readyState);
                                } else {
                                    console.log('Tidak ada track video aktif di stream.');
                                }

                                videoElement.srcObject = stream;

                                videoElement.onloadedmetadata = () => {
                                    console.log('Metadata video sudah dimuat.');
                                    console.log('Ukuran asli video dari stream:', videoElement.videoWidth, 'x', videoElement
                                        .videoHeight);
                                    console.log('Status video (readyState):', videoElement.readyState);
                                };
                                videoElement.onplaying = () => {
                                    console.log('Video seharusnya sedang berputar (playing).');
                                };
                                videoElement.onerror = (e) => {
                                    console.error('Ada error pada elemen video:', e);
                                };

                                videoElement.style.display = 'block';
                                cameraContainer.style.display = 'block';
                                takeSnapshotBtn.style.display = 'inline-block'; // Make sure it's visible
                                previewImg.src = '#';
                                previewImg.style.display = 'none';
                                fileInputElement.value = '';
                                useCameraBtn.innerHTML = '<i class="bi bi-x-circle-fill"></i> Tutup Kamera';
                                useCameraBtn.classList.remove('btn-outline-primary');
                                useCameraBtn.classList.add('btn-danger');
                            } catch (err) {
                                console.error("Error accessing camera: ", err);
                                alert("Tidak bisa mengakses kamera. Pastikan izin diberikan. Error: " + err.message);
                                try {
                                    stream = await navigator.mediaDevices.getUserMedia({
                                        video: true
                                    });
                                } catch (fallbackErr) {
                                    console.error("Error accessing fallback camera: ", fallbackErr);
                                    alert("Tidak bisa mengakses kamera (fallback). Error: " + fallbackErr.message);
                                }
                            }
                        });

                        function stopCameraStream() {
                            if (stream) {
                                stream.getTracks().forEach(track => track.stop());
                                stream = null;
                                videoElement.srcObject = null;
                                videoElement.style.display = 'none';
                                takeSnapshotBtn.style.display = 'none';
                            }
                        }

                        takeSnapshotBtn.addEventListener('click', () => {
                            if (!stream || !videoElement.videoWidth) {
                                alert('Kamera belum siap atau stream tidak aktif.');
                                return;
                            }
                            const context = canvasElement.getContext('2d');
                            const videoWidth = videoElement.videoWidth;
                            const videoHeight = videoElement.videoHeight;
                            canvasElement.width = videoWidth;
                            canvasElement.height = videoHeight;

                            context.drawImage(videoElement, 0, 0, videoWidth, videoHeight);

                            const now = new Date();
                            const timestamp = now.toLocaleString('id-ID', {
                                day: '2-digit',
                                month: 'short',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit'
                            });

                            let fontSize = Math.max(12, Math.min(videoWidth / 30, videoHeight / 20)); // Ukuran font dinamis
                            context.font = `bold ${fontSize}px Arial`;
                            context.textAlign = 'left';
                            const padding = 10;

                            const textMetrics = context.measureText(timestamp);
                            const textHeightWithPadding = fontSize + 8; // Perkiraan tinggi teks + padding background

                            context.fillStyle = 'rgba(0, 0, 0, 0.6)';
                            context.fillRect(padding - 4, videoHeight - textHeightWithPadding - padding + 4, textMetrics.width + 8,
                                textHeightWithPadding);

                            context.fillStyle = 'yellow';
                            context.fillText(timestamp, padding, videoHeight - padding - (fontSize * 0.2));


                            const dataUrl = canvasElement.toDataURL('image/jpeg', 0.9);
                            previewImg.src = dataUrl;
                            previewImg.style.display = 'block';

                            canvasElement.toBlob(function(blob) {
                                const fileName = `bukti_pengembalian_${Date.now()}.jpg`;
                                const imageFile = new File([blob], fileName, {
                                    type: 'image/jpeg'
                                });
                                const dataTransfer = new DataTransfer();
                                dataTransfer.items.add(imageFile);
                                fileInputElement.files = dataTransfer.files;
                            }, 'image/jpeg', 0.9);

                            stopCameraStream();
                            cameraContainer.style.display = 'none';
                            useCameraBtn.innerHTML = '<i class="bi bi-camera-fill"></i> Gunakan Kamera';
                            useCameraBtn.classList.remove('btn-danger');
                            useCameraBtn.classList.add('btn-outline-primary');
                        });

                        if (formPengembalian) { // Pastikan form ada sebelum add event listener
                            formPengembalian.addEventListener('submit', function(event) {
                                if (fileInputElement.files.length === 0) {
                                    alert('Bukti foto pengembalian wajib diisi. Silakan unggah file atau ambil foto dari kamera.');
                                    event.preventDefault();
                                }
                            });
                        }
                    </script>
                @else
                    @if ($peminjaman->status_pengembalian != 'disetujui')
                        <p class="mt-3"><i>Tidak dapat mengajukan pengembalian untuk item ini saat ini. Status Peminjaman:
                                {{ $peminjaman->status_peminjaman }}. Status Pengembalian:
                                {{ $peminjaman->status_pengembalian ?? 'Belum ada' }}.</i></p>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <footer id="footer" class="footer dark-background">
        @include('pengguna.component.footer')
    </footer>
@endsection
