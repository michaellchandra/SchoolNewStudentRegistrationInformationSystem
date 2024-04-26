document.addEventListener("DOMContentLoaded", function() {
    var paymentForm = document.getElementById("paymentForm");
    var paymentFormWaitingVerification = document.getElementById("paymentFormWaitingVerification");
    var syaratKetentuan = document.getElementById("syaratKetentuan");
    var paymentAdministrative = document.getElementById('paymentAdministrative');

    var registrationStatus = "{{ $registration->registrationStatus }}"; // Ambil dari server-side

    if (registrationStatus === "Menunggu Verifikasi Pembayaran Formulir") {
        paymentForm.style.display = "none";
        paymentFormWaitingVerification.style.display = "block";
        paymentAdministrative.style.display="none"
    } else if(registrationStatus == "Pendaftaran Akun Selesai"){
        paymentForm.style.display = "block";
        paymentFormWaitingVerification.style.display = "none";
        syaratKetentuan.style.display = "none";
        paymentAdministrative.style.display = "none"
    } else if (registrationStatus == "Pembayaran Formulir Terverifikasi") {
        syaratKetentuan.style.display = "block";
        paymentForm.style.display = "none";
        paymentFormWaitingVerification.style.display = "none";
    }else if(registrationStatus === "Butuh Revisi Pembayaran Formulir"){
        
    
    } else if(registrationStatus === "Menunggu Verifikasi Biodata & Berkas"){

    } else if(registrationStatus === "Butuh Revisi Biodata & Berkas"){

    } else if(registrationStatus === "Biodata & Berkas Terverifikasi") {

    } else if(registrationStatus === "Jadwal Tes Terkonfirmasi"){

    } else if(registrationStatus === "Hasil Tes Lulus"){

    } else if(registrationStatus === "Hasil Tes Gagal") {

    } else if (registrationStatus === "Menunggu Verifikasi Pembayaran Administrasi"){

    }
    
});