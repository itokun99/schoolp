<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends Core_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model("UserModel");
        $this->load->model("ActivityModel");
        $this->load->model("ContactModel");
    }
   
    public function sendMessage()
    {
        $contactEmail = $this->input->post('contactEmail');
        $contactPesan = $this->input->post('contactPesan');
        $contactTelepon = $this->input->post('contactTelepon');
        $contactNama = $this->input->post('contactNama');
        $datez = date('Y-m-d H:i:s');
        
        $ins_db = array(
            'name' => $contactNama,
            'phone' => $contactTelepon,
            'message' => $contactPesan,
            'email' => $contactEmail,
            'datez' => $datez
        );
        $ins_query_db = $this->ContactModel->save($ins_db);
        $data = "sukses";
        echo json_encode($data);
    }

    public function fillProvinsi()
    {   
        $cekAvailable = $this->db->query("SELECT nama_provinsi,provinsiid FROM provinsi 
        WHERE NOT nama_provinsi = 'DKI JAKARTA' 
        ORDER BY nama_provinsi");
        $data = $cekAvailable->result_array();
        echo json_encode($data);
    }

    public function fillSekolahStart()
    {
        $tingkat = $this->input->get('tingkatSearch');
        $provinsi = $this->input->get('tingkatProvinsi');
        $kabupaten = $this->input->get('tingkatKabupaten');
        $kecamatan = $this->input->get('tingkatKecamatan');
        $sekolah = $this->input->get('tingkatNamaSekolah');
        if($provinsi == "" && $kabupaten == "" && $kecamatan == "")
        {
            if($tingkat == "ALL")
            {
                $cekAvailable = $this->db->query("SELECT school_name FROM b_school 
                WHERE school_name LIKE '%$sekolah%' 
                ORDER BY school_name 
                LIMIT 10");
                $data = $cekAvailable->result_array();
                echo json_encode($data);
            }
            else
            {
                $cekAvailable = $this->db->query("SELECT school_name FROM b_school 
                WHERE school_name LIKE '%$sekolah%' AND jenjang_pendidikan = '$tingkat' 
                ORDER BY school_name 
                LIMIT 10");
                $data = $cekAvailable->result_array();
                echo json_encode($data);
            }
        }
        else if($provinsi != "" && $kabupaten == "" && $kecamatan == "")
        {
            if($tingkat == "ALL")
            {
                $cekAvailable = $this->db->query("SELECT school_name FROM b_school_detail 
                INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid
                INNER JOIN provinsi on b_school_detail.provinsi_id = provinsi.provinsiid
                WHERE school_name LIKE '%$sekolah%' AND nama_provinsi = '$provinsi'
                ORDER BY school_name
                LIMIT 10");
                $data = $cekAvailable->result_array();
                echo json_encode($data);
            }
            else
            {
                $cekAvailable = $this->db->query("SELECT school_name FROM b_school_detail 
                INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid
                INNER JOIN provinsi on b_school_detail.provinsi_id = provinsi.provinsiid
                WHERE school_name LIKE '%$sekolah%' AND nama_provinsi = '$provinsi' AND jenjang_pendidikan = '$tingkat'
                ORDER BY school_name
                LIMIT 10");
                $data = $cekAvailable->result_array();
                echo json_encode($data);
            }
        }
        else if($provinsi != "" && $kabupaten != "" && $kecamatan == "")
        {
            if($tingkat == "ALL")
            {
                $cekAvailable = $this->db->query("SELECT school_name FROM b_school_detail 
                INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid
                INNER JOIN provinsi on b_school_detail.provinsi_id = provinsi.provinsiid
                INNER JOIN kabupaten on b_school_detail.kabupaten_id = kabupaten.kabupatenid
                WHERE school_name LIKE '%$sekolah%' AND nama_provinsi = '$provinsi' AND nama_kabupaten = '$kabupaten'
                ORDER BY school_name
                LIMIT 10");
                $data = $cekAvailable->result_array();
                echo json_encode($data);
            }
            else
            {
                $cekAvailable = $this->db->query("SELECT school_name FROM b_school_detail 
                INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid
                INNER JOIN provinsi on b_school_detail.provinsi_id = provinsi.provinsiid
                INNER JOIN kabupaten on b_school_detail.kabupaten_id = kabupaten.kabupatenid
                WHERE school_name LIKE '%$sekolah%' AND nama_provinsi = '$provinsi' AND jenjang_pendidikan = '$tingkat' AND nama_kabupaten = '$kabupaten'
                ORDER BY school_name
                LIMIT 10");
                $data = $cekAvailable->result_array();
                echo json_encode($data);
            }
        }
        else if($provinsi != "" && $kabupaten != "" && $kecamatan != "")
        {
            if($tingkat == "ALL")
            {
                $cekAvailable = $this->db->query("SELECT school_name FROM b_school_detail 
                INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid
                INNER JOIN provinsi on b_school_detail.provinsi_id = provinsi.provinsiid
                INNER JOIN kabupaten on b_school_detail.kabupaten_id = kabupaten.kabupatenid
                INNER JOIN kecamatan on b_school_detail.kecamatan_id = kecamatan.kecamatanid
                WHERE school_name LIKE '%$sekolah%' AND nama_provinsi = '$provinsi' AND nama_kabupaten = '$kabupaten' AND nama_kecamatan = '$kecamatan'
                ORDER BY school_name
                LIMIT 10");
                $data = $cekAvailable->result_array();
                echo json_encode($data);
            }
            else
            {
                $cekAvailable = $this->db->query("SELECT school_name FROM b_school_detail 
                INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid
                INNER JOIN provinsi on b_school_detail.provinsi_id = provinsi.provinsiid
                INNER JOIN kabupaten on b_school_detail.kabupaten_id = kabupaten.kabupatenid
                INNER JOIN kecamatan on b_school_detail.kecamatan_id = kecamatan.kecamatanid
                WHERE school_name LIKE '%$sekolah%' AND nama_provinsi = '$provinsi' AND nama_kabupaten = '$kabupaten' AND nama_kecamatan = '$kecamatan' AND jenjang_pendidikan = '$tingkat'
                ORDER BY school_name
                LIMIT 10");
                $data = $cekAvailable->result_array();
                echo json_encode($data);
            }
        }
    }

    public function fillKabupaten()
    {
        $provinsi = $this->input->get('provinsi');
        $cekAvailable = $this->db->query("SELECT nama_kabupaten,kabupatenid FROM kabupaten 
        INNER JOIN provinsi on kabupaten.provinsi_id = provinsi.provinsiid
        WHERE nama_provinsi = '$provinsi'");
        $data = $cekAvailable->result_array();
        echo json_encode($data);
    }

    public function fillKecamatan()
    {
        $kabupaten = $this->input->get('kabupaten');
        $cekAvailable = $this->db->query("SELECT nama_kecamatan,kecamatanid FROM kecamatan 
        INNER JOIN kabupaten on kecamatan.kabupaten_id = kabupaten.kabupatenid
        WHERE nama_kabupaten = '$kabupaten'");
        $data = $cekAvailable->result_array();
        echo json_encode($data);
    }

    public function getSekolahTingkat()
    {
        $tingkat = $this->input->get('tingkatSearch');
        if($tingkat == "ALL")
        {
            $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid");
        }
        else
        {
            $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE jenjang_pendidikan = '$tingkat'");
        }
        $totalSekolahData = $getSekolahData->num_rows();
        $sekolahData = $getSekolahData->result_array();
        if($totalSekolahData == "0")
        {
            $data = "ERSEANOF";
            echo json_encode($data);
        }
        else
        {
            $session_data = array(
                'tingkat' => $tingkat,
                'provinsi_id' => "",
                'kabupaten_id' => "",
                'kecamatan_id' => "",
                'school_name' => ""
                );
            $this->session->set_userdata($session_data);
            $data = $sekolahData;
            echo json_encode($data);
        }
    }

    public function getSekolahTingkatWithName()
    {
        $tingkat = $this->input->get('tingkatSearch');
        $tingkatNamaSekolah = $this->input->get('tingkatNamaSekolah');
        $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE school_name = '$tingkatNamaSekolah'");
        $totalSekolahData = $getSekolahData->num_rows();
        $sekolahData = $getSekolahData->result_array();
        if($totalSekolahData == "0")
        {
            $data = "ERSEANOF";
            echo json_encode($data);
        }
        else
        {
            $session_data = array(
                'tingkat' => $tingkat,
                'provinsi_id' => "",
                'kabupaten_id' => "",
                'kecamatan_id' => "",
                'school_name' => $tingkatNamaSekolah
                );
            $this->session->set_userdata($session_data);
            $data = $sekolahData;
            echo json_encode($data);
        }
    }

    public function getSekolahProvinsi()
    {
        $tingkat = $this->input->get('tingkatSearch');
        $provinsi = $this->input->get('tingkatProvinsi');
        $getProvinsiData = $this->db->query("SELECT * FROM provinsi WHERE nama_provinsi = '$provinsi'");
        $provinsiData = $getProvinsiData->num_rows();
        if($provinsiData == "0")
        {
            $data = "ERSEA001";
            echo json_encode($data);
        }
        else
        {
            $provinsiAllData = $getProvinsiData->result_array();
            $provinsiID = $provinsiAllData[0]['provinsiid'];
            
            if($tingkat == "ALL")
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' LIMIT 50  ");
            }
            else
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND jenjang_pendidikan = '$tingkat'");
            }
            
            $totalSekolahData = $getSekolahData->num_rows();
            
            if($totalSekolahData == "0")
            {
                $data = "ERSEANOF";
                echo json_encode($data);
            }
            else
            {
                $sekolahData = $getSekolahData->result_array();
                $session_data = array(
                    'tingkat' => $tingkat,
                    'provinsi_id' => $provinsiID,
                    'kabupaten_id' => "",
                    'kecamatan_id' => "",
                    'school_name' => ""
                    );
                $this->session->set_userdata($session_data);
                $data = $sekolahData;
                echo json_encode($data);
            }
        }
    }

    public function getSekolahProvinsiWithName()
    {
        $tingkat = $this->input->get('tingkatSearch');
        $provinsi = $this->input->get('tingkatProvinsi');
        $sekolah = $this->input->get('tingkatNamaSekolah');
        $getProvinsiData = $this->db->query("SELECT * FROM provinsi WHERE nama_provinsi = '$provinsi'");
        $provinsiData = $getProvinsiData->num_rows();
        if($provinsiData == "0")
        {
            $data = "ERSEA001";
            echo json_encode($data);
        }
        else
        {
            $provinsiAllData = $getProvinsiData->result_array();
            $provinsiID = $provinsiAllData[0]['provinsiid'];
            if($tingkat == "ALL")
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND school_name = '$sekolah'");
            }
            else
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND school_name = '$sekolah' AND jenjang_pendidikan = '$tingkat'");
            }
            
            $totalSekolahData = $getSekolahData->num_rows();
            $sekolahData = $getSekolahData->result_array();
            if($totalSekolahData == "0")
            {
                $data = "ERSEANOF";
                echo json_encode($data);
            }
            else
            {
                $session_data = array(
                    'tingkat' => $tingkat,
                    'provinsi_id' => $provinsiID,
                    'kabupaten_id' => "",
                    'kecamatan_id' => "",
                    'school_name' => $sekolah
                    );
                $this->session->set_userdata($session_data);
                $data = $sekolahData;
                echo json_encode($data);
            }
        }
    }

    public function getSekolahKabupaten()
    {
        $tingkat = $this->input->get('tingkatSearch');
        $provinsi = $this->input->get('tingkatProvinsi');
        $kabupaten = $this->input->get('tingkatKabupaten');
        $getProvinsiData = $this->db->query("SELECT * FROM provinsi WHERE nama_provinsi = '$provinsi'");
        $provinsiData = $getProvinsiData->num_rows();
        $getKabupatenData = $this->db->query("SELECT * FROM kabupaten WHERE nama_kabupaten = '$kabupaten'");
        $kabupatenData = $getKabupatenData->num_rows();
        if($provinsiData == "0")
        {
            $data = "ERSEA001";
            echo json_encode($data);
        }
        else if($kabupatenData == "0")
        {
            $data = "ERSEA002";
            echo json_encode($data);
        }
        else
        {
            $provinsiAllData = $getProvinsiData->result_array();
            $provinsiID = $provinsiAllData[0]['provinsiid'];
            $kabupatenAllData = $getKabupatenData->result_array();
            $kabupatenID = $kabupatenAllData[0]['kabupatenid'];
            if($tingkat == "ALL")
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND kabupaten_id = '$kabupatenID'");
            }
            else
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND kabupaten_id = '$kabupatenID' AND jenjang_pendidikan = '$tingkat'");
            }
            $totalSekolahData = $getSekolahData->num_rows();
            $sekolahData = $getSekolahData->result_array();
            if($totalSekolahData == "0")
            {
                $data = "ERSEANOF";
                echo json_encode($data);
            }
            else
            {
                $session_data = array(
                    'tingkat' => $tingkat,
                    'provinsi_id' => $provinsiID,
                    'kabupaten_id' => $kabupatenID,
                    'kecamatan_id' => "",
                    'school_name' => ""
                    );
                $this->session->set_userdata($session_data);
                $data = $sekolahData;
                echo json_encode($data);
            }
        }
    }
    
    public function getSekolahKabupatenWithName()
    {
        $tingkat = $this->input->get('tingkatSearch');
        $provinsi = $this->input->get('tingkatProvinsi');
        $kabupaten = $this->input->get('tingkatKabupaten');
        $sekolah = $this->input->get('tingkatNamaSekolah');
        $getProvinsiData = $this->db->query("SELECT * FROM provinsi WHERE nama_provinsi = '$provinsi'");
        $provinsiData = $getProvinsiData->num_rows();
        $getKabupatenData = $this->db->query("SELECT * FROM kabupaten WHERE nama_kabupaten = '$kabupaten'");
        $kabupatenData = $getKabupatenData->num_rows();
        if($provinsiData == "0")
        {
            $data = "ERSEA001";
            echo json_encode($data);
        }
        else if($kabupatenData == "0")
        {
            $data = "ERSEA002";
            echo json_encode($data);
        }
        else
        {
            $provinsiAllData = $getProvinsiData->result_array();
            $provinsiID = $provinsiAllData[0]['provinsiid'];
            $kabupatenAllData = $getKabupatenData->result_array();
            $kabupatenID = $kabupatenAllData[0]['kabupatenid'];
            if($tingkat == "ALL")
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND kabupaten_id = '$kabupatenID' AND school_name = '$sekolah'");
            }
            else
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND kabupaten_id = '$kabupatenID' AND school_name = '$sekolah' AND jenjang_pendidikan = '$tingkat'");
            }
            $totalSekolahData = $getSekolahData->num_rows();
            $sekolahData = $getSekolahData->result_array();
            if($totalSekolahData == "0")
            {
                $data = "ERSEANOF";
                echo json_encode($data);
            }
            else
            {
                $session_data = array(
                    'tingkat' => $tingkat,
                    'provinsi_id' => $provinsiID,
                    'kabupaten_id' => $kabupatenID,
                    'kecamatan_id' => "",
                    'school_name' => $sekolah
                    );
                $this->session->set_userdata($session_data);
                $data = $sekolahData;
                echo json_encode($data);
            }
        }
    }

    public function getSekolahKecamatan()
    {
        $tingkat = $this->input->get('tingkatSearch');
        $provinsi = $this->input->get('tingkatProvinsi');
        $kabupaten = $this->input->get('tingkatKabupaten');
        $kecamatan = $this->input->get('tingkatKecamatan');
        $getProvinsiData = $this->db->query("SELECT * FROM provinsi WHERE nama_provinsi = '$provinsi'");
        $provinsiData = $getProvinsiData->num_rows();
        $getKabupatenData = $this->db->query("SELECT * FROM kabupaten WHERE nama_kabupaten = '$kabupaten'");
        $kabupatenData = $getKabupatenData->num_rows();
        $getKecamatanData = $this->db->query("SELECT * FROM kecamatan WHERE nama_kecamatan = '$kecamatan'");
        $kecamatanData = $getKecamatanData->num_rows();
        if($provinsiData == "0")
        {
            $data = "ERSEA001";
            echo json_encode($data);
        }
        else if($kabupatenData == "0")
        {
            $data = "ERSEA002";
            echo json_encode($data);
        }
        else if($kecamatanData == "0")
        {
            $data = "ERSEA003";
            echo json_encode($data);
        }
        else
        {
            $provinsiAllData = $getProvinsiData->result_array();
            $provinsiID = $provinsiAllData[0]['provinsiid'];
            $kabupatenAllData = $getKabupatenData->result_array();
            $kabupatenID = $kabupatenAllData[0]['kabupatenid'];
            $kecamatanAllData = $getKecamatanData->result_array();
            $kecamatanID = $kecamatanAllData[0]['kecamatanid'];
            if($tingkat == "ALL")
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND kabupaten_id = '$kabupatenID' AND kecamatan_id = '$kecamatanID'");
            }
            else
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND kabupaten_id = '$kabupatenID' AND kecamatan_id = '$kecamatanID' AND jenjang_pendidikan = '$tingkat'");
            }
            $totalSekolahData = $getSekolahData->num_rows();
            $sekolahData = $getSekolahData->result_array();
            if($totalSekolahData == "0")
            {
                $data = "ERSEANOF";
                echo json_encode($data);
            }
            else
            {
                $session_data = array(
                    'tingkat' => $tingkat,
                    'provinsi_id' => $provinsiID,
                    'kabupaten_id' => $kabupatenID,
                    'kecamatan_id' => $kecamatanID,
                    'school_name' => ""
                    );
                $this->session->set_userdata($session_data);
                $data = $sekolahData;
                echo json_encode($data);
            }
        }
    }

    public function getSekolahWithName()
    {
        $tingkat = $this->input->get('tingkatSearch');
        $provinsi = $this->input->get('tingkatProvinsi');
        $kabupaten = $this->input->get('tingkatKabupaten');
        $kecamatan = $this->input->get('tingkatKecamatan');
        $sekolah = $this->input->get('tingkatNamaSekolah');
        $getProvinsiData = $this->db->query("SELECT * FROM provinsi WHERE nama_provinsi = '$provinsi'");
        $provinsiData = $getProvinsiData->num_rows();
        $getKabupatenData = $this->db->query("SELECT * FROM kabupaten WHERE nama_kabupaten = '$kabupaten'");
        $kabupatenData = $getKabupatenData->num_rows();
        $getKecamatanData = $this->db->query("SELECT * FROM kecamatan WHERE nama_kecamatan = '$kecamatan'");
        $kecamatanData = $getKecamatanData->num_rows();
        if($provinsiData == "0")
        {
            $data = "ERSEA001";
            echo json_encode($data);
        }
        else if($kabupatenData == "0")
        {
            $data = "ERSEA002";
            echo json_encode($data);
        }
        else if($kecamatanData == "0")
        {
            $data = "ERSEA003";
            echo json_encode($data);
        }
        else
        {
            $provinsiAllData = $getProvinsiData->result_array();
            $provinsiID = $provinsiAllData[0]['provinsiid'];
            $kabupatenAllData = $getKabupatenData->result_array();
            $kabupatenID = $kabupatenAllData[0]['kabupatenid'];
            $kecamatanAllData = $getKecamatanData->result_array();
            $kecamatanID = $kecamatanAllData[0]['kecamatanid'];
            $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND kabupaten_id = '$kabupatenID' AND kecamatan_id = '$kecamatanID' AND school_name LIKE '%$sekolah%'");
            $totalSekolahData = $getSekolahData->num_rows();
            $sekolahData = $getSekolahData->result_array();
            if($totalSekolahData == "0")
            {
                $data = "ERSEA004";
                echo json_encode($data);
            }
            else
            {
                if($tingkat == "ALL")
                {
                    $getSekolahDataTingkat = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE school_name LIKE '%$sekolah%'");
                }
                else
                {
                    $getSekolahDataTingkat = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE jenjang_pendidikan = '$tingkat' AND school_name LIKE '%$sekolah%'");
                }
                $totalSekolahDataTingkat = $getSekolahDataTingkat->num_rows();
                $sekolahDataTingkat = $getSekolahDataTingkat->result_array();
                if($totalSekolahDataTingkat == "0")
                {
                    $data = "ERSEANOF";
                    echo json_encode($data);
                }
                else
                {
                    $session_data = array(
                        'tingkat' => $tingkat,
                        'provinsi_id' => $provinsiID,
                        'kabupaten_id' => $kabupatenID,
                        'kecamatan_id' => $kecamatanID,
                        'school_name' => $sekolah
                        );
                    $this->session->set_userdata($session_data);
                    $data = $sekolahDataTingkat;
                    echo json_encode($data);
                }
            }
        }
    }

    public function getSekolahDataSession()
    {
        $tingkat = $this->session->userdata('tingkat');
        $provinsiID = $this->session->userdata('provinsi_id');
        $kabupatenID = $this->session->userdata('kabupaten_id');
        $kecamatanID = $this->session->userdata('kecamatan_id');
        $schoolname = $this->session->userdata('school_name');

        if($tingkat != "" && $provinsiID == "" && $kabupatenID == "" && $kecamatanID == "" && $schoolname == "")
        {
            if($tingkat == "ALL")
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid");
            }
            else
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE jenjang_pendidikan = '$tingkat'");
            }
            $sekolahData = $getSekolahData->result_array();
            $data['sekolah'] = $sekolahData;
            $data['jenis'] = "negara";
            echo json_encode($data);
        }
        else if($tingkat != "" && $provinsiID == "" && $kabupatenID == "" && $kecamatanID == "" && $schoolname != "")
        {
            $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE school_name = '$schoolname'");
            $sekolahData = $getSekolahData->result_array();
            $data['sekolah'] = $sekolahData;
            $data['jenis'] = "sekolah";
            echo json_encode($data);
        }
        else if($tingkat != "" && $provinsiID != "" && $kabupatenID == "" && $kecamatanID == "" && $schoolname == "")
        {
            if($tingkat == "ALL")
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID'");
            }
            else
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND jenjang_pendidikan = '$tingkat'");
            }
            $sekolahData = $getSekolahData->result_array();
            $data['sekolah'] = $sekolahData;
            $data['jenis'] = "provinsi";
            echo json_encode($data);
        }
        else if($tingkat != "" && $provinsiID != "" && $kabupatenID == "" && $kecamatanID == "" && $schoolname != "")
        {
            $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND school_name = '$schoolname'");
            $sekolahData = $getSekolahData->result_array();
            $data['sekolah'] = $sekolahData;
            $data['jenis'] = "provinsi";
            echo json_encode($data);
        }
        else if($tingkat != "" && $provinsiID != "" && $kabupatenID != "" && $kecamatanID == "" && $schoolname == "")
        {
            if($tingkat == "ALL")
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND kabupaten_id = '$kabupatenID'");
            }
            else
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND kabupaten_id = '$kabupatenID' AND jenjang_pendidikan = '$tingkat'");
            }
            $sekolahData = $getSekolahData->result_array();
            $data['sekolah'] = $sekolahData;
            $data['jenis'] = "kabupaten";
            echo json_encode($data);
        }
        else if($tingkat != "" && $provinsiID != "" && $kabupatenID != "" && $kecamatanID == "" && $schoolname != "")
        {
            $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND kabupaten_id = '$kabupatenID' AND school_name = '$schoolname'");
            $sekolahData = $getSekolahData->result_array();
            $data['sekolah'] = $sekolahData;
            $data['jenis'] = "kabupaten";
            echo json_encode($data);
        }
        else if($tingkat != "" && $provinsiID != "" && $kabupatenID != "" && $kecamatanID != "" && $schoolname == "")
        {
            if($tingkat == "ALL")
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND kabupaten_id = '$kabupatenID' AND kecamatan_id = '$kecamatanID'");
            }
            else
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND kabupaten_id = '$kabupatenID' AND kecamatan_id = '$kecamatanID' AND jenjang_pendidikan = '$tingkat'");
            }
            $sekolahData = $getSekolahData->result_array();
            $data['sekolah'] = $sekolahData;
            $data['jenis'] = "kecamatan";
            echo json_encode($data);
        }
        else 
        {
            if($tingkat == "ALL")
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND kabupaten_id = '$kabupatenID' AND kecamatan_id = '$kecamatanID' AND school_name LIKE '%$schoolname%'");
            }
            else
            {
                $getSekolahData = $this->db->query("SELECT * FROM b_school_detail INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid WHERE provinsi_id = '$provinsiID' AND kabupaten_id = '$kabupatenID' AND kecamatan_id = '$kecamatanID' AND jenjang_pendidikan = '$tingkat' AND school_name LIKE '%$schoolname%'");
            }
            $sekolahData = $getSekolahData->result_array();
            $data['sekolah'] = $sekolahData;
            $data['jenis'] = "sekolah";
            echo json_encode($data);
        }
    }

    public function getSchoolDetail()
    {
        $school_id = $this->input->get('id');
        $getSekolahDataDetail = $this->db->query("SELECT * FROM b_school_detail 
        INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid 
        INNER JOIN kabupaten on b_school_detail.kabupaten_id = kabupaten.kabupatenid
        INNER JOIN kecamatan on b_school_detail.kecamatan_id = kecamatan.kecamatanid
        INNER JOIN provinsi on b_school_detail.provinsi_id = provinsi.provinsiid
        WHERE b_school_detail.school_id = '$school_id' LIMIT 1");
        $sekolahData = $getSekolahDataDetail->result_array();
        $data = $sekolahData;
        echo json_encode($data);
    }

    public function sendKey()
    {
        $userEmail = $this->input->get('email');
        $key = "123456";
        $subject = "Key Verifikasi";
        $this->load->library('email');
        $fromemail = "info@kes.co.id";
        $toemail = $userEmail;
        $subject = $subject;
        
        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                        </head><body>';

        $message = '<div class="table-responsive">
        <table style="background-color: #54c8ff; margin: 0px auto; padding: 30px; width:80%;">
            <tr>
                <td><center><img src="'. base_url('assets/website/images/register/logo.png').'" width="80%";></center></td>
            </tr>
            <tr>
                <td align="center"><br><font size="4px" color="white"><b>Berikut adalah kode verifikasi anda</b></font></td>
            </tr>
            <tr>
                <td align="center">
                    <p style="background-color:#308bfd; border: none; border-radius: 4px; width:250px; padding:10px; margin-top: 10px;"><font size="6px" color="white" style="letter-spacing: 7px;"><b>'. $key .'</b></font></p>
                </td>
            </tr>
        </table>
        </div>';

        $config = array(
            'charset' => 'utf-8',
            'wordwrap' => TRUE,
            'mailtype' => "html",
            );
        
        $this->email->initialize($config);
        $this->email->from($fromemail, "no-reply@kes.co.id");
        $this->email->to($toemail);
        $this->email->subject($subject);				
        $this->email->message($message);
        if($this->email->send())
        {
            $data = "sukses";
            echo json_encode($data);
        }
        else
        {
            echo $this->email->print_debugger();
        }		
    }

	public function register()
	{
        $akunKategori = $this->input->post('kategori');
        $datez = date('Y-m-d H:i:s');
        $login_type = 2; //login dari website
        if($akunKategori == "parents")
        {
            $member_type = "3";
            $parentEmail = $this->input->post('email');
            $parentPassword = $this->input->post('password');
            $parentNama = $this->input->post('name');
            $parentAgama = $this->input->post('agama'); 
            $parentAlamat = $this->input->post('alamat'); 
            $parentLahir = $this->input->post('lahir'); 
            $parentTelepon = $this->input->post('telephone'); 
            $parentKelamin = $this->input->post('kelamin');
            if($parentKelamin == "Pria")
            {
                $parentRelasi = "Ayah";
            }
            else
            {
                $parentRelasi = "Ibu";
            }
            $cekAvailable = $this->db->query("SELECT memberid FROM b_member WHERE email='$parentEmail'");
            $status = $cekAvailable->num_rows();

            if($status == 0)
            {
                $ins_db = array(
                    'fullname' => $parentNama,
                    'password' => password_hash(base64_encode($parentPassword), PASSWORD_DEFAULT),
                    'email' => $parentEmail,
                    'mobile_phone' => $parentTelepon,
                    'address' => $parentAlamat,
                    'gender' => $parentKelamin,
                    'religion' => $parentAgama,
                    'birth_date' => $parentLahir,
                    'member_type' => $member_type,
                    'publish' => 0,
                    'datez' => $datez,
                    'login_type_from' => $login_type,
                    'relation' => $parentRelasi		
                );
                $ins_query_db = $this->UserModel->save($ins_db);
                
                $key = "3581tiulpJakartaKids";
                $cipher="AES-128-CBC";
                $ivlen = openssl_cipher_iv_length($cipher);
                $iv = openssl_random_pseudo_bytes($ivlen);
                $ciphertext_raw = openssl_encrypt($parentEmail, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
                $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
                $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
                $email_encrypt = str_replace("/", " ", $ciphertext);

                $session_data = array(
                'email' => $email_encrypt 
                );
                $this->session->set_userdata($session_data);
                $email_session = $this->session->userdata('email');
                $subject = "Aktivasi Akun KES";
                $this->load->library('email');
                $fromemail = "info@kes.co.id";
                $toemail = $parentEmail;
                $subject = $subject;
                
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                                "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                </head><body>';
                
                $message = '<div class="table-responsive">
                <table style="background-color: #54c8ff; margin: 0px auto; padding: 30px; width:80%;">
                <tr>
                    <td><center><img src="' . base_url('assets/website/images/register/logo.png') . '" width="80%";></center></td>
                </tr>
                <tr>
                <td align="center"><br><font size="4px" color="white"><b>Terima kasih telah mendaftar di Kids Education System! Tinggal 1 langkah lagi anda dapat bergabung dengan kami..</b></font></td>
                </tr>
                <tr>
                <td align="center" ><br><font size="3px" color="white">Klik tombol di bawah ini untuk mengaktifkan ID anda</font></td>
                </tr>
                <tr>
                <td><br><a href="' . base_url() .'UserController/register_activation/'. $email_session . '/'. '"><center><button style="background-color:#308bfd; cursor: pointer; border: none; width:400px; padding:15px;"><font size="3px" color="white"><b>AKTIFKAN ID SAYA</b></font></button></center></a></td>
                </tr>
                </table>
                </div></body>';

                $config = array(
                    'charset' => 'utf-8',
                    'wordwrap' => TRUE,
                    'mailtype' => "html",
                    );
                
                $this->email->initialize($config);
                $this->email->from($fromemail, "no-reply@kes.co.id");
                $this->email->to($toemail);
                $this->email->subject($subject);				
                $this->email->message($message);
                if($this->email->send())
                {
                    $data = "sukses";
                    echo json_encode($data);
                }
                else
                {
                    echo $this->email->print_debugger();
                }		
            }
            else
            {
                $data = "ERREG001";
                echo json_encode($data);
            }
        }
        else
        {
            $member_type = "6";
            $userEmail = $this->input->post('email');
            $userPassword = $this->input->post('password');
            $userNama = $this->input->post('name');
            $userTelepon = $this->input->post('telephone'); 	

            $cekAvailable = $this->db->query("SELECT memberid FROM b_member WHERE email='$userEmail'");
            $status = $cekAvailable->num_rows();

            if($status == 0)
            {
                $ins_db = array(
                    'fullname' => $userNama,
                    'password' => password_hash(base64_encode($userPassword), PASSWORD_DEFAULT),
                    'email' => $userEmail,
                    'mobile_phone' => $userTelepon,
                    'member_type' => $member_type,
                    'publish' => 0,
                    'datez' => $datez,
                    'login_type_from' => $login_type			
                );
                $ins_query_db = $this->UserModel->save($ins_db);
                $key = "3581tiulpJakartaKids";
                $cipher="AES-128-CBC";
                $ivlen = openssl_cipher_iv_length($cipher);
                $iv = openssl_random_pseudo_bytes($ivlen);
                $ciphertext_raw = openssl_encrypt($userEmail, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
                $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
                $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
                $email_encrypt = str_replace("/", " ", $ciphertext);

                $session_data = array(
                'email' => $email_encrypt 
                );
                $this->session->set_userdata($session_data);
                $email_session = $this->session->userdata('email');
                $subject = "Aktivasi Akun KES";
                $this->load->library('email');
                $fromemail = "info@kes.co.id";
                $toemail = $userEmail;
                $subject = $subject;
                
                $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                                "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                </head><body>';
                
                $message = '<div class="table-responsive">
                <table style="background-color: #54c8ff; margin: 0px auto; padding: 30px; width:80%;">
                <tr>
                <td><center><img src="' . base_url('assets/website/images/register/logo.png') . '" width="80%";></center></td>
                </tr>
                <tr>
                <td align="center"><br><font size="4px" color="white"><b>Terima kasih telah mendaftar di Kids Education System! Tinggal 1 langkah lagi anda dapat bergabung dengan kami..</b></font></td>
                </tr>
                <tr>
                <td align="center"><br><font size="3px" color="white">Klik tombol di bawah ini untuk mengaktifkan ID anda</font></td>
                </tr>
                <tr>
                <td><br><a href="' . base_url() .'UserController/register_activation/'. $email_session . '/'. '"><center><button style="background-color:#308bfd; cursor: pointer; border: none; width:400px; padding:15px;"><font size="3px" color="white"><b>AKTIFKAN ID SAYA</b></font></button></center></a></td>
                </tr>
                </table>
                </div></body>';

                $config = array(
                    'charset' => 'utf-8',
                    'wordwrap' => TRUE,
                    'mailtype' => "html",
                    );
                
                $this->email->initialize($config);
                $this->email->from($fromemail, "no-reply@kes.co.id");
                $this->email->to($toemail);
                $this->email->subject($subject);				
                $this->email->message($message);
                if($this->email->send())
                {
                    $data = "sukses";
                    echo json_encode($data);
                }
                else
                {
                    echo $this->email->print_debugger();
                }		
            }
            else
            {
                $data = "ERREG001";
                echo json_encode($data);
            }
        } 
    }

    public function login()
	{
        $loginFrom = $this->input->post('loginFrom');

        if($loginFrom == "facebook")
        {
            $loginEmail = $this->input->post('loginEmail');
            $loginName = $this->input->post('loginName');
            $cekAvailable = $this->db->query("SELECT * FROM b_member WHERE email='$loginEmail'");
            $status = $cekAvailable->num_rows();
            $datez = date('Y-m-d H:i:s');

            if($status == 0)
            {     
                $login_type = 2; //login dari website
                $member_type = 6;

                $ins_db = array(
                    'fullname' => $loginName,
                    'email' => $loginEmail,
                    'member_type' => $member_type,
                    'publish' => 1,
                    'datez' => $datez,
                    'login_type_from' => $login_type,
                    'lastlogin' => $datez,
                    'lastupdate' => $datez				
                );
                $ins_query_db = $this->UserModel->save($ins_db);
                $session_data = array(
                    'userName' => $loginName,
                    'userEmail' => $loginEmail,
                    'loginFrom' => "facebook",
                );
                $this->session->set_userdata($session_data);
            }
            else
            {
                $upt_db = array(
                    'lastlogin' => $datez
                );
                $upd_query_db = $this->UserModel->save($upt_db, array('email' => $loginEmail));
                $dataUser = $cekAvailable->result_array();	
                $loginName = $dataUser[0]['fullname'];
                $session_data = array(
                    'userName' => $loginName,
                    'userEmail' => $loginEmail,
                    'loginFrom' => "facebook",
                );
                $this->session->set_userdata($session_data);
            }
            $data = "sukses";
            echo json_encode($data);
        }
        else if($loginFrom == "normal")
        {
            $loginEmail = $this->input->post('loginEmail');
            $loginPassword = $this->input->post('loginPassword');
            $cekUser = $this->db->query("SELECT * FROM b_member WHERE email='$loginEmail' AND publish = '1' AND (member_type = '3' OR member_type = '6')");
            $status = $cekUser->num_rows();
            $dataUser = $cekUser->result_array();	
            $datez = date('Y-m-d H:i:s');

            if($status == 0)
            {  
                $data = "ERLOG001";
                echo json_encode($data);
            }
            else
            {
                $userPassword = $dataUser[0]['password'];
                if (password_verify(base64_encode($loginPassword), $userPassword)) 
                {
                    $upt_db = array(
                        'lastlogin' => $datez
                    );
                    $upd_query_db = $this->UserModel->save($upt_db, array('email' => $loginEmail));
                    $userName = $dataUser[0]['fullname'];
                    $session_data = array(
                        'userName' => $userName,
                        'userEmail' => $loginEmail,
                        'loginFrom' => "normal",
                    );
                    $this->session->set_userdata($session_data);
                    $data = "sukses";
                    echo json_encode($data);
                } 
                else 
                {
                    $data = "ERLOG002";
                    echo json_encode($data);
                }
                
            }
        }
        else if($loginFrom == "gmail")
        {
            $loginEmail = $this->input->post('loginEmail');
            $loginName = $this->input->post('loginName');
            $cekAvailable = $this->db->query("SELECT * FROM b_member WHERE email='$loginEmail'");
            $status = $cekAvailable->num_rows();
            $datez = date('Y-m-d H:i:s');

            if($status == 0)
            {     
                $login_type = 2; //login dari website
                $member_type = 6;

                $ins_db = array(
                    'fullname' => $loginName,
                    'email' => $loginEmail,
                    'member_type' => $member_type,
                    'publish' => 1,
                    'datez' => $datez,
                    'login_type_from' => $login_type,
                    'lastlogin' => $datez			
                );
                $ins_query_db = $this->UserModel->save($ins_db);
                $session_data = array(
                    'userName' => $loginName,
                    'userEmail' => $loginEmail,
                    'loginFrom' => "gmail",
                );
                $this->session->set_userdata($session_data);
            }
            else
            {
                $upt_db = array(
                    'lastlogin' => $datez
                );
                $upd_query_db = $this->UserModel->save($upt_db, array('email' => $loginEmail));
                $dataUser = $cekAvailable->result_array();	
                $loginName = $dataUser[0]['fullname'];
                $session_data = array(
                    'userName' => $loginName,
                    'userEmail' => $loginEmail,
                    'loginFrom' => "gmail",
                );
                $this->session->set_userdata($session_data);
            }
            $data = "sukses";
            echo json_encode($data);
        }
    }
    
    public function update()
    {
        $userNama = $this->input->post('userNama');
        $userTelepon = $this->input->post('userTelepon');
        $userEmail = $this->session->userdata('userEmail');
        $datez = date('Y-m-d H:i:s');
        $upt_db = array(
            'fullname' => $userNama,
            'mobile_phone' => $userTelepon,
            'lastupdate' => $datez
        );
        $upd_query_db = $this->UserModel->save($upt_db, array('email' => $userEmail));
        $this->session->set_userdata('userName', $userNama);

        $member = $this->UserModel->getOne(array('email' => $userEmail));
        $menu_title = "MEMBER";
        $menu_desc =  "Edit Member Data from Website: $userNama";
        $menu_detail = "OLD<br>---<br> Name: $member->fullname <br> Mobile Phone: $member->mobile_phone <br><br>NEW<br>---<br> Name: $userNama <br> Mobile Phone: $userTelepon";
        $menu_action = "EDIT";
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        $ins_db = array(
            'member_id' => $member->memberid,
            'username' => $userNama,
            'menu_title' => $menu_title,
            'menu_desc' => $menu_desc,
            'menu_detail' => $menu_detail,
            'menu_action' => $menu_action,
            'datez' => $datez,
            'ipaddress' => $ipaddress
        );
        $ins_query_db = $this->ActivityModel->save($ins_db);
            
        $data = "sukses";
        echo json_encode($data);
    }

    public function update_parent()
    {
        $userEmail = $this->session->userdata('userEmail');
        $userName = $this->session->userdata('userName');
        $kategoriHubungan = $this->input->post('kategoriHubungan');
        $parentAlamat = $this->input->post('alamat');
        $parentAgama = $this->input->post('agama');
        $parentLahir = $this->input->post('lahir');
        if($kategoriHubungan == "Wali")
        {
            $waliKelamin = $this->input->post('kelamin');
        }
        elseif($kategoriHubungan == "Ayah")
        {
            $waliKelamin = "Pria";
        }
        else
        {
            $waliKelamin = "Wanita";
        }
        
        $datez = date('Y-m-d H:i:s');
        $upt_db = array(
            'address' => $parentAlamat,
            'gender' => $waliKelamin,
            'religion' => $parentAgama,
            'relation' => $kategoriHubungan,
            'birth_date' => $parentLahir,
            'lastupdate' => $datez
        );
        $upd_query_db = $this->UserModel->save($upt_db, array('email' => $userEmail));

        $member = $this->UserModel->getOne(array('email' => $userEmail));
        $menu_title = "MEMBER";
        $menu_desc =  "Upgrade Member to Parents: $userName";
        $menu_detail = "Penambahan data untuk menjadi orang tua";
        $menu_action = "UPGRADE MEMBER";
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        $ins_db = array(
            'member_id' => $member->memberid,
            'username' => $userName,
            'menu_title' => $menu_title,
            'menu_desc' => $menu_desc,
            'menu_detail' => $menu_detail,
            'menu_action' => $menu_action,
            'datez' => $datez,
            'ipaddress' => $ipaddress
        );
        $ins_query_db = $this->ActivityModel->save($ins_db);
        $data = "sukses";
        echo json_encode($data);
    }

    public function upload()
	{
        $upload_dir = './assets/images/profile';
        
        $userEmail = $this->session->userdata('userEmail');
        $cekAvailable = $this->db->query("SELECT picture FROM b_member WHERE email='$userEmail'");
        $userData = $cekAvailable->result_array();
        $userOldFoto = $userData[0]['picture'];
        
        if (isset($userOldFoto) && $userOldFoto <> "")
        {
            $fileglobss = $upload_dir."/"."ss_$userOldFoto";
            if (file_exists($fileglobss)) unlink ("assets/images/profile/ss_$userOldFoto");						
            $fileglobmm = $upload_dir."/"."mm_$userOldFoto";
            if (file_exists($fileglobmm)) unlink ("assets/images/profile/mm_$userOldFoto");
        }
        
        if(!empty($_FILES['userFoto']['name']))
        {
            $randomString = $this->RandomString(20);
            $file_name = "$randomString.jpg";
            $config['upload_path'] = $upload_dir;
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = "mm_$file_name";
            
            //Load upload library and initialize configuration
            $this->load->library('upload');
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('userFoto'))
            {
                $uploadData = $this->upload->data();
                
                $file_size = $uploadData['file_size'];
                $file_path = $uploadData['file_path'];
                $path_source = $uploadData['full_path'];
                
                $new_thumb = $file_path . "ss_$file_name";
                copy($path_source, $new_thumb);					  
                //print_r($uploadData);

                $config['image_library'] = 'gd2';
                $config['source_image'] = $path_source;
                $config['quality'] = '80';
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 300;
                $config['height'] = 300;                    
              
                $this->load->library('image_lib');
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();
                
                $config['image_library'] = 'gd2';
                $config['source_image'] = $new_thumb;
                $config['quality'] = '80';
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 100;
                $config['height'] = 100;                    
              
                $this->load->library('image_lib');
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();
                
                $picture = $file_name;
                
                if (isset($picture_old) && $picture_old <> "")
                {
                    $fileglobss = $upload_dir."/"."ss_$picture_old";
                    if (file_exists($fileglobss)) unlink ("assets/images/profile/ss_$picture_old");						
                    $fileglobmm = $upload_dir."/"."mm_$picture_old";
                    if (file_exists($fileglobmm)) unlink ("assets/images/profile/mm_$picture_old");
                }
            }
            else
            {
                $picture = '';
            }
            
        }
        else
        {
            $picture = $userOldFoto;
        }
        
        $upt_db = array(
            'picture' => $picture,
        );
        $upd_query_db = $this->UserModel->save($upt_db, array('email' => $userEmail));
        $data = "sukses";
        echo json_encode($data);
        
        /*
        if($userOldFoto != "")
        {
            $fileglobss = "./assets/website/images/user/".$userOldFoto;
            if (file_exists($fileglobss)) 
            {
                unlink ("assets/website/images/user/$userOldFoto");
            }						
            $type = explode('.', $_FILES["userFoto"]["name"]);
            $type = strtolower($type[count($type)-1]);
            $userFoto = uniqid(rand()).'.'.$type;
            $url = "./assets/website/images/user/".$userFoto;
            if(in_array($type, array("jpg", "jpeg", "png", "pdf")))
            if(is_uploaded_file($_FILES["userFoto"]["tmp_name"]))
            if(move_uploaded_file($_FILES["userFoto"]["tmp_name"],$url))
            {
            	$upt_db = array(
                    'picture' => $userFoto,
                );
                $upd_query_db = $this->UserModel->save($upt_db, array('email' => $userEmail));
                $data = "sukses";
                echo json_encode($data);
            }
            else
            {
            	return false;
            }
        }
        else
        {
            $type = explode('.', $_FILES["userFoto"]["name"]);
            $type = strtolower($type[count($type)-1]);
            $userFoto = uniqid(rand()).'.'.$type;
            $url = "./assets/website/images/user/".$userFoto;
            if(in_array($type, array("jpg", "jpeg", "png", "pdf")))
            if(is_uploaded_file($_FILES["userFoto"]["tmp_name"]))
            if(move_uploaded_file($_FILES["userFoto"]["tmp_name"],$url))
            {
            	$upt_db = array(
                    'picture' => $userFoto,
                );
                $upd_query_db = $this->UserModel->save($upt_db, array('email' => $userEmail));
                $data = "sukses";
                echo json_encode($data);
            }
            else
            {
            	return false;
            }
        }
        */
    }
    
    public function logout()
    {
        $loginFrom = $this->session->userdata('loginFrom');
        if($loginFrom == "facebook")
        {
            if($this->session->userdata('userName') == "")
            {
                return false;
            }
            else
            {
                $session_data = array(
                    'userName','userEmail','loginFrom'
                );
                $this->session->unset_userdata($session_data);
                $data = "sukses";
                echo json_encode($data);
            }
        }
        else if($loginFrom == "normal" || $loginFrom == "gmail"  )
        {
            $session_data = array(
                'userName','userEmail','loginFrom'
            );
            $this->session->unset_userdata($session_data);
            $data = "sukses";
            echo json_encode($data);
        }
    }

    public function set_new_password()
    {
        $newPassword = $this->input->post('newPassword');
        $emailMobile = $this->input->post('emailMobile');
        if($emailMobile!=""){
            $forgetEmail = $emailMobile;
            $query_db = array(
                'password' => password_hash(base64_encode($newPassword), PASSWORD_DEFAULT)
            );	
            $upd_query_db = $this->UserModel->save($query_db, array('email' => $forgetEmail));
            $data = "sukses";
            echo json_encode($data);
        }else{
            $forgetEmail = $this->session->userdata('forget-email');
            $query_db = array(
                'password' => password_hash(base64_encode($newPassword), PASSWORD_DEFAULT)
            );	
            $upd_query_db = $this->UserModel->save($query_db, array('email' => $forgetEmail));
            $this->session->unset_userdata('forget-email');
            $data = "sukses";
            echo json_encode($data);
        }
    }

    public function forget()
    {
        $forgetEmail = $this->input->post('forgetEmail');
        $cekAvailable = $this->db->query("SELECT memberid FROM b_member WHERE email='$forgetEmail'");
        $status = $cekAvailable->num_rows();
        if($status == "0")
        {
            $data = "ERRES001";
            echo json_encode($data);
        }
        else
        {
            $key = "3581tiulpJakartaKids";
            $cipher="AES-128-CBC";
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = openssl_random_pseudo_bytes($ivlen);
            $ciphertext_raw = openssl_encrypt($forgetEmail, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
            $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
            $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
            $email_encrypt = str_replace("/", " ", $ciphertext);

            $session_data = array(
            'forget-email' => $email_encrypt 
            );
            $this->session->set_userdata($session_data);
            $email_session = $this->session->userdata('forget-email');
            $subject = "Lupa password Akun KES";
            $this->load->library('email');
            $fromemail = "info@kes.co.id";
            $toemail = $forgetEmail;
            $subject = $subject;
            
            $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                            "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                            </head><body>';
            
            $message = '<div class="table-responsive">
            <table style="background-color: #54c8ff; margin: 0px auto; padding: 30px; width:80%;">
            <tr>
            <td><center><img src="' . base_url('assets/website/images/register/logo.png') . '" width="80%";></center></td>
            </tr>
            <tr>
            <td align="center"><br><font size="3px" color="white">Klik tombol di bawah ini untuk mengatur ulang akta sandi anda</font></td>
            </tr>
            <tr>
            <td><br><a href="' . base_url() .'UserController/forget_verification/'. $email_session . '/'. '"><center><button style="background-color:#308bfd; cursor: pointer; border: none; width:400px; padding:15px;"><font size="3px" color="white"><b>ATUR ULANG PASSWORD SAYA</b></font></button></center></a></td>
            </tr>
            </table>
            </div></body>';

            $config = array(
                'charset' => 'utf-8',
                'wordwrap' => TRUE,
                'mailtype' => "html",
                );
            
            $this->email->initialize($config);
            $this->email->from($fromemail, "no-reply@kes.co.id");
            $this->email->to($toemail);
            $this->email->subject($subject);				
            $this->email->message($message);
            if($this->email->send())
            {
                $data = "sukses";
                echo json_encode($data);
            }
            else
            {
                echo $this->email->print_debugger();
            }		
        }
    }

    public function forget_decrypt()
    {
        $emailMobile = $this->input->post('emailMobile');
        
        $key = "3581tiulpJakartaKids";
        $c = base64_decode($emailMobile);
        $cipher="AES-128-CBC";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = substr($c, 0, $ivlen);
        $sha2len=32;
        $hmac = substr($c, $ivlen, $sha2len);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $data = $original_plaintext;
        echo json_encode($data);
    }

    public function register_activation($email_session)
    {
        $email = trim($email_session);
        $email_decrypt = str_replace("%20", "/", $email);
        $key = "3581tiulpJakartaKids";
        $c = base64_decode($email_decrypt);
        $cipher="AES-128-CBC";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = substr($c, 0, $ivlen);
        $sha2len=32;
        $hmac = substr($c, $ivlen, $sha2len);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        
        $query_db = array(
            'publish' => 1,
        );	
        $upd_query_db = $this->UserModel->save($query_db, array('email' => $original_plaintext));
    	redirect('register-verification');
    }

    public function forget_verification($email_session)
    {
        $email = trim($email_session);
        $email_decrypt = str_replace("%20", "/", $email);
        $key = "3581tiulpJakartaKids";
        $c = base64_decode($email_decrypt);
        $cipher="AES-128-CBC";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = substr($c, 0, $ivlen);
        $sha2len=32;
        $hmac = substr($c, $ivlen, $sha2len);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $this->session->set_userdata('forget-email', $original_plaintext);
    	redirect('setting-password');
    }

    public function get_news()
    {
        $email = trim($email_session);
        $email_decrypt = str_replace("%20", "/", $email);
        $key = "3581tiulpJakartaKids";
        $c = base64_decode($email_decrypt);
        $cipher="AES-128-CBC";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = substr($c, 0, $ivlen);
        $sha2len=32;
        $hmac = substr($c, $ivlen, $sha2len);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
        $this->session->set_userdata('forget-email', $original_plaintext);
    	redirect('setting-password');
    }

    public function fillSekolah()
    {
        $tingkat = $this->input->get('tingkat');
        $provinsi = $this->input->get('provinsi');
        $kabupaten = $this->input->get('kabupaten');
        $kecamatan = $this->input->get('kecamatan');
        $sekolah = $this->input->get('sekolah');
        if($provinsi == "" && $kabupaten == "" && $kecamatan == "")
        {
            if($tingkat == "ALL")
            {
                $cekAvailable = $this->db->query("SELECT school_name,schoolid FROM b_school 
                WHERE school_name LIKE '%$sekolah%' 
                ORDER BY school_name 
                LIMIT 10");
                $data = $cekAvailable->result_array();
                echo json_encode($data);
            }
            else
            {
                $cekAvailable = $this->db->query("SELECT school_name,schoolid FROM b_school_detail 
                INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid
                WHERE school_name LIKE '%$sekolah%' AND jenjang_pendidikan = '$tingkat' 
                ORDER BY school_name 
                LIMIT 10");
                $data = $cekAvailable->result_array();
                echo json_encode($data);
            }
        }
        else if($provinsi != "" && $kabupaten == "" && $kecamatan == "")
        {
            if($tingkat == "ALL")
            {
                $cekAvailable = $this->db->query("SELECT school_name,schoolid FROM b_school_detail 
                INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid
                INNER JOIN provinsi on b_school_detail.provinsi_id = provinsi.provinsiid
                WHERE school_name LIKE '%$sekolah%' AND nama_provinsi = '$provinsi'
                ORDER BY school_name
                LIMIT 10");
                $data = $cekAvailable->result_array();
                echo json_encode($data);
            }
            else
            {
                $cekAvailable = $this->db->query("SELECT school_name,schoolid FROM b_school_detail 
                INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid
                INNER JOIN provinsi on b_school_detail.provinsi_id = provinsi.provinsiid
                WHERE school_name LIKE '%$sekolah%' AND nama_provinsi = '$provinsi' AND jenjang_pendidikan = '$tingkat'
                ORDER BY school_name
                LIMIT 10");
                $data = $cekAvailable->result_array();
                echo json_encode($data);
            }
        }
        else if($provinsi != "" && $kabupaten != "" && $kecamatan == "")
        {
            if($tingkat == "ALL")
            {
                $cekAvailable = $this->db->query("SELECT school_name FROM b_school_detail 
                INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid
                INNER JOIN provinsi on b_school_detail.provinsi_id = provinsi.provinsiid
                INNER JOIN kabupaten on b_school_detail.kabupaten_id = kabupaten.kabupatenid
                WHERE school_name LIKE '%$sekolah%' AND nama_provinsi = '$provinsi' AND nama_kabupaten = '$kabupaten'
                ORDER BY school_name
                LIMIT 10");
                $data = $cekAvailable->result_array();
                echo json_encode($data);
            }
            else
            {
                $cekAvailable = $this->db->query("SELECT school_name FROM b_school_detail 
                INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid
                INNER JOIN provinsi on b_school_detail.provinsi_id = provinsi.provinsiid
                INNER JOIN kabupaten on b_school_detail.kabupaten_id = kabupaten.kabupatenid
                WHERE school_name LIKE '%$sekolah%' AND nama_provinsi = '$provinsi' AND jenjang_pendidikan = '$tingkat' AND nama_kabupaten = '$kabupaten'
                ORDER BY school_name
                LIMIT 10");
                $data = $cekAvailable->result_array();
                echo json_encode($data);
            }
        }
        else if($provinsi != "" && $kabupaten != "" && $kecamatan != "")
        {
            if($tingkat == "ALL")
            {
                $cekAvailable = $this->db->query("SELECT school_name FROM b_school_detail 
                INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid
                INNER JOIN provinsi on b_school_detail.provinsi_id = provinsi.provinsiid
                INNER JOIN kabupaten on b_school_detail.kabupaten_id = kabupaten.kabupatenid
                INNER JOIN kecamatan on b_school_detail.kecamatan_id = kecamatan.kecamatanid
                WHERE school_name LIKE '%$sekolah%' AND nama_provinsi = '$provinsi' AND nama_kabupaten = '$kabupaten' AND nama_kecamatan = '$kecamatan'
                ORDER BY school_name
                LIMIT 10");
                $data = $cekAvailable->result_array();
                echo json_encode($data);
            }
            else
            {
                $cekAvailable = $this->db->query("SELECT school_name FROM b_school_detail 
                INNER JOIN b_school on b_school_detail.school_id = b_school.schoolid
                INNER JOIN provinsi on b_school_detail.provinsi_id = provinsi.provinsiid
                INNER JOIN kabupaten on b_school_detail.kabupaten_id = kabupaten.kabupatenid
                INNER JOIN kecamatan on b_school_detail.kecamatan_id = kecamatan.kecamatanid
                WHERE school_name LIKE '%$sekolah%' AND nama_provinsi = '$provinsi' AND nama_kabupaten = '$kabupaten' AND nama_kecamatan = '$kecamatan' AND jenjang_pendidikan = '$tingkat'
                ORDER BY school_name
                LIMIT 10");
                $data = $cekAvailable->result_array();
                echo json_encode($data);
            }
        }
    }

    public function getSekolahReact()
    {
        $key = $this->input->get('key');
        $cekAvailable = $this->db->query("SELECT school_name,schoolid FROM b_school 
        WHERE school_name LIKE '%$key%' 
        ORDER BY school_name 
        LIMIT 10");
        $data = $cekAvailable->result_array();
        echo json_encode($data);
    }
}
