<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Core_Model extends CI_Model {

	private $numRowsNoLimit = 0;

	function __construct() {
		parent::__construct();
	}
	
	public function truncate() {
		$this->db->truncate($this->tableName);
	}

	public function getNumRows() {
		return $this->numRowsNoLimit;
	}

	public function getAll($limit = 0, $offset = 0, $fields = array(), $joins = array(), $order = array()) {
		$results = false;

		$this->db->from($this->tableName);

		if (isset($joins) && is_array($joins) && count($joins) > 0) {
			foreach ($joins as $join) {
				$this->db->join($join['table'], $join['on'], $join['dir']);
			}
		}
		$query = $this->db->get();
		if (isset($query)) {
			$results = $query->result();
		}
		$this->numRowsNoLimit = count($results);

		if (count($fields) > 0) {
			$this->db->select(implode(",", $fields));
		}

		$this->db->from($this->tableName);
		$this->db->limit($limit, $offset);

		if (isset($joins) && is_array($joins) && count($joins) > 0) {
			foreach ($joins as $join) {
				$this->db->join($join['table'], $join['on'], $join['dir']);
			}
		}

		if(count($order) > 0){
            $this->db->order_by($order[0],$order[1]);
        }

		$query = $this->db->get();
		if (isset($query)) {
			$results = $query->result();
		}
		return $results;
	}

	public function getByCriteria($criteria = array(), $fields = array(), $limit = 0, $offset = 0, $joins = array(), $order = array()) {
		$results = false;
		
		if (count($fields) > 0) {
			$this->db->select(implode(",", $fields));
		}

		$this->db->from($this->tableName);

		if (isset($joins) && is_array($joins) && count($joins) > 0) {
			foreach ($joins as $join) {
				$this->db->join($join['table'], $join['on'], $join['dir']);
			}
		}

		$this->db->where($criteria);

		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}
		
		if(count($order) > 0){
            $this->db->order_by($order[0],$order[1]);
        }

		$query = $this->db->get();
		if (isset($query)) {
			$results = $query->result();
		}

		return $results;
	}

	public function getByKeyword($keyColumn = "", $keyWord = "", $criteria = array(), $fields = array(), $limit = 0, $offset = 0, $joins = array()) {
		$this->db->from($this->tableName);
		$this->db->where($criteria);
		$this->db->where($keyColumn . " LIKE '%" . $keyWord . "%'");
		$query = $this->db->get();
		if (isset($query)) {
			$results = $query->result();
		}
		$this->numRowsNoLimit = count($results);

		$results = false;

		if (count($fields) > 0) {
			$this->db->select(implode(",", $fields));
		}

		$this->db->from($this->tableName);
		$this->db->where($criteria);
		$this->db->where($keyColumn . " LIKE '%" . $keyWord . "%'");

		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}
        if (isset($joins) && is_array($joins) && count($joins) > 0) {
            foreach ($joins as $join) {
                $this->db->join($join['table'], $join['on'], $join['dir']);
            }
        }
		$query = $this->db->get();
		if (isset($query)) {
			$results = $query->result();
		}

		return $results;
	}

	public function getOne($criteria = array(), $fields = array(), $joins = array()) {
		$result = false;

		$results = $this->getByCriteria($criteria, $fields, 0, 0, $joins);
		if (isset($results) && isset($results[0])) {
			$result = $results[0];
		}

		return $result;
	}

	public function save($data, $criteria = array()) {
		$id = -1;
		
		if (count($criteria) > 0) {
			$this->db->where($criteria);
			$this->db->update($this->tableName, $data);
		} else {
			$this->db->insert($this->tableName, $data);
			$id = $this->db->insert_id();
		}
		
		return $id;
	}

	public function delete($criteria = array()) {
		$this->db->where($criteria);
		$this->db->delete($this->tableName);
	}

}
