<div class="mb-3">
    <label class="form-label fw-semibold" style="color: #3d1c02;">Nama Lengkap</label>
    <input type="text" name="name"
        class="form-control rounded-3 border-opacity-50 @error('name') is-invalid @enderror"
        placeholder="Masukkan nama pengguna"
        value="{{ old('name', $user->name ?? '') }}">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold" style="color: #3d1c02;">Alamat Email</label>
    <input type="email" name="email"
        class="form-control rounded-3 border-opacity-50 @error('email') is-invalid @enderror"
        placeholder="contoh@gmail.com"
        value="{{ old('email', $user->email ?? '') }}">
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label fw-semibold" style="color: #3d1c02;">Password</label>
    <input type="password" name="password"
        class="form-control rounded-3 border-opacity-50 @error('password') is-invalid @enderror"
        placeholder="{{ isset($user->id) ? 'Masukkan password baru' : 'Masukkan password' }}">
    @if(isset($user->id))
        <small class="text-muted d-block mt-1" style="font-size: 0.825rem;">
            Kosongkan jika tidak ingin mengubah password.
        </small>
    @endif
    @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-4">
    <label class="form-label fw-semibold" style="color: #3d1c02;">Role / Peran</label>
    <select name="role_id" class="form-select rounded-3 border-opacity-50 @error('role_id') is-invalid @enderror">
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

<hr class="my-4 text-muted opacity-25">

<div class="d-flex align-items-center justify-content-end gap-2">
    <a href="{{ route('admin.users') }}" class="btn btn-light rounded-pill px-4 fw-semibold text-secondary">
        Batal
    </a>
    <button type="submit" class="btn text-white rounded-pill px-4 fw-bold shadow-sm" style="background-color: #3d1c02; border: none;">
        @if(isset($user->id))
            Simpan Perubahan
        @else
            Simpan
        @endif
    </button>
</div>