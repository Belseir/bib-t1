<?php
include('conexion.php');

class Loan
{
    public $id = null;
    public $user_id = null;
    public $book_id = null;
    public $since = null;
    public $till = null;
    public $debt = null;
    public $paid = null;

    public function validateSave()
    {
        if (
            $this->user_id &&
            $this->book_id &&
            $this->since &&
            $this->till &&
            $this->debt
        )
            return true;
        return false;
    }

    public function validateUpdate()
    {
        if (
            $this->id && ($this->till ||
                $this->debt || $this->paid)
        )
            return true;
        return false;
    }
}

class LoanManager
{
    function save(Loan $loan)
    {
        $connection = new Conexion();
        $db = $connection->db;

        $sql = "INSERT INTO loans(user_id, book_id, since, till, debt) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);

        $stmt->bind_param('iissd', $loan->user_id, $loan->book_id, $loan->since, $loan->till, $loan->debt);

        $stmt->execute();
    }

    function update(Loan $loan)
    {
        $connection = new Conexion();
        $db = $connection->db;


        $sql = "UPDATE loans SET till = COALESCE(?, till), debt = COALESCE(?, debt), paid = COALESCE(?, paid) WHERE id = ?";
        $stmt = $db->prepare($sql);

        $stmt->bind_param('sidd', $loan->till, $loan->debt, $loan->paid, $loan->id);

        $stmt->execute();
    }


    function remove($id)
    {
        $connection = new Conexion();
        $db = $connection->db;

        $sql = "DELETE FROM loans WHERE id = ?";
        $stmt = $db->prepare($sql);

        $stmt->bind_param('i', $id);

        $stmt->execute();
    }

    function get($id = false)
    {
        $connection = new Conexion();
        $db = $connection->db;

        if ($id) {
            $sql = "SELECT loans.id, loans.since, loans.till, loans.debt, loans.paid, personas.nombre, personas.apellido, personas.telefono, libros_d.Titulo, libros_d.Autor FROM ((`loans` 
                    INNER JOIN personas ON loans.user_id = personas.id) 
                    INNER JOIN libros_d ON loans.book_id = libros_d.id_libro) WHERE loans.id = ? AND paid = 0;";

            $stmt = $this->db->prepare($sql);

            $stmt->bind_param('i', $id);
        } else {
            $sql = "SELECT loans.id, loans.since, loans.till, loans.debt, loans.paid, personas.nombre, personas.apellido, personas.telefono, libros_d.Titulo, libros_d.Autor FROM ((`loans` 
            INNER JOIN personas ON loans.user_id = personas.id) 
            INNER JOIN libros_d ON loans.book_id = libros_d.id_libro) WHERE paid = 0";

            $stmt = $db->prepare($sql);
        };

        $stmt->execute();
        $result = mysqli_stmt_get_result($stmt);

        return $result;
    }
}
