<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Blowfish Encryption</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body class="bg-light text-dark">
<div class="container my-5">
  <h1 class="text-primary fw-bold text-center mb-5">Blowfish Encryption Tool</h1>

  <div class="row g-4">
    <!-- Left Column (Text encrypt/decrypt) -->
    <div class="col-12 col-lg-8">
      <div class="card m-3 p-4 shadow-sm">
        <h2 class="text-primary fw-semibold d-flex align-items-center gap-2 mb-4">
          <i class="bi bi-chat-dots-fill"></i> Text Encryption / Decryption
        </h2>

        {{-- Encrypt Form --}}
        <form method="POST" action="/encrypt-text" class="d-flex flex-column gap-3 mb-4">
          @csrf
          <label for="encrypt_input" class="form-label fw-semibold">Text to Encrypt:</label>
          <textarea
            name="input"
            id="encrypt_input"
            rows="4"
            class="form-control">{{ session('encrypt_input') }}</textarea>
          <button type="submit" class="btn btn-primary align-self-start">
            <i class="bi bi-shield-lock-fill"></i> Encrypt Text
          </button>
        </form>

        <div class="mb-4">
          <h3 class="fw-semibold">Encrypted Result:</h3>
          <textarea
            readonly
            rows="4"
            class="form-control bg-light">{{ session('encrypted_result') }}</textarea>
        </div>

        {{-- Decrypt Form --}}
        <form method="POST" action="/decrypt-text" class="d-flex flex-column gap-3 mb-4">
          @csrf
          <label for="decrypt_input" class="form-label fw-semibold">Text to Decrypt:</label>
          <textarea
            name="input"
            id="decrypt_input"
            rows="4"
            class="form-control"
          >{{ session('decrypt_input') }}</textarea>
          <button type="submit" class="btn btn-success align-self-start">
            <i class="bi bi-unlock-fill"></i> Decrypt Text
          </button>
        </form>

        <div>
          <h3 class="fw-semibold">Decrypted Result:</h3>
          <textarea
            readonly
            rows="4"
            class="form-control bg-light"
          >{{ session('decrypted_result') }}</textarea>
        </div>
      </div>
    </div>

    <!-- Right Column (File encrypt/decrypt) -->
    <div class="col-12 col-lg-4">
      <div class="card m-3 p-4 shadow-sm" style="max-height: 90vh; overflow-y: auto;">
        <h2 class="text-purple fw-semibold d-flex align-items-center gap-2 mb-4" style="color:#6f42c1;">
          <i class="bi bi-file-earmark-lock-fill"></i> File Encryption / Decryption
        </h2>

        {{-- Encrypt File --}}
        <form method="POST" action="/encrypt-file" enctype="multipart/form-data" class="d-flex flex-column gap-3 mb-4">
          @csrf
          <label class="form-label fw-semibold">Select File to Encrypt:</label>
          <input
            type="file"
            name="input_file"
            class="form-control"
            required
          />
          <button type="submit" class="btn" style="background-color:#6f42c1; color:white;">
            <i class="bi bi-download"></i> Encrypt & Download
          </button>
        </form>

        {{-- Decrypt File --}}
        <form method="POST" action="/decrypt-file" enctype="multipart/form-data" class="d-flex flex-column gap-3 mb-0">
          @csrf
          <label class="form-label fw-semibold">Select File to Decrypt:</label>
          <input
            type="file"
            name="input_file"
            class="form-control"
            required
          />
          <button type="submit" class="btn" style="background-color:#20c997; color:white;">
            <i class="bi bi-upload"></i> Decrypt & Download
          </button>
        </form>
      </div>
    </div>
  </div>

  <footer class="text-center text-muted mt-5 small">
    &copy; {{ date('Y') }} Blowfish Encryption x Laravel
  </footer>
</div>

<!-- Bootstrap JS Bundle (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
