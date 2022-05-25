<?php
include("../libreria/loan.php");
include("../libreria/persona.php");
include("../libreria/libro_d.php");

include("menu_bs.php");

?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.css" />
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.12.1/datatables.min.js"></script>

<div class="row">

    <div style="margin-top: 20px;" class="col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Prestamos</div>
            <table id="loan-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Persona</th>
                        <th class="text-center">Telefono</th>
                        <th class="text-center">Libro</th>
                        <th class="text-center">Autor</th>
                        <th class="text-center">Desde</th>
                        <th class="text-center">Hasta</th>
                        <th class="text-center">Importe/dia</th>
                        <th class="text-center">Importe Total</th>
                        <th class="text-center">Pago</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $loanManager = new LoanManager();
                        $loans = $loanManager->get();

                        while ($row = $loans->fetch_assoc()) {
                            $now = time();
                            $start = strtotime($row['since']);
                            $end = strtotime($row['till']);
                            $datediff = $now - $start;
                            $daysFromStart = round($datediff / (60 * 60 * 24));
                            $datediff = $now - $end;
                            $daysFromEnd = round($datediff / (60 * 60 * 24));

                            $persona = $row['nombre'] . " " . $row['apellido'];
                            $currentDebt = $row['debt'] * $daysFromStart;

                            if ($daysFromEnd > 0) {
                                echo "
                                <tr id='{$row['id']}' style='background-color: #FFCCCC'>
                                    <td>{$persona}</td>
                                    <td>{$row['telefono']}</td>
                                    <td>{$row['Titulo']}</td>
                                    <td>{$row['Autor']}</td>
                                    <td>{$row['since']}</td>
                                    <td>{$row['till']}</td>
                                    <td>{$row['debt']}</td>
                                    <td>{$currentDebt}</td>
                                    <td>
                                        <input type='checkbox' class='checkbox' name='paid' value='{$row['paid']}'/>
                                    </td>
                                </tr>
                                ";
                            } else {
                                echo "
                                <tr id='{$row['id']}' style='background-color: #fff'>
                                    <td>{$persona}</td>
                                    <td>{$row['telefono']}</td>
                                    <td>{$row['Titulo']}</td>
                                    <td>{$row['Autor']}</td>
                                    <td>{$row['since']}</td>
                                    <td>
                                        <input type='date'  name='till' value='{$row['till']}'></input>
                                    </td>
                                    <td>
                                        <input type='number' name='debt' value='{$row['debt']}' min=0></input>
                                    </td>
                                    <td>{$currentDebt}</td>
                                    <td>
                                        <input type='checkbox' name='paid' class='checkbox' value='{$row['paid']}'/>
                                    </td>
                                </tr>
                                ";
                            }
                        }   
                    ?>
                </tbody>
            </table>
        </div>

        <div class="col-sm-8">
            <form id="new-loan" class="form-inline" method="POST">
                <div class="form-group">
                    <input id="user-id" class="form-control" name="user_id" list="users" placeholder="User">
                    <datalist id="users">
                        <?php
                            $persona = new Persona();
                            $users = $persona->buscar('');

                            foreach ($users as $user) {
                                $username = $user['nombre'] . " " . $user['apellido'];
                                echo "<option data-value='{$user['id']}' value='{$username}'></option>";
                            }
                        ?>
                    </datalist>

                    <input id="book-id" class="form-control" name="book_id" list="books" placeholder="Book">
                    <datalist id="books">
                        <?php
                            $libro_d = new Libro_d();
                            $books = $libro_d->mostrar_todos();

                            foreach ($books as $book) {
                                $titulo = $book['Titulo'];
                                echo "<option data-value='{$book['id_libro']}' value='{$titulo}'></option>";
                            }
                        ?>
                    </datalist>
                </div>
                <div class="form-group">
                    <input class="form-control" name="since" type='date' value='<?php echo $mysqldate = date('Y-m-d', time()); ?>'>
                    <input class="form-control" name="till" type='date'>
                </div>
                <div class="input-group">
                    <div class="input-group-addon">$</div>
                    <input class="form-control" name="debt" type='text' placeholder="Importe/dia">
                    <div class="input-group-addon">.00</div>
                </div>


                <button id="submit-button" type="submit" class="btn btn-primary btn-sm">Nuevo</button>
                <form>

        </div>
        <div class="col-sm-4 text-right">
            <button type="button" id="update-button" class="btn btn-primary btn-sm">Actualizar Modificados</button>
        </div>

        <script src="../public/js/loans.js"></script>
    </div>
</div>
</div>
</body>

</html>