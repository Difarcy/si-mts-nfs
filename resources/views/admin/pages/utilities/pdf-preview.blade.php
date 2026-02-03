<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Preview</title>
    <!-- Memuat Library PDF.js dari CDNJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script>
        // Set worker src
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
    </script>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #525659;
            font-family: sans-serif;
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .header {
            background: #323639;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .btn {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            margin-left: 10px;
        }

        .btn-close {
            background: #f44336;
        }

        .btn:hover {
            opacity: 0.9;
        }

        #viewer-container {
            flex: 1;
            overflow: auto;
            display: flex;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
        }

        canvas {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
            max-width: 100%;
        }

        .loading {
            color: white;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="header">
        <span id="doc-title">Memuat Dokumen...</span>
        <div>
            <span id="page_info" style="margin-right: 15px; font-size: 14px;"></span>
            <a id="download-link" href="#" class="btn" download>Download</a>
            <button onclick="window.close()" class="btn btn-close">Tutup</button>
        </div>
    </div>

    <div id="viewer-container">
        <div id="pdf-render-area"></div>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const fileUrl = urlParams.get('url');

        if (!fileUrl) {
            document.getElementById('doc-title').textContent = "Error: URL Dokumen Kosong";
        } else {
            // Update UI Info
            const fileName = fileUrl.split('/').pop();
            document.title = "Preview: " + fileName;
            document.getElementById('doc-title').textContent = fileName;
            document.getElementById('download-link').href = fileUrl;

            // Extract path dari URL storage
            // Misal: http://si-mts-nfs.test/storage/pengumuman/files/xxx.pdf
            // Kita ambil bagian setelah '/storage/'
            let filePath = fileUrl;

            // Jika URL mengandung '/storage/', ambil bagian setelahnya
            if (filePath.includes('/storage/')) {
                filePath = filePath.split('/storage/')[1];
            }

            // Gunakan route serve-pdf kita dengan parameter path
            const servePdfUrl = "{{ route('admin.serve-pdf') }}" + "?path=" + encodeURIComponent(filePath);

            // Render PDF menggunakan URL yang sudah diperbaiki
            const loadingTask = pdfjsLib.getDocument(servePdfUrl);

            loadingTask.promise.then(function (pdf) {
                // PDF Loaded
                document.getElementById('page_info').textContent = pdf.numPages + " Halaman";
                const container = document.getElementById('pdf-render-area');

                // Loop render setiap halaman dengan kualitas tinggi
                for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                    pdf.getPage(pageNum).then(function (page) {
                        // Naikkan scale untuk kualitas lebih tajam
                        const scale = 2.0; // Dari 1.5 -> 2.0
                        const viewport = page.getViewport({ scale: scale });
                        
                        // Deteksi device pixel ratio (untuk layar retina/4K)
                        const outputScale = window.devicePixelRatio || 1;

                        const canvas = document.createElement('canvas');
                        const context = canvas.getContext('2d');
                        
                        // Set canvas size dengan mempertimbangkan pixel ratio
                        canvas.width = Math.floor(viewport.width * outputScale);
                        canvas.height = Math.floor(viewport.height * outputScale);
                        
                        // CSS size harus tetap ukuran asli viewport
                        canvas.style.width = Math.floor(viewport.width) + "px";
                        canvas.style.height = Math.floor(viewport.height) + "px";
                        canvas.style.display = 'block';

                        container.appendChild(canvas);
                        
                        // Transform untuk scale rendering di layar high-DPI
                        const transform = outputScale !== 1 
                            ? [outputScale, 0, 0, outputScale, 0, 0] 
                            : null;

                        const renderContext = {
                            canvasContext: context,
                            viewport: viewport,
                            transform: transform
                        };
                        page.render(renderContext);
                    });
                }
            }, function (reason) {
                // PDF Loading Error
                console.error(reason);
                document.getElementById('viewer-container').innerHTML = '<div class="loading">Gagal memuat dokumen: ' + reason.message + '<br><small>Pastikan file dapat diakses dan bukan cross-origin restricted.</small></div>';
            });
        }
    </script>
</body>

</html>