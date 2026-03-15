//
if (!localStorage.getItem('userTable')) {
    localStorage.setItem('userTable', JSON.stringify([]));
}
// Logic Login

// Use Email
// Fungsi Menampilkan Pop-up
function toggleModal(isShowing) {
    const modal = document.getElementById('emailModal');
    if (isShowing) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    } else {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}

// Logic Valdation Login if form submited
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');

    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah halaman refresh

            // Mengambil input dari user
            const emailInput = document.getElementById('loginEmail').value;
            const passwordInput = document.getElementById('loginPassword').value;

            // Mengambil "tabel" data user dari localStorage (jika kosong, buat array kosong)
            let users = JSON.parse(localStorage.getItem('userTable')) || [];

            // Mencari apakah ada user yang email dan password-nya cocok
            const validUser = users.find(user => user.email === emailInput && user.password === passwordInput);

            // Memberikan pesan sesuai hasil pengecekan
            if (validUser) {
                alert('Anda berhasil login!');
                toggleModal(false); // Tutup pop-up otomatis setelah berhasil
                loginForm.reset(); // Kosongkan form
                
                // Pindah ke halaman dashboard
                window.location.href = 'dashboard.html';
            } else {
                alert('Silahkan cek kembali user & password Anda');
            }
        });
    }
});

// Logic Sign Up
const registerForm = document.getElementById('registerForm');

if (registerForm) {
    registerForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah halaman reload

        // Mengambil nilai yang diketik user
        const name = document.getElementById('regName').value;
        const email = document.getElementById('regEmail').value;
        const password = document.getElementById('regPassword').value;

        // mengambil "tabel" dari localStorage
        let users = JSON.parse(localStorage.getItem('userTable'));

        // mengecek apakah email sudah terdaftar atau belum
        const isEmailExist = users.some(user => user.email === email);

        if (isEmailExist) {
            alert('Email sudah terdaftar, gunakan email lain atau Log In');
        } else {
            // Masukkan data baru ke dalam "tabel"
            users.push({
                name: name,
                email: email,
                password: password
            });

            // Menyimpan kembali tabel yang sudah diupdate ke localStorage
            localStorage.setItem('userTable', JSON.stringify(users));
            
            alert('Registrasi berhasil! Masuk ke halaman login');
            registerForm.reset(); // Mengosongkan form
            
            // Pindah ke halaman login
            window.location.href = 'login.html'; 
        }
    });
}

