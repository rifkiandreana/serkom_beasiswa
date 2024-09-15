<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beasiswa</title>
    <link rel="stylesheet" href="style_index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <header>
        <div class="logo"> <img src="img/Indonesia_Emas_nobg.png" alt=""></div>
        <nav>
            <a href="#about">Tentang Kami</a>
            <a href="#timeline">Timeline</a>
            <a href="#testi">Testimoni</a>
            <a href="login.php"><button type="button" class="btn btn-primary">Daftar/Masuk</button></a>
        </nav>
    </header>
    <section>
        <div class="hero">
            <h1>Bantuan Biaya Pendidikan Untuk Menyiapkan Indonesia Emas 2045</h1>
            <p>Jenjang S1.</p>
            <a href="login.php"><button type="button" class="btn btn-primary">Daftar/Masuk</button></a>
        </div>
    </section>
    <section id="about">
        <div class="container-fluid">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-10">
                <h1 class="text-center fw-bold mt-3">Beasiswa Indonesia Emas 2045 (BIE 2045) – Jenjang S1</h1>
                <hr />
                </div>
                <div class="col-10 mt-3">
                <figure>
                    <blockquote class="blockquote">
                    <p>"Bersama bintang. Bersama bulan. Bersama langit malam. Cukup dengan melihat alam, kamu merasakan kedamaian."</p>
                    </blockquote>
                    <figcaption class="blockquote-footer fs-5">
                    <cite title="Source Title">Rohmatikal Maskur</cite>
                    </figcaption>
                </figure>
                <h3 style="text-align: justify;">
                Beasiswa Indonesia Emas 2045 merupakan program beasiswa unggulan yang dirancang untuk mempersiapkan generasi emas Indonesia di tahun 2045. Program ini memberikan kesempatan bagi putra-putri terbaik bangsa untuk melanjutkan studi di jenjang Sarjana (S1) baik di dalam maupun luar negeri.

                Program beasiswa ini bertujuan mencetak pemimpin masa depan yang berdaya saing global, inovatif, dan berkarakter kuat. Dengan dukungan penuh dari pemerintah, peserta Beasiswa Indonesia Emas 2045 akan mendapatkan pembiayaan studi secara komprehensif, termasuk biaya kuliah, biaya hidup, hingga pelatihan pengembangan diri.   
                </h3>
                </div>
                <div class="col-10 mt-3">
                <div class="row">
                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                    <iframe width="560" height="335" src="https://www.youtube.com/embed/PX2BHNylSkE?si=jWyFu7EobTX5HdCF" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    <div class="col-12 col-md-6 map-container">
                    <img src="img/indonesia-emas-204588770.logowik.com.webp" width="100%" height="335" alt="">
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>
    <section id="timeline">
        <div class="container-fluid">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-10">
                <h1 class="text-center fw-bold mt-3">Timeline</h1>
                <hr />
                </div>
                <div style="text-align: center;">
                        <img src="img/timeline-bie.png" alt="" style="max-width: 50%; height: auto;">
                    </div>
            </div>
            </div>
        </div>

    </section>
    <section id="testi">
    <div class="testimonials-wrapper">
        <div class="testimonials-container">
            <h2>Testimoni Penerima Beasiswa</h2>
            <div class="testimonial">
                <div class="testimonial-content">
                    <p>"Beasiswa ini benar-benar mengubah hidup saya. Dengan dukungan ini, saya bisa fokus pada studi saya tanpa khawatir tentang biaya. Terima kasih banyak!"</p>
                </div>
                <div class="testimonial-author">
                    <p><strong>Hamka Hamzah</strong>, Penerima Beasiswa 2024</p>
                </div>
            </div>
            <div class="testimonial">
                <div class="testimonial-content">
                    <p>"Saya sangat bersyukur mendapatkan kesempatan ini. Beasiswa ini tidak hanya membantu saya secara finansial tetapi juga memberikan motivasi tambahan untuk mencapai impian saya."</p>
                </div>
                <div class="testimonial-author">
                    <p><strong>Jendri Pitoy</strong>, Penerima Beasiswa 2023</p>
                </div>
            </div>

            <div class="testimonial">
                <div class="testimonial-content">
                    <p>"Saya sangat bersyukur mendapatkan kesempatan ini di Beasiswa ini. Semoga Saya Bisa jadi Menkominfo"</p>
                </div>
                <div class="testimonial-author">
                    <p><strong>Kaesang P</strong>, Penerima Beasiswa 2023</p>
                </div>
            </div>
            <!-- Tambahkan lebih banyak testimonial di sini -->
        </div>
    </div>
    </section>
    </div>

    
    <footer>
        Copyright | BIE 2045
    </footer>

    
    <button id="scroll-to-top" title="Kembali ke Atas">↑</button>
    <script>
            document.addEventListener('DOMContentLoaded', function() {
            var scrollToTopButton = document.getElementById('scroll-to-top');

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) { // Menampilkan tombol ketika scroll lebih dari 300px
                    scrollToTopButton.style.display = 'block';
                } else {
                    scrollToTopButton.style.display = 'none';
                }
            });

            scrollToTopButton.addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
