<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label fw-bold mb-1" style="color: #3a1a05; font-size: 0.875rem;">Nama Lengkap</label>
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 12px 0 0 12px; border-color: #e5d5c5;">
                <i class="bi bi-person"></i>
            </span>
            <input type="text" name="name" id="name"
                class="form-control border-start-0 shadow-none @error('name') is-invalid @enderror"
                placeholder="Masukkan nama pengguna"
                value="{{ old('name', $user->name ?? '') }}"
                style="background: #ffffff; border-color: #e5d5c5; border-radius: 0 12px 12px 0; padding: 0.75rem 1rem;">
        </div>
        @error('name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="email" class="form-label fw-bold mb-1" style="color: #3a1a05; font-size: 0.875rem;">Alamat Email</label>
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 12px 0 0 12px; border-color: #e5d5c5;">
                <i class="bi bi-envelope"></i>
            </span>
            <input type="email" name="email" id="email"
                class="form-control border-start-0 shadow-none @error('email') is-invalid @enderror"
                placeholder="contoh@gmail.com"
                value="{{ old('email', $user->email ?? '') }}"
                style="background: #ffffff; border-color: #e5d5c5; border-radius: 0 12px 12px 0; padding: 0.75rem 1rem;">
        </div>
        @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="password" class="form-label fw-bold mb-1" style="color: #3a1a05; font-size: 0.875rem;">Password</label>
        <div class="input-group">
            <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 12px 0 0 12px; border-color: #e5d5c5;">
                <i class="bi bi-lock"></i>
            </span>
            <input type="password" name="password" id="password"
                class="form-control border-start-0 shadow-none @error('password') is-invalid @enderror"
                placeholder="{{ isset($user->id) ? 'Kosongkan jika tidak diubah' : 'Masukkan password' }}"
                style="background: #ffffff; border-color: #e5d5c5; border-radius: 0 12px 12px 0; padding: 0.75rem 1rem;">
        </div>
        @if(isset($user->id))
            <small class="text-muted d-block mt-1" style="font-size: 0.775rem;">*Kosongkan jika tidak ingin mengubah password.</small>
        @endif
        @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold mb-1" style="color: #3a1a05; font-size: 0.875rem;">Role / Peran</label>
        <input type="hidden" name="role_id" id="role_id_input" value="{{ old('role_id', $user->role_id ?? '') }}">
        
        <div class="dropdown w-100">
            <button class="btn bg-white w-100 d-flex align-items-center justify-content-between text-start shadow-none @error('role_id') border-danger @enderror" type="button" id="roleDropdownButton" data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid #e5d5c5; border-radius: 0 12px 12px 0; padding: 0.75rem 1rem;">
                <span class="d-flex align-items-center gap-2 text-dark">
                    <i class="bi bi-shield-check text-muted"></i>
                    <span id="selectedRoleText">-- Pilih Role --</span>
                </span>
                <i class="bi bi-chevron-down text-muted fs-7"></i>
            </button>
            <ul class="dropdown-menu w-100 shadow-sm py-2" aria-labelledby="roleDropdownButton" style="border: 1px solid #e5d5c5; border-radius: 12px; background: #ffffff;">
                <li><a class="dropdown-item py-2 px-3 role-option" href="#" data-value="" data-text="-- Pilih Role --">-- Pilih Role --</a></li>
                @foreach($roles as $role)
                    <li><a class="dropdown-item py-2 px-3 role-option" href="#" data-value="{{ $role->id }}" data-text="{{ ucfirst($role->name) }}">{{ ucfirst($role->name) }}</a></li>
                @endforeach
            </ul>
        </div>

        @error('role_id')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>

<style>
    /* Hilangkan background biru bawaan select dan buat hover item dropdown jadi krem hangat */
    .dropdown-item:hover, .dropdown-item:focus {
        background-color: #faf2ea !important;
        color: #3a1a05 !important;
    }
    .dropdown-item.active {
        background-color: #3a1a05 !important;
        color: #ffffff !important;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputHidden = document.getElementById('role_id_input');
        const selectedText = document.getElementById('selectedRoleText');
        const options = document.querySelectorAll('.role-option');

        // Set initial text jika ada nilai lama (old / edit mode)
        const currentVal = inputHidden.value;
        if(currentVal) {
            options.forEach(opt => {
                if(opt.getAttribute('data-value') === currentVal) {
                    selectedText.textContent = opt.getAttribute('data-text');
                    selectedText.classList.remove('text-muted');
                    selectedText.classList.add('fw-semibold', 'text-dark');
                }
            });
        }

        // Event saat opsi diklik
        options.forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                const val = this.getAttribute('data-value');
                const text = this.getAttribute('data-text');

                inputHidden.value = val;
                selectedText.textContent = text;
                
                if(val === "") {
                    selectedText.classList.add('text-muted');
                } else {
                    selectedText.classList.remove('text-muted');
                    selectedText.classList.add('fw-semibold', 'text-dark');
                }
            });
        });
    });
</script>

<div class="d-flex align-items-center justify-content-end gap-2 mt-5 pt-3 border-top" style="border-color: #f1e5d7 !important;">
    <a href="{{ route('admin.users') }}" class="btn px-4 py-2" style="background: #f7f2ea; color: #3a1a05; font-weight: 600; border-radius: 12px; transition: all 0.2s;">
        Batal
    </a>
    <button type="submit" class="btn px-4 py-2 text-white" style="background: #3a1a05; font-weight: 600; border-radius: 12px; transition: all 0.2s; box-shadow: 0 4px 12px rgba(58, 26, 5, 0.2);">
        @if(isset($user->id))
            Simpan Perubahan
        @else
            Simpan Data
        @endif
    </button>
</div>