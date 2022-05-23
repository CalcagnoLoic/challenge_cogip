<?php

namespace app\model;

use app\model\Database;
use \PDO;

class WelcomeModel
{
    public $db;

    public function __construct()
    {
        return $this->db = new Database();
    }

    public function readLastInvoices()
    {
        $query = 
            "SELECT numberinvoice, date , company 
            FROM invoice
            INNER JOIN company 
            on invoice.id = company.id 
            ORDER BY date DESC LIMIT 5";
        $stmt = $this->db->getInstance()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function readLastContact()
    {
        $query2 = 
            "SELECT lastname, firstname, phone, email, company
            FROM people 
            INNER JOIN company
                on people.id_company = company.id
            ORDER BY people.id DESC LIMIT 5
            ";
        $stmt = $this->db->getInstance()->prepare($query2);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function readLastCompanies()
    {
        $query = 
            "SELECT company, vatnumber, country, type 
            FROM people 
            INNER JOIN company 
                on people.id = company.id 
            INNER JOIN type 
                on company.id = type.id 
                ORDER BY people.id DESC LIMIT 5";
        $stmt = $this->db->getInstance()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}