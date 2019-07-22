<?php
    class Pagination extends Database
    {
        public $page_result;
        public $table;
        public $total_pages;
        public $nb_result;
        public $limit_starting_nb;
        public $page;
        public function __construct($res,$table)
        {
            $this->page_result = $res;
            $this->table = $table;
        }
        public function paginate()
        {
            global $conn;
            $query = "SELECT * FROM " . $this->table;
            if($stmt = $conn->prepare($query))
            {
                if($stmt->execute())
                    $this->nb_result = $stmt->rowCount();
            }
            // determine numbers of total pages available
            $this->total_pages = ceil($this->nb_result/$this->page_result);
            //determine which page number visitor is currently on
            if (!isset($_GET['page']))
                $this->page = 1;
            else
                $this->page = $_GET['page'];
            // determine the sql limit startin number
            $this->limit_starting_nb = ($this->page - 1) * $this->page_result;

            $limit = $this->limit_starting_nb . ',' . $this->page_result;
            if($this->fetchpost("posts",$limit))
            {
                return 1;
            }
        }
    }