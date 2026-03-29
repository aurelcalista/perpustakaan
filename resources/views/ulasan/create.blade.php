@extends('layouts.app')

@section('content')

<style>
/* Background section */
.ulasan-section {
    padding: 60px 20px;
    background: #f4f7fb;
}

/* Card form */
.ulasan-card {
    max-width: 600px;
    margin: auto;
    background: #ffffff;
    padding: 35px;
    border-radius: 16px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.06);
    animation: fadeIn 0.4s ease-in-out;
}

/* Title */
.ulasan-title {
    text-align: center;
    font-size: 24px;
    font-weight: bold;
    color: #3b5bdb;
    margin-bottom: 25px;
}

/* Form group */
.form-group {
    margin-bottom: 18px;
}

/* Label */
.form-label {
    font-weight: 600;
    display: block;
    margin-bottom: 6px;
    color: #333;
}

/* Input */
.form-input {
    width: 100%;
    padding: 12px;
    border: 1px solid #dcdcdc;
    border-radius: 10px;
    transition: 0.2s;
    font-size: 14px;
}

/* Focus effect */
.form-input:focus {
    border-color: #4e73df;
    outline: none;
    box-shadow: 0 0 0 2px rgba(78,115,223,0.15);
}

/* Button */
.btn-submit {
    width: 100%;
    padding: 13px;
    background: linear-gradient(135deg, #4e73df, #6c8cff);
    color: white;
    border: none;
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

/* Hover */
.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(78,115,223,0.2);
}

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<section class="ulasan-section">

    <div class="ulasan-card">

        <div class="ulasan-title">
             Beri Ulasan
        </div>

        <form action="{{ route('ulasan.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Kelas</label>
                <input type="text" name="kelas" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Ulasan</label>
                <textarea name="isi" class="form-input" required></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Rating</label>
                <select name="rating" class="form-input">
                    <option value="5">★★★★★</option>
                    <option value="4">★★★★☆</option>
                    <option value="3">★★★☆☆</option>
                    <option value="2">★★☆☆☆</option>
                    <option value="1">★☆☆☆☆</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">
                Kirim Ulasan 
            </button>

        </form>

    </div>

</section>

@endsection