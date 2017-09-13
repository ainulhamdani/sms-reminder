<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EcServiceAlert extends CI_Model{
    
    private $ANC_MESSAGE_DUE = "Selamat pagi, Bu xxnama. Berikut adalah jumlah Ibu Hamil Anda yang jadwal kunjungan ANCnya akan tiba: ANC 2 = xx2 ibu , ANC 3 = xx3 ibu , ANC 4 = xx4 ibu. Silahkan periksa register Anda dan prioritaskan klien-klien tersebut.";
    private $ANC_MESSAGE_NOW = "Selamat pagi, Bu xxnama. Sekedar mengingatkan, Ibu-ibu Hamil berikut ini sudah saatnya melakukan pemeriksaan ANC: ANC 2 = xx2 ibu, ANC 3 = xx3 ibu , ANC 4 = xx4 ibu. Anda harus memprioritaskan klien tersebut.";
    private $ANC_MESSAGE_OVERDUE = "Selamat pagi, Bu xxnama. Berikut ini adalah jumlah ibu hamil anda yang jadwal ANCnya telah lewat waktu: ANC 2 = xx2 ibu , ANC 3 = xx3 ibu, ANC 4 = xx4 ibu. Mohon prioritaskan klien-klien ini sekarang.";
    private $TT_HB_MESSAGE_DUE = "Selamat pagi, Bu xxnama. Berikut adalah jumlah ibu hamil yang jadwal tes Hb, imunisasi TT dan Fe-nya sudah tiba minggu ini: TT 1 = xtt1 ibu, TT 2 = xtt2 ibu, Tes Hb 1 = xhb1 ibu, Tes Hb Follow-up = xhbf ibu, Tes Hb 2 = xhb2 ibu, Fe 1 = xfe1 ibu, Fe 2 = xfe2 ibu, dan Fe 3 = xfe3 ibu.";
    private $TT_HB_MESSAGE_OVERDUE = "Selamat pagi, Bu xxnama. Berikut adalah jumlah ibu hamil yang jadwal tes Hb, imunisasi TT dan Fe-nya telah lewat waktu tapi masih bisa menerima pelayanan: TT 1 = xtt1 ibu, TT 2 = xtt2 ibu, Tes Hb 1 = xhb1 ibu, Tes Hb Follow-up = xhbf ibu, Tes Hb 2 = xhb2 ibu, Fe 1 = xfe1 ibu, Fe 2 = xfe2 ibu, dan Fe 3 = xfe3 ibu.";
    private $PNC_KN_MESSAGE_DUE = "Selamat pagi, Bu xxnama. Berikut adalah jumlah pasien ibu yang jadwal pemeriksaan nifas dan neonatal-nya telah tiba:  KF 1 dan KN 1 = xkf1 ibu dan xkn1 bayi, KF 2 dan KN 2= xkf2 ibu dan xkn2 bayi, KF 3 dan KN 3 = xkf3 ibu dan xkn3 bayi, serta KF 4 = xkf4 ibu.";
    private $PNC_KN_MESSAGE_OVERDUE = "Selamat pagi, Bu xxnama. Berikut adalah jumlah pasien ibu yang jadwal pemeriksaan nifas dan neonatal-nya telah lewat waktu tapi masih bisa menerima pelayanan:  KF 1 dan KN 1 = xkf1 ibu dan xkn1 bayi, KF 2 dan KN 2= xkf2 ibu dan xkn2 bayi, KF 3 dan KN 3 = xkf3 ibu dan xkn3 bayi, serta KF 4 = xkf4 ibu.";
    private $CHILD_IMMU_MESSAGE_DUE = "Selamat pagi, Bu xxnama. Berikut adalah jumlah pasien ibu yang jadwal imunisasinya telah tiba:  Hb 0 = xhb0 bayi, BCG dan Polio 1 = xbp1 bayi, DPT/HB 1 dan Polio 2 = xdp2 bayi, DPT/HB 2 dan Polio 3 = xdp3 bayi, DPT/HB 3 dan Polio 4 = xdp4 bayi serta Campak = xcam bayi.";
    private $CHILD_IMMU_MESSAGE_OVERDUE = "Selamat pagi, Bu xxnama. Berikut adalah jumlah pasien ibu yang jadwal imunisasinya telah lewat waktu tapi masih bisa menerima pelayanan:  Hb 0 = xhb0 bayi, BCG dan Polio 1 = xbp1 bayi, DPT/HB 1 dan Polio 2 = xdp2 bayi, DPT/HB 2 dan Polio 3 = xdp3 bayi, DPT/HB 3 dan Polio 4 = xdp4 bayi serta Campak = xcam bayi.";
    private $FP_MESSAGE_DUE = "Selamat pagi, Bu xxnama. Berikut adalah jumlah pasien KB yang jadwal perpanjangan masa alat kontrasepsinya telah tiba: Suntik KB 3 bulan = xsk3 ibu, Suntik KB 1 bulan = xsk1 ibu, KB IUD = xiud ibu dan KB Implan = ximp ibu.";
    private $FP_MESSAGE_OVERDUE = "Selamat pagi, Bu xxnama. Berikut adalah jumlah pasien KB yang jadwal perpanjangan masa alat kontrasepsinya telah lewat waktu tapi masih bisa menerima pelayanan: Suntik KB 3 bulan = xsk3 ibu, Suntik KB 1 bulan = xsk1 ibu, KB IUD = xiud ibu dan KB Implan = ximp ibu.";
    
    private $ANC2_MESSAGE_DUE = "Target pasien ANC 2 Anda minggu ini adalah: ";
    private $ANC3_MESSAGE_DUE = "Target pasien ANC 3 Anda minggu ini adalah: ";
    private $ANC4_MESSAGE_DUE = "Target pasien ANC 4 Anda minggu ini adalah: ";
    private $ANC2_MESSAGE_OVERDUE = "Berikut adalah ibu hamil yang tidak datang bulan lalu untuk ANC 2: ";
    private $ANC3_MESSAGE_OVERDUE = "Berikut adalah ibu hamil yang tidak datang bulan lalu untuk ANC 3: ";
    private $ANC4_MESSAGE_OVERDUE = "Berikut adalah ibu hamil yang tidak datang bulan lalu untuk ANC 4: ";
    
    private $PNC_MESSAGE_DUE = "Ibu nifas yang jadwal kunjungan KFxxx hari ini adalah: ";
    private $PNC_MESSAGE_OVERDUE = "Ibu nifas yang belum dikunjungi untuk KFxxx adalah: ";
    
    private $ANC1_MESSAGE = "Selamat! Ibu sudah melakukan pemeriksaan ANC 1. Tahukah Ibu? Ibu Hamil dianjurkan unttuk memeriksakan kehamilannya ke bidan PALING SEDIKIT 4 kali, yakni 1 kali pada usia kehamilan 0 - 3 BULAN, 1 kali pada usia kehamilan 4 - 6 BULAN dan 2 kali pada usia kehamilan 7 - 9 BULAN. ";
    private $ANC2_MESSAGE = "Sudah memeriksakan kehamilan? Bulan ini adalah jadwal Ibu melakukan pemeriksaan ANC 2, yaitu pemeriksaan kehamilan saat usia kandungan 4 - 6 bulan. Jika belum, segera kunjungi posyandu/polindes terdekat di desa Ibu. Perhatikan apakah berat badan Ibu bertambah sesuai usia kandungan. Berat badan yang bertambah menandakan janin tumbuh dengan baik.";
    private $ANC3_MESSAGE = "Jadwal pemeriksaan ANC 3 untuk Ibu sudah tiba. Saat usia kandungan 7 bulan, Ibu Hamil harus memeriksakan kehamilannya kembali. Pemeriksaan kehamilan rutin bisa membantu bidan mengetahui masalah kehamilan dan persalinan lebih dini, sehingga bisa mempersiapkan pencegahan atau pengobatan yang diperlukan. ";
    private $ANC4_MESSAGE = "Waktu persalinan Ibu semakin dekat! Jangan lupa mengunjungi bidan untuk melakukan pemeriksaan ANC 4. Pemeriksaan ini dianjurkan bagi Ibu yang akan segera melahirkan. Bidan akan memberitahu Ibu tanda-tanda persalinan dan hal-hal yang perlu disiapkan untuk kelahiran bayi. Jadi, jangan lewatkan pemeriksaan ini ya.";
    private $TT1_MESSAGE = "Pernah mendengar penyakit tetanus? Tetanus adalah penyakit berbahaya yang dapat menyebabkan penderitanya kejang-kejang. Bayi baru lahir sangat mudah terkena penyakit ini. Untuk mencegahnya, ibu hamil diberi imunisasi tetanus (TT) oleh bidan pada saat pemeriksaan kehamilan pertamanya. Jika Ibu belum mendapat imunisasi ini, segera kunjungi bidan di posyandu/polindes terdekat di desa Ibu.";
    private $TT2_MESSAGE = "Sudah mendapat imunisasi tetanus (TT)? Ibu Hamil harus mendapatkan imunisasi tetanus (TT) 2 KALI selama kehamilan. Imunisas tetanus kedua (TT 2) harus diberikan 1 bulan setelah pemberian imunisasi tetanus pertama (TT 1). Segera kunjungi posyandu/polindes di desa Ibu untuk menerima imunisasi TT kedua dari bidan.";
    private $HB_TEST1_MESSAGE = "Tahukah Ibu? Ibu Hamil sangat mudah terkena anemia. 37% Ibu Hamil di Indonesia menderita penyakit ini. Penyakit anemia bisa membahayakan kesehatan ibu dan janin. Lakukanlah tes Hb (hemoglobin) di polindes/puskesmas untuk mendeteksi anemia. Anemia dapat diobati dengan rutin meminum Tablet Tambah Darah (TTD) sesuai anjuran bidan.";
    private $HB_FU_MESSAGE = "Jika Ibu menderita anemia, Ibu perlu meminum Tablet Tambah Darah (TTD) lebih banyak dari biasanya untuk menormalkan kadar Hb (hemoglobin) dalam darah. Untuk mengecek apakah kadar Hb Ibu sudah kembali normal, lakukan tes Hb di polindes/puskesmas. Ibu dikatakan sembuh dari anemia jika kadar Hb Ibu adalah 11 mg/dl atau lebih.";
    private $HB_TEST2_MESSAGE = "Ibu hamil yang TIDAK ANEMIA akan memiliki pertumbuhan janin yang baik sehingga bayi dapat lahir dengan berat badan normal atau di atas 2,5 kg. Selain itu, perdarahan saat melahirkan akan lebih sedikit dibandingkan ibu yang anemia. Jika Ibu belum melakukan tes Hb saat usia kandungan 7 bulan ke atas, segera kunjungi polindes/puskesmas terdekat.";
    private $IFA1_MESSAGE = "Saat hamil, wanita mudah kekurangan zat besi sehingga menyebabkannya terkena anemia. Kekurangan zat besi pada ibu hamil dapat dicegah dengan meminum secara rutin Tablet Tambah Darah (TTD) yang disediakan gratis oleh Pemerintah melalui bidan di polindes/puskesmas. Pastikan Ibu menerima jumlah TTD yang cukup sampai pemeriksaan Ibu berikutnya.";
    private $IFA2_MESSAGE = "Ibu hamil dianjurkan mengkonsumsi PALING SEDIKIT 90 Tablet Tambah Darah (TTD) selama kehamilan. Akan tetapi, agar ibu tetap sehat dan janin tumbuh dengan baik, Ibu Hamil disarankan untuk meminum TTD setiap hari. Jika Ibu anemia, Ibu harus meminum TTD 2 kali lebih banyak. Pastikan Ibu menerima jumlah TTD yang cukup sampai pemeriksaan Ibu berikutnya.";
    private $IFA3_MESSAGE = "Rutin meminum Tablet Tambah Darah setiap hari? Ingatlah, setiap satu tablet yang Ibu minum bisa membantu Ibu agar terhindar dari penyakit anemia serta menjaga ibu dan janin tetap sehat. Pastikan Ibu menerima jumlah Tablet Tambah Darah yang cukup dari bidan di posyandu/polindes.";
    private $PNC1_MESSAGE = "Pemeriksaan Nifas (KF) adalah pemeriksaan yang dilakukan bidan dalam jangka waktu 42 HARI setelah Ibu melahirkan dan dilakukan sebanyak 4 KALI. Bidan biasanya melakukan pemeriksaan nifas pertama atau KF 1 enam jam setelah Ibu melahirkan atau sebelum Ibu pulang ke rumah. Ibu akan menerima SMS pemberitahuan untuk jadwal pemeriksaan nifas berikutnya.";
    private $PNC2_MESSAGE = "Minggu ini adalah jadwal Ibu melakukan pemeriksaan nifas kedua (KF 2). Ibu akan dikunjungi oleh bidan untuk KF 2 paling lambat 3 hari setelah persalinan. Bidan akan memeriksa tekanan darah, suhu, banyak perdarahan, tinggi perut dan sebagainya untuk memastikan tidak ada komplikasi setelah persalinan.";
    private $PNC3_MESSAGE = "Jadwal pemeriksaan nifas ketiga (KF 3) untuk Ibu adalah minggu ini. Ibu mungkin akan dikunjungi bidan paling lambat sebelum 1 bulan setelah persalinan. Sebagian kematian ibu di Indonesia disebabkan oleh komplikasi setelah persalinan. Pemeriksaan nifas penting untuk mendeteksi penyakit sebelum menjadi lebih parah dan membahayakan Ibu.";
    private $PNC4_MESSAGE = "Waktu pemeriksaan nifas keempat (KF 4) untuk Ibu sudah tiba. Dalam 2 minggu ini, bidan akan mengunjungi Ibu untuk melakukan pemeriksaan nifas terakhir. Masa nifas adalah waktu bagi Ibu untuk memulihkan diri setelah proses persalinan. Jagalah kebersihan diri, istirahat yang cukup dan makan makanan yang beragam.";
    private $KN1_MESSAGE = "Bidan akan mengunjungi rumah Ibu untuk melakukan pemeriksaan bayi yang baru lahir atau disebut juga KN. Pemeriksaan pada bayi Ibu akan dilakukan sebanyak 3 KALI sebelum bayi berusia 1 bulan. Bidan biasanya melakukan pemeriksaan bayi pertama (KN 1) sebelum ibu dan bayi pulang. Ibu akan menerima SMS pemberitahuan untuk jadwal pemeriksaan bayi berikutnya.";
    private $KN2_MESSAGE = "Jadwal pemeriksaan bayi kedua (KN 2) untuk bayi Ibu sudah tiba. Bidan akan mengunjungi ibu paling lambat sebelum usia bayi 1 minggu. Jika bayi belum mendapat imunisai Hb 0 (nol), beritahu bidan agar bayi bisa menerima imunisasi Hb 0 sebelum bayi berusia 7 hari. Biasanya, bidan akan melakukan pemeriksaan pada ibu dan bayi pada kunjungan yang sama.";
    private $KN3_MESSAGE = "Minggu ini adalah jadwal pemeriksaan bayi ketiga (KN 3). Ibu akan dikunjungi bidan paling lambat sebelum bayi berusia 1 bulan. Pada usia ini, bayi mudah terkena penyakit. Berikan bayi perlindungan terbaik dengan cara memberi ASI. Jangan memberi makanan/cairan lain seperti madu atau air.";
    private $HB0_MESSAGE = "Bayi yang baru lahir harus menerima imunisasi Hb 0 (nol) segera setelah lahir atau paling lambat 7 hari setelah lahir. Jika bayi Ibu belum diimunisasi Hb 0, beritahukan pada bidan saat melakukan kunjungan rumah atau kunjungilah polindes/puskesmas terdekat. Imunisasi ini untuk melindungi bayi dari penyakit Hepatits B yang menular dan berbahaya.";
    private $BCG_POLIO1_MESSAGE = "Bulan ini adalah jadwal pemberian Imunisasi BCG dan Polio 1 untuk bayi Ibu. Imunisasi ini harus diberikan sebelum bayi berusia 2 bulan untuk melindungi bayi dari penyakit TBC dan Polio. TBC adalah penyakit yang menyerang paru-paru, sedangkan Polio menyebabkan kelumpuhan pada kaki dan tangan anak. ";
    private $HB1_POLIO2_MESSAGE = "Bulan ini adalah jadwal pemberian imunisasi DPT/HB 1 dan Polio 2 untuk bayi ibu, silahkan mengunjungi posyandu/polindes terdekat Ibu. Imunisasi ini diberikan untuk melindungi bayi dari penyakit difteri, batuk rejan, tetanus, hepatitis B dan polio. The interval between the current with the previous immunization is 1 month.";
    private $HB2_POLIO3_MESSAGE = "Bulan ini adalah jadwal pemberian imunisasi DPT/HB 2 dan Polio 3 untuk bayi Ibu, silahkan mengunjungi posyandu/polindes terdekat. Imunisasi ini diberikan untuk melindungi bayi dari penyakit difteri, batuk rejan, tetanus, hepatitis B dan polio. Pemberian imunisasi ini dengan imunisasi sebelumnya harus berjarak 1 bulan. ";
    private $HB3_POLIO4_MESSAGE = "Bulan ini adalah jadwal pemberian imunisasi DPT/HB 3 dan Polio 4 untuk bayi Ibu, silahkan mengunjungi posyandu/polindes terdekat. Imunisasi ini diberikan untuk melindungi bayi dari penyakit difteri, batuk rejan, tetanus, hepatitis B dan polio. Pemberian imunisasi ini dengan imunisasi sebelumnya harus berjarak 1 bulan. ";
    private $CAMPAK_MESSAGE = "Bulan ini adalah jadwal pemberian imunisasi Campak untuk bayi Ibu, silahkan mengunjungi posyandu/polindes terdekat. Imunisasi ini diberikan untuk melindungi bayi dari penyakit campak, yaitu penyakit menular yang menyerang kulit dan menimbulkan bercak-bercak merah di kulit.";
    private $SUNTIK3_MESSAGE = "Minggu ini adalah jadwal Ibu melakukan suntik ulang KB, silahkan mengunjungi polindes terdekat. Rencanakanlah jumlah anak yang Ibu dan suami inginkan. Jarak kehamilan yang terlalu dekat atau kurang dari 2 tahun dapat berakibat buruk bagi kehamilan dan persalinan ibu dikarenakan kondisi Ibu yang belum sepenuhnya pulih.";
    private $SUNTIK1_MESSAGE = "Minggu ini adalah jadwal Ibu melakukan suntik ulang KB, silahkan mengunjungi polindes terdekat. Rencanakanlah jumlah anak yang Ibu dan suami inginkan. Jarak kehamilan yang terlalu dekat atau kurang dari 2 tahun dapat berakibat buruk bagi kehamilan dan persalinan ibu dikarenakan kondisi Ibu yang belum sepenuhnya pulih.";
    private $IUD_MESSAGE = "Sudah waktunya melepas KB IUD Ibu, silahkan mengunjungi puskesmas terdekat. ";
    private $IMPLAN_MESSAGE = "Sudah waktunya melepas KB Implan Ibu, silahkan mengunjungi puskesmas terdekat. ";
  
    private $bidans = [
                       'Serage'=>array('nama'=>'Yani Sasmarani','tel'=>'+6281916097333'),
                       'Teduh'=>array('nama'=>'Bq. Wardatul Jannah','tel'=>'+6287765681750'),
                       'Gerantung'=>array('nama'=>'Sylvia Puspita','tel'=>'+6281803648244'),
                       'Kopang Rembiga'=>array('nama'=>'Laelaturahmi','tel'=>'+6281907802238'),
                       'Montong Gamang'=>array('nama'=>'Bq. Nurhayati','tel'=>'+6287763442828'),
                       'Mantang'=>array('nama'=>'Nini Marsini','tel'=>'+6287765981625'),
                       'Presak'=>array('nama'=>'Khairani','tel'=>'+6287864198845'),
                       'Gemel'=>array('nama'=>'Eri Sulistiani','tel'=>'+6281907341641'),
                       'Batu Tulis'=>array('nama'=>'Lisa Isnaeni','tel'=>'+6281998961032'),
                       'Labulia'=>array('nama'=>'Sulhani','tel'=>'+6281805778989')];
    
//    private $bidans = ['Montong Gamang'=>array('nama'=>'Ainul Hamdani','tel'=>'+6281916029525'),
//                        'Mantang'=>array('nama'=>'Siti','tel'=>'+6287864564295')];
//    private $bidans = ['Mantang'=>array('nama'=>'Ainul Hamdani','tel'=>'+6281916029525')];
    
    private $jadwal = ['Serage'=>array([],['Lekong jae'=>'Lekong jae','Semaye'=>'Semaye','Belenje'=>'Belenje'],['Beberik'=>'Beberik','Mapasan'=>'Mapasan','Sulung'=>'Sulung'],['Rurut'=>'Rurut','Bt salang'=>'Bt salang'],[],[]),
                       'Teduh'=>array([],['Jati'=>'Jati'],['Pengengat'=>'Pengengat','Pengolah'=>'Pengolah'],['Montong putik'=>'Montong putik'],['Teduh'=>'Teduh'],[]),
                       'Gerantung'=>array([],['Bual 1'=>'Bual 1','Bual 2'=>'Bual 2','Lingkok Kudung'=>'Lingkok Kudung'],['Juring'=>'Juring'],['Guntur'=>'Guntur','Gerantung'=>'Gerantung'],[],[]),
                       'Kopang Rembiga'=>array([],['Ngorok'=>'Ngorok','Puyung'=>'Puyung','Bajur'=>'Bajur','Gubuk'=>'Gubuk','Kopang 1'=>'Kopang 1','Bhineka'=>'Bhineka','Lingkung'=>'Lingkung'],['Pengkores'=>'Pengkores','Barat Masjid'=>'Barat Masjid','Gubuk Alang'=>'Gubuk Alang','Mentinggo'=>'Mentinggo','Kayun'=>'Kayun','BTN Jelojok'=>'BTN Jelojok'],['Renggung'=>'Renggung','Pendagi'=>'Pendagi','Lendang Lok'=>'Lendang Lok','Gunung Malang'=>'Gunung Malang','Bore'=>'Bore','Bebak'=>'Bebak','Jontak'=>'Jontak'],[],[]),
                       'Montong Gamang'=>array([],['Dasan tinggi'=>'Dasan tinggi','Karang Tengak'=>'Karang Tengak','Montong Bulok'=>'Montong Bulok','Mumbang 1'=>'Mumbang 1','Mumbang 2'=>'Mumbang 2','Mumbang 3'=>'Mumbang 3'],['Embung Karung 3'=>'Embung Karung 3','Nyanggi'=>'Nyanggi','Penimpah'=>'Penimpah','Embung Karung 1'=>'Embung Karung 1','Montong Tanger'=>'Montong Tanger'],['Montong Gamang 1'=>'Montong Gamang 1','Gonjong'=>'Gonjong','Binkok'=>'Binkok','Embung Karung 2'=>'Embung Karung 2','Montong Gamang 2'=>'Montong Gamang 2','Montong Gamang 3'=>'Montong Gamang 3'],[],[]),
                       'Mantang'=>array([],['Kabar'=>'Kabar','Mantang I'=>'Mantang I','Raju Mas'=>'Raju Mas','Tampeng'=>'Tampeng'],['Seganteng'=>'Seganteng','Pengadok'=>'Pengadok','Otak Desa'=>'Otak Desa','Alun-alun'=>'Alun-alun','Kelanjuh Daye'=>'Kelanjuh Daye'],['Tenten'=>'Tenten','Tundung'=>'Tundung','Ceret'=>'Ceret','Gb Gunung'=>'Gb Gunung','Jantuk'=>'Jantuk'],['Tj Bereng B'=>'Tj Bereng B','Tj Bereng T'=>'Tj Bereng T','Tenten'=>'Tenten','Riris'=>'Riris','Keren'=>'Keren','Banjar Metu'=>'Banjar Metu'],[]),
                       'Presak'=>array([],['Selojan'=>'Selojan','Presak Lauk'=>'Presak Lauk','Presak Tengak'=>'Presak Tengak','Subahnale I'=>'Subahnale I'],['Subahnale II'=>'Subahnale II','Dumpu'=>'Dumpu','Aik Gering'=>'Aik Gering','Sandik'=>'Sandik','Ds Aman'=>'Ds Aman'],['Penyengak'=>'Penyengak','Presak Daye'=>'Presak Daye','Pajangan'=>'Pajangan','Bujak Daye'=>'Bujak Daye','Batu Lajan'=>'Batu Lajan','Boak'=>'Boak'],[],[]),
                       'Gemel'=>array([],['Gemel'=>'Gemel','Merobok'=>'Merobok','Bilemantik'=>'Bilemantik','Kebun tengak'=>'Kebun tengak'],['Bunceman'=>'Bunceman','Bunsibah'=>'Bunsibah','Bunprie'=>'Bunprie','Mtg Kecial'=>'Mtg Kecial'],[],[],[]),
                       'Batu Tulis'=>array([],['Bangket Gawah'=>'Bangket Gawah','Bon Rungkang'=>'Bon Rungkang'],['Bonje'=>'Bonje','Jereneng'=>'Jereneng'],['Batu Tulis'=>'Batu Tulis'],['Gontoran'=>'Gontoran'],[]),
                       'Labulia'=>array([],['Enjak'=>'Enjak','Dasan Tuan'=>'Dasan Tuan','Olor Agung'=>'Olor Agung','Tandek Daye'=>'Tandek Daye','Tandek Lauk'=>'Tandek Lauk'],['Sulin'=>'Sulin','Wareng Kandel'=>'Wareng Kandel','Labulia Lauk'=>'Labulia Lauk','Bonduduk'=>'Bonduduk'],['Labulia Desa'=>'Labulia Desa','Tober'=>'Tober','Pengempokan'=>'Pengempokan','Batu Tinggang'=>'Batu Tinggang'],['Dasan Sebeleq'=>'Dasan Sebeleq','Labulia Daye'=>'Labulia Daye'],[])];
    
    function __construct() {
        parent::__construct();
        $this->load->model('Rapidpro');
        $this->load->model('EcLocationModel','loc');
    }
    
    private function send_message($msg,$to){
        $status = $this->Rapidpro->postBroadcasts($msg,$to);
        if(!($status[0]!='E')){
            $this->send_message($msg, $to);
        }
        return $status;
    }
    
    private function ancKe($anc,$data){
        if(sizeof($data)==0){
            return 1;
        }else{
            $a[1] = $a[2] = $a[3] = 0;
            foreach ($data as $d){
                if($d['ga']<13){
                    $a[1]++;
                }elseif($d['ga']>=13&&$d['ga']<28){
                    $a[2]++;
                }elseif($d['ga']>=28&&$d['ga']<42){
                    $a[3]++;
                }
            }
            if($anc['ga']<13){
                return 1;
            }elseif($anc['ga']>=13&&$a[2]==0){
                return 2;
            }elseif($anc['ga']>=13&&$anc['ga']<28){
                return 2;
            }elseif($anc['ga']>=28&&$a[3]==0){
                return 3;
            }elseif($anc['ga']>=28&&$a[3]>0){
                return 4;
            }
            if($a[2]==0&&$a[3]>0)var_dump($a);
        }
    }
    
    private function minggu_ke($today){
        $day = date("Y-m",  strtotime($today))."-01";
        $minggu_ke = 0;
        while($day!=$today){
            if(date("N",  strtotime($day))==1) $minggu_ke++;
            $day = date("Y-m-d",  strtotime($day." +1 day"));
        }
        if($day==$today){
            if(date("N",  strtotime($day))==1) $minggu_ke++;
        }
        return $minggu_ke;
    }
    
    public function alertAncDue(){
        $analyticsDB = $this->load->database('ec_analytics', TRUE);
        $now = date("Y-m-d");
//        $now = '2017-04-24';
        $minggu_ke = $this->minggu_ke($now);
        var_dump($minggu_ke);
        $batas = date("Y-m-d", strtotime($now." -42 weeks"));
        $result = array();
        $data = array("due"=>array("anc2"=>array(),"anc3"=>array(),"anc4"=>array()));
        $final_result = array();
        foreach ($this->bidans as $user=>$bidan){
            $dusun = $this->loc->getDusunTypo($user);
            foreach ($dusun as $x=>$dsn){
                $final_result[$user][$dsn] = $data;
            }
        }
        
        $query  = $analyticsDB->query("SELECT event_bidan_kunjungan_anc.baseEntityId,event_bidan_kunjungan_anc.locationId,event_bidan_kunjungan_anc.ancDate,event_bidan_kunjungan_anc.usiaKlinis,event_bidan_tambah_anc.tanggalHPHT,client_ibu.dusun,client_ibu.namaLengkap FROM event_bidan_kunjungan_anc LEFT JOIN event_bidan_tambah_anc ON event_bidan_kunjungan_anc.baseEntityId=event_bidan_tambah_anc.baseEntityId LEFT JOIN client_ibu ON event_bidan_kunjungan_anc.baseEntityId=client_ibu.baseEntityId WHERE tanggalHPHT > '$batas' ORDER BY event_bidan_kunjungan_anc.ancDate");
        $query2 = $analyticsDB->query("SELECT baseEntityId FROM event_bidan_dokumentasi_persalinan")->result();
        $datapnc = [];
        foreach ($query2 as $q){
            $datapnc[$q->baseEntityId] = TRUE;
        }
        $query2 = $analyticsDB->query("SELECT baseEntityId FROM event_bidan_penutupan_anc")->result();
        $dataclose = [];
        foreach ($query2 as $q){
            $dataclose[$q->baseEntityId] = TRUE;
        }
        $dataanc = [];
        foreach ($query->result() as $ibuhamil){
            if(array_key_exists($ibuhamil->baseEntityId, $datapnc)) continue;
            if(array_key_exists($ibuhamil->baseEntityId, $dataclose)) continue;
            if(!array_key_exists(str_replace('.','',trim($ibuhamil->locationId)),$this->jadwal)) continue;
            if(!array_key_exists(str_replace('.','',trim($ibuhamil->dusun)),  $this->jadwal[str_replace('.','',trim($ibuhamil->locationId))][$minggu_ke])) continue;
            $now = date_create(date("Y-m-d"));
            $hpht = null;
            if(array_key_exists($ibuhamil->baseEntityId, $result)){
                $old_anc = strtotime($result[$ibuhamil->baseEntityId]["anc_date"]);
                $new_anc = strtotime($ibuhamil->ancDate);
                if($new_anc > $old_anc){
                    $result[$ibuhamil->baseEntityId]["locationid"] = str_replace('.','',trim($ibuhamil->locationId));
                    $result[$ibuhamil->baseEntityId]["anc_date"] = $ibuhamil->ancDate;
                    $result[$ibuhamil->baseEntityId]["nama"]  = $ibuhamil->namaLengkap;
                    $result[$ibuhamil->baseEntityId]["dusun"]  = str_replace('.','',trim($ibuhamil->dusun));
                    $result[$ibuhamil->baseEntityId]["ga"] = (int)$ibuhamil->usiaKlinis;
                    $result[$ibuhamil->baseEntityId]["anc_ke"]  = $this->ancKe($result[$ibuhamil->baseEntityId],$dataanc[$ibuhamil->baseEntityId]);
                    array_push($dataanc[$ibuhamil->baseEntityId],$result[$ibuhamil->baseEntityId]);
                }
            }else{
                $result[$ibuhamil->baseEntityId]["locationid"]  = str_replace('.','',trim($ibuhamil->locationId));
                $result[$ibuhamil->baseEntityId]["anc_date"]  = $ibuhamil->ancDate;
                $result[$ibuhamil->baseEntityId]["nama"]  = $ibuhamil->namaLengkap;
                $result[$ibuhamil->baseEntityId]["dusun"]  = str_replace('.','',trim($ibuhamil->dusun));
                $result[$ibuhamil->baseEntityId]["ga"] = (int)$ibuhamil->usiaKlinis;
                $dataanc[$ibuhamil->baseEntityId] = [];
                $result[$ibuhamil->baseEntityId]["anc_ke"]  = $this->ancKe($result[$ibuhamil->baseEntityId],$dataanc[$ibuhamil->baseEntityId]);
                array_push($dataanc[$ibuhamil->baseEntityId],$result[$ibuhamil->baseEntityId]);
            }
        }
//        foreach ($dataanc as $be=>$dt){
//            if(sizeof($dt)<2)continue;
//            var_dump($be);
//            var_dump($dt);
//        }
//        
//        foreach ($result as $x=>$r){
//            if($r['anc_ke']!=$r["anc_ke_sistem"]){
//            var_dump($x);
//            var_dump($r);
//            }
//        }
//        exit;
        foreach ($result as $id=>$res){
            if(array_key_exists($res['locationid'], $final_result)){
                if(array_key_exists($res['dusun'], $final_result[$res['locationid']])){
                    if($res["anc_ke"]==1){
                        if($res["ga"]>12&&$res["ga"]<=18){
                            array_push($final_result[$res['locationid']][$res['dusun']]["due"]["anc2"],$res['nama']);
                        }
                    }elseif($res["anc_ke"]==2){
                        if($res["ga"]>28&&$res["ga"]<=32){
                            array_push($final_result[$res['locationid']][$res['dusun']]["due"]["anc3"],$res['nama']);
                        }
                    }elseif($res["anc_ke"]==3){
                        if($res["ga"]>32&&$res["ga"]<=36){
                            array_push($final_result[$res['locationid']][$res['dusun']]["due"]["anc4"],$res['nama']);
                        }
                    }
                }
            }
        }
        
        foreach ($final_result as $user=>$final){
            var_dump($user);
            $penerima = [$this->bidans[$user]['tel']];
            $pesan_due2 = $this->ANC2_MESSAGE_DUE;
            $pesan_due3 = $this->ANC3_MESSAGE_DUE;
            $pesan_due4 = $this->ANC4_MESSAGE_DUE;
            
            foreach($final as $dusun=>$anc){
                if(!(sizeof($anc['due']['anc2'])==0)){
                    $pesan_due2 .= $dusun."=";
                    foreach ($anc['due']['anc2'] as $nama) {
                      $pesan_due2 .= $nama.", ";
                    }
                }
                if(!(sizeof($anc['due']['anc3'])==0)){
                    $pesan_due3 .= $dusun."=";
                    foreach ($anc['due']['anc3'] as $nama) {
                      $pesan_due3 .= $nama.", ";
                    }
                }
                if(!(sizeof($anc['due']['anc4'])==0)){
                    $pesan_due4 .= $dusun."=";
                    foreach ($anc['due']['anc4'] as $nama) {
                      $pesan_due4 .= $nama.", ";
                    }
                }
            }
            
            if(strlen($pesan_due2)==44){
                //var_dump($pesan_due2."Tidak ada");
            }else{
                //var_dump($pesan_due2);
                $status = $this->send_message($pesan_due2,$penerima);
                var_dump($status);
            }
            if(strlen($pesan_due3)==44){
                //var_dump($pesan_due3."Tidak ada");
            }else{
                //var_dump($pesan_due3);
                $status = $this->send_message($pesan_due3,$penerima);
                var_dump($status);
            }
            if(strlen($pesan_due4)==44){
                //var_dump($pesan_due4."Tidak ada");
            }else{
                //var_dump($pesan_due4);
                $status = $this->send_message($pesan_due4,$penerima);
                var_dump($status);
            }
        }
        
        
    }
    
    public function alertAncOverdue(){
        $analyticsDB = $this->load->database('ec_analytics', TRUE);
        $now = date("Y-m-d");
        $batas = date("Y-m-d", strtotime($now." -42 weeks"));
        $result = array();
        $data = array("overdue"=>array("anc2"=>array(),"anc3"=>array(),"anc4"=>array()));
        $final_result = array();
        foreach ($this->bidans as $user=>$bidan){
            $dusun = $this->loc->getDusunTypo($user);
            foreach ($dusun as $x=>$dsn){
                $final_result[$user][$dsn] = $data;
            }
        }
        
        $query  = $analyticsDB->query("SELECT *,event_bidan_tambah_anc.tanggalHPHT,client_ibu.dusun,client_ibu.namaLengkap FROM event_bidan_kunjungan_anc LEFT JOIN event_bidan_tambah_anc ON event_bidan_kunjungan_anc.baseEntityId=event_bidan_tambah_anc.baseEntityId LEFT JOIN client_ibu ON event_bidan_kunjungan_anc.baseEntityId=client_ibu.baseEntityId WHERE tanggalHPHT > '$batas' GROUP BY event_bidan_kunjungan_anc.baseEntityId");
        $query2 = $analyticsDB->query("SELECT baseEntityId FROM event_bidan_dokumentasi_persalinan")->result();
        $datapnc = [];
        foreach ($query2 as $q){
            $datapnc[$q->baseEntityId] = TRUE;
        }
        $query2 = $analyticsDB->query("SELECT baseEntityId FROM event_bidan_penutupan_anc")->result();
        $dataclose = [];
        foreach ($query2 as $q){
            $dataclose[$q->baseEntityId] = TRUE;
        }
        $dataanc = [];
        foreach ($query->result() as $ibuhamil){
            if(array_key_exists($ibuhamil->baseEntityId, $datapnc)) continue;
            if(array_key_exists($ibuhamil->baseEntityId, $dataclose)) continue;
            $now = date_create(date("Y-m-d"));
            $hpht = null;
            if(array_key_exists($ibuhamil->baseEntityId, $result)){
                $old_anc = strtotime($result[$ibuhamil->baseEntityId]["anc_date"]);
                $new_anc = strtotime($ibuhamil->ancDate);
                if($new_anc > $old_anc){
                    $result[$ibuhamil->baseEntityId]["locationid"] = str_replace('.','',trim($ibuhamil->locationId));
                    $result[$ibuhamil->baseEntityId]["anc_date"] = $ibuhamil->ancDate;
                    $result[$ibuhamil->baseEntityId]["nama"]  = $ibuhamil->namaLengkap;
                    $result[$ibuhamil->baseEntityId]["dusun"]  = str_replace('.','',trim($ibuhamil->dusun));
                    $result[$ibuhamil->baseEntityId]["ga"] = (int)$ibuhamil->usiaKlinis;
                    $result[$ibuhamil->baseEntityId]["anc_ke"]  = $this->ancKe($result[$ibuhamil->baseEntityId],$dataanc[$ibuhamil->baseEntityId]);
                    array_push($dataanc[$ibuhamil->baseEntityId],$result[$ibuhamil->baseEntityId]);
                }
            }else{
                $result[$ibuhamil->baseEntityId]["locationid"]  = str_replace('.','',trim($ibuhamil->locationId));
                $result[$ibuhamil->baseEntityId]["anc_date"]  = $ibuhamil->ancDate;
                $result[$ibuhamil->baseEntityId]["nama"]  = $ibuhamil->namaLengkap;
                $result[$ibuhamil->baseEntityId]["dusun"]  = str_replace('.','',trim($ibuhamil->dusun));
                $result[$ibuhamil->baseEntityId]["ga"] = (int)$ibuhamil->usiaKlinis;
                $dataanc[$ibuhamil->baseEntityId] = [];
                $result[$ibuhamil->baseEntityId]["anc_ke"]  = $this->ancKe($result[$ibuhamil->baseEntityId],$dataanc[$ibuhamil->baseEntityId]);
                array_push($dataanc[$ibuhamil->baseEntityId],$result[$ibuhamil->baseEntityId]);
            }
        }
        
//        foreach ($result as $r){
//            var_dump($r);
//        }
//        exit;
        foreach ($result as $id=>$res){
            if(array_key_exists($res['locationid'], $final_result)){
                if(array_key_exists($res['dusun'], $final_result[$res['locationid']])){
                    if($res["anc_ke"]==1){
                        if($res["ga"]>18&&$res["ga"]<=42){
                            array_push($final_result[$res['locationid']][$res['dusun']]["overdue"]["anc2"],$id);
                        }
                    }elseif($res["anc_ke"]==2){
                        if($res["ga"]>32&&$res["ga"]<=42){
                            array_push($final_result[$res['locationid']][$res['dusun']]["overdue"]["anc3"],$id);
                        }
                    }elseif($res["anc_ke"]==3){
                        if($res["ga"]>36&&$res["ga"]<=42){
                            array_push($final_result[$res['locationid']][$res['dusun']]["overdue"]["anc4"],$id);
                        }
                    }
                }
            }
        }
        
        foreach ($final_result as $user=>$final){
            var_dump($user);
            $penerima = [$this->bidans[$user]['tel']];
            $pesan_overdue2 = $pesan_overdue2_2 = $pesan_overdue2_3 = "";
            $pesan_overdue3 = $pesan_overdue3_2 = $pesan_overdue3_3 = "";
            $pesan_overdue4 = $pesan_overdue4_2 = $pesan_overdue4_3 = "";
            
            foreach($final as $dusun=>$anc){
                if(!(sizeof($anc['overdue']['anc2'])==0)){
                    foreach ($anc['overdue']['anc2'] as $idibu){
                        if(strlen($pesan_overdue2)>350){
                            if(strlen($pesan_overdue2_2)>350){
                                $pesan_overdue2_3 .= $result[$idibu]['nama'].", ";
                            }else $pesan_overdue2_2 .= $result[$idibu]['nama'].", ";
                        }else{
                            $pesan_overdue2 .= $result[$idibu]['nama'].", ";
                        }
                    }
                    
                }
                if(!(sizeof($anc['overdue']['anc3'])==0)){
                    foreach ($anc['overdue']['anc3'] as $idibu){
                        if(strlen($pesan_overdue3)>350){
                            if(strlen($pesan_overdue3_2)>350){
                                $pesan_overdue3_3 .= $result[$idibu]['nama'].", ";
                            }else $pesan_overdue3_2 .= $result[$idibu]['nama'].", ";
                        }else{
                            $pesan_overdue3 .= $result[$idibu]['nama'].", ";
                        }
                    }
                }
                if(!(sizeof($anc['overdue']['anc4'])==0)){
                    foreach ($anc['overdue']['anc4'] as $idibu){
                        if(strlen($pesan_overdue4)>350){
                            if(strlen($pesan_overdue4_2)>350){
                                $pesan_overdue4_3 .= $result[$idibu]['nama'].", ";
                            }else $pesan_overdue4_2 .= $result[$idibu]['nama'].", ";
                        }else{
                            $pesan_overdue4 .= $result[$idibu]['nama'].", ";
                        }
                    }
                }
            }
            
            if($pesan_overdue2!=""&&$pesan_overdue2_2!=""){
                var_dump($this->ANC2_MESSAGE_OVERDUE."(Bagian1) ".$pesan_overdue2);
                $status = $this->send_message($this->ANC2_MESSAGE_OVERDUE."(Bagian1) ".$pesan_overdue2,$penerima);
                var_dump($status);
            }elseif($pesan_overdue2!=""){
                var_dump($this->ANC2_MESSAGE_OVERDUE.$pesan_overdue2);
                $status = $this->send_message($this->ANC2_MESSAGE_OVERDUE.$pesan_overdue2,$penerima);
                var_dump($status);
            }else{
                //var_dump($this->ANC2_MESSAGE_OVERDUE."Tidak ada");
            }
            if($pesan_overdue2_2!=""){
                var_dump($this->ANC2_MESSAGE_OVERDUE."(Bagian2) ".$pesan_overdue2_2);
                $status = $this->send_message($this->ANC2_MESSAGE_OVERDUE."(Bagian2) ".$pesan_overdue2_2,$penerima);
                var_dump($status);
            }
            if($pesan_overdue2_3!=""){
                var_dump($this->ANC2_MESSAGE_OVERDUE."(Bagian3) ".$pesan_overdue2_3);
                $status = $this->send_message($this->ANC2_MESSAGE_OVERDUE."(Bagian3) ".$pesan_overdue2_3,$penerima);
                var_dump($status);
            }
            
            if($pesan_overdue3!=""&&$pesan_overdue3_2!=""){
                var_dump($this->ANC3_MESSAGE_OVERDUE."(Bagian1) ".$pesan_overdue3);
                $status = $this->send_message($this->ANC3_MESSAGE_OVERDUE."(Bagian1) ".$pesan_overdue3,$penerima);
                var_dump($status);
            }elseif($pesan_overdue3!=""){
                var_dump($this->ANC3_MESSAGE_OVERDUE.$pesan_overdue3);
                $status = $this->send_message($this->ANC3_MESSAGE_OVERDUE.$pesan_overdue3,$penerima);
                var_dump($status);
            }else{
                //var_dump($this->ANC3_MESSAGE_OVERDUE."Tidak ada");
            }
            if($pesan_overdue3_2!=""){
                var_dump($this->ANC3_MESSAGE_OVERDUE."(Bagian2) ".$pesan_overdue3_2);
                $status = $this->send_message($this->ANC3_MESSAGE_OVERDUE."(Bagian2) ".$pesan_overdue3_2,$penerima);
                var_dump($status);
            }
            if($pesan_overdue3_3!=""){
                var_dump($this->ANC3_MESSAGE_OVERDUE."(Bagian3) ".$pesan_overdue3_3);
                $status = $this->send_message($this->ANC3_MESSAGE_OVERDUE."(Bagian3) ".$pesan_overdue3_3,$penerima);
                var_dump($status);
            }
            
            if($pesan_overdue4!=""&&$pesan_overdue4_2!=""){
                var_dump($this->ANC4_MESSAGE_OVERDUE."(Bagian1) ".$pesan_overdue4);
                $status = $this->send_message($this->ANC4_MESSAGE_OVERDUE."(Bagian1) ".$pesan_overdue4,$penerima);
                var_dump($status);
            }elseif($pesan_overdue4!=""){
                var_dump($this->ANC4_MESSAGE_OVERDUE.$pesan_overdue4);
                $status = $this->send_message($this->ANC4_MESSAGE_OVERDUE.$pesan_overdue4,$penerima);
                var_dump($status);
            }else{
                //var_dump($this->ANC4_MESSAGE_OVERDUE."Tidak ada");
            }
            if($pesan_overdue4_2!=""){
                var_dump($this->ANC4_MESSAGE_OVERDUE."(Bagian2) ".$pesan_overdue4_2);
                $status = $this->send_message($this->ANC4_MESSAGE_OVERDUE."(Bagian2) ".$pesan_overdue4_2,$penerima);
                var_dump($status);
            }
            if($pesan_overdue4_3!=""){
                var_dump($this->ANC4_MESSAGE_OVERDUE."(Bagian3) ".$pesan_overdue4_3);
                $status = $this->send_message($this->ANC4_MESSAGE_OVERDUE."(Bagian3) ".$pesan_overdue4_3,$penerima);
                var_dump($status);
            }
        }
        
        
    }
    
    public function alertPncDue(){
        $analyticsDB = $this->load->database('ec_analytics', TRUE);
        $now = date("Y-m-d");
//        $now = '2017-04-13';
        var_dump($now);
        $batas = date("Y-m-d", strtotime($now." -42 days"));
        $result = array();
        $data = array("due"=>array("kf1"=>array(),"kf2"=>array(),"kf3"=>array(),"kf4"=>array()));
        $final_result = array();
        foreach ($this->bidans as $user=>$bidan){
            $final_result[$user] = $data;
        }
        //var_dump($query->result());
        $query  = $analyticsDB->query("SELECT event_bidan_dokumentasi_persalinan.baseEntityId,event_bidan_dokumentasi_persalinan.locationId, client_ibu.namaLengkap, client_anak.birthDate FROM event_bidan_dokumentasi_persalinan LEFT JOIN client_anak ON client_anak.ibuCaseId = event_bidan_dokumentasi_persalinan.baseEntityId LEFT JOIN client_ibu ON event_bidan_dokumentasi_persalinan.baseEntityId=client_ibu.baseEntityId WHERE client_anak.birthDate > '$batas' AND keadaanBayi='hidup' AND locationId!='' GROUP BY event_bidan_dokumentasi_persalinan.baseEntityId");
        $query2 = $analyticsDB->query("SELECT baseEntityId,hariKeKF FROM event_bidan_kunjungan_pnc ORDER BY PNCDate DESC")->result();
        $datapnc = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->baseEntityId, $datapnc)){
                $datapnc[$q->baseEntityId] = $q->hariKeKF;
            }
            
        }
        $query2 = $analyticsDB->query("SELECT * FROM event_bidan_kunjungan_neonatal ORDER BY tanggalKunjunganBayiPerbulan  DESC")->result();
        $datachild = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->baseEntityId, $datachild)){
                $datachild[$q->baseEntityId]["kunjunganNeonatal"] = $q->kunjunganNeonatal;
                $datachild[$q->baseEntityId]["hb0"] = $q->hb0;
            }
            
        }
        foreach ($query->result() as $ibunifas){
            $today = date_create($now);
            $result[$ibunifas->baseEntityId]["nama"] = $ibunifas->namaLengkap;
            $result[$ibunifas->baseEntityId]["lastkf"] = 'None';
            $result[$ibunifas->baseEntityId]["lastkn"] = 'None';
            $result[$ibunifas->baseEntityId]["68"] = 'None';
            $result[$ibunifas->baseEntityId]["locationid"]  = str_replace('.', '', $ibunifas->locationId);
            $tgl_lahir = date_create(date("Y-m-d",  strtotime($ibunifas->birthDate)));
            $diff = date_diff($today,$tgl_lahir);
            $diff_day = $diff->days;
            $result[$ibunifas->baseEntityId]["ga"] = $diff_day;
            
            if(array_key_exists($ibunifas->baseEntityId, $datapnc)){
                $result[$ibunifas->baseEntityId]["lastkf"]  = (int)$datapnc[$ibunifas->baseEntityId];
            }
            if(array_key_exists($ibunifas->baseEntityId, $datachild)){
                $result[$ibunifas->baseEntityId]["lastkn"]  = $datachild[$ibunifas->baseEntityId]['kunjunganNeonatal'];
                if($datachild[$ibunifas->baseEntityId]['hb0']!='')$result[$ibunifas->baseEntityId]["68"]  = $datachild[$ibunifas->baseEntityId]['hb0'];
            }
        }
        
        foreach ($result as $id=>$res){
            if($res['ga']==3){
                if($res['lastkf']=='None'){
                    array_push($final_result[$res['locationid']]["due"]["kf1"],$res);
                }
            }
            if($res['ga']==8){
                if($res['lastkf']=='None'||$res['lastkf']!='kf1'){
                    array_push($final_result[$res['locationid']]["due"]["kf2"],$res);
                }
            }
            if($res['ga']==29){
                if($res['lastkf']=='None'||$res['lastkf']!='kf2'){
                    array_push($final_result[$res['locationid']]["due"]["kf3"],$res);
                }
            }
        }
//        var_dump($result);
        foreach ($final_result as $desa=>$due){
            var_dump($desa);
            $penerima = [$this->bidans[$desa]['tel']];
            $pesan['kf1'] = str_replace('xxx', '1', $this->PNC_MESSAGE_DUE);
            $pesan['kf2'] = str_replace('xxx', '2', $this->PNC_MESSAGE_DUE);
            $pesan['kf3'] = str_replace('xxx', '3', $this->PNC_MESSAGE_DUE);
            $pesan['kf4'] = str_replace('xxx', '4', $this->PNC_MESSAGE_DUE);
            
            foreach ($due['due'] as $kf=>$dataibu){
                if(!(sizeof($due['due'][$kf])==0)){
                    foreach ($dataibu as $ibu){
                        if($ibu==end($dataibu)){
                            $pesan[$kf] .= $ibu['nama'];
                        }else{
                            $pesan[$kf] .= $ibu['nama'].", ";
                        }
                    }
                    //var_dump($pesan[$kf]);
                    $status = $this->send_message($pesan[$kf],$penerima);
                    var_dump($status);
                }
            }
        }
    }
    
    public function alertPncOverDue(){
        $analyticsDB = $this->load->database('ec_analytics', TRUE);
        $now = date("Y-m-d");
//        $now = '2017-04-13';
        var_dump($now);
        $batas = date("Y-m-d", strtotime($now." -42 days"));
        $result = array();
        $data = array("due"=>array("kf1"=>array(),"kf2"=>array(),"kf3"=>array(),"kf4"=>array()));
        $final_result = array();
        foreach ($this->bidans as $user=>$bidan){
            $final_result[$user] = $data;
        }
        //var_dump($query->result());
        $query  = $analyticsDB->query("SELECT event_bidan_dokumentasi_persalinan.baseEntityId,event_bidan_dokumentasi_persalinan.locationId, client_ibu.namaLengkap, client_anak.birthDate FROM event_bidan_dokumentasi_persalinan LEFT JOIN client_anak ON client_anak.ibuCaseId = event_bidan_dokumentasi_persalinan.baseEntityId LEFT JOIN client_ibu ON event_bidan_dokumentasi_persalinan.baseEntityId=client_ibu.baseEntityId WHERE client_anak.birthDate > '$batas' AND keadaanBayi='hidup' AND locationId!='' GROUP BY event_bidan_dokumentasi_persalinan.baseEntityId");
        $query2 = $analyticsDB->query("SELECT baseEntityId,hariKeKF FROM event_bidan_kunjungan_pnc ORDER BY PNCDate DESC")->result();
        $datapnc = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->baseEntityId, $datapnc)){
                $datapnc[$q->baseEntityId] = $q->hariKeKF;
            }
            
        }
        $query2 = $analyticsDB->query("SELECT * FROM event_bidan_kunjungan_neonatal ORDER BY tanggalKunjunganBayiPerbulan  DESC")->result();
        $datachild = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->baseEntityId, $datachild)){
                $datachild[$q->baseEntityId]["kunjunganNeonatal"] = $q->kunjunganNeonatal;
                $datachild[$q->baseEntityId]["hb0"] = $q->hb0;
            }
            
        }
        foreach ($query->result() as $ibunifas){
            $today = date_create($now);
            $result[$ibunifas->baseEntityId]["nama"] = $ibunifas->namaLengkap;
            $result[$ibunifas->baseEntityId]["lastkf"] = 'None';
            $result[$ibunifas->baseEntityId]["lastkn"] = 'None';
            $result[$ibunifas->baseEntityId]["68"] = 'None';
            $result[$ibunifas->baseEntityId]["locationid"]  = str_replace('.', '', $ibunifas->locationId);
            $tgl_lahir = date_create(date("Y-m-d",  strtotime($ibunifas->birthDate)));
            $diff = date_diff($today,$tgl_lahir);
            $diff_day = $diff->days;
            $result[$ibunifas->baseEntityId]["ga"] = $diff_day;
            
            if(array_key_exists($ibunifas->baseEntityId, $datapnc)){
                $result[$ibunifas->baseEntityId]["lastkf"]  = (int)$datapnc[$ibunifas->baseEntityId];
            }
            if(array_key_exists($ibunifas->baseEntityId, $datachild)){
                $result[$ibunifas->baseEntityId]["lastkn"]  = $datachild[$ibunifas->baseEntityId]['kunjunganNeonatal'];
                if($datachild[$ibunifas->baseEntityId]['hb0']!='')$result[$ibunifas->baseEntityId]["68"]  = $datachild[$ibunifas->baseEntityId]['hb0'];
            }
        }
        
        foreach ($result as $id=>$res){
            if($res['ga']==8){
                if($res['lastkf']=='None'){
                    array_push($final_result[$res['locationid']]["due"]["kf1"],$res);
                }
            }
            if($res['ga']==29){
                if($res['lastkf']=='None'||$res['lastkf']!='kf1'){
                    array_push($final_result[$res['locationid']]["due"]["kf2"],$res);
                }
            }
            if($res['ga']==36){
                if($res['lastkf']=='None'||$res['lastkf']!='kf2'){
                    array_push($final_result[$res['locationid']]["due"]["kf3"],$res);
                }
            }
        }
//        var_dump($result);
        foreach ($final_result as $desa=>$due){
            var_dump($desa);
            $penerima = [$this->bidans[$desa]['tel']];
            $pesan['kf1'] = str_replace('xxx', '1', $this->PNC_MESSAGE_OVERDUE);
            $pesan['kf2'] = str_replace('xxx', '2', $this->PNC_MESSAGE_OVERDUE);
            $pesan['kf3'] = str_replace('xxx', '3', $this->PNC_MESSAGE_OVERDUE);
            $pesan['kf4'] = str_replace('xxx', '4', $this->PNC_MESSAGE_OVERDUE);
            
            foreach ($due['due'] as $kf=>$dataibu){
                if(!(sizeof($due['due'][$kf])==0)){
                    foreach ($dataibu as $ibu){
                        if($ibu==end($dataibu)){
                            $pesan[$kf] .= $ibu['nama'];
                        }else{
                            $pesan[$kf] .= $ibu['nama'].", ";
                        }
                    }
                    //var_dump($pesan[$kf]);
                    $status = $this->send_message($pesan[$kf],$penerima);
                    var_dump($status);
                }
            }
        }
    }
    
    public function alertAncBumil(){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $now = date("Y-m-d");
        $batas = date("Y-m-d", strtotime($now." -42 weeks"));
        $result = array();
        $data = array("anc1"=>array(),"anc2"=>array(),"anc3"=>array(),"anc4"=>array());
        $final_result = array();
        foreach ($this->bidans as $user=>$bidan){
            $final_result[$user] = $data;
        }
        $query  = $analyticsDB->query("SELECT * FROM kartu_anc_visit WHERE tanggalHPHT > '$batas' GROUP BY baseEntityId");
        $query2 = $analyticsDB->query("SELECT baseEntityId FROM kartu_pnc_dokumentasi_persalinan")->result();
        $datapnc = [];
        foreach ($query2 as $q){
            $datapnc[$q->baseEntityId] = TRUE;
        }
        $query2 = $analyticsDB->query("SELECT baseEntityId FROM kartu_anc_close")->result();
        $dataclose = [];
        foreach ($query2 as $q){
            $dataclose[$q->baseEntityId] = TRUE;
        }
        foreach ($query->result() as $i=>$ibuhamil){
            if(array_key_exists($ibuhamil->baseEntityId, $datapnc)) continue;
            if(array_key_exists($ibuhamil->baseEntityId, $dataclose)) continue;
            $now = date_create(date("Y-m-d"));
            $hpht = null;
            if(array_key_exists($ibuhamil->kiId, $result)){
                $old_anc = strtotime($result[$ibuhamil->kiId]["anc_date"]);
                $new_anc = strtotime($ibuhamil->ancDate);
                if($new_anc > $old_anc){
                    $result[$ibuhamil->kiId]["locationid"] = $ibuhamil->locationId;
                    $result[$ibuhamil->kiId]["anc_date"] = $ibuhamil->ancDate;
                    $result[$ibuhamil->kiId]["anc_ke"]  = $ibuhamil->ancKe;
                    $hpht = date_create(date("Y-m-d",  strtotime($ibuhamil->tanggalHPHT)));
                    $diff = date_diff($now,$hpht);
                    $diff_week = (int)($diff->days/7)+1;
                    $result[$ibuhamil->kiId]["ga"] = $diff_week;
                }
            }else{
                $result[$ibuhamil->kiId]["locationid"]  = $ibuhamil->locationId;
                $result[$ibuhamil->kiId]["anc_date"]  = $ibuhamil->ancDate;
                $result[$ibuhamil->kiId]["anc_ke"]  = $ibuhamil->ancKe;
                $hpht = date_create(date("Y-m-d",  strtotime($ibuhamil->tanggalHPHT)));
                $diff = date_diff($now,$hpht);
                $diff_week = (int)($diff->days/7)+1;
                $result[$ibuhamil->kiId]["ga"] = $diff_week;
            }
        }
        foreach ($result as $id=>$res){
            if($res["anc_ke"]=='1'){
                if($res["ga"]<14){
                    array_push($final_result[$res['locationid']]["anc1"],$id);
                }
                if($res["ga"]==14){
                    array_push($final_result[$res['locationid']]["anc2"],$id);
                }
            }elseif($res["anc_ke"]=='2'){
                if($res["ga"]==28){
                    array_push($final_result[$res['locationid']]["anc3"],$id);
                }
            }elseif($res["anc_ke"]=='3'){
                if($res["ga"]==36){
                    array_push($final_result[$res['locationid']]["anc4"],$id);
                }
            }
        }
        $query = $analyticsDB->query("SELECT kiId,NomorTelponHp FROM kartu_ibu_registration")->result();
        $datatlp = [];
        foreach ($query as $q){
            $datatlp[$q->kiId] = $q->NomorTelponHp;
        }
        foreach ($final_result as $user=>$final){
            foreach ($final['anc1'] as $ibuanc1){
                if(array_key_exists($ibuanc1, $datatlp)){
                    $tlp = $datatlp[$ibuanc1];
                    if($tlp!=""&&$tlp!="None"){
                        $num = (string)$tlp;
                        if(substr($num, 0,1)=='0'){
                            $num[0] = '+';
                            $num = str_replace('+',"+62",$num);
                        }else{
                            $num[0] = '+';
                            $num = str_replace('+',"+628",$num);
                        }
//                        var_dump($num);
//                        var_dump($this->ANC1_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->ANC1_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
            foreach ($final['anc2'] as $ibuanc1){
                if(array_key_exists($ibuanc1, $datatlp)){
                    $tlp = $datatlp[$ibuanc1];
                    if($tlp!=""&&$tlp!="None"){
                        $num = (string)$tlp;
                        if(substr($num, 0,1)=='0'){
                            $num[0] = '+';
                            $num = str_replace('+',"+62",$num);
                        }else{
                            $num[0] = '+';
                            $num = str_replace('+',"+628",$num);
                        }
//                        var_dump($num);
//                        var_dump($this->ANC2_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->ANC2_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
            foreach ($final['anc3'] as $ibuanc1){
                if(array_key_exists($ibuanc1, $datatlp)){
                    $tlp = $datatlp[$ibuanc1];
                    if($tlp!=""&&$tlp!="None"){
                        $num = (string)$tlp;
                        if(substr($num, 0,1)=='0'){
                            $num[0] = '+';
                            $num = str_replace('+',"+62",$num);
                        }else{
                            $num[0] = '+';
                            $num = str_replace('+',"+628",$num);
                        }
//                        var_dump($num);
//                        var_dump($this->ANC3_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->ANC3_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
            foreach ($final['anc4'] as $ibuanc1){
                if(array_key_exists($ibuanc1, $datatlp)){
                    $tlp = $datatlp[$ibuanc1];
                    if($tlp!=""&&$tlp!="None"){
                        $num = (string)$tlp;
                        if(substr($num, 0,1)=='0'){
                            $num[0] = '+';
                            $num = str_replace('+',"+62",$num);
                        }else{
                            $num[0] = '+';
                            $num = str_replace('+',"+628",$num);
                        }
//                        var_dump($num);
//                        var_dump($this->ANC4_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->ANC4_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
        }
    }
    
    public function alertPnc(){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $now = date("Y-m-d");
        $batas = date("Y-m-d", strtotime($now." -50 days"));
        $result = array();
        $data = array("due"=>array("kf1"=>array(),"kf2"=>array(),"kf3"=>array(),"kf4"=>array(),"kn1"=>array(),"kn2"=>array(),"kn3"=>array()),"overdue"=>array("kf1"=>array(),"kf2"=>array(),"kf3"=>array(),"kf4"=>array(),"kn1"=>array(),"kn2"=>array(),"kn3"=>array()));
        $final_result = array();
        foreach ($this->bidans as $user=>$bidan){
            $final_result[$user] = $data;
        }
        //var_dump($query->result());
        $query  = $analyticsDB->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$batas' GROUP BY baseEntityId");
        $query2 = $analyticsDB->query("SELECT baseEntityId,hariKeKF FROM kartu_pnc_visit ORDER BY referenceDate DESC")->result();
        $datapnc = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->baseEntityId, $datapnc)){
                $datapnc[$q->baseEntityId] = $q->hariKeKF;
            }
            
        }
        $query2 = $analyticsDB->query("SELECT * FROM kohort_bayi_neonatal_period ORDER BY submissionDate DESC")->result();
        $datachild = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->childId, $datachild)){
                $datachild[$q->childId]["kunjunganNeonatal"] = $q->kunjunganNeonatal;
                $datachild[$q->childId]["kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan"] = $q->kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan;
            }
            
        }
        foreach ($query->result() as $ibunifas){
            $now = date_create(date("Y-m-d"));
            $result[$ibunifas->baseEntityId]["lastkf"] = 'None';
            $result[$ibunifas->baseEntityId]["lastkn"] = 'None';
            $result[$ibunifas->baseEntityId]["68"] = 'None';
            $result[$ibunifas->baseEntityId]["locationid"]  = $ibunifas->locationId;
            $tgl_lahir = date_create(date("Y-m-d",  strtotime($ibunifas->tanggalLahirAnak)));
            $diff = date_diff($now,$tgl_lahir);
            $diff_day = $diff->days;
            $result[$ibunifas->baseEntityId]["ga"] = $diff_day;
            
            if(array_key_exists($ibunifas->baseEntityId, $datapnc)){
                $result[$ibunifas->baseEntityId]["lastkf"]  = $datapnc[$ibunifas->baseEntityId];
            }
            if(array_key_exists($ibunifas->childId, $datachild)){
                $result[$ibunifas->baseEntityId]["lastkn"]  = $datachild[$ibunifas->childId]['kunjunganNeonatal'];
                if($datachild[$ibunifas->childId]['kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan']!='')$result[$ibunifas->baseEntityId]["68"]  = $datachild[$ibunifas->childId]['kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan'];
            }
        }
        
        foreach ($result as $id=>$res){
            if($res['lastkf']=='None'){
                if($res['ga']<3){
                    array_push($final_result[$res['locationid']]["due"]["kf1"],$id);
                }elseif($res['ga']>=3){
                    array_push($final_result[$res['locationid']]["overdue"]["kf1"],$id);
                }
            }
            if($res['lastkf']=='kf1'){
                if($res['ga']>=3&&$res['ga']<8){
                    array_push($final_result[$res['locationid']]["due"]["kf2"],$id);
                }elseif($res['ga']>=8){
                    array_push($final_result[$res['locationid']]["overdue"]["kf2"],$id);
                }
            }
            if($res['lastkf']=='kf2'){
                if($res['ga']>=8&&$res['ga']<29){
                    array_push($final_result[$res['locationid']]["due"]["kf3"],$id);
                }elseif($res['ga']>=29){
                    array_push($final_result[$res['locationid']]["overdue"]["kf3"],$id);
                }
            }
            if($res['lastkf']=='kf3'){
                if($res['ga']>=29&&$res['ga']<50){
                    array_push($final_result[$res['locationid']]["due"]["kf4"],$id);
                }elseif($res['ga']>=50){
                    array_push($final_result[$res['locationid']]["overdue"]["kf4"],$id);
                }
            }
            
            if($res['lastkn']=='None'){
                if($res['ga']<3){
                    array_push($final_result[$res['locationid']]["due"]["kn1"],$id);
                }elseif($res['ga']>=3&&$res['68']=='None'){
                    array_push($final_result[$res['locationid']]["overdue"]["kn1"],$id);
                }
            }
            if($res['lastkn']=='5_jam_pertama'){
                if($res['ga']>=3&&$res['ga']<8){
                    array_push($final_result[$res['locationid']]["due"]["kn2"],$id);
                }elseif($res['ga']>=8){
                    array_push($final_result[$res['locationid']]["overdue"]["kn2"],$id);
                }
            }
            
            if($res['lastkn']=='Kedua'){
                if($res['ga']>=8&&$res['ga']<29){
                    array_push($final_result[$res['locationid']]["due"]["kn3"],$id);
                }elseif($res['ga']>=29){
                    array_push($final_result[$res['locationid']]["overdue"]["kn3"],$id);
                }
            }
            
        }
        
        
    }
    
    public function alertPncIbu(){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $now = date("Y-m-d");
        $batas = date("Y-m-d", strtotime($now." -50 days"));
        $result = array();
        $data = array("kf1"=>array(),"kf2"=>array(),"kf3"=>array(),"kf4"=>array(),"kn1"=>array(),"kn2"=>array(),"kn3"=>array());
        $final_result = array();
        foreach ($this->bidans as $user=>$bidan){
            $final_result[$user] = $data;
        }
        //var_dump($query->result());
        $query  = $analyticsDB->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$batas' GROUP BY baseEntityId");
        $query2 = $analyticsDB->query("SELECT kiId,hariKeKF FROM kartu_pnc_visit ORDER BY referenceDate DESC")->result();
        $datapnc = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->kiId, $datapnc)){
                $datapnc[$q->kiId] = $q->hariKeKF;
            }
            
        }
        $query2 = $analyticsDB->query("SELECT * FROM kohort_bayi_neonatal_period ORDER BY submissionDate DESC")->result();
        $datachild = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->childId, $datachild)){
                $datachild[$q->childId]["kunjunganNeonatal"] = $q->kunjunganNeonatal;
                $datachild[$q->childId]["kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan"] = $q->kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan;
            }
            
        }
        $query2 = $analyticsDB->query("SELECT baseEntityId,kiId FROM kartu_anc_visit GROUP BY baseEntityId")->result();
        $dataid = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->baseEntityId, $dataid)){
                $dataid[$q->baseEntityId]= $q->kiId;
            }
            
        }
        foreach ($query->result() as $ibunifas){
            if(array_key_exists($ibunifas->baseEntityId, $dataid)){
                $id = $dataid[$ibunifas->baseEntityId];
            }else{
                continue;
            }
            $now = date_create(date("Y-m-d"));
            $result[$id]["lastkf"] = 'None';
            $result[$id]["lastkn"] = 'None';
            $result[$id]["68"] = 'None';
            $result[$id]["locationid"]  = $ibunifas->locationId;
            $tgl_lahir = date_create(date("Y-m-d",  strtotime($ibunifas->tanggalLahirAnak)));
            $diff = date_diff($now,$tgl_lahir);
            $diff_day = $diff->days;
            $result[$id]["ga"] = $diff_day;
            
            if(array_key_exists($id, $datapnc)){
                $result[$id]["lastkf"]  = $datapnc[$id];
            }
            if(array_key_exists($ibunifas->childId, $datachild)){
                $result[$id]["lastkn"]  = $datachild[$ibunifas->childId]['kunjunganNeonatal'];
                if($datachild[$ibunifas->childId]['kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan']!='')$result[$id]["68"]  = $datachild[$ibunifas->childId]['kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan'];
            }
        }
        
        foreach ($result as $id=>$res){
            if($res['lastkf']=='None'){
                if($res['ga']<3){
                    array_push($final_result[$res['locationid']]["kf1"],$id);
                }
            }
            if($res['lastkf']=='kf1'){
                if($res['ga']==3){
                    array_push($final_result[$res['locationid']]["kf2"],$id);
                }
            }
            if($res['lastkf']=='kf2'){
                if($res['ga']==8){
                    array_push($final_result[$res['locationid']]["kf3"],$id);
                }
            }
            if($res['lastkf']=='kf3'){
                if($res['ga']==29){
                    array_push($final_result[$res['locationid']]["kf4"],$id);
                }
            }
            
            if($res['lastkn']=='None'){
                if($res['ga']<3){
                    array_push($final_result[$res['locationid']]["kn1"],$id);
                }
            }
            if($res['lastkn']=='5_jam_pertama'){
                if($res['ga']==3){
                    array_push($final_result[$res['locationid']]["kn2"],$id);
                }
            }
            
            if($res['lastkn']=='Kedua'){
                if($res['ga']==8){
                    array_push($final_result[$res['locationid']]["kn3"],$id);
                }
            }
        }
        $query = $analyticsDB->query("SELECT kiId,NomorTelponHp FROM kartu_ibu_registration")->result();
        $datatlp = [];
        foreach ($query as $q){
            $datatlp[$q->kiId] = $q->NomorTelponHp;
        }
        foreach ($final_result as $user=>$final){
            foreach ($final['kf1'] as $ibu){
                if(array_key_exists($ibu, $datatlp)){
                    $tlp = $datatlp[$ibu];
                    if($tlp!=""&&$tlp!="None"){
                        $num = (string)$tlp;
                        if(substr($num, 0,1)=='0'){
                            $num[0] = '+';
                            $num = str_replace('+',"+62",$num);
                        }else{
                            $num[0] = '+';
                            $num = str_replace('+',"+628",$num);
                        }
//                        var_dump($num);
//                        var_dump($this->PNC1_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->PNC1_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
            foreach ($final['kf2'] as $ibu){
                if(array_key_exists($ibu, $datatlp)){
                    $tlp = $datatlp[$ibu];
                    if($tlp!=""&&$tlp!="None"){
                        $num = (string)$tlp;
                        if(substr($num, 0,1)=='0'){
                            $num[0] = '+';
                            $num = str_replace('+',"+62",$num);
                        }else{
                            $num[0] = '+';
                            $num = str_replace('+',"+628",$num);
                        }
//                        var_dump($num);
//                        var_dump($this->PNC2_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->PNC2_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
            foreach ($final['kf3'] as $ibu){
                if(array_key_exists($ibu, $datatlp)){
                    $tlp = $datatlp[$ibu];
                    if($tlp!=""&&$tlp!="None"){
                        $num = (string)$tlp;
                        if(substr($num, 0,1)=='0'){
                            $num[0] = '+';
                            $num = str_replace('+',"+62",$num);
                        }else{
                            $num[0] = '+';
                            $num = str_replace('+',"+628",$num);
                        }
//                        var_dump($num);
//                        var_dump($this->PNC3_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->PNC3_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
            foreach ($final['kf4'] as $ibu){
                if(array_key_exists($ibu, $datatlp)){
                    $tlp = $datatlp[$ibu];
                    if($tlp!=""&&$tlp!="None"){
                        $num = (string)$tlp;
                        if(substr($num, 0,1)=='0'){
                            $num[0] = '+';
                            $num = str_replace('+',"+62",$num);
                        }else{
                            $num[0] = '+';
                            $num = str_replace('+',"+628",$num);
                        }
//                        var_dump($num);
//                        var_dump($this->PNC4_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->PNC4_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
            foreach ($final['kn1'] as $ibu){
                if(array_key_exists($ibu, $datatlp)){
                    $tlp = $datatlp[$ibu];
                    if($tlp!=""&&$tlp!="None"){
                        $num = (string)$tlp;
                        if(substr($num, 0,1)=='0'){
                            $num[0] = '+';
                            $num = str_replace('+',"+62",$num);
                        }else{
                            $num[0] = '+';
                            $num = str_replace('+',"+628",$num);
                        }
//                        var_dump($num);
//                        var_dump($this->KN1_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->KN1_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
            foreach ($final['kn2'] as $ibu){
                if(array_key_exists($ibu, $datatlp)){
                    $tlp = $datatlp[$ibu];
                    if($tlp!=""&&$tlp!="None"){
                        $num = (string)$tlp;
                        if(substr($num, 0,1)=='0'){
                            $num[0] = '+';
                            $num = str_replace('+',"+62",$num);
                        }else{
                            $num[0] = '+';
                            $num = str_replace('+',"+628",$num);
                        }
//                        var_dump($num);
//                        var_dump($this->KN2_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->KN2_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
            foreach ($final['kn3'] as $ibu){
                if(array_key_exists($ibu, $datatlp)){
                    $tlp = $datatlp[$ibu];
                    if($tlp!=""&&$tlp!="None"){
                        $num = (string)$tlp;
                        if(substr($num, 0,1)=='0'){
                            $num[0] = '+';
                            $num = str_replace('+',"+62",$num);
                        }else{
                            $num[0] = '+';
                            $num = str_replace('+',"+628",$num);
                        }
//                        var_dump($num);
//                        var_dump($this->KN3_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->KN3_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
        }
    }
}