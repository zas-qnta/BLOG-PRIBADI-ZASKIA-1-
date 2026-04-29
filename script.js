// 1. Variabel & Tipe Data (Object & Array)
const profil = {
    nama: "Zaskia Qanita Najiyah",
    status: "Mahasiswa",
    kampus: "UMMI"
};

const daftarKeahlian = ["Python", "RStudio", "Web Design"];

// 2. Output Dasar (Console log untuk debugging)
console.log("Script loaded! Halo " + profil.nama);

// 3. Arrow Function untuk Interaksi (Fungsi Modern)
const greeting = () => {
    const jam = new Date().getHours();
    let pesan = "";

    // 4. Percabangan (If...Else)
    if (jam < 12) {
        pesan = "Selamat Pagi! 🌅";
    } else if (jam < 18) {
        pesan = "Selamat Siang! ☀️";
    } else {
        pesan = "Selamat Malam! 🌙";
    }
    
    // 5. DOM Manipulation (Mengubah isi teks di Hero)
    const subTitle = document.querySelector(".hero-content p");
    subTitle.innerHTML = `${pesan} Saya ${profil.status} Teknik Informatika @ ${profil.kampus}`;
};

// Panggil fungsi saat halaman dimuat
greeting();

// 6. Validasi Form & Event Listener
const formIdentitas = document.querySelector(".perfect-form");

//formIdentitas.addEventListener("submit", (event) => {
    // Mencegah reload halaman
    //event.preventDefault();

    // Mengambil data dari input (DOM Manipulation)
    const namaInput = document.querySelector('input[type="text"]').value;
    const emailInput = document.querySelector('input[type="email"]').value;

    // Logika Sederhana: Validasi Form
    if (namaInput === "" || emailInput === "") {
        alert("Data kamu berhasil dikirim. Terima kasih sudah mampir! ✨");
    } else {
        alert(`Halo ${namaInput}! Data kamu berhasil dikirim. Terima kasih sudah mampir! ✨`);
        formIdentitas.reset(); 
    };

// 7. Perulangan (Loop) untuk mencetak keahlian di console
console.log("Daftar Keahlian:");
for (let i = 0; i < daftarKeahlian.length; i++) {
    console.log(`${i + 1}. ${daftarKeahlian[i]}`);
}