<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ServiceAlert extends CI_Model{
    
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
                       'user1'=>array('nama'=>'Sri Maryani','tel'=>'+6281907679110'),
                       'user2'=>array('nama'=>'Sumiati','tel'=>'+62818364744'),
                       'user3'=>array('nama'=>'Hj. Ismayati','tel'=>'+6281936784100'),
                       'user4'=>array('nama'=>'Indah Kurniawati','tel'=>'+6281907280006'),
                       'user5'=>array('nama'=>'Suhaeni','tel'=>'+6285934646216'),
                       'user6'=>array('nama'=>'Tuti Alawiyah','tel'=>'+6287864607228'),
                       'user8'=>array('nama'=>'Bq. Silvia','tel'=>'+6281917374736'),
                       'user9'=>array('nama'=>'Erna Kuspitawati','tel'=>'+6281805753100'),
                       'user11'=>array('nama'=>'Ning Suryaningsih','tel'=>'+6281999483435'),
                       'user12'=>array('nama'=>'Dwinta','tel'=>'+6281246158988'),
                       'user13'=>array('nama'=>'Munah','tel'=>'+6281917946598'),
                       'user14'=>array('nama'=>'Eka Zuryatun','tel'=>'+6281902831937')
                        ];
    
    private $jadwal = ['user1'=>array([],[],['Lengkok Bunut'=>'Lengkok Bunut','Walun'=>'Walun','Renge'=>'Renge','Sondo'=>'Sondo'],['Presak'=>'Presak','Gulung'=>'Gulung','Lekor Timur'=>'Lekor Timur','Taken Aken'=>"Taken Aken"],['Pepao Timur'=>'Pepao Timur','Pepao Barat'=>'Pepao Barat','Pepao Tengah'=>'Pepao Tengah','Lekor Barat'=>'Lekor Barat','Pelapak'=>'Pelapak'],[]),
                       'user2'=>array([],[],["Gundu"=>"Gundu","Janggawana Selatan"=>"Janggawana Selatan","Janggawana Utara"=>"Janggawana Utara","Keruak"=>"Keruak","Sengkerek"=>"Sengkerek"],["Lingkok Buak Timur"=>"Lingkok Buak Timur","Lingkok Buak Barat"=>"Lingkok Buak Barat","Jembe Barat"=>"Jembe Barat","Jembe Timur"=>"Jembe Timur"],["Terentem"=>"Terentem","Pengempok"=>"Pengempok","Suangke"=>"Suangke","Presak Sanggeng"=>"Presak Sanggeng"],[]),
                       'user3'=>array([],["Pendem"=>"Pendem"],["Maliklo"=>"Maliklo","Gelondong"=>"Gelondong","Piling"=>"Piling","Penuntut"=>"Penuntut"],["Jelitong"=>"Jelitong","Lekong Bangkon"=>"Lekong Bangkon","Kuang"=>"Kuang","Karang Majelo"=>"Karang Majelo"],["Petorok"=>"Petorok","Gelung"=>"Gelung","Jangka"=>"Jangka","Nyangget"=>"Nyangget","Montong Bile"=>"Montong Bile"],[]),
                       'user4'=>array([],["Setuta Timur"=>"Setuta Timur","Setuta Barat"=>"Setuta Barat","Siwi"=>"Siwi"],["Batu Belek"=>"Batu Belek","Liwung"=>"Liwung","Liwung Selatan"=>"Liwung Selatan"],["Juna"=>"Juna","Nunang+Selatan"=>"Nunang Selatan","Biletawah"=>"Biletawah"],[],[]),
                       'user5'=>array([],["Jango Utara"=>"Jango Utara","Rungkang Timur"=>"Rungkang Timur","Rungkang Barat"=>"Rungkang Barat","Kenyalu I"=>"Kenyalu I"],["Grepek"=>"Grepek","Puntik Baru"=>"Puntik Baru","Jango Selatan"=>"Jango Selatan"],["Kenyalu II"=>"Kenyalu II",],[],[]),
                       'user6'=>array([],["Perok Timur"=>"Perok Timur","Tempek Empek"=>"Tempek Empek","Batu Bungus Utara"=>"Batu Bungus Utara","Perok Barat"=>"Perok Barat","Pengebat"=>"Pengebat"],["Nunang Utara"=>"Nunang Utara","Sadah"=>"Sadah","Batu Kembar Timur"=>"Batu Kembar Timur"],["Penambong"=>"Penambong","Lemokek"=>"Lemokek","Batu Kembar Barat"=>"Batu Kembar Barat","Lambah Olot"=>"Lambah Olot"],["Tonjong"=>"Tonjong"],[]),
                       'user8'=>array([],["Sarah"=>"Sarah","Sempalan"=>"Sempalan"],["Lebak"=>"Lebak","Dayen Rurung"=>"Dayen Rurung"],["Embung Rungkas"=>"Embung Rungkas","Bagek Dewe"=>"Bagek Dewe","Sampet"=>"Sampet"],["Dese"=>"Dese","Abe"=>"Abe"],[]),
                       'user9'=>array([],["Kale"=>"Kale","Sengkol II"=>"Sengkol II","Sedo"=>"Sedo"],["Penambong"=>"Penambong","Jomang"=>"Jomang","Tajuk"=>"Tajuk","Pesarih"=>"Pesarih"],["Semundal"=>"Semundal","Soweng"=>"Soweng","Junge"=>"Junge","Peresak"=>"Peresak"],["Belong"=>"Belong","Sereneng"=>"Sereneng","Piyang"=>"Piyang","Sengkol I"=>"Sengkol I","Lotir"=>"Lotir"],[]),
                       'user11'=>array([],[],[],[],[],[]),
                       'user12'=>array([],[],[],[],[],[]),
                       'user13'=>array([],["Pengembur I"=>"Pengembur I","Pengembur II"=>"Pengembur II","Sepit"=>"Sepit"],["Penyampi"=>"Penyampi","Sinah"=>"Sinah","Pengembur III"=>"Pengembur III","Tamping"=>"Tamping"],["Tawah"=>"Tawah","Batu Belek"=>"Batu Belek"],["Siwang"=>"Siwang","Perigi"=>"Perigi","Keramat"=>"Keramat"],[]),
                       'user14'=>array([],["Anak Anjan"=>"Anak Anjan","Kadik"=>"Kadik","Penupi"=>"Penupi"],["Karang Baru"=>"Karang Baru","Lamben"=>"Lamben"],["Bolok"=>"Bolok","Tenang"=>"Tenang"],[],[])];
    
    function __construct() {
        parent::__construct();
        $this->load->model('Rapidpro');
        $this->load->model('LocationModel','loc');
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
    
    private function send_message($msg,$to){
        $status = $this->Rapidpro->postBroadcasts($msg,$to);
        if(!($status[0]!='E')){
            $this->send_message($msg, $to);
        }
        return $status;
    }
    
    public function alertAnc(){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $now = date("Y-m-d");
        $batas = date("Y-m-d", strtotime($now." -42 weeks"));
        $result = array();
        $data = array("due"=>array("anc2"=>array(),"anc3"=>array(),"anc4"=>array()),"now"=>array("anc2"=>array(),"anc3"=>array(),"anc4"=>array()),"overdue"=>array("anc2"=>array(),"anc3"=>array(),"anc4"=>array()));
        $final_result = array();
        foreach ($this->bidans as $user=>$bidan){
            $final_result[$user] = $data;
        }
        
        $query  = $analyticsDB->query("SELECT * FROM kartu_anc_visit WHERE tanggalHPHT > '$batas'");
        $query2 = $analyticsDB->query("SELECT motherId FROM kartu_pnc_dokumentasi_persalinan")->result();
        $datapnc = [];
        foreach ($query2 as $q){
            $datapnc[$q->motherId] = TRUE;
        }
        $query2 = $analyticsDB->query("SELECT motherId FROM kartu_anc_close")->result();
        $dataclose = [];
        foreach ($query2 as $q){
            $dataclose[$q->motherId] = TRUE;
        }
        foreach ($query->result() as $ibuhamil){
            if(array_key_exists($ibuhamil->motherId, $datapnc)) continue;
            if(array_key_exists($ibuhamil->motherId, $dataclose)) continue;
            $now = date_create(date("Y-m-d"));
            $hpht = null;
            if(array_key_exists($ibuhamil->motherId, $result)){
                $old_anc = strtotime($result[$ibuhamil->motherId]["anc_date"]);
                $new_anc = strtotime($ibuhamil->ancDate);
                if($new_anc > $old_anc){
                    $result[$ibuhamil->motherId]["userid"] = $ibuhamil->userID;
                    $result[$ibuhamil->motherId]["anc_date"] = $ibuhamil->ancDate;
                    $result[$ibuhamil->motherId]["anc_ke"]  = $ibuhamil->ancKe;
                    $hpht = date_create(date("Y-m-d",  strtotime($ibuhamil->tanggalHPHT)));
                    $diff = date_diff($now,$hpht);
                    $diff_week = ($diff->days/7)+1;
                    $result[$ibuhamil->motherId]["ga"] = $diff_week;
                }
            }else{
                $result[$ibuhamil->motherId]["userid"]  = $ibuhamil->userID;
                $result[$ibuhamil->motherId]["anc_date"]  = $ibuhamil->ancDate;
                $result[$ibuhamil->motherId]["anc_ke"]  = $ibuhamil->ancKe;
                $hpht = date_create(date("Y-m-d",  strtotime($ibuhamil->tanggalHPHT)));
                $diff = date_diff($now,$hpht);
                $diff_week = ($diff->days/7)+1;
                $result[$ibuhamil->motherId]["ga"] = $diff_week;
            }
        }
        foreach ($result as $id=>$res){
            if($res["anc_ke"]=='1'){
                if($res["ga"]<=14){
                    array_push($final_result[$res['userid']]["due"]["anc2"],$id);
                }
                if($res["ga"]>14&&$res["ga"]<=26){
                    array_push($final_result[$res['userid']]["now"]["anc2"],$id);
                }
                if($res["ga"]>26&&$res["ga"]<=42){
                    array_push($final_result[$res['userid']]["overdue"]["anc2"],$id);
                }
            }elseif($res["anc_ke"]=='2'){
                if($res["ga"]>26&&$res["ga"]<=28){
                    array_push($final_result[$res['userid']]["due"]["anc3"],$id);
                }
                if($res["ga"]>28&&$res["ga"]<=34){
                    array_push($final_result[$res['userid']]["now"]["anc3"],$id);
                }
                if($res["ga"]>34&&$res["ga"]<=42){
                    array_push($final_result[$res['userid']]["overdue"]["anc3"],$id);
                }
            }elseif($res["anc_ke"]=='3'){
                if($res["ga"]>34&&$res["ga"]<=36){
                    array_push($final_result[$res['userid']]["due"]["anc4"],$id);
                }
                if($res["ga"]>36&&$res["ga"]<=39){
                    array_push($final_result[$res['userid']]["now"]["anc4"],$id);
                }
                if($res["ga"]>39&&$res["ga"]<=42){
                    array_push($final_result[$res['userid']]["overdue"]["anc4"],$id);
                }
            }
        }
        
        foreach ($final_result as $user=>$final){
            $penerima = [$this->bidans[$user]['tel']];
            if(!(sizeof($final['due']['anc2'])==0&&sizeof($final['due']['anc3'])==0&&sizeof($final['due']['anc4'])==0)){
                $pesan = $this->ANC_MESSAGE_DUE;
                $pesan = str_replace('xxnama', $this->bidans[$user]['nama'], $pesan);
                $pesan = str_replace('xx2', sizeof($final['due']['anc2']), $pesan);
                $pesan = str_replace('xx3', sizeof($final['due']['anc3']), $pesan);
                $pesan = str_replace('xx4', sizeof($final['due']['anc4']), $pesan);
                var_dump($pesan);
//                $status = $this->Rapidpro->postBroadcasts($pesan,$penerima);
//                print_r($status);
            }


            if(!(sizeof($final['now']['anc2'])==0&&sizeof($final['now']['anc3'])==0&&sizeof($final['now']['anc4'])==0)){
                $pesan = $this->ANC_MESSAGE_NOW;
                $pesan = str_replace('xxnama', $this->bidans[$user]['nama'], $pesan);
                $pesan = str_replace('xx2', sizeof($final['now']['anc2']), $pesan);
                $pesan = str_replace('xx3', sizeof($final['now']['anc3']), $pesan);
                $pesan = str_replace('xx4', sizeof($final['now']['anc4']), $pesan);
                var_dump($pesan);
//                $status = $this->Rapidpro->postBroadcasts($pesan,$penerima);
//                print_r($status);
            }


            if(!(sizeof($final['overdue']['anc2'])==0&&sizeof($final['overdue']['anc3'])==0&&sizeof($final['overdue']['anc4'])==0)){
                $pesan = $this->ANC_MESSAGE_OVERDUE;
                $pesan = str_replace('xxnama', $this->bidans[$user]['nama'], $pesan);
                $pesan = str_replace('xx2', sizeof($final['overdue']['anc2']), $pesan);
                $pesan = str_replace('xx3', sizeof($final['overdue']['anc3']), $pesan);
                $pesan = str_replace('xx4', sizeof($final['overdue']['anc4']), $pesan);
                var_dump($pesan);
//                $status = $this->Rapidpro->postBroadcasts($pesan,$penerima);
//                print_r($status);
            }
        }
    }
    
    public function alertAncDue(){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $now = date("Y-m-d");
        $batas = date("Y-m-d", strtotime($now." -42 weeks"));
        $minggu_ke = $this->minggu_ke($now);
        $result = array();
        $data = array("due"=>array("anc2"=>array(),"anc3"=>array(),"anc4"=>array()));
        $final_result = array();
        $all_dusun = $this->loc->getAllDusunTypo();
        foreach ($this->bidans as $user=>$bidan){
            $dusun = $this->loc->getDusunTypo($this->loc->getIntLocId('bidan')[$user]);
            foreach ($dusun as $x=>$dsn){
                $final_result[$user][$dsn] = $data;
            }
        }
        
        $query  = $analyticsDB->query("SELECT kartu_anc_visit.userID,kartu_anc_visit.motherId,kartu_anc_visit.ancDate,kartu_anc_visit.tanggalHPHT,kartu_anc_visit.ancKe,kartu_ibu_registration.dusun,kartu_ibu_registration.namalengkap FROM kartu_anc_visit LEFT JOIN kartu_ibu_registration ON kartu_anc_visit.kiId=kartu_ibu_registration.kiId WHERE tanggalHPHT > '$batas'");
        $query2 = $analyticsDB->query("SELECT motherId FROM kartu_pnc_dokumentasi_persalinan")->result();
        $datapnc = [];
        foreach ($query2 as $q){
            $datapnc[$q->motherId] = TRUE;
        }
        $query2 = $analyticsDB->query("SELECT motherId FROM kartu_anc_close")->result();
        $dataclose = [];
        foreach ($query2 as $q){
            $dataclose[$q->motherId] = TRUE;
        }
        foreach ($query->result() as $ibuhamil){
            if(array_key_exists($ibuhamil->motherId, $datapnc)) continue;
            if(array_key_exists($ibuhamil->motherId, $dataclose)) continue;
            if(!array_key_exists(str_replace('.','',trim($ibuhamil->userID)),$this->jadwal)) continue;
            if(!array_key_exists(str_replace('.','',trim($ibuhamil->dusun)),  $this->jadwal[str_replace('.','',trim($ibuhamil->userID))][$minggu_ke])) continue;
            $now = date_create(date("Y-m-d"));
            $hpht = null;
            if(array_key_exists($ibuhamil->motherId, $result)){
                $old_anc = strtotime($result[$ibuhamil->motherId]["anc_date"]);
                $new_anc = strtotime($ibuhamil->ancDate);
                if($new_anc > $old_anc){
                    $result[$ibuhamil->motherId]["userid"] = $ibuhamil->userID;
                    $result[$ibuhamil->motherId]["anc_date"] = $ibuhamil->ancDate;
                    $result[$ibuhamil->motherId]["anc_ke"]  = $ibuhamil->ancKe;
                    $result[$ibuhamil->motherId]["nama"]  = $ibuhamil->namalengkap;
                    $result[$ibuhamil->motherId]["dusun"]  = str_replace('.','',trim($ibuhamil->dusun));
                    $hpht = date_create(date("Y-m-d",  strtotime($ibuhamil->tanggalHPHT)));
                    $diff = date_diff($now,$hpht);
                    $diff_week = ($diff->days/7)+1;
                    $result[$ibuhamil->motherId]["ga"] = $diff_week;
                }
            }else{
                $result[$ibuhamil->motherId]["userid"]  = $ibuhamil->userID;
                $result[$ibuhamil->motherId]["anc_date"]  = $ibuhamil->ancDate;
                $result[$ibuhamil->motherId]["anc_ke"]  = $ibuhamil->ancKe;
                $result[$ibuhamil->motherId]["nama"]  = $ibuhamil->namalengkap;
                $result[$ibuhamil->motherId]["dusun"]  = str_replace('.','',trim($ibuhamil->dusun));
                $hpht = date_create(date("Y-m-d",  strtotime($ibuhamil->tanggalHPHT)));
                $diff = date_diff($now,$hpht);
                $diff_week = ($diff->days/7)+1;
                $result[$ibuhamil->motherId]["ga"] = $diff_week;
            }
        }
        foreach ($result as $id=>$res){
            if(array_key_exists($res['userid'], $final_result)){
                if(array_key_exists($all_dusun[$this->loc->getIntLocId('bidan')[$res['userid']]][$res['dusun']], $final_result[$res['userid']])){
                    if($res["anc_ke"]==1){
                        if($res["ga"]>12&&$res["ga"]<=18){
                            array_push($final_result[$res['userid']][$all_dusun[$this->loc->getIntLocId('bidan')[$res['userid']]][$res['dusun']]]["due"]["anc2"],$res['nama']);
                        }
                    }elseif($res["anc_ke"]==2){
                        if($res["ga"]>28&&$res["ga"]<=32){
                            array_push($final_result[$res['userid']][$all_dusun[$this->loc->getIntLocId('bidan')[$res['userid']]][$res['dusun']]]["due"]["anc3"],$res['nama']);
                        }
                    }elseif($res["anc_ke"]==3){
                        if($res["ga"]>32&&$res["ga"]<=36){
                            array_push($final_result[$res['userid']][$all_dusun[$this->loc->getIntLocId('bidan')[$res['userid']]][$res['dusun']]]["due"]["anc4"],$res['nama']);
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
            var_dump($penerima);
            if(strlen($pesan_due2)==44){
                //var_dump($pesan_due2."Tidak ada");
            }else{
                var_dump($pesan_due2);
//                $status = $this->send_message($pesan_due2,$penerima);
//                var_dump($status);
            }
            if(strlen($pesan_due3)==44){
                //var_dump($pesan_due3."Tidak ada");
            }else{
                var_dump($pesan_due3);
//                $status = $this->send_message($pesan_due3,$penerima);
//                var_dump($status);
            }
            if(strlen($pesan_due4)==44){
                //var_dump($pesan_due4."Tidak ada");
            }else{
                var_dump($pesan_due4);
//                $status = $this->send_message($pesan_due4,$penerima);
//                var_dump($status);
            }
        }
    }
    
    public function alertAncOverDue(){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $now = date("Y-m-d");
        $batas = date("Y-m-d", strtotime($now." -42 weeks"));
        $minggu_ke = $this->minggu_ke($now);
        $result = array();
        $data = array("overdue"=>array("anc2"=>array(),"anc3"=>array(),"anc4"=>array()));
        $final_result = array();
        $all_dusun = $this->loc->getAllDusunTypo();
        foreach ($this->bidans as $user=>$bidan){
            $dusun = $this->loc->getDusunTypo($this->loc->getIntLocId('bidan')[$user]);
            foreach ($dusun as $x=>$dsn){
                $final_result[$user][$dsn] = $data;
            }
        }
        
        $query  = $analyticsDB->query("SELECT kartu_anc_visit.*,kartu_ibu_registration.dusun,kartu_ibu_registration.namalengkap FROM kartu_anc_visit LEFT JOIN kartu_ibu_registration ON kartu_anc_visit.kiId=kartu_ibu_registration.kiId WHERE tanggalHPHT > '$batas'");
        $query2 = $analyticsDB->query("SELECT motherId FROM kartu_pnc_dokumentasi_persalinan")->result();
        $datapnc = [];
        foreach ($query2 as $q){
            $datapnc[$q->motherId] = TRUE;
        }
        $query2 = $analyticsDB->query("SELECT motherId FROM kartu_anc_close")->result();
        $dataclose = [];
        foreach ($query2 as $q){
            $dataclose[$q->motherId] = TRUE;
        }
        foreach ($query->result() as $ibuhamil){
            if(array_key_exists($ibuhamil->motherId, $datapnc)) continue;
            if(array_key_exists($ibuhamil->motherId, $dataclose)) continue;
            if(!array_key_exists(str_replace('.','',trim($ibuhamil->userID)),$this->jadwal)) continue;
//            if(!array_key_exists(str_replace('.','',trim($ibuhamil->dusun)),  $this->jadwal[str_replace('.','',trim($ibuhamil->userID))][$minggu_ke])) continue;
            $now = date_create(date("Y-m-d"));
            $hpht = null;
            if(array_key_exists($ibuhamil->motherId, $result)){
                $old_anc = strtotime($result[$ibuhamil->motherId]["anc_date"]);
                $new_anc = strtotime($ibuhamil->ancDate);
                if($new_anc > $old_anc){
                    $result[$ibuhamil->motherId]["userid"] = $ibuhamil->userID;
                    $result[$ibuhamil->motherId]["anc_date"] = $ibuhamil->ancDate;
                    $result[$ibuhamil->motherId]["anc_ke"]  = $ibuhamil->ancKe;
                    $result[$ibuhamil->motherId]["nama"]  = $ibuhamil->namalengkap;
                    $result[$ibuhamil->motherId]["dusun"]  = str_replace('.','',trim($ibuhamil->dusun));
                    $hpht = date_create(date("Y-m-d",  strtotime($ibuhamil->tanggalHPHT)));
                    $diff = date_diff($now,$hpht);
                    $diff_week = ($diff->days/7)+1;
                    $result[$ibuhamil->motherId]["ga"] = $diff_week;
                }
            }else{
                $result[$ibuhamil->motherId]["userid"]  = $ibuhamil->userID;
                $result[$ibuhamil->motherId]["anc_date"]  = $ibuhamil->ancDate;
                $result[$ibuhamil->motherId]["anc_ke"]  = $ibuhamil->ancKe;
                $result[$ibuhamil->motherId]["nama"]  = $ibuhamil->namalengkap;
                $result[$ibuhamil->motherId]["dusun"]  = str_replace('.','',trim($ibuhamil->dusun));
                $hpht = date_create(date("Y-m-d",  strtotime($ibuhamil->tanggalHPHT)));
                $diff = date_diff($now,$hpht);
                $diff_week = ($diff->days/7)+1;
                $result[$ibuhamil->motherId]["ga"] = $diff_week;
            }
        }
        foreach ($result as $id=>$res){
            if(array_key_exists($res['userid'], $final_result)){
                if(array_key_exists($res['dusun'], $final_result[$res['userid']])){
                    if($res["anc_ke"]==1){
                        if($res["ga"]>18&&$res["ga"]<=42){
                            array_push($final_result[$res['userid']][$res['dusun']]["overdue"]["anc2"],$id);
                        }
                    }elseif($res["anc_ke"]==2){
                        if($res["ga"]>32&&$res["ga"]<=42){
                            array_push($final_result[$res['userid']][$res['dusun']]["overdue"]["anc3"],$id);
                        }
                    }elseif($res["anc_ke"]==3){
                        if($res["ga"]>36&&$res["ga"]<=42){
                            array_push($final_result[$res['userid']][$res['dusun']]["overdue"]["anc4"],$id);
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
                //$status = $this->send_message($this->ANC2_MESSAGE_OVERDUE."(Bagian1) ".$pesan_overdue2,$penerima);
                //var_dump($status);
            }elseif($pesan_overdue2!=""){
                var_dump($this->ANC2_MESSAGE_OVERDUE.$pesan_overdue2);
                //$status = $this->send_message($this->ANC2_MESSAGE_OVERDUE.$pesan_overdue2,$penerima);
                //var_dump($status);
            }else{
                //var_dump($this->ANC2_MESSAGE_OVERDUE."Tidak ada");
            }
            if($pesan_overdue2_2!=""){
                var_dump($this->ANC2_MESSAGE_OVERDUE."(Bagian2) ".$pesan_overdue2_2);
                //$status = $this->send_message($this->ANC2_MESSAGE_OVERDUE."(Bagian2) ".$pesan_overdue2_2,$penerima);
                //var_dump($status);
            }
            if($pesan_overdue2_3!=""){
                var_dump($this->ANC2_MESSAGE_OVERDUE."(Bagian3) ".$pesan_overdue2_3);
                //$status = $this->send_message($this->ANC2_MESSAGE_OVERDUE."(Bagian3) ".$pesan_overdue2_3,$penerima);
                //var_dump($status);
            }
            
            if($pesan_overdue3!=""&&$pesan_overdue3_2!=""){
                var_dump($this->ANC3_MESSAGE_OVERDUE."(Bagian1) ".$pesan_overdue3);
                //$status = $this->send_message($this->ANC3_MESSAGE_OVERDUE."(Bagian1) ".$pesan_overdue3,$penerima);
                //var_dump($status);
            }elseif($pesan_overdue3!=""){
                var_dump($this->ANC3_MESSAGE_OVERDUE.$pesan_overdue3);
                //$status = $this->send_message($this->ANC3_MESSAGE_OVERDUE.$pesan_overdue3,$penerima);
                //var_dump($status);
            }else{
                //var_dump($this->ANC3_MESSAGE_OVERDUE."Tidak ada");
            }
            if($pesan_overdue3_2!=""){
                var_dump($this->ANC3_MESSAGE_OVERDUE."(Bagian2) ".$pesan_overdue3_2);
                //$status = $this->send_message($this->ANC3_MESSAGE_OVERDUE."(Bagian2) ".$pesan_overdue3_2,$penerima);
                //var_dump($status);
            }
            if($pesan_overdue3_3!=""){
                var_dump($this->ANC3_MESSAGE_OVERDUE."(Bagian3) ".$pesan_overdue3_3);
                //$status = $this->send_message($this->ANC3_MESSAGE_OVERDUE."(Bagian3) ".$pesan_overdue3_3,$penerima);
                //var_dump($status);
            }
            
            if($pesan_overdue4!=""&&$pesan_overdue4_2!=""){
                var_dump($this->ANC4_MESSAGE_OVERDUE."(Bagian1) ".$pesan_overdue4);
                //$status = $this->send_message($this->ANC4_MESSAGE_OVERDUE."(Bagian1) ".$pesan_overdue4,$penerima);
                //var_dump($status);
            }elseif($pesan_overdue4!=""){
                var_dump($this->ANC4_MESSAGE_OVERDUE.$pesan_overdue4);
                //$status = $this->send_message($this->ANC4_MESSAGE_OVERDUE.$pesan_overdue4,$penerima);
                //var_dump($status);
            }else{
                //var_dump($this->ANC4_MESSAGE_OVERDUE."Tidak ada");
            }
            if($pesan_overdue4_2!=""){
                var_dump($this->ANC4_MESSAGE_OVERDUE."(Bagian2) ".$pesan_overdue4_2);
                //$status = $this->send_message($this->ANC4_MESSAGE_OVERDUE."(Bagian2) ".$pesan_overdue4_2,$penerima);
                //var_dump($status);
            }
            if($pesan_overdue4_3!=""){
                var_dump($this->ANC4_MESSAGE_OVERDUE."(Bagian3) ".$pesan_overdue4_3);
                //$status = $this->send_message($this->ANC4_MESSAGE_OVERDUE."(Bagian3) ".$pesan_overdue4_3,$penerima);
                //var_dump($status);
            }
        }
    }
    
    public function alertPncDue(){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $now = date("Y-m-d");
//        $now = '2017-04-16';
        var_dump($now);
        $batas = date("Y-m-d", strtotime($now." -42 days"));
        $result = array();
        $data = array("due"=>array("kf1"=>array(),"kf2"=>array(),"kf3"=>array(),"kf4"=>array()));
        $final_result = array();
        foreach ($this->bidans as $user=>$bidan){
            $final_result[$user] = $data;
        }
        //var_dump($query->result());
        $query  = $analyticsDB->query("SELECT kartu_pnc_dokumentasi_persalinan.*,kartu_ibu_registration.namalengkap FROM kartu_pnc_dokumentasi_persalinan LEFT JOIN kartu_anc_registration INNER JOIN kartu_ibu_registration ON kartu_ibu_registration.kiId=kartu_anc_registration.kiId ON kartu_pnc_dokumentasi_persalinan.motherId=kartu_anc_registration.motherId WHERE tanggalLahirAnak > '$batas' GROUP BY kartu_pnc_dokumentasi_persalinan.motherId");
        $query2 = $analyticsDB->query("SELECT motherId,hariKeKF FROM kartu_pnc_visit ORDER BY referenceDate DESC")->result();
        $datapnc = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->motherId, $datapnc)){
                $datapnc[$q->motherId] = $q->hariKeKF;
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
            $today = date_create($now);
            $result[$ibunifas->motherId]["nama"] = $ibunifas->namalengkap;
            $result[$ibunifas->motherId]["lastkf"] = 'None';
            $result[$ibunifas->motherId]["lastkn"] = 'None';
            $result[$ibunifas->motherId]["68"] = 'None';
            $result[$ibunifas->motherId]["userid"]  = $ibunifas->userID;
            $tgl_lahir = date_create(date("Y-m-d",  strtotime($ibunifas->tanggalLahirAnak)));
            $diff = date_diff($today,$tgl_lahir);
            $diff_day = $diff->days;
            $result[$ibunifas->motherId]["ga"] = $diff_day;
            
            if(array_key_exists($ibunifas->motherId, $datapnc)){
                $result[$ibunifas->motherId]["lastkf"]  = $datapnc[$ibunifas->motherId];
            }
            if(array_key_exists($ibunifas->childId, $datachild)){
                $result[$ibunifas->motherId]["lastkn"]  = $datachild[$ibunifas->childId]['kunjunganNeonatal'];
                if($datachild[$ibunifas->childId]['kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan']!='')$result[$ibunifas->motherId]["68"]  = $datachild[$ibunifas->childId]['kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan'];
            }
        }
        
        foreach ($result as $id=>$res){
            if($res['ga']<3){
                if($res['lastkf']=='None'){
                    array_push($final_result[$res['userid']]["due"]["kf1"],$res);
                }
            }
            if($res['ga']==4){
                if($res['lastkf']=='None'||$res['lastkf']<=3){
                    array_push($final_result[$res['userid']]["due"]["kf2"],$res);
                }
            }
            if($res['ga']==9){
                if($res['lastkf']=='None'||$res['lastkf']<=8){
                    array_push($final_result[$res['userid']]["due"]["kf3"],$res);
                }
            }
            if($res['ga']==36){
                if($res['lastkf']=='None'||$res['lastkf']<36){
                    array_push($final_result[$res['userid']]["due"]["kf4"],$res);
                }
            }
        }
        
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
                    var_dump($pesan[$kf]);
//                    $status = $this->send_message($pesan[$kf],$penerima);
//                    var_dump($status);
                }
            }
        }
    }
    
    public function alertPncOverDue(){
        $analyticsDB = $this->load->database('analytics', TRUE);
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
        $query  = $analyticsDB->query("SELECT kartu_pnc_dokumentasi_persalinan.*,kartu_ibu_registration.namalengkap FROM kartu_pnc_dokumentasi_persalinan LEFT JOIN kartu_anc_registration INNER JOIN kartu_ibu_registration ON kartu_ibu_registration.kiId=kartu_anc_registration.kiId ON kartu_pnc_dokumentasi_persalinan.motherId=kartu_anc_registration.motherId WHERE tanggalLahirAnak > '$batas' GROUP BY kartu_pnc_dokumentasi_persalinan.motherId");
        $query2 = $analyticsDB->query("SELECT motherId,hariKeKF FROM kartu_pnc_visit ORDER BY referenceDate DESC")->result();
        $datapnc = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->motherId, $datapnc)){
                $datapnc[$q->motherId] = $q->hariKeKF;
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
            $today = date_create($now);
            $result[$ibunifas->motherId]["nama"] = $ibunifas->namalengkap;
            $result[$ibunifas->motherId]["lastkf"] = 'None';
            $result[$ibunifas->motherId]["lastkn"] = 'None';
            $result[$ibunifas->motherId]["68"] = 'None';
            $result[$ibunifas->motherId]["userid"]  = $ibunifas->userID;
            $tgl_lahir = date_create(date("Y-m-d",  strtotime($ibunifas->tanggalLahirAnak)));
            $diff = date_diff($today,$tgl_lahir);
            $diff_day = $diff->days;
            $result[$ibunifas->motherId]["ga"] = $diff_day;
            
            if(array_key_exists($ibunifas->motherId, $datapnc)){
                $result[$ibunifas->motherId]["lastkf"]  = $datapnc[$ibunifas->motherId];
            }
            if(array_key_exists($ibunifas->childId, $datachild)){
                $result[$ibunifas->motherId]["lastkn"]  = $datachild[$ibunifas->childId]['kunjunganNeonatal'];
                if($datachild[$ibunifas->childId]['kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan']!='')$result[$ibunifas->motherId]["68"]  = $datachild[$ibunifas->childId]['kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan'];
            }
        }
        
        foreach ($result as $id=>$res){
            if($res['ga']==3){
                if($res['lastkf']=='None'){
                    array_push($final_result[$res['userid']]["due"]["kf1"],$res);
                }
            }
            if($res['ga']==8){
                if($res['lastkf']=='None'||$res['lastkf']<=3){
                    array_push($final_result[$res['userid']]["due"]["kf2"],$res);
                }
            }
            if($res['ga']==29){
                if($res['lastkf']=='None'||$res['lastkf']<=8){
                    array_push($final_result[$res['userid']]["due"]["kf3"],$res);
                }
            }
            if($res['ga']==42){
                if($res['lastkf']=='None'||$res['lastkf']<=29){
                    array_push($final_result[$res['userid']]["due"]["kf4"],$res);
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
                    var_dump($pesan[$kf]);
//                    $status = $this->send_message($pesan[$kf],$penerima);
//                    var_dump($status);
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
        $query  = $analyticsDB->query("SELECT * FROM kartu_anc_visit WHERE tanggalHPHT > '$batas' GROUP BY motherId");
        $query2 = $analyticsDB->query("SELECT motherId FROM kartu_pnc_dokumentasi_persalinan")->result();
        $datapnc = [];
        foreach ($query2 as $q){
            $datapnc[$q->motherId] = TRUE;
        }
        $query2 = $analyticsDB->query("SELECT motherId FROM kartu_anc_close")->result();
        $dataclose = [];
        foreach ($query2 as $q){
            $dataclose[$q->motherId] = TRUE;
        }
        foreach ($query->result() as $i=>$ibuhamil){
            if(array_key_exists($ibuhamil->motherId, $datapnc)) continue;
            if(array_key_exists($ibuhamil->motherId, $dataclose)) continue;
            $now = date_create(date("Y-m-d"));
            $hpht = null;
            if(array_key_exists($ibuhamil->kiId, $result)){
                $old_anc = strtotime($result[$ibuhamil->kiId]["anc_date"]);
                $new_anc = strtotime($ibuhamil->ancDate);
                if($new_anc > $old_anc){
                    $result[$ibuhamil->kiId]["userid"] = $ibuhamil->userID;
                    $result[$ibuhamil->kiId]["anc_date"] = $ibuhamil->ancDate;
                    $result[$ibuhamil->kiId]["anc_ke"]  = $ibuhamil->ancKe;
                    $hpht = date_create(date("Y-m-d",  strtotime($ibuhamil->tanggalHPHT)));
                    $diff = date_diff($now,$hpht);
                    $diff_week = (int)($diff->days/7)+1;
                    $result[$ibuhamil->kiId]["ga"] = $diff_week;
                }
            }else{
                $result[$ibuhamil->kiId]["userid"]  = $ibuhamil->userID;
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
                    array_push($final_result[$res['userid']]["anc1"],$id);
                }
                if($res["ga"]==14){
                    array_push($final_result[$res['userid']]["anc2"],$id);
                }
            }elseif($res["anc_ke"]=='2'){
                if($res["ga"]==28){
                    array_push($final_result[$res['userid']]["anc3"],$id);
                }
            }elseif($res["anc_ke"]=='3'){
                if($res["ga"]==36){
                    array_push($final_result[$res['userid']]["anc4"],$id);
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
    
    public function alertTTHB(){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $now = date("Y-m-d");
        $batas = date("Y-m-d", strtotime($now." -42 weeks"));
        $result = array();
        $data = array("due"=>array("tt1"=>array(),"tt2"=>array(),"hb1"=>array(),"hbf"=>array(),"hb2"=>array(),"fe1"=>array(),"fe2"=>array(),"fe3"=>array()),"overdue"=>array("tt1"=>array(),"tt2"=>array(),"hb1"=>array(),"hbf"=>array(),"hb2"=>array(),"fe1"=>array(),"fe2"=>array(),"fe3"=>array()));
        $final_result = array();
        foreach ($this->bidans as $user=>$bidan){
            $final_result[$user] = $data;
        }
        $query  = $analyticsDB->query("SELECT * FROM kartu_anc_visit WHERE tanggalHPHT > '$batas' GROUP BY motherId");
        $query2 = $analyticsDB->query("SELECT motherId FROM kartu_pnc_dokumentasi_persalinan")->result();
        $datapnc = [];
        foreach ($query2 as $q){
            $datapnc[$q->motherId] = TRUE;
        }
        $query2 = $analyticsDB->query("SELECT motherId FROM kartu_anc_close")->result();
        $dataclose = [];
        foreach ($query2 as $q){
            $dataclose[$q->motherId] = TRUE;
        }
        $query2 = $analyticsDB->query("SELECT motherId,laboratoriumPeriksaHbHasil FROM kartu_anc_visit_labTest ORDER BY referenceDate")->result();
        $datalabs = [];
        foreach ($query2 as $q){
            if(array_key_exists($q->motherId, $datalabs)){
                array_push($datalabs[$q->motherId], $q->laboratoriumPeriksaHbHasil);
            }else{
                $datalabs[$q->motherId] = [];
                array_push($datalabs[$q->motherId], $q->laboratoriumPeriksaHbHasil);
            }
            
        }
        foreach ($query->result() as $ibuhamil){
            if(array_key_exists($ibuhamil->motherId, $datapnc)) continue;
            if(array_key_exists($ibuhamil->motherId, $dataclose)) continue;
            $now = date_create(date("Y-m-d"));
            $hpht = null;
            if(array_key_exists($ibuhamil->motherId, $result)){
                $old_anc = strtotime($result[$ibuhamil->motherId]["anc_date"]);
                $new_anc = strtotime($ibuhamil->ancDate);
                if($new_anc > $old_anc){
                    $result[$ibuhamil->motherId]["userid"] = $ibuhamil->userID;
                    $result[$ibuhamil->motherId]["anc_date"] = $ibuhamil->ancDate;
                    $result[$ibuhamil->motherId]["tt_ke"]  = $ibuhamil->statusImunisasitt;
                    $result[$ibuhamil->motherId]["fe"]  = $ibuhamil->pelayananfe0;
                    $hpht = date_create(date("Y-m-d",  strtotime($ibuhamil->tanggalHPHT)));
                    $diff = date_diff($now,$hpht);
                    $diff_week = ($diff->days/7)+1;
                    $result[$ibuhamil->motherId]["ga"] = $diff_week;
                    if($diff_week<14&&$ibuhamil->pelayananfe0=="Ya") $result[$ibuhamil->motherId]["fe1"] = "ya";
                    if($diff_week>=14&&$diff_week<28&&$ibuhamil->pelayananfe0=="Ya") $result[$ibuhamil->motherId]["fe2"] = "ya";
                    if($diff_week>=28&&$diff_week<42&&$ibuhamil->pelayananfe0=="Ya") $result[$ibuhamil->motherId]["fe2"] = "ya";
                }
            }else{
                $result[$ibuhamil->motherId]["userid"]  = $ibuhamil->userID;
                $result[$ibuhamil->motherId]["anc_date"]  = $ibuhamil->ancDate;
                $result[$ibuhamil->motherId]["tt_ke"]  = $ibuhamil->statusImunisasitt;
                $result[$ibuhamil->motherId]["fe"]  = $ibuhamil->pelayananfe0;
                $result[$ibuhamil->motherId]["fe1"] = "tidak";
                $result[$ibuhamil->motherId]["fe2"] = "tidak";
                $result[$ibuhamil->motherId]["fe3"] = "tidak";
                $hpht = date_create(date("Y-m-d",  strtotime($ibuhamil->tanggalHPHT)));
                $diff = date_diff($now,$hpht);
                $diff_week = ($diff->days/7)+1;
                $result[$ibuhamil->motherId]["ga"] = $diff_week;
                if($diff_week<14&&$ibuhamil->pelayananfe0=="Ya") $result[$ibuhamil->motherId]["fe1"] = "ya";
                if($diff_week>=14&&$diff_week<28&&$ibuhamil->pelayananfe0=="Ya") $result[$ibuhamil->motherId]["fe2"] = "ya";
                if($diff_week>=28&&$diff_week<42&&$ibuhamil->pelayananfe0=="Ya") $result[$ibuhamil->motherId]["fe2"] = "ya";
            }
            $result[$ibuhamil->motherId]["hb_tes"] = 'None';
            if(array_key_exists($ibuhamil->motherId, $datalabs)){
                foreach ($datalabs[$ibuhamil->motherId] as $lab){
                    if($lab!=""&&$lab!="None") $result[$ibuhamil->motherId]["hb_tes"] = $lab;
                }
            }
        }
        foreach ($result as $id=>$res){
            if($res["tt_ke"]=='tt_ke_0'){
                if($res["ga"]<14){
                    array_push($final_result[$res['userid']]["due"]["tt1"],$id);
                }
                if($res["ga"]>=14&&$res["ga"]<42){
                    array_push($final_result[$res['userid']]["overdue"]["tt1"],$id);
                }
            }elseif($res["tt_ke"]=='tt_ke_1'){
                $anc = date_create($res['anc_date']);
                $now = date_create(date("Y-m-d"));
                $diff = date_diff($now,$anc);
                $diff_week = ($diff->days/7)+1;
                if($res["ga"]>=40){
                    array_push($final_result[$res['userid']]["overdue"]["tt2"],$id);
                }elseif($diff_week<=4){
                    array_push($final_result[$res['userid']]["due"]["tt2"],$id);
                }
            }
            if($res["hb_tes"]=='None'){
                if($res["ga"]<14){
                    array_push($final_result[$res['userid']]["due"]["hb1"],$id);
                }
                if($res["ga"]>=14&&$res["ga"]<28){
                    array_push($final_result[$res['userid']]["overdue"]["hb1"],$id);
                }
                if($res["ga"]>=28&&$res["ga"]<40){
                    array_push($final_result[$res['userid']]["due"]["hb2"],$id);
                }
                if($res["ga"]>=40&&$res["ga"]<42){
                    array_push($final_result[$res['userid']]["overdue"]["hb2"],$id);
                }
            }elseif($res["hb_tes"]<11){
                if($res["ga"]<28){
                    array_push($final_result[$res['userid']]["due"]["hbf"],$id);
                }
                if($res["ga"]>=28&&$res["ga"]<42){
                    array_push($final_result[$res['userid']]["overdue"]["hbf"],$id);
                }
            }
            if($res["fe"]=='Tidak'){
                if($res["ga"]<14&&$res['fe1']=='tidak'){
                    array_push($final_result[$res['userid']]["due"]["fe1"],$id);
                }
                if($res["ga"]>=14&&$res["ga"]<28&&$res['fe1']=='tidak'){
                    array_push($final_result[$res['userid']]["overdue"]["fe1"],$id);
                }elseif($res["ga"]>=14&&$res["ga"]<28&&$res['fe2']=='tidak'){
                    array_push($final_result[$res['userid']]["due"]["fe2"],$id);
                }
                if($res["ga"]>=28&&$res["ga"]<42&&$res['fe2']=='tidak'){
                    array_push($final_result[$res['userid']]["overdue"]["fe2"],$id);
                }elseif($res["ga"]>=28&&$res["ga"]<40&&$res['fe3']=='tidak'){
                    array_push($final_result[$res['userid']]["due"]["fe3"],$id);
                }
                if($res["ga"]>=40&&$res['fe3']=='tidak'){
                    array_push($final_result[$res['userid']]["overdue"]["fe3"],$id);
                }
            }
        }
        
        foreach ($final_result as $user=>$final){
            $penerima = [$this->bidans[$user]['tel']];
            if(!(sizeof($final['due']['tt1'])==0&&sizeof($final['due']['tt2'])==0&&sizeof($final['due']['hb1'])==0&&sizeof($final['due']['hbf'])==0&&sizeof($final['due']['hb2'])==0&&sizeof($final['due']['fe1'])==0&&sizeof($final['due']['fe2'])==0&&sizeof($final['due']['fe3'])==0)){
                $pesan = $this->TT_HB_MESSAGE_DUE;
                $pesan = str_replace('xxnama', $this->bidans[$user]['nama'], $pesan);
                $pesan = str_replace('xtt1', sizeof($final['due']['tt1']), $pesan);
                $pesan = str_replace('xtt2', sizeof($final['due']['tt2']), $pesan);
                $pesan = str_replace('xhb1', sizeof($final['due']['hb1']), $pesan);
                $pesan = str_replace('xhbf', sizeof($final['due']['hbf']), $pesan);
                $pesan = str_replace('xhb2', sizeof($final['due']['hb2']), $pesan);
                $pesan = str_replace('xfe1', sizeof($final['due']['fe1']), $pesan);
                $pesan = str_replace('xfe2', sizeof($final['due']['fe2']), $pesan);
                $pesan = str_replace('xfe3', sizeof($final['due']['fe3']), $pesan);
//                var_dump($pesan);
                $status = $this->Rapidpro->postBroadcasts($pesan,$penerima);
                print_r($status);
            }

            if(!(sizeof($final['overdue']['tt1'])==0&&sizeof($final['overdue']['tt2'])==0&&sizeof($final['overdue']['hb1'])==0&&sizeof($final['overdue']['hbf'])==0&&sizeof($final['overdue']['hb2'])==0&&sizeof($final['overdue']['fe1'])==0&&sizeof($final['overdue']['fe2'])==0&&sizeof($final['overdue']['fe3'])==0)){
                $pesan = $this->TT_HB_MESSAGE_OVERDUE;
                $pesan = str_replace('xxnama', $this->bidans[$user]['nama'], $pesan);
                $pesan = str_replace('xtt1', sizeof($final['overdue']['tt1']), $pesan);
                $pesan = str_replace('xtt2', sizeof($final['overdue']['tt2']), $pesan);
                $pesan = str_replace('xhb1', sizeof($final['overdue']['hb1']), $pesan);
                $pesan = str_replace('xhbf', sizeof($final['overdue']['hbf']), $pesan);
                $pesan = str_replace('xhb2', sizeof($final['overdue']['hb2']), $pesan);
                $pesan = str_replace('xfe1', sizeof($final['overdue']['fe1']), $pesan);
                $pesan = str_replace('xfe2', sizeof($final['overdue']['fe2']), $pesan);
                $pesan = str_replace('xfe3', sizeof($final['overdue']['fe3']), $pesan);
//                var_dump($pesan);
                $status = $this->Rapidpro->postBroadcasts($pesan,$penerima);
                print_r($status);
            }
        }
    }
    
    public function alertTTHBBumil(){
        while(ob_get_level())ob_end_clean(); // remove output buffers
        ob_implicit_flush(true);
        $analyticsDB = $this->load->database('analytics', TRUE);
        $now = date("Y-m-d");
        $batas = date("Y-m-d", strtotime($now." -42 weeks"));
        $result = array();
        $data = array("tt1"=>array(),"tt2"=>array(),"hb1"=>array(),"hbf"=>array(),"hb2"=>array(),"fe1"=>array(),"fe2"=>array(),"fe3"=>array());
        $final_result = array();
        foreach ($this->bidans as $user=>$bidan){
            $final_result[$user] = $data;
        }
        $query  = $analyticsDB->query("SELECT userID,motherId,kiId,ancDate,statusImunisasitt,pelayananfe0,tanggalHPHT FROM kartu_anc_visit WHERE tanggalHPHT > '$batas' GROUP BY motherId");
        $query2 = $analyticsDB->query("SELECT motherId,laboratoriumPeriksaHbHasil FROM kartu_anc_visit_labTest ORDER BY referenceDate")->result();
        $datalabs = [];
        foreach ($query2 as $q){
            if(array_key_exists($q->motherId, $datalabs)){
                array_push($datalabs[$q->motherId], $q->laboratoriumPeriksaHbHasil);
            }else{
                $datalabs[$q->motherId] = [];
                array_push($datalabs[$q->motherId], $q->laboratoriumPeriksaHbHasil);
            }
            
        }
        $total = $query->num_rows();
        foreach ($query->result() as $i=>$ibuhamil){
            $now = date_create(date("Y-m-d"));
            $hpht = null;
            if(array_key_exists($ibuhamil->kiId, $result)){
                $old_anc = strtotime($result[$ibuhamil->kiId]["anc_date"]);
                $new_anc = strtotime($ibuhamil->ancDate);
                if($new_anc > $old_anc){
                    $result[$ibuhamil->kiId]["userid"] = $ibuhamil->userID;
                    $result[$ibuhamil->kiId]["anc_date"] = $ibuhamil->ancDate;
                    $result[$ibuhamil->kiId]["tt_ke"]  = $ibuhamil->statusImunisasitt;
                    $result[$ibuhamil->kiId]["fe"]  = $ibuhamil->pelayananfe0;
                    $hpht = date_create(date("Y-m-d",  strtotime($ibuhamil->tanggalHPHT)));
                    $diff = date_diff($now,$hpht);
                    $diff_week = (int)($diff->days/7)+1;
                    $result[$ibuhamil->kiId]["ga"] = $diff_week;
                    if($diff_week<14&&$ibuhamil->pelayananfe0=="Ya") $result[$ibuhamil->kiId]["fe1"] = "ya";
                    if($diff_week>=14&&$diff_week<28&&$ibuhamil->pelayananfe0=="Ya") $result[$ibuhamil->motherId]["fe2"] = "ya";
                    if($diff_week>=28&&$diff_week<42&&$ibuhamil->pelayananfe0=="Ya") $result[$ibuhamil->motherId]["fe2"] = "ya";
                }
            }else{
                $result[$ibuhamil->kiId]["userid"]  = $ibuhamil->userID;
                $result[$ibuhamil->kiId]["anc_date"]  = $ibuhamil->ancDate;
                $result[$ibuhamil->kiId]["tt_ke"]  = $ibuhamil->statusImunisasitt;
                $result[$ibuhamil->kiId]["fe"]  = $ibuhamil->pelayananfe0;
                $result[$ibuhamil->kiId]["fe1"] = "tidak";
                $result[$ibuhamil->kiId]["fe2"] = "tidak";
                $result[$ibuhamil->kiId]["fe3"] = "tidak";
                $hpht = date_create(date("Y-m-d",  strtotime($ibuhamil->tanggalHPHT)));
                $diff = date_diff($now,$hpht);
                $diff_week = (int)($diff->days/7)+1;
                $result[$ibuhamil->kiId]["ga"] = $diff_week;
                if($diff_week<14&&$ibuhamil->pelayananfe0=="Ya") $result[$ibuhamil->kiId]["fe1"] = "ya";
                if($diff_week>=14&&$diff_week<28&&$ibuhamil->pelayananfe0=="Ya") $result[$ibuhamil->kiId]["fe2"] = "ya";
                if($diff_week>=28&&$diff_week<42&&$ibuhamil->pelayananfe0=="Ya") $result[$ibuhamil->kiId]["fe2"] = "ya";
            }
            $result[$ibuhamil->kiId]["hb_tes"] = 'None';
            if(array_key_exists($ibuhamil->motherId, $datalabs)){
                foreach ($datalabs[$ibuhamil->motherId] as $lab){
                    if($lab!=""&&$lab!="None") $result[$ibuhamil->kiId]["hb_tes"] = $lab;
                }
            }
            
        }
        foreach ($result as $id=>$res){
            if($res["tt_ke"]=='tt_ke_0'){
                if($res["ga"]<14){
                    array_push($final_result[$res['userid']]["tt1"],$id);
                }
            }elseif($res["tt_ke"]=='tt_ke_1'){
                $anc = date_create($res['anc_date']);
                $now = date_create(date("Y-m-d"));
                $diff = date_diff($now,$anc);
                $diff_week = (int)($diff->days/7)+1;
                if($diff_week==4){
                    array_push($final_result[$res['userid']]["tt2"],$id);
                }
            }
            if($res["hb_tes"]=='None'){
                if($res["ga"]<14){
                    array_push($final_result[$res['userid']]["hb1"],$id);
                }
                if($res["ga"]==28){
                    array_push($final_result[$res['userid']]["hb2"],$id);
                }
            }elseif($res["hb_tes"]<11){
                array_push($final_result[$res['userid']]["hbf"],$id);
            }
            if($res["fe"]=='Tidak'){
                if($res["ga"]<14&&$res['fe1']=='tidak'){
                    array_push($final_result[$res['userid']]["fe1"],$id);
                }
                if($res["ga"]==14&&$res['fe2']=='tidak'){
                    array_push($final_result[$res['userid']]["fe2"],$id);
                }
                if($res["ga"]==28&&$res['fe3']=='tidak'){
                    array_push($final_result[$res['userid']]["fe3"],$id);
                }
            }
            $i++;
        }
//        
//        foreach ($final_result as $user=>$final){
//            var_dump($final);
//        }
        
        $a = 0;
        $query = $analyticsDB->query("SELECT kiId,NomorTelponHp FROM kartu_ibu_registration")->result();
        $datatlp = [];
        foreach ($query as $q){
            $datatlp[$q->kiId] = $q->NomorTelponHp;
        }
        foreach ($final_result as $user=>$final){
            //var_dump($final);return;
            foreach ($final as $jenis=>$ibus){
                foreach ($ibus as $ibu){
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
                            $a++;
                            switch($jenis){
                                case "tt1":
//                                    var_dump($num);
//                                    var_dump($this->TT1_MESSAGE);
                                    $status = $this->Rapidpro->postBroadcasts($this->TT1_MESSAGE,array($num));
                                    print_r($status);
                                    break;
                                case "tt2":
//                                    var_dump($num);
//                                    var_dump($this->TT2_MESSAGE);
                                    $status = $this->Rapidpro->postBroadcasts($this->TT2_MESSAGE,array($num));
                                    print_r($status);
                                    break;
                                case "hb1":
//                                    var_dump($num);
//                                    var_dump($this->HB_TEST1_MESSAGE);
                                    $status = $this->Rapidpro->postBroadcasts($this->HB_TEST1_MESSAGE,array($num));
                                    print_r($status);
                                    break;
                                case "hbf":
//                                    var_dump($num);
//                                    var_dump($this->HB_FU_MESSAGE);
                                    $status = $this->Rapidpro->postBroadcasts($this->HB_FU_MESSAGE,array($num));
                                    print_r($status);
                                    break;
                                case "hb2":
//                                    var_dump($num);
//                                    var_dump($this->HB_TEST2_MESSAGE);
                                    $status = $this->Rapidpro->postBroadcasts($this->HB_TEST2_MESSAGE,array($num));
                                    print_r($status);
                                    break;
                                case "fe1":
//                                    var_dump($num);
//                                    var_dump($this->IFA1_MESSAGE);
                                    $status = $this->Rapidpro->postBroadcasts($this->IFA1_MESSAGE,array($num));
                                    print_r($status);
                                    break;
                                case "fe2":
//                                    var_dump($num);
//                                    var_dump($this->IFA2_MESSAGE);
                                    $status = $this->Rapidpro->postBroadcasts($this->IFA2_MESSAGE,array($num));
                                    print_r($status);
                                    break;
                                case "fe3":
//                                    var_dump($num);
//                                    var_dump($this->IFA3_MESSAGE);
                                    $status = $this->Rapidpro->postBroadcasts($this->IFA3_MESSAGE,array($num));
                                    print_r($status);
                                    break;
                            }
                        }
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
        $query  = $analyticsDB->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$batas' GROUP BY motherId");
        $query2 = $analyticsDB->query("SELECT motherId,hariKeKF FROM kartu_pnc_visit ORDER BY referenceDate DESC")->result();
        $datapnc = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->motherId, $datapnc)){
                $datapnc[$q->motherId] = $q->hariKeKF;
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
            $result[$ibunifas->motherId]["lastkf"] = 'None';
            $result[$ibunifas->motherId]["lastkn"] = 'None';
            $result[$ibunifas->motherId]["68"] = 'None';
            $result[$ibunifas->motherId]["userid"]  = $ibunifas->userID;
            $tgl_lahir = date_create(date("Y-m-d",  strtotime($ibunifas->tanggalLahirAnak)));
            $diff = date_diff($now,$tgl_lahir);
            $diff_day = $diff->days;
            $result[$ibunifas->motherId]["ga"] = $diff_day;
            
            if(array_key_exists($ibunifas->motherId, $datapnc)){
                $result[$ibunifas->motherId]["lastkf"]  = $datapnc[$ibunifas->motherId];
            }
            if(array_key_exists($ibunifas->childId, $datachild)){
                $result[$ibunifas->motherId]["lastkn"]  = $datachild[$ibunifas->childId]['kunjunganNeonatal'];
                if($datachild[$ibunifas->childId]['kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan']!='')$result[$ibunifas->motherId]["68"]  = $datachild[$ibunifas->childId]['kunjunganNeonatalpertama6sd48jamTanggaldanBulanKunjungan'];
            }
        }
        
        foreach ($result as $id=>$res){
            if($res['lastkf']=='None'){
                if($res['ga']<3){
                    array_push($final_result[$res['userid']]["due"]["kf1"],$id);
                }elseif($res['ga']>=3){
                    array_push($final_result[$res['userid']]["overdue"]["kf1"],$id);
                }
            }
            if($res['lastkf']=='kf1'){
                if($res['ga']>=3&&$res['ga']<8){
                    array_push($final_result[$res['userid']]["due"]["kf2"],$id);
                }elseif($res['ga']>=8){
                    array_push($final_result[$res['userid']]["overdue"]["kf2"],$id);
                }
            }
            if($res['lastkf']=='kf2'){
                if($res['ga']>=8&&$res['ga']<29){
                    array_push($final_result[$res['userid']]["due"]["kf3"],$id);
                }elseif($res['ga']>=29){
                    array_push($final_result[$res['userid']]["overdue"]["kf3"],$id);
                }
            }
            if($res['lastkf']=='kf3'){
                if($res['ga']>=29&&$res['ga']<50){
                    array_push($final_result[$res['userid']]["due"]["kf4"],$id);
                }elseif($res['ga']>=50){
                    array_push($final_result[$res['userid']]["overdue"]["kf4"],$id);
                }
            }
            
            if($res['lastkn']=='None'){
                if($res['ga']<3){
                    array_push($final_result[$res['userid']]["due"]["kn1"],$id);
                }elseif($res['ga']>=3&&$res['68']=='None'){
                    array_push($final_result[$res['userid']]["overdue"]["kn1"],$id);
                }
            }
            if($res['lastkn']=='5_jam_pertama'){
                if($res['ga']>=3&&$res['ga']<8){
                    array_push($final_result[$res['userid']]["due"]["kn2"],$id);
                }elseif($res['ga']>=8){
                    array_push($final_result[$res['userid']]["overdue"]["kn2"],$id);
                }
            }
            
            if($res['lastkn']=='Kedua'){
                if($res['ga']>=8&&$res['ga']<29){
                    array_push($final_result[$res['userid']]["due"]["kn3"],$id);
                }elseif($res['ga']>=29){
                    array_push($final_result[$res['userid']]["overdue"]["kn3"],$id);
                }
            }
            
        }
        
        foreach ($final_result as $user=>$final){
            $penerima = [$this->bidans[$user]['tel']];
            if(!(sizeof($final['due']['kf1'])==0&&sizeof($final['due']['kf2'])==0&&sizeof($final['due']['kf3'])==0&&sizeof($final['due']['kf4'])==0&&sizeof($final['due']['kn1'])==0&&sizeof($final['due']['kn2'])==0&&sizeof($final['due']['kn3'])==0)){
                $pesan = $this->PNC_KN_MESSAGE_DUE;
                $pesan = str_replace('xxnama', $this->bidans[$user]['nama'], $pesan);
                $pesan = str_replace('xkf1', sizeof($final['due']['kf1']), $pesan);
                $pesan = str_replace('xkf2', sizeof($final['due']['kf2']), $pesan);
                $pesan = str_replace('xkf3', sizeof($final['due']['kf3']), $pesan);
                $pesan = str_replace('xkf4', sizeof($final['due']['kf4']), $pesan);
                $pesan = str_replace('xkn1', sizeof($final['due']['kn1']), $pesan);
                $pesan = str_replace('xkn2', sizeof($final['due']['kn2']), $pesan);
                $pesan = str_replace('xkn3', sizeof($final['due']['kn3']), $pesan);
//                var_dump($pesan);
                $status = $this->Rapidpro->postBroadcasts($pesan,$penerima);
                print_r($status);
            }

            if(!(sizeof($final['overdue']['kf1'])==0&&sizeof($final['overdue']['kf2'])==0&&sizeof($final['overdue']['kf3'])==0&&sizeof($final['overdue']['kf4'])==0&&sizeof($final['overdue']['kn1'])==0&&sizeof($final['overdue']['kn2'])==0&&sizeof($final['overdue']['kn3'])==0)){
                $pesan = $this->PNC_KN_MESSAGE_OVERDUE;
                $pesan = str_replace('xxnama', $this->bidans[$user]['nama'], $pesan);
                $pesan = str_replace('xkf1', sizeof($final['overdue']['kf1']), $pesan);
                $pesan = str_replace('xkf2', sizeof($final['overdue']['kf2']), $pesan);
                $pesan = str_replace('xkf3', sizeof($final['overdue']['kf3']), $pesan);
                $pesan = str_replace('xkf4', sizeof($final['overdue']['kf4']), $pesan);
                $pesan = str_replace('xkn1', sizeof($final['overdue']['kn1']), $pesan);
                $pesan = str_replace('xkn2', sizeof($final['overdue']['kn2']), $pesan);
                $pesan = str_replace('xkn3', sizeof($final['overdue']['kn3']), $pesan);
//                var_dump($pesan);
                $status = $this->Rapidpro->postBroadcasts($pesan,$penerima);
                print_r($status);
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
        $query  = $analyticsDB->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak > '$batas' GROUP BY motherId");
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
        $query2 = $analyticsDB->query("SELECT motherId,kiId FROM kartu_anc_visit GROUP BY motherId")->result();
        $dataid = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->motherId, $dataid)){
                $dataid[$q->motherId]= $q->kiId;
            }
            
        }
        foreach ($query->result() as $ibunifas){
            if(array_key_exists($ibunifas->motherId, $dataid)){
                $id = $dataid[$ibunifas->motherId];
            }else{
                continue;
            }
            $now = date_create(date("Y-m-d"));
            $result[$id]["lastkf"] = 'None';
            $result[$id]["lastkn"] = 'None';
            $result[$id]["68"] = 'None';
            $result[$id]["userid"]  = $ibunifas->userID;
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
                    array_push($final_result[$res['userid']]["kf1"],$id);
                }
            }
            if($res['lastkf']=='kf1'){
                if($res['ga']==3){
                    array_push($final_result[$res['userid']]["kf2"],$id);
                }
            }
            if($res['lastkf']=='kf2'){
                if($res['ga']==8){
                    array_push($final_result[$res['userid']]["kf3"],$id);
                }
            }
            if($res['lastkf']=='kf3'){
                if($res['ga']==29){
                    array_push($final_result[$res['userid']]["kf4"],$id);
                }
            }
            
            if($res['lastkn']=='None'){
                if($res['ga']<3){
                    array_push($final_result[$res['userid']]["kn1"],$id);
                }
            }
            if($res['lastkn']=='5_jam_pertama'){
                if($res['ga']==3){
                    array_push($final_result[$res['userid']]["kn2"],$id);
                }
            }
            
            if($res['lastkn']=='Kedua'){
                if($res['ga']==8){
                    array_push($final_result[$res['userid']]["kn3"],$id);
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
    
    public function alertImunisasi(){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $now = date("Y-m-d");
        $batas = date("Y-m-d", strtotime($now." -1 year"));
        $result = array();
        $data = array("due"=>array("hb0"=>array(),"bp1"=>array(),"dp2"=>array(),"dp3"=>array(),"dp4"=>array(),"cam"=>array()),"overdue"=>array("hb0"=>array(),"bp1"=>array(),"dp2"=>array(),"dp3"=>array(),"dp4"=>array(),"cam"=>array()));
        $final_result = array();
        foreach ($this->bidans as $user=>$bidan){
            $final_result[$user] = $data;
        }
        
        $query  = $analyticsDB->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak >= '$batas' GROUP BY childId");
        $query2 = $analyticsDB->query("SELECT * FROM kohort_bayi_immunization ORDER BY clientVersionSubmissionDate DESC")->result();
        $dataimunisasi = [];
        foreach ($query2 as $q){
            $dataimunisasi[$q->childId]["tanggalpemberianimunisasiHb07"] = $q->tanggalpemberianimunisasiHb07;
            $dataimunisasi[$q->childId]["tanggalpemberianimunisasiBCGdanPolio1"] = $q->tanggalpemberianimunisasiBCGdanPolio1;
            $dataimunisasi[$q->childId]["tanggalpemberianimunisasiDPTHB1Polio2"] = $q->tanggalpemberianimunisasiDPTHB1Polio2;
            $dataimunisasi[$q->childId]["tanggalpemberianimunisasiDPTHB2Polio3"] = $q->tanggalpemberianimunisasiDPTHB2Polio3;
            $dataimunisasi[$q->childId]["tanggalpemberianimunisasiDPTHB3Polio4"] = $q->tanggalpemberianimunisasiDPTHB3Polio4;
            $dataimunisasi[$q->childId]["tanggalpemberianimunisasiCampak"] = $q->tanggalpemberianimunisasiCampak;
        }
        foreach ($query->result() as $anak){
            $now = date_create(date("Y-m-d"));
            $tgl_lahir = date_create(date("Y-m-d",  strtotime($anak->tanggalLahirAnak)));
            $diff = date_diff($now,$tgl_lahir);
            $result[$anak->childId]["userid"]  = $anak->userID;
            $result[$anak->childId]["umur"]  = $diff->m;
            $result[$anak->childId]["umurdays"]  = $diff->days;
            $result[$anak->childId]["imunisasi"]  = array(false,false,false,false,false,false);
            $result[$anak->childId]["tgl_imunisasi"]  = array('','','','','','');
            $result[$anak->childId]["jarak_imunisasi"]  = array('','','','','','');
            if(array_key_exists($anak->childId, $dataimunisasi)){
                if($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiHb07']!='None'&&$dataimunisasi[$anak->childId]['tanggalpemberianimunisasiHb07']!=''){
                    $result[$anak->childId]["imunisasi"][0] = TRUE;
                    $result[$anak->childId]["tgl_imunisasi"][0] = $dataimunisasi[$anak->childId]['tanggalpemberianimunisasiHb07'];
                    $tgl_kunj = date_create(date("Y-m-d",  strtotime($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiHb07'])));
                    $diff = date_diff($now,$tgl_kunj);
                    $result[$anak->childId]["jarak_imunisasi"][0]  = (int)(($diff->days/7)+1);
                }
                if($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiBCGdanPolio1']!='None'&&$dataimunisasi[$anak->childId]['tanggalpemberianimunisasiBCGdanPolio1']!=''){
                    $result[$anak->childId]["imunisasi"][1] = TRUE;
                    $result[$anak->childId]["tgl_imunisasi"][1] = $dataimunisasi[$anak->childId]['tanggalpemberianimunisasiBCGdanPolio1'];
                    $tgl_kunj = date_create(date("Y-m-d",  strtotime($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiBCGdanPolio1'])));
                    $diff = date_diff($now,$tgl_kunj);
                    $result[$anak->childId]["jarak_imunisasi"][1]  = (int)(($diff->days/7)+1);
                }
                if($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB1Polio2']!='None'&&$dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB1Polio2']!=''){
                    $result[$anak->childId]["imunisasi"][2] = TRUE;
                    $result[$anak->childId]["tgl_imunisasi"][2] = $dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB1Polio2'];
                    $tgl_kunj = date_create(date("Y-m-d",  strtotime($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB1Polio2'])));
                    $diff = date_diff($now,$tgl_kunj);
                    $result[$anak->childId]["jarak_imunisasi"][2]  = (int)(($diff->days/7)+1);
                }
                if($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB2Polio3']!='None'&&$dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB2Polio3']!=''){
                    $result[$anak->childId]["imunisasi"][3] = TRUE;
                    $result[$anak->childId]["tgl_imunisasi"][3] = $dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB2Polio3'];
                    $tgl_kunj = date_create(date("Y-m-d",  strtotime($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB2Polio3'])));
                    $diff = date_diff($now,$tgl_kunj);
                    $result[$anak->childId]["jarak_imunisasi"][3]  = (int)(($diff->days/7)+1);
                }
                if($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB3Polio4']!='None'&&$dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB3Polio4']!=''){
                    $result[$anak->childId]["imunisasi"][4] = TRUE;
                    $result[$anak->childId]["tgl_imunisasi"][4] = $dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB3Polio4'];
                    $tgl_kunj = date_create(date("Y-m-d",  strtotime($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB3Polio4'])));
                    $diff = date_diff($now,$tgl_kunj);
                    $result[$anak->childId]["jarak_imunisasi"][4]  = (int)(($diff->days/7)+1);
                }
                if($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiCampak']!='None'&&$dataimunisasi[$anak->childId]['tanggalpemberianimunisasiCampak']!=''){
                    $result[$anak->childId]["imunisasi"][5] = TRUE;
                    $result[$anak->childId]["tgl_imunisasi"][5] = $dataimunisasi[$anak->childId]['tanggalpemberianimunisasiCampak'];
                    $tgl_kunj = date_create(date("Y-m-d",  strtotime($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiCampak'])));
                    $diff = date_diff($now,$tgl_kunj);
                    $result[$anak->childId]["jarak_imunisasi"][5]  = (int)(($diff->days/7)+1);
                }
            }
        }
        
        foreach ($result as $id=>$res){
            if(!$res['imunisasi'][0]){
                if($res['umur']==0&&$res['umurdays']<5){
                    array_push($final_result[$res['userid']]["due"]["hb0"],$id);
                }elseif($res['umur']==0&&$res['umurdays']>5){
                    array_push($final_result[$res['userid']]["overdue"]["hb0"],$id);
                }
            }
            if(!$res['imunisasi'][1]){
                if($res['umur']==1){
                    array_push($final_result[$res['userid']]["due"]["bp1"],$id);
                }elseif($res['umur']==2){
                    array_push($final_result[$res['userid']]["overdue"]["bp1"],$id);
                }
            }
            if(!$res['imunisasi'][2]){
                if($res['umur']==2&&$res['jarak_imunisasi'][1]>=4&&$res['jarak_imunisasi'][1]<8){
                    array_push($final_result[$res['userid']]["due"]["dp2"],$id);
                }elseif($res['umur']==2&&$res['jarak_imunisasi'][1]>=8){
                    array_push($final_result[$res['userid']]["overdue"]["dp2"],$id);
                }
            }
            if(!$res['imunisasi'][3]){
                if($res['umur']==3&&$res['jarak_imunisasi'][2]>=4&&$res['jarak_imunisasi'][2]<8){
                    array_push($final_result[$res['userid']]["due"]["dp3"],$id);
                }elseif($res['umur']==4&&$res['jarak_imunisasi'][2]>=8){
                    array_push($final_result[$res['userid']]["overdue"]["dp3"],$id);
                }
            }
            if(!$res['imunisasi'][4]){
                if($res['umur']==4&&$res['jarak_imunisasi'][3]>=4&&$res['jarak_imunisasi'][3]<8){
                    array_push($final_result[$res['userid']]["due"]["dp4"],$id);
                }elseif($res['umur']==5&&$res['jarak_imunisasi'][3]>=8){
                    array_push($final_result[$res['userid']]["overdue"]["dp4"],$id);
                }
            }if(!$res['imunisasi'][5]){
                if($res['umur']==9){
                    array_push($final_result[$res['userid']]["due"]["cam"],$id);
                }elseif($res['umur']>=10&&$res['umur']<12){
                    array_push($final_result[$res['userid']]["overdue"]["cam"],$id);
                }
            }
        }
        
        foreach ($final_result as $user=>$final){
            $penerima = [$this->bidans[$user]['tel']];
            if(!(sizeof($final['due']['hb0'])==0&&sizeof($final['due']['bp1'])==0&&sizeof($final['due']['dp2'])==0&&sizeof($final['due']['dp3'])==0&&sizeof($final['due']['dp4'])==0&&sizeof($final['due']['cam'])==0)){
                $pesan = $this->CHILD_IMMU_MESSAGE_DUE;
                $pesan = str_replace('xxnama', $this->bidans[$user]['nama'], $pesan);
                $pesan = str_replace('xhb0', sizeof($final['due']['hb0']), $pesan);
                $pesan = str_replace('xbp1', sizeof($final['due']['bp1']), $pesan);
                $pesan = str_replace('xdp2', sizeof($final['due']['dp2']), $pesan);
                $pesan = str_replace('xdp3', sizeof($final['due']['dp3']), $pesan);
                $pesan = str_replace('xdp4', sizeof($final['due']['dp4']), $pesan);
                $pesan = str_replace('xcam', sizeof($final['due']['cam']), $pesan);
//                var_dump($pesan);
                $status = $this->Rapidpro->postBroadcasts($pesan,$penerima);
                print_r($status);
            }

            if(!(sizeof($final['overdue']['hb0'])==0&&sizeof($final['overdue']['bp1'])==0&&sizeof($final['overdue']['dp2'])==0&&sizeof($final['overdue']['dp3'])==0&&sizeof($final['overdue']['dp4'])==0&&sizeof($final['overdue']['cam'])==0)){
                $pesan = $this->CHILD_IMMU_MESSAGE_OVERDUE;
                $pesan = str_replace('xxnama', $this->bidans[$user]['nama'], $pesan);
                $pesan = str_replace('xhb0', sizeof($final['overdue']['hb0']), $pesan);
                $pesan = str_replace('xbp1', sizeof($final['overdue']['bp1']), $pesan);
                $pesan = str_replace('xdp2', sizeof($final['overdue']['dp2']), $pesan);
                $pesan = str_replace('xdp3', sizeof($final['overdue']['dp3']), $pesan);
                $pesan = str_replace('xdp4', sizeof($final['overdue']['dp4']), $pesan);
                $pesan = str_replace('xcam', sizeof($final['overdue']['cam']), $pesan);
//                var_dump($pesan);
                $status = $this->Rapidpro->postBroadcasts($pesan,$penerima);
                print_r($status);
            }
        }
    }
    
    public function alertImunisasiAnak(){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $now = date("Y-m-d");
        $batas = date("Y-m-d", strtotime($now." -1 year"));
        $result = array();
        $data = array("hb0"=>array(),"bp1"=>array(),"dp2"=>array(),"dp3"=>array(),"dp4"=>array(),"cam"=>array());
        $final_result = array();
        foreach ($this->bidans as $user=>$bidan){
            $final_result[$user] = $data;
        }
        
        $query  = $analyticsDB->query("SELECT * FROM kartu_pnc_dokumentasi_persalinan WHERE tanggalLahirAnak >= '$batas' GROUP BY childId");
        $query2 = $analyticsDB->query("SELECT * FROM kohort_bayi_immunization ORDER BY clientVersionSubmissionDate DESC")->result();
        $dataimunisasi = [];
        foreach ($query2 as $q){
            $dataimunisasi[$q->childId]["tanggalpemberianimunisasiHb07"] = $q->tanggalpemberianimunisasiHb07;
            $dataimunisasi[$q->childId]["tanggalpemberianimunisasiBCGdanPolio1"] = $q->tanggalpemberianimunisasiBCGdanPolio1;
            $dataimunisasi[$q->childId]["tanggalpemberianimunisasiDPTHB1Polio2"] = $q->tanggalpemberianimunisasiDPTHB1Polio2;
            $dataimunisasi[$q->childId]["tanggalpemberianimunisasiDPTHB2Polio3"] = $q->tanggalpemberianimunisasiDPTHB2Polio3;
            $dataimunisasi[$q->childId]["tanggalpemberianimunisasiDPTHB3Polio4"] = $q->tanggalpemberianimunisasiDPTHB3Polio4;
            $dataimunisasi[$q->childId]["tanggalpemberianimunisasiCampak"] = $q->tanggalpemberianimunisasiCampak;
        }
        $query2 = $analyticsDB->query("SELECT motherId,kiId FROM kartu_anc_visit GROUP BY motherId")->result();
        $dataid = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->motherId, $dataid)){
                $dataid[$q->motherId]= $q->kiId;
            }
            
        }
        foreach ($query->result() as $anak){
            if(array_key_exists($anak->motherId, $dataid)){
                $id = $dataid[$anak->motherId];
            }else{
                continue;
            }
            $now = date_create(date("Y-m-d"));
            $tgl_lahir = date_create(date("Y-m-d",  strtotime($anak->tanggalLahirAnak)));
            $diff = date_diff($now,$tgl_lahir);
            $result[$id]["userid"]  = $anak->userID;
            $result[$id]["umur"]  = $diff->m;
            $result[$id]["umurdays"]  = $diff->days;
            $result[$id]["imunisasi"]  = array(false,false,false,false,false,false);
            $result[$id]["tgl_imunisasi"]  = array('','','','','','');
            $result[$id]["jarak_imunisasi"]  = array('','','','','','');
            if(array_key_exists($anak->childId, $dataimunisasi)){
                if($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiHb07']!='None'&&$dataimunisasi[$anak->childId]['tanggalpemberianimunisasiHb07']!=''){
                    $result[$id]["imunisasi"][0] = TRUE;
                    $result[$id]["tgl_imunisasi"][0] = $dataimunisasi[$anak->childId]['tanggalpemberianimunisasiHb07'];
                    $tgl_kunj = date_create(date("Y-m-d",  strtotime($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiHb07'])));
                    $diff = date_diff($now,$tgl_kunj);
                    $result[$id]["jarak_imunisasi"][0]  = (int)(($diff->days/7)+1);
                }
                if($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiBCGdanPolio1']!='None'&&$dataimunisasi[$anak->childId]['tanggalpemberianimunisasiBCGdanPolio1']!=''){
                    $result[$id]["imunisasi"][1] = TRUE;
                    $result[$id]["tgl_imunisasi"][1] = $dataimunisasi[$anak->childId]['tanggalpemberianimunisasiBCGdanPolio1'];
                    $tgl_kunj = date_create(date("Y-m-d",  strtotime($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiBCGdanPolio1'])));
                    $diff = date_diff($now,$tgl_kunj);
                    $result[$id]["jarak_imunisasi"][1]  = (int)(($diff->days/7)+1);
                }
                if($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB1Polio2']!='None'&&$dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB1Polio2']!=''){
                    $result[$id]["imunisasi"][2] = TRUE;
                    $result[$id]["tgl_imunisasi"][2] = $dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB1Polio2'];
                    $tgl_kunj = date_create(date("Y-m-d",  strtotime($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB1Polio2'])));
                    $diff = date_diff($now,$tgl_kunj);
                    $result[$id]["jarak_imunisasi"][2]  = (int)(($diff->days/7)+1);
                }
                if($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB2Polio3']!='None'&&$dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB2Polio3']!=''){
                    $result[$id]["imunisasi"][3] = TRUE;
                    $result[$id]["tgl_imunisasi"][3] = $dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB2Polio3'];
                    $tgl_kunj = date_create(date("Y-m-d",  strtotime($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB2Polio3'])));
                    $diff = date_diff($now,$tgl_kunj);
                    $result[$id]["jarak_imunisasi"][3]  = (int)(($diff->days/7)+1);
                }
                if($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB3Polio4']!='None'&&$dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB3Polio4']!=''){
                    $result[$id]["imunisasi"][4] = TRUE;
                    $result[$id]["tgl_imunisasi"][4] = $dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB3Polio4'];
                    $tgl_kunj = date_create(date("Y-m-d",  strtotime($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiDPTHB3Polio4'])));
                    $diff = date_diff($now,$tgl_kunj);
                    $result[$id]["jarak_imunisasi"][4]  = (int)(($diff->days/7)+1);
                }
                if($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiCampak']!='None'&&$dataimunisasi[$anak->childId]['tanggalpemberianimunisasiCampak']!=''){
                    $result[$id]["imunisasi"][5] = TRUE;
                    $result[$id]["tgl_imunisasi"][5] = $dataimunisasi[$anak->childId]['tanggalpemberianimunisasiCampak'];
                    $tgl_kunj = date_create(date("Y-m-d",  strtotime($dataimunisasi[$anak->childId]['tanggalpemberianimunisasiCampak'])));
                    $diff = date_diff($now,$tgl_kunj);
                    $result[$id]["jarak_imunisasi"][5]  = (int)(($diff->days/7)+1);
                }
            }
        }
        
        foreach ($result as $id=>$res){
            if(!$res['imunisasi'][0]){
                if($res['umur']==0&&$res['umurdays']<5){
                    array_push($final_result[$res['userid']]["hb0"],$id);
                }
            }
            if(!$res['imunisasi'][1]){
                if($res['umur']==1){
                    array_push($final_result[$res['userid']]["bp1"],$id);
                }
            }
            if(!$res['imunisasi'][2]){
                if($res['umur']==2&&$res['jarak_imunisasi'][1]==4){
                    array_push($final_result[$res['userid']]["dp2"],$id);
                }
            }
            if(!$res['imunisasi'][3]){
                if($res['umur']==3&&$res['jarak_imunisasi'][2]==4){
                    array_push($final_result[$res['userid']]["dp3"],$id);
                }
            }
            if(!$res['imunisasi'][4]){
                if($res['umur']==4&&$res['jarak_imunisasi'][3]==4){
                    array_push($final_result[$res['userid']]["dp4"],$id);
                }
            }if(!$res['imunisasi'][5]){
                if($res['umur']==9){
                    array_push($final_result[$res['userid']]["cam"],$id);
                }
            }
        }
//        
//        foreach ($final_result as $user=>$final){
//            var_dump($final);
//        }
        $query = $analyticsDB->query("SELECT kiId,NomorTelponHp FROM kartu_ibu_registration")->result();
        $datatlp = [];
        foreach ($query as $q){
            $datatlp[$q->kiId] = $q->NomorTelponHp;
        }
        foreach ($final_result as $user=>$final){
            foreach ($final['hb0'] as $ibu){
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
//                        var_dump($this->HB0_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->HB0_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
            foreach ($final['bp1'] as $ibu){
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
//                        var_dump($this->BCG_POLIO1_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->BCG_POLIO1_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
            foreach ($final['dp2'] as $ibu){
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
//                        var_dump($this->HB1_POLIO2_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->HB1_POLIO2_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
            foreach ($final['dp3'] as $ibu){
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
//                        var_dump($this->HB3_POLIO4_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->HB3_POLIO4_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
            foreach ($final['dp4'] as $ibu){
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
//                        var_dump($this->HB3_POLIO4_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->HB3_POLIO4_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
            foreach ($final['cam'] as $ibu){
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
//                        var_dump($this->CAMPAK_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->CAMPAK_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
        }
    }
    
    public function alertKb(){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $now = date("Y-m-d");
        $batas = date("Y-m-d", strtotime($now." -6 years"));
        $result = array();
        $data = array("due"=>array("kb3"=>array(),"kb1"=>array(),"iud"=>array(),"implan"=>array()),"overdue"=>array("kb3"=>array(),"kb1"=>array(),"iud"=>array(),"implan"=>array()));
        $final_result = array();
        foreach ($this->bidans as $user=>$bidan){
            $final_result[$user] = $data;
        }
        
        $query  = $analyticsDB->query("SELECT * FROM kohort_kb_pelayanan WHERE tanggalkunjungan > '$batas' GROUP BY kiId");
        $query2 = $analyticsDB->query("SELECT * FROM kohort_kb_update ORDER BY tanggalkunjungan DESC")->result();
        $datakb = [];
        foreach ($query2 as $q){
            if(array_key_exists($q->kiId, $datakb)){
                array_push($datakb[$q->kiId], $q);
            }else{
                $datakb[$q->kiId] = [];
                array_push($datakb[$q->kiId], $q);
            }
        }
        $query2 = $analyticsDB->query("SELECT kiId,tanggalHPHT FROM kartu_anc_registration GROUP BY motherId ORDER BY tanggalHPHT DESC")->result();
        $dataanc = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->kiId, $dataanc)){
                $dataanc[$q->kiId] = $q->tanggalHPHT;
            }
        }
        $query2 = $analyticsDB->query("SELECT kiId,submissionDate FROM kohort_kb_close ORDER BY submissionDate DESC")->result();
        $datadrop = [];
        foreach ($query2 as $q){
            if(!array_key_exists($q->kiId, $datadrop)){
                $datadrop[$q->kiId] = $q->submissionDate;
            }
        }
        foreach ($query->result() as $ibukb){
            $now = date_create(date("Y-m-d"));
            if($ibukb->tanggalkunjungan==''||$ibukb->tanggalkunjungan=='None') continue;
            if(array_key_exists($ibukb->kiId, $dataanc)){
                $tglanc = date("Y-m-d",  strtotime($dataanc[$ibukb->kiId]));
                $tgl_kunj = date("Y-m-d",  strtotime($ibukb->tanggalkunjungan));
                if($tglanc>$tgl_kunj) continue; 
            }
            if(array_key_exists($ibukb->kiId, $datadrop)){
                $tgldrop = date("Y-m-d",  strtotime($datadrop[$ibukb->kiId]));
                $tgl_kunj = date("Y-m-d",  strtotime($ibukb->tanggalkunjungan));
                if($tgldrop>$tgl_kunj) continue;
            }
            $today = date("Y-m-d");
            $batas = date("Y-m-d",  strtotime($ibukb->tanggalkunjungan. "+2 months"));
            if($today>$batas&&$ibukb->jenisKontrasepsi=="suntik") continue;
            $batas = date("Y-m-d",  strtotime($ibukb->tanggalkunjungan. "+5 months"));
            if($today>$batas&&$ibukb->jenisKontrasepsi=="suntik_depoprovera") continue;
            
            $result[$ibukb->kiId]["tgl_kunj"] = $ibukb->tanggalkunjungan;
            $result[$ibukb->kiId]["kb"] = strtolower($ibukb->jenisKontrasepsi);
            $result[$ibukb->kiId]["userid"]  = $ibukb->userID;
            $tgl_kunjungan = date_create(date("Y-m-d",  strtotime($ibukb->tanggalkunjungan)));
            $diff = date_diff($now,$tgl_kunjungan);
            $result[$ibukb->kiId]["diff_week"] = (int)($diff->days/7)+1;
            $result[$ibukb->kiId]["diff_year"] = $diff->y;
            if(array_key_exists($ibukb->kiId, $datakb)){
                foreach ($datakb[$ibukb->kiId] as $upd){
                    $result[$ibukb->kiId]["tgl_kunj"] = $upd->tanggalkunjungan;
                    $result[$ibukb->kiId]["kb"] = strtolower($upd->jenisKontrasepsi);
                    $tgl_kunjungan = date_create(date("Y-m-d",  strtotime($upd->tanggalkunjungan)));
                    $diff = date_diff($now,$tgl_kunjungan);
                    $result[$ibukb->kiId]["diff_week"] = (int)($diff->days/7)+1;
                    $result[$ibukb->kiId]["diff_year"] = $diff->y;
                }
            }
        }
        
        foreach ($result as $id=>$res){
            if($res['kb']=='suntik_depoprovera'){
                if($res['diff_week']==11){
                    array_push($final_result[$res['userid']]["due"]["kb3"],$id);
                }elseif($res['diff_week']>=12){
                    array_push($final_result[$res['userid']]["overdue"]["kb3"],$id);
                }
            }
            if($res['kb']=='suntik'){
                if($res['diff_week']==3){
                    array_push($final_result[$res['userid']]["due"]["kb1"],$id);
                }elseif($res['diff_week']>=4){
                    array_push($final_result[$res['userid']]["overdue"]["kb1"],$id);
                }
            }
            if($res['kb']=='iud'){
                if($res['diff_year']==10){
                    array_push($final_result[$res['userid']]["due"]["iud"],$id);
                }elseif($res['diff_year']>=11){
                    array_push($final_result[$res['userid']]["overdue"]["iud"],$id);
                }
            }
            if($res['kb']=='implant'){
                if($res['diff_year']==5){
                    array_push($final_result[$res['userid']]["due"]["implan"],$id);
                }elseif($res['diff_year']>=6){
                    array_push($final_result[$res['userid']]["overdue"]["implan"],$id);
                }
            }
        }
        
        foreach ($final_result as $user=>$final){
            $penerima = [$this->bidans[$user]['tel']];
            if(!(sizeof($final['due']['kb3'])==0&&sizeof($final['due']['kb1'])==0&&sizeof($final['due']['iud'])==0&&sizeof($final['due']['implan'])==0)){
                $pesan = $this->FP_MESSAGE_DUE;
                $pesan = str_replace('xxnama', $this->bidans[$user]['nama'], $pesan);
                $pesan = str_replace('xsk3', sizeof($final['due']['kb3']), $pesan);
                $pesan = str_replace('xsk1', sizeof($final['due']['kb1']), $pesan);
                $pesan = str_replace('xiud', sizeof($final['due']['iud']), $pesan);
                $pesan = str_replace('ximp', sizeof($final['due']['implan']), $pesan);
//                var_dump($pesan);
                $status = $this->Rapidpro->postBroadcasts($pesan,$penerima);
                print_r($status);
            }

            if(!(sizeof($final['overdue']['kb3'])==0&&sizeof($final['overdue']['kb1'])==0&&sizeof($final['overdue']['iud'])==0&&sizeof($final['overdue']['implan'])==0)){
                $pesan = $this->FP_MESSAGE_OVERDUE;
                $pesan = str_replace('xxnama', $this->bidans[$user]['nama'], $pesan);
                $pesan = str_replace('xsk3', sizeof($final['overdue']['kb3']), $pesan);
                $pesan = str_replace('xsk1', sizeof($final['overdue']['kb1']), $pesan);
                $pesan = str_replace('xiud', sizeof($final['overdue']['iud']), $pesan);
                $pesan = str_replace('ximp', sizeof($final['overdue']['implan']), $pesan);
//                var_dump($pesan);
                $status = $this->Rapidpro->postBroadcasts($pesan,$penerima);
                print_r($status);
            }
        }
    }
    
    public function alertKbIbu(){
        $analyticsDB = $this->load->database('analytics', TRUE);
        $now = date("Y-m-d");
        $batas = date("Y-m-d", strtotime($now." -6 years"));
        $result = array();
        $data = array("kb3"=>array(),"kb1"=>array(),"iud"=>array(),"implan"=>array());
        $final_result = array();
        foreach ($this->bidans as $user=>$bidan){
            $final_result[$user] = $data;
        }
        
        $query  = $analyticsDB->query("SELECT * FROM kohort_kb_pelayanan WHERE tanggalkunjungan > '$batas' GROUP BY kiId");
        $query2 = $analyticsDB->query("SELECT * FROM kohort_kb_update ORDER BY tanggalkunjungan DESC")->result();
        $datakb = [];
        foreach ($query2 as $q){
            if(array_key_exists($q->kiId, $datakb)){
                array_push($datakb[$q->kiId], $q);
            }else{
                $datakb[$q->kiId] = [];
                array_push($datakb[$q->kiId], $q);
            }
        }
        foreach ($query->result() as $ibukb){
            $now = date_create(date("Y-m-d"));
            if($ibukb->tanggalkunjungan==''||$ibukb->tanggalkunjungan=='None') continue;;
            $result[$ibukb->kiId]["tgl_kunj"] = $ibukb->tanggalkunjungan;
            $result[$ibukb->kiId]["kb"] = strtolower($ibukb->jenisKontrasepsi);
            $result[$ibukb->kiId]["userid"]  = $ibukb->userID;
            $tgl_kunjungan = date_create(date("Y-m-d",  strtotime($ibukb->tanggalkunjungan)));
            $diff = date_diff($now,$tgl_kunjungan);
            $result[$ibukb->kiId]["diff_week"] = (int)($diff->days/7)+1;
            $result[$ibukb->kiId]["diff_year"] = $diff->y;
            if(array_key_exists($ibukb->kiId, $datakb)){
                foreach ($datakb[$ibukb->kiId] as $upd){
                    $result[$ibukb->kiId]["tgl_kunj"] = $upd->tanggalkunjungan;
                    $result[$ibukb->kiId]["kb"] = strtolower($upd->jenisKontrasepsi);
                    $tgl_kunjungan = date_create(date("Y-m-d",  strtotime($upd->tanggalkunjungan)));
                    $diff = date_diff($now,$tgl_kunjungan);
                    $result[$ibukb->kiId]["diff_week"] = (int)($diff->days/7)+1;
                    $result[$ibukb->kiId]["diff_year"] = $diff->y;
                }
            }
        }
        
        foreach ($result as $id=>$res){
            if($res['kb']=='suntik_depoprovera'){
                if($res['diff_week']==11){
                    array_push($final_result[$res['userid']]["kb3"],$id);
                }
            }
            if($res['kb']=='suntik'){
                if($res['diff_week']==3){
                    array_push($final_result[$res['userid']]["kb1"],$id);
                }
            }
            if($res['kb']=='iud'){
                if($res['diff_year']==10){
                    array_push($final_result[$res['userid']]["iud"],$id);
                }
            }
            if($res['kb']=='implant'){
                if($res['diff_year']==5){
                    array_push($final_result[$res['userid']]["implan"],$id);
                }
            }
        }
        
        $query = $analyticsDB->query("SELECT kiId,NomorTelponHp FROM kartu_ibu_registration")->result();
        $datatlp = [];
        foreach ($query as $q){
            $datatlp[$q->kiId] = $q->NomorTelponHp;
        }
        foreach ($final_result as $user=>$final){
            foreach ($final['kb3'] as $ibu){
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
//                        var_dump($this->SUNTIK3_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->SUNTIK3_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
            foreach ($final['kb1'] as $ibu){
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
//                        var_dump($this->SUNTIK1_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->SUNTIK1_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
            foreach ($final['iud'] as $ibu){
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
//                        var_dump($this->IUD_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->IUD_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
            foreach ($final['implan'] as $ibu){
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
//                        var_dump($this->IMPLAN_MESSAGE);
                        $status = $this->Rapidpro->postBroadcasts($this->IMPLAN_MESSAGE,array($num));
                        print_r($status);
                    }
                }
            }
        }
    }
}