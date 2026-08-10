<div class="row g-4">
    <div class="col-md-6">
        <div class="p-3 rounded-4" style="background: #fffaf5; border: 1px solid #f1e5d7;">
            <label class="form-label fw-semibold mb-2" style="color: #3d1c02;">Nama Lengkap</label>
            <input type="text" name="name"
                class="form-control rounded-3 border-0 shadow-sm @error('name') is-invalid @enderror"
                placeholder="Masukkan nama pengguna"
                value="{{ old('name', $user->name ?? '') }}"
                style="background: #ffffff;">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="p-3 rounded-4" style="background: #fffaf5; border: 1px solid #f1e5d7;">
            <label class="form-label fw-semibold mb-2" style="color: #3d1c02;">Alamat Email</label>
            <input type="email" name="email"
                class="form-control rounded-3 border-0 shadow-sm @error('email') is-invalid @enderror"
                placeholder="contoh@gmail.com"
                value="{{ old('email', $user->email ?? '') }}"
                style="background: #ffffff;">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row g-4 mt-1">
    <div class="col-md-6">
        <div class="p-3 rounded-4" style="background: #fffaf5; border: 1px solid #f1e5d7;">
            <label class="form-label fw-semibold mb-2" style="color: #3d1c02;">Password</label>
            <input type="password" name="password"
                class="form-control rounded-3 border-0 shadow-sm @error('password') is-invalid @enderror"
                placeholder="{{ isset($user->id) ? 'Masukkan password baru' : 'Masukkan password' }}"
                style="background: #ffffff;">
            @if(isset($user->id))
                <small class="text-muted d-block mt-2" style="font-size: 0.825rem;">
                    Kosongkan jika tidak ingin mengubah password.
                </small>
            @endif
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="p-3 rounded-4" style="background: #fffaf5; border: 1px solid #f1e5d7;">
            <label class="form-label fw-semibold mb-2" style="color: #3d1c02;">Role / Peran</label>
            <select name="role_id" class="form-select rounded-3 border-0 shadow-sm @error('role_id') is-invalid @enderror" style="background: #ffffff;">
                <option value="">-- Pilih Role --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
            @error('role_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<hr class="my-4 text-muted opacity-25">

<div class="d-flex flex-column flex-md-row align-items-stretch align-items-md-center justify-content-end gap-2">
    <a href="{{ route('admin.users') }}" class="btn btn-light rounded-pill px-4 fw-semibold text-secondary border-0 shadow-sm" style="background: #f7f2ea;">
        Batal
    </a>
    <button type="submit" class="btn text-white rounded-pill px-4 fw-bold shadow-sm" style="background: #3a1a05; border: none;">
        @if(isset($user->id))
            Simpan Perubahan
        @else
            Simpan
        @endif
    </button>
</div>