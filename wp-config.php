<?php
/**
 * Konfigurasi dasar WordPress.
 *
 * Berkas ini berisi konfigurasi-konfigurasi berikut: Pengaturan MySQL, Awalan Tabel,
 * Kunci Rahasia, Bahasa WordPress, dan ABSPATH. Anda dapat menemukan informasi lebih
 * lanjut dengan mengunjungi Halaman Codex {@link http://codex.wordpress.org/Editing_wp-config.php
 * Menyunting wp-config.php}. Anda dapat memperoleh pengaturan MySQL dari web host Anda.
 *
 * Berkas ini digunakan oleh skrip penciptaan wp-config.php selama proses instalasi.
 * Anda tidak perlu menggunakan situs web, Anda dapat langsung menyalin berkas ini ke
 * "wp-config.php" dan mengisi nilai-nilainya.
 *
 * @package WordPress
 */

// ** Pengaturan MySQL - Anda dapat memperoleh informasi ini dari web host Anda ** //
/** Nama basis data untuk WordPress */
define( 'DB_NAME', 'dpm' );

/** Nama pengguna basis data MySQL */
define( 'DB_USER', 'gbsasia' );

/** Kata sandi basis data MySQL */
define( 'DB_PASSWORD', 'dpmgbs451577' );

/** Nama host MySQL */
define( 'DB_HOST', '36.92.71.157' );

/** Set Karakter Basis Data yang digunakan untuk menciptakan tabel basis data. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Jenis Collate Basis Data. Jangan ubah ini jika ragu. */
define('DB_COLLATE', '');

define('DISALLOW_FILE_EDIT', true);
//define('FS_METHOD', 'direct');


/**#@+
 * Kunci Otentifikasi Unik dan Garam.
 *
 * Ubah baris berikut menjadi frase unik!
 * Anda dapat menciptakan frase-frase ini menggunakan {@link https://api.wordpress.org/secret-key/1.1/salt/ Layanan kunci-rahasia WordPress.org}
 * Anda dapat mengubah baris-baris berikut kapanpun untuk mencabut validasi seluruh cookies. Hal ini akan memaksa seluruh pengguna untuk masuk log ulang.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Vz.:4z_s0V!M|O.O*c -j}Yy`{?Hpq6+pyvq#a ]y$|79]72]4!`.@Dd,`)@mFEk' );
define( 'SECURE_AUTH_KEY',  'v6}-Qn*+^eX5uE0.{vl)T-HoH&o}-]e?L)1)qh>`q}<z~a@.,QpE2RsZ$:k@<s%G' );
define( 'LOGGED_IN_KEY',    'F}|5_:qrWXd5Ja8e$zn F#WIQf;dTZR`)W/s_qyO-f]OgDSWOi|kd#xSpAT&kq%v' );
define( 'NONCE_KEY',        'Fa(KK;ZWtuz8%zJNq^;$R@-<!8ZDr~[|S0e;c I{:qvb,Yg*x=yob(#~m5eE/wh.' );
define( 'AUTH_SALT',        'l@HHlJVbqS^hxBv.ltC<,a`Uqs0(=` koS]xbE<;h9*#@ham8/*dwKeGA~F0vPfH' );
define( 'SECURE_AUTH_SALT', 'N!zW];R{cL,7UXeb =A|_9#]Q4ci#2#@Ge~lQnAh~jcVE _rK1/H5yD#!W.]q0pT' );
define( 'LOGGED_IN_SALT',   'YG[;B~ZReLefi)XkvUU dNV/(|g@adVaXq3ac)paa_DE]ebDi*G)JAm-[Yh)MDIk' );
define( 'NONCE_SALT',       'B}NY&n2uIkkur1c`z4`Jyuf$Pp&coss@u!GIO!=^e{;}KJQ2geH+Tcb.=&IZV={8' );

/**#@-*/

/**
 * Awalan Tabel Basis Data WordPress.
 *
 * Anda dapat memiliki beberapa instalasi di dalam satu basis data jika Anda memberikan awalan unik
 * kepada masing-masing tabel. Harap hanya masukkan angka, huruf, dan garis bawah!
 */
$table_prefix = 'dpm_';

/**
 * Untuk pengembang: Moda pengawakutuan WordPress.
 *
 * Ubah ini menjadi "true" untuk mengaktifkan tampilan peringatan selama pengembangan.
 * Sangat disarankan agar pengembang plugin dan tema menggunakan WP_DEBUG
 * di lingkungan pengembangan mereka.
 */
define('WP_DEBUG', false);

/* Cukup, berhenti menyunting! Selamat ngeblog. */

/** Lokasi absolut direktori WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Menentukan variabel-variabel WordPress berkas-berkas yang disertakan. */
require_once(ABSPATH . 'wp-settings.php');
