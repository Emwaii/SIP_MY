<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_JadwalTeknisi extends CI_Model
{
    private $_table = "jadwal_teknisi";

    public function getAllJadtek()
    {
        $this->db->select('*');
        $this->db->from('jadwal_teknisi');
        $this->db->join('produk', 'produk.id_produk = jadwal_teknisi.id_produk');
        $query = $this->db->get();
        return  $query->result();
    }

    public function simpandatajadtek($data)
    {
        $this->db->insert('jadwal_teknisi', $data);
        return TRUE;
    }
    
    public function simpandataterjadwal($data)
    {
        $this->db->insert('teknisi_terjadwal', $data);
        return TRUE;
    }

    public function _uploadFileInvoice()
    {
        $config['upload_path']          = './upload/teknisi/file_invoice/';
		$config['allowed_types']        = 'pdf|doc|docx';
        // $config['file_name']            = $this->input->post('nama_brosur');
        $config['encrypt_name']         = false;
        $config['overwrite']            = true;
        $config['max_size']             = 5094; // 1MB

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_invoice')) {
            return $this->upload->data("file_name");
        }
        // print_r($this->upload->display_errors());
        return "default.pdf";
    }
    public function _uploadFileBuktiBayar()
    {
        $config1['upload_path']          = './upload/teknisi/bukti_bayar/';
		$config1['allowed_types']        = 'pdf|doc|docx';
        // $config['file_name']            = $this->input->post('nama_brosur');
        $config1['encrypt_name']         = false;
        $config1['overwrite']            = true;
        $config1['max_size']             = 5094; // 1MB

        $this->load->library('upload', $config1);

        if ($this->upload->do_upload('file_jadwal_teknisi')) {
            return $this->upload->data("file_name");
        }
        // print_r($this->upload->display_errors());
        return "default.pdf";
    }
    

    public function getID($id)
    {
        return $this->db->get_where('jadwal_teknisi', ['id' => $id])->row();
    }

   
    public function del_jadtek($id)
    {
        return $this->db->delete('jadwal_teknisi', array("id_jadwal" => $id));
    }

    public function update_jadtek($data, $id)
    {
        $this->db->update('jadwal_teknisi', $data, $id);
        return TRUE;
    }
}