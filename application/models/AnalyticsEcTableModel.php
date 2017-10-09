<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AnalyticsEcTableModel extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    
    private $table =[
        'bidan'=> [
            'event_bidan_identitas_ibu'=>'Registrasi Ibu',
            'event_bidan_tambah_anc'=>'Registrasi ANC',
            'event_bidan_kunjungan_anc'=>'Kunjungan ANC',
            'event_bidan_kunjungan_anc_lab_test'=>'Lab Test',
            'event_bidan_kunjungan_anc_integrasi'=>'ANC Integrasi',
            'event_bidan_rencana_persalinan'=>'Rencana Persalinan',
            'event_bidan_dokumentasi_persalinan'=>'Dokumentasi Persalinan',
            'event_bidan_penutupan_anc'=>'Penutupan ANC',
            'event_bidan_kunjungan_pnc'=>'Kunjungan PNC',
            'event_bidan_child_registration'=>'Registrasi Anak',
            'event_bidan_kunjungan_neonatal'=>'Kunjungan Neonatal',
            'event_bidan_imunisasi_bayi'=>'Imunisasi Bayi',
            'event_bidan_penutupan_anak'=>'Penutupuan Anak',
            'event_bidan_tambah_kb'=>'Tambah KB',
            'event_bidan_kohort_pelayanan_kb'=>'Pelayanan KB',
            'event_bidan_penutupan_kb'=>'Penutupan KB',
            'event_bidan_penutupan_ibu'=>'Penutupan Ibu',
            'event_bidan_tambah_bayi'=>'Tambah Bayi'],
        'gizi'=>[
            'event_gizi_registrasi_gizi'=>'Registrasi Gizi',
            'event_gizi_kunjungan_gizi'=>'Kunjungan Gizi',
            'event_gizi_penutupan_anak'=>'Penutupan Anak'],
        'vaksinator'=>[
            'event_vaksin_registrasi_vaksinator'=>'Registrasi Vaksinator',
            'event_vaksin_imunisasi_bayi'=>'Form Imunisasi',
            'event_vaksin_penutupan_anak'=>'Penutuan Anak']];
    
    public function getTable($fhw){
        return $this->table[$fhw];
    }
    public function getTableName($fhw){
        $ret = [];
        foreach ($this->table[$fhw] as $table=>$tname){
            array_push($ret, $table);
        }
        return $ret;
    }
    public function getTableIndex($fhw){
        $i = 0;
        $ret = [];
        foreach ($this->table[$fhw] as $table=>$tname){
            $ret[$table] = $i;
            $i++;
        }
        return $ret;
    }
}