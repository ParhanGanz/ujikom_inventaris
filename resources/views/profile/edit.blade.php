<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Tampilkan Foto Saat Ini -->
    <img src="{{ auth()->user()->foto_url }}" alt="Foto Profil" class="w-24 h-24 rounded-full mb-4">

    <!-- Input Foto -->
    <div>
        <label for="foto">Foto Profil</label>
        <input type="file" name="foto" id="foto" accept="image/*">
    </div>

    <!-- Input Username -->
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" value="{{ old('username', auth()->user()->username) }}" required>
    </div>

    <!-- Input Nama Lengkap -->
    <div>
        <label for="nama_lengkap">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', auth()->user()->nama_lengkap) }}" required>
    </div>

    <!-- Input Email -->
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
    </div>

    <!-- Input WhatsApp -->
    <div>
        <label for="no_whatsapp">No. WhatsApp</label>
        <input type="text" name="no_whatsapp" value="{{ old('no_whatsapp', auth()->user()->no_whatsapp) }}">
    </div>

    <button type="submit">Simpan Perubahan</button>
</form>