# PA_PemWeb


Catatan (Injil)
1. Kalau Mau Buka Detail Buku:
Linknya = "detail_buku.php?id_buku= {Masukkan id buku disini}"
Sisanya terhubung ke data buku

2. Home belum ada php, session, jadi agak susah sambunging dengan login, (butuh session) @Raply (A) 
- Gak ketahuan udh login atau belum (nyambung ke ke session itu)
- Masih ada banyak gambar buku yang lokal, (belum terhubung ke sql);

3. Login, Register, Logout masih belum nyambung sama index.html @Aiman , itu session yang $_SESSION['username'} jangan diganti sudah kusamain di kodinganku.
- Login, 
- Session Start: username 
- Session Start: login = true? gk bisa bedain admin, user, dan tamu(gk login)

4. @Heri 
> Navbar
- Keranjang: keranjang.php, asal udh ada session pasti aman
- Histori: history.php, sama kek keranjang yang penting ada session setelah login
