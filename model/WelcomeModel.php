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
            "SELECT numberinvoice as InvoicesNumber, date as Date, company as Company, invoice.id
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
            "SELECT lastname as Lastname, firstname as Firstname, phone as Phone, email as Email, company as Company, people.id
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
            "SELECT company as Company, vatnumber as TVANumber, country as Country, typecompany as TypeCompany, id
            FROM company
            ORDER BY id DESC LIMIT 5";
        $stmt = $this->db->getInstance()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function deleteInvoices()
    {
        if(isset($_POST['del'])) {
            foreach($_POST['del'] as $value) {
                $deleteRes = $this->db->getInstance()->prepare("DELETE FROM invoice WHERE id = :id");
                $deleteRes -> execute([
                    'id' => $value,
                ]);
            }
        }
    }

    public function deleteContact()
    {
        if(isset($_POST['del'])) {
            foreach($_POST['del'] as $value) {
                $deleteRes = $this->db->getInstance()->prepare("DELETE FROM contact WHERE people.id = :id");
                $deleteRes -> execute([
                    'id' => $value,
                ]);
            }
        }
    }

    public function deleteCompanies()
    {
        if(isset($_POST['del'])) {
            foreach($_POST['del'] as $value) {
                $deleteRes = $this->db->getInstance()->prepare("DELETE FROM company WHERE company.id = :id");
                $deleteRes -> execute([
                    'id' => $value,
                ]);
            }
        }
    }
}