
# 🦉 Internship Daily Logbook (SaaS)

Satu platform pengurusan logbook internship yang moden, dibina khas untuk memudahkan pelajar merekod tugasan harian secara tersusun dengan antaramuka bertaraf profesional.

---

## ✨ Ciri-Ciri Utama
*   **Kanban Board UI**: Urus tugasan dengan fungsi *drag-and-drop* yang lancar (Ongoing, Completed, Stuck).
*   **Official Table View**: Jana jadual logbook rasmi yang mengikut format universiti.
*   **Smart Print System**: Fungsi cetakan pintar yang menyembunyikan status dalaman dan menunjukkan ruangan *Supervisor Remarks*.
*   **Multi-tenant Security**: Setiap pengguna mempunyai ruang storan dan pangkalan data yang diasingkan secara selamat (Bouncer Protection).
*   **Custom Branding**: Pengguna boleh memuat naik logo syarikat dan nama syarikat sendiri untuk paparan header.

## 🛠️ Tech Stack
*   **Framework**: Laravel 11 (PHP 8.2+)
*   **Frontend**: Tailwind CSS & Alpine.js
*   **Database**: MySQL / PostgreSQL
*   **Authentication**: Laravel Breeze (Customized UI)
*   **Storage**: Amazon S3 / Local Storage (untuk logo syarikat)

## 🚀 Pemasangan (Local Development)

1.  **Clone repository ini:**
    ```bash
    git clone [https://github.com/Bukhhh/internship-logbook.git](https://github.com/Bukhhh/internship-logbook.git)
    cd internship-logbook
    ```

2.  **Install dependencies:**
    ```bash
    composer install
    npm install
    
```

3.  **Setup Environment:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Configure Database:**
    Kemaskini maklumat `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` di dalam fail `.env`.

5.  **Migration & Build:**
    ```bash
    php artisan migrate
    npm run build
    ```

6.  **Jalankan server:**
    ```bash
    php artisan serve
    ```

## 📈 Perancangan Masa Hadapan (Roadmap)
*   [ ] **AI Integration**: Menggunakan **Random Forest / Ensemble Classifier** untuk mengklasifikasikan jenis tugasan secara automatik.
*   [ ] **RAG Implementation**: Mengintegrasikan *Retrieval-Augmented Generation* untuk menjawab soalan berkaitan polisi internship berdasarkan dokumen PDF.
*   [ ] **Offline Support**: Membina versi PWA untuk penggunaan tanpa internet.

## 👤 Penulis
**Mohamad Bukhari**  
*Final Year Computer Science Student at UiTM Tapah*  
*Technical Intern at Hypepresso Insight Sdn Bhd*


