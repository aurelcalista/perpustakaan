 document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            // Simulasi login
            if (username && password) {
                alert('Login berhasil!\n\nUsername: ' + username + '\n\nAnda akan diarahkan ke dashboard perpustakaan.');
                // Di sini bisa ditambahkan redirect ke halaman dashboard
                // window.location.href = 'dashboard.html';
            } else {
                alert('Mohon isi semua field!');
            }
        });