<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LocationEcModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    private $loc = [
        "bidan"=>array(
            "Darek"=>array('nouser1'=>'Pandan Indah','user26'=>'Serage','user22'=>'Teduh'),
            "Pengadang"=>array('user30'=>'Gerantung','nouser1'=>'Jurang Jaler','nouser2'=>'Pengadang'),
            "Kopang"=>array('user21'=>'Aik Bual','user25'=>'Kopang Rembiga','user29'=>'Montong Gamang'),
            "Mantang"=>array('nouser1'=>'Barabali','user24'=>'Mantang','user23'=>'Presak','nouser2'=>'Tampak Siring'),
            "Mujur"=>array('nouser1'=>'Mujur','nouser2'=>'Sukaraja'),
            "Puyung"=>array('nouser1'=>'Dasan Ketujur','user27'=>'Gemel'),
            "Ubung"=>array('user20'=>'Batu Tulis','user28'=>'Labulia','nouser1'=>'Ubung')),
        "vaksinator"=>array(
            "Darek"=>array('nouser1'=>'Pandan Indah','vaksin26'=>'Serage','nouser2'=>'Teduh'),
            "Pengadang"=>array('vaksin30'=>'Gerantung','nouser1'=>'Jurang Jaler','nouser2'=>'Pengadang'),
            "Kopang"=>array('vaksin21'=>'Aik Bual','vaksin25'=>'Kopang Rembiga','vaksin29'=>'Montong Gamang'),
            "Mantang"=>array('nouser1'=>'Barabali','nouser2'=>'Mantang','vaksin23'=>'Presak','nouser3'=>'Tampak Siring'),
            "Mujur"=>array('nouser1'=>'Mujur','nouser2'=>'Sukaraja'),
            "Puyung"=>array('nouser1'=>'Dasan Ketujur','nouser2'=>'Gemel'),
            "Ubung"=>array('vaksin20'=>'Batu Tulis','nouser1'=>'Labulia','nouser2'=>'Ubung')),
        "gizi"=>array(
            "Darek"=>array('nouser1'=>'Pandan Indah','gizi26'=>'Serage','nouser2'=>'Teduh'),
            "Pengadang"=>array('gizi30'=>'Gerantung','nouser1'=>'Jurang Jaler','nouser2'=>'Pengadang'),
            "Kopang"=>array('gizi21'=>'Aik Bual','gizi25'=>'Kopang Rembiga','gizi29'=>'Montong Gamang'),
            "Mantang"=>array('nouser1'=>'Barabali','nouser2'=>'Mantang','gizi23'=>'Presak','nouser3'=>'Tampak Siring'),
            "Mujur"=>array('nouser1'=>'Mujur','nouser2'=>'Sukaraja'),
            "Puyung"=>array('nouser1'=>'Dasan Ketujur','nouser2'=>'Gemel'),
            "Ubung"=>array('gizi20'=>'Batu Tulis','nouser1'=>'Labulia','nouser2'=>'Ubung'))
        ];
    
    private $loc_id = [
            "Darek"=>array('Pandan Indah'=>'Pandan Indah','Serage'=>'Serage','Teduh'=>'Teduh'),
            "Pengadang"=>array('Gerantung'=>'Gerantung','Jurang Jaler'=>'Jurang Jaler','Pengadang'=>'Pengadang'),
            "Kopang"=>array('Aik Bual'=>'Aik Bual','Kopang Rembiga'=>'Kopang Rembiga','Montong Gamang'=>'Montong Gamang'),
            "Mantang"=>array('Barabali'=>'Barabali','Mantang.'=>'Mantang','Presak.'=>'Presak','Tampak Siring'=>'Tampak Siring'),
            "Mujur"=>array('Mujur'=>'Mujur','Sukaraja'=>'Sukaraja'),
            "Puyung"=>array('Dasan Ketujur'=>'Dasan Ketujur','Gemel'=>'Gemel'),
            "Ubung"=>array('Batu Tulis'=>'Batu Tulis','Labulia'=>'Labulia','Ubung'=>'Ubung')
        ];
    
    private $int_loc_id = [
            "bidan"=>array('Serage'=>'Serage','Teduh'=>'Teduh','Gerantung'=>'Gerantung','Kopang Rembiga'=>'Kopang Rembiga','Montong Gamang'=>'Montong Gamang','Mantang.'=>'Mantang','Presak.'=>'Presak','Gemel'=>'Gemel','Batu Tulis'=>'Batu Tulis','Labulia'=>'Labulia'),
            "gizi"=>array('Serage'=>'Serage','Gerantung'=>'Gerantung','Kopang Rembiga'=>'Kopang Rembiga','Montong Gamang'=>'Montong Gamang','Presak.'=>'Presak','Batu Tulis'=>'Batu Tulis'),
            "vaksinator"=>array('Serage'=>'Serage','Gerantung'=>'Gerantung','Kopang Rembiga'=>'Kopang Rembiga','Montong Gamang'=>'Montong Gamang','Presak.'=>'Presak','Batu Tulis'=>'Batu Tulis')
        ];
    
    private $dusun = [
        'Pandan Indah'=>array(1=>'Aik kerit','Bolor gejek','kelambi 1','kelambi 2','Kreak','Mangkoneng','Nangker','Panggongan','Rege','Sukalalem'),
        'Serage'=>array(1=>'Beberik','Belenje','Bt. salang','Lekong jae','Mapasan','Rurut','Semaye','Sulung'),
        'Teduh'=>array(1=>'Jati','Montong putik','Pengengat','Pengolah','Teduh.'),
        'Gerantung'=>array(1=>'Bual 2','Bual.','Gerantung.','Guntur','Juring','Lingkok Kudung'),
        'Jurang Jaler'=>array(1=>'Berembeng','Jurang Jaler.','Lingkok Eyat','Mapong','Mertak Men','Pinggal Bedok','Prai Gunung'),
        'Pengadang'=>array(1=>'Banar','Banar2','Bikan Pait','Bun Datu','Bunut Bireng','Embur Teres','LD. Kunyit 1','LD. Kunyit 2','MT. Tanggak','MT. Tanggak Selatan','Pengadang Selatan','Pengadang Utara','Prentek','Rangah','Regak','Sorong','Sundawe','Tambun'),
        'Aik Bual'=>array(1=>'Bare Eleh','Bual','Nyeredet','Pertanian','Rabuli','Ramus','Talon Ambon'),
        'Kopang Rembiga'=>array(1=>'Bajur','Barat Masjid','Bebak','Bhineka','Bore','BTN Jelojok','Gubuk','Gubuk Alang','Gunung Malang','Jontak','Kayun','Kopang 1','Lendang Lok','Lingkung','Mentinggo','Ngorok','Pendagi','Pengkores','Puyung.','Renggung'),
        'Montong Gamang'=>array(1=>'Binkok','Dasan tinggi','Embung Karung 1','Embung Karung 2','Embung Karung 3','Gonjong.','Karang Tengak','Montong Bulok','Montong Gamang 1','Montong Gamang 2','Montong Gamang 3','Montong Tanger','Mumbang 1','Mumbang 2','Mumbang 3','Nyanggi','Penimpah'),
        'Barabali'=>array(1=>'Barabali 1','Barabali 2','Celegeh','Dasan Baru','Gwh. Lendang Terong','Kebon Nyiur','Kelanjuh Lk','Ld. Dode','Ld. Re','Ld. Terong Daye','Lk. Kudung','Muhajirin h','Pondok Pande','Prako','Presak..','Sade','Surebaye Bat','Surebaye Daye','Surebaye Lauq','Tojak'),
        'Mantang'=>array(1=>'Alun-alun','Banjar Metu','Ceret','Gb. Gunung','Jantuk','Kabar','Kelanjuh Daye','Keren','Mantang I','Otak Desa','Pengadok','Raju Mas','Riris','Seganteng','Tampeng','Tenten','Tj. Bereng B','Tj. Bereng T','Tundung'),
        'Presak'=>array(1=>'Aik Gering','Batu Lajan','Boak','Bujak Daye','Ds. Aman','Dumpu','Pajangan','Penyengak','Presak Daye','Presak Lauk','Presak Tengak','Sandik','Selojan','Subahnale I','Subahnale II'),
        'Tampak Siring'=>array(1=>'Antak-Antak','Batu Meta','Beneng','Dsn. Baru','Gbk. Blimbing','Jadot','Jeranjang','Ld. Kekah','Lk. Petelahan','Pedadan','Sanggok'),
        'Mujur'=>array(1=>'Berenyok','Budiwathon','Bunut Baok','Gawah Malang','Kebun Alit','Kolak','Kudung Are','Lokon','Montong Inggu','Mungkik','Orok-orok','Pendem.','Pengendong','Perluasan','Santong.','Sebolet','Senayan','Serasap','Tanak Beak','Tembuku'),
        'Sukaraja'=>array(1=>'Bengkang','Karang katon','Kebun pelangeh','Kudung paok','Lengkah','Mircod','Montong bile.','Rajak','Selandung','Songkok'),
        'Dasan Ketujur'=>array(1=>'Bangket tengak','Dasan ketujur','Gubuk Punik','Krembeng','Lingkung daye','Lingkung Lauk','Merek','Mosok','Otak dese','Pedalaman','Sengkolit','Singosari','Sumpak bat','Sumpak timuk','Taman daye','Waker'),
        'Gemel'=>array(1=>'Bilemantik','Bunceman','Bunprie','Bunsibah','Gemel.','Kebun tengak','Merobok','Mtg. Kecial'),
        'Batu Tulis'=>array(1=>'Bangket Gawah','Batu Tulis.','Bon Rungkang','Bonje','Gontoran','Jereneng'),
        'Labulia'=>array(1=>'Batu Tinggang','Bonduduk','Dasan Sebeleq','Enjak','Labulia.','Olor Agung','Sulin','Tandek','Tober'),
        'Ubung'=>array(1=>'Aik Are','Bagek Nunggal','Batrate','Batu Karang','Bejelo','Bile Kere','Dasan Baru.','Keraning','Pelowok','Pemangket','Punimbe','Punjambong','Tohpati','Ubung 1')
    ];
    
    private $dusun_typo = [
        'Pandan Indah'=>array('Aik kerit'=>'Aik kerit','Bolor gejek'=>'Bolor gejek','kelambi 1'=>'kelambi 1','kelambi 2'=>'kelambi 2','Kreak'=>'Kreak','Mangkoneng'=>'Mangkoneng','Nangker'=>'Nangker','Panggongan'=>'Panggongan','Rege'=>'Rege','Sukalalem'=>'Sukalalem'),
        'Serage'=>array('Beberik'=>'Beberik','Belenje'=>'Belenje','Bt. salang'=>'Bt salang','Lekong jae'=>'Lekong jae','Mapasan'=>'Mapasan','Rurut'=>'Rurut','Semaye'=>'Semaye','Sulung'=>'Sulung'),
        'Teduh'=>array('Jati'=>'Jati','Montong putik'=>'Montong putik','Pengengat'=>'Pengengat','Pengolah'=>'Pengolah','Teduh.'=>'Teduh','Teduh'=>'Teduh'),
        'Gerantung'=>array('Bual 2'=>'Bual 2','Bual.'=>'Bual','Bual'=>'Bual','Gerantung.'=>'Gerantung','Gerantung'=>'Gerantung','Guntur'=>'Guntur','Juring'=>'Juring','Lingkok Kudung'=>'Lingkok Kudung'),
        'Jurang Jaler'=>array('Berembeng'=>'Berembeng','Jurang Jaler.'=>'Jurang Jaler','Jurang Jaler'=>'Jurang Jaler','Lingkok Eyat'=>'Lingkok Eyat','Mapong'=>'Mapong','Mertak Men'=>'Mertak Men','Pinggal Bedok'=>'Pinggal Bedok','Prai Gunung'=>'Prai Gunung'),
        'Pengadang'=>array('Banar'=>'Banar','Banar2'=>'Banar2','Bikan Pait'=>'Bikan Pait','Bun Datu'=>'Bun Datu','Bunut Bireng'=>'Bunut Bireng','Embur Teres'=>'Embur Teres','LD. Kunyit 1'=>'LD Kunyit 1','LD. Kunyit 2'=>'LD Kunyit 2','MT. Tanggak'=>'MT Tanggak','MT. Tanggak Selatan'=>'MT Tanggak Selatan','Pengadang Selatan'=>'Pengadang Selatan','Pengadang Utara'=>'Pengadang Utara','Prentek'=>'Prentek','Rangah'=>'Rangah','Regak'=>'Regak','Sorong'=>'Sorong','Sundawe'=>'Sundawe','Tambun'=>'Tambun'),
        'Aik Bual'=>array('Bare Eleh'=>'Bare Eleh','Bual'=>'Bual','Nyeredep'=>'Nyeredet','Nyeredet'=>'Nyeredet','Pertanian'=>'Pertanian','Rabuli'=>'Rabuli','Ramus'=>'Ramus','Ramuw'=>'Ramus','Talun Ambon'=>'Talon Ambon'),
        'Kopang Rembiga'=>array('Bajur'=>'Bajur','Barat Masjid'=>'Barat Masjid','Bebak'=>'Bebak','Bhineka'=>'Bhineka','Bore'=>'Bore','BTN Jelojok'=>'BTN Jelojok','Gubuk'=>'Gubuk','Gubuk Alang'=>'Gubuk Alang','Gunung Malang'=>'Gunung Malang','Jontak'=>'Jontak','Kayun'=>'Kayun','Kopang 1'=>'Kopang 1','Lendang Lok'=>'Lendang Lok','Lingkung'=>'Lingkung','Mentinggo'=>'Mentinggo','Ngorok'=>'Ngorok','Pendagi'=>'Pendagi','Pengkores'=>'Pengkores','Puyung.'=>'Puyung','Puyung'=>'Puyung','Renggung'=>'Renggung'),
        'Montong Gamang'=>array('Binkok'=>'Binkok','Dasan tinggi'=>'Dasan tinggi','Embung Karung 1'=>'Embung Karung 1','Embung Karung 2'=>'Embung Karung 2','Embung Karung 3'=>'Embung Karung 3','Gonjong.'=>'Gonjong','Gonjong'=>'Gonjong','Karang Tengak'=>'Karang Tengak','Montong Bulok'=>'Montong Bulok','Montong Gamang 1'=>'Montong Gamang 1','Montong Gamang 2'=>'Montong Gamang 2','Montong Gamang 3'=>'Montong Gamang 3','Montong Tanger'=>'Montong Tanger','Mumbang 1'=>'Mumbang 1','Mumbang 2'=>'Mumbang 2','Mumbang 3'=>'Mumbang 3','Nyanggi'=>'Nyanggi','Penimpah'=>'Penimpah'),
        'Barabali'=>array('Barabali 1'=>'Barabali 1','Barabali 2'=>'Barabali 2','Celegeh'=>'Celegeh','Dasan Baru'=>'Dasan Baru','Gwh. Lendang Terong'=>'Gwh Lendang Terong','Kebon Nyiur'=>'Kebon Nyiur','Kelanjuh Lk'=>'Kelanjuh Lk','Ld. Dode'=>'Ld Dode','Ld. Re'=>'Ld Re','Ld. Terong Daye'=>'Ld Terong Daye','Lk. Kudung'=>'Lk Kudung','Muhajirin h'=>'Muhajirin h','Pondok Pande'=>'Pondok Pande','Prako'=>'Prako','Presak..'=>'Presak','Presak'=>'Presak','Sade'=>'Sade','Surebaye Bat'=>'Surebaye Bat','Surebaye Daye'=>'Surebaye Daye','Surebaye Lauq'=>'Surebaye Lauq','Tojak'=>'Tojak'),
        'Mantang'=>array('Alun-alun'=>'Alun-alun','Banjar Metu'=>'Banjar Metu','Ceret'=>'Ceret','Gb. Gunung'=>'Gb Gunung','Jantuk'=>'Jantuk','Kabar'=>'Kabar','Kelanjuh Daye'=>'Kelanjuh Daye','Keren'=>'Keren','Mantang I'=>'Mantang I','Otak Desa'=>'Otak Desa','Pedaleman'=>'Pedaleman','Pengadok'=>'Pengadok','Raju Mas'=>'Raju Mas','Riris'=>'Riris','Seganteng'=>'Seganteng','Tampeng'=>'Tampeng','Tenten'=>'Tenten','Tj. Bereng B'=>'Tj Bereng B','Tj. Bereng T'=>'Tj Bereng T','Tundung'=>'Tundung'),
        'Presak'=>array('Aik Gering'=>'Aik Gering','Batu Lajan'=>'Batu Lajan','Boak'=>'Boak','Bujak Daye'=>'Bujak Daye','Ds. Aman'=>'Ds Aman','Dumpu'=>'Dumpu','Pajangan'=>'Pajangan','Penyengak'=>'Penyengak','Presak Daye'=>'Presak Daye','Presak Lauk'=>'Presak Lauk','Presak Tengak'=>'Presak Tengak','Sandik'=>'Sandik','Selojan'=>'Selojan','Subahnale I'=>'Subahnale I','Subahnale II'=>'Subahnale II'),
        'Tampak Siring'=>array('Antak-Antak'=>'Antak-Antak','Batu Meta'=>'Batu Meta','Beneng'=>'Beneng','Dsn. Baru'=>'Dsn Baru','Gbk. Blimbing'=>'Gbk Blimbing','Jadot'=>'Jadot','Jeranjang'=>'Jeranjang','Ld. Kekah'=>'Ld Kekah','Lk. Petelahan'=>'Lk Petelahan','Pedadan'=>'Pedadan','Sanggok'=>'Sanggok'),
        'Mujur'=>array('Berenyok'=>'Berenyok','Budiwathon'=>'Budiwathon','Bunut Baok'=>'Bunut Baok','Gawah Malang'=>'Gawah Malang','Kebun Alit'=>'Kebun Alit','Kolak'=>'Kolak','Kudung Are'=>'Kudung Are','Lokon'=>'Lokon','Montong Inggu'=>'Montong Inggu','Mungkik'=>'Mungkik','Orok-orok'=>'Orok-orok','Pendem.'=>'Pendem','Pendem'=>'Pendem','Pengendong'=>'Pengendong','Perluasan'=>'Perluasan','Santong.'=>'Santong','Santong'=>'Santong','Sebolet'=>'Sebolet','Senayan'=>'Senayan','Serasap'=>'Serasap','Tanak Beak'=>'Tanak Beak','Tembuku'=>'Tembuku'),
        'Sukaraja'=>array('Bengkang'=>'Bengkang','Karang katon'=>'Karang katon','Kebun pelangeh'=>'Kebun pelangeh','Kudung paok'=>'Kudung paok','Lengkah'=>'Lengkah','Mircod'=>'Mircod','Montong bile.'=>'Montong bile','Montong bile'=>'Montong bile','Rajak'=>'Rajak','Selandung'=>'Selandung','Songkok'=>'Songkok'),
        'Dasan Ketujur'=>array('Bangket tengak'=>'Bangket tengak','Dasan ketujur'=>'Dasan ketujur','Gubuk Punik'=>'Gubuk Punik','Krembeng'=>'Krembeng','Lingkung daye'=>'Lingkung daye','Lingkung Lauk'=>'Lingkung Lauk','Merek'=>'Merek','Mosok'=>'Mosok','Otak dese'=>'Otak dese','Pedalaman'=>'Pedalaman','Sengkolit'=>'Sengkolit','Singosari'=>'Singosari','Sumpak bat'=>'Sumpak bat','Sumpak timuk'=>'Sumpak timuk','Taman daye'=>'Taman daye','Waker'=>'Waker'),
        'Gemel'=>array('Bilemantik'=>'Bilemantik','Bunceman'=>'Bunceman','Bunprie'=>'Bunprie','Bunsibah'=>'Bunsibah','Gemel.'=>'Gemel','Gemel'=>'Gemel','Kebun tengak'=>'Kebun tengak','Merobok'=>'Merobok','Mtg. Kecial'=>'Mtg Kecial'),
        'Batu Tulis'=>array('Bangket Gawah'=>'Bangket Gawah','Batutulis'=>'Batu Tulis','Batu tulis.'=>'Batu Tulis','Batu Tulis.'=>'Batu Tulis','Batu Tulis'=>'Batu Tulis','Bunrungkang'=>'Bon Rungkang','Bon Rungkang / Bonje'=>'Bon Rungkang','Bon Rungkang'=>'Bon Rungkang','Bonje'=>'Bonje','Bunje'=>'Bonje','Gontoran'=>'Gontoran','Jereneng'=>'Jereneng'),
        'Labulia'=>array('Batu Tinggang'=>'Batu Tinggang','Bonduduk'=>'Bonduduk','Dasan Sebeleq'=>'Dasan Sebeleq','Enjak'=>'Enjak','Labulia Desa'=>'Labulia Desa','Dasan Tuan'=>'Dasan Tuan','Labulia Lauk'=>'Labulia Lauk','Labulia Daye'=>'Labulia Daye','Olor Agung'=>'Olor Agung','Sulin'=>'Sulin','Wareng Kandel'=>'Wareng Kandel','Tandek Daye'=>'Tandek Daye','Tandek Lauk'=>'Tandek Lauk','Pengempokan'=>'Pengempokan','Tober'=>'Tober'),
        'Ubung'=>array('Aik Are'=>'Aik Are','Bagek Nunggal'=>'Bagek Nunggal','Batrate'=>'Batrate','Batu Karang'=>'Batu Karang','Bejelo'=>'Bejelo','Bile Kere'=>'Bile Kere','Dasan Baru.'=>'Dasan Baru','Dasan Baru'=>'Dasan Baru','Keraning'=>'Keraning','Pelowok'=>'Pelowok','Pemangket'=>'Pemangket','Punimbe'=>'Punimbe','Punjambong'=>'Punjambong','Tohpati'=>'Tohpati','Ubung 1'=>'Ubung 1')
    ];
    
    public function getAllLoc($fhw){
        return $this->loc[$fhw];
    }
    
    public function getAllLocSpv($fhw,$kec){
        return [$kec=>$this->loc[$fhw][$kec]];
    }
    
    public function getLocId($kec){
        return $this->loc_id[$kec];
    }
    
    public function getIntLocId($fhw){
        return $this->int_loc_id[$fhw];
    }
    
    public function getLocIdQuery($locId){
        $location = '';
        foreach ($locId as $loc=>$id){
            $location .= "locationId LIKE '%$loc%'";
            if($id!=  end($locId)) $location .= " OR ";
        }
        return $location;
    }
    
    public function getLocIdAndDesabyDesa($desa){
        foreach ($this->loc_id as $kec=>$desas){
            if($ret = array_search($desa, $desas)) return [$ret=>$desa];
        }
    }
    
    public function getLocIdbyDesa($desa){
        foreach ($this->loc_id as $kec=>$desas){
            if($ret = array_search($desa, $desas)) return $ret;
        }
    }
    
    public function getDesa($fhw,$kec){
        return $this->loc[$fhw][$kec];
    }
    
    public function getKecUsers($fhw,$kec){
        $users = [];
        foreach ($this->loc[$fhw][$kec] as $user=>$loc){
            array_push($users, $user);
        }
        return $users;
    }
    
    public function getKecFromDesa($namadesa){
        $namadesa = str_replace('%20',' ',$namadesa);
        foreach ($this->loc['bidan'] as $kec=>$loc){
            if(array_search($namadesa,$loc)){
                return $kec;
            }
        }
    }
    
    public function getKecFromUser($fhw,$userid){
        foreach ($this->loc[$fhw] as $kec=>$loc){
            if(array_key_exists($userid, $loc)){
                return $kec;
            }
        }
    }

    public function getDesaFromDusun($dusun){
        foreach ($this->dusun_typo as $desa=>$dusun_list){
            if(array_search($dusun,$dusun_list)){
                return $desa;
            }
        }
    }
    
    public function getUserFromDusun($fhw,$dusun){
        $desa = $this->getDesaFromDusun($dusun);
        foreach ($this->loc[$fhw] as $kec=>$desa_list){
            if($user = array_search($desa,$desa_list)){
                return $user;
            }
        }
    }
    
    public function getKecFromDusun($fhw,$dusun){
        return $this->getKecFromDesa($this->getDesaFromDusun($dusun));
    }

    public function getDesaUser($fhw,$kec,$desa){
        foreach ($this->loc[$fhw][$kec] as $user=>$loc){
            if($loc==$desa) return $user;
        }
    }
    
    
    
    public function getDesaFromUser($fhw,$kec,$userid){
        foreach ($this->loc[$fhw][$kec] as $user=>$loc){
            if($user==$userid) return $loc;
        }
    }
    
    public function getDusun($desa){
        return $this->dusun[$desa];
    }
    
    public function getDusunTypo($desa){
        return $this->dusun_typo[$desa];
    }
}