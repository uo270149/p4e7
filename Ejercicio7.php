<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Sofía Suárez Fernández UO270149" />
    <meta name="description" content="P4-Ejercicio7. Base de datos de temática libre." />
    <title>Ejercicio 7</title>
    <link rel="stylesheet" href="Ejercicio7.css" />
</head>

<body>
    <h1>Gestión UniOvi</h1>

    <nav>
        <ul>
            <li><a href="#baseEncabezado" title="Crear Base">Crear Base de Datos</a></li>
            <li><a href="#insertarEncabezado" title="Insertar Datos">Insertar datos</a></li>
            <li><a href="#buscarEncabezado" title="Buscar Datos">Buscar datos en una tabla</a></li>
            <li><a href="#eliminarEncabezado" title="Eliminar Datos">Eliminar datos de una tabla</a></li>
        </ul>
    </nav>

    <!-- CREAR BASE -->
    <h2 id="baseEncabezado">Crear Base de Datos</h2>
    <p>Crear base de datos</p>
    <form class="formBase" action='#' method='post'>
        <input type='submit' title="crearbase" class='button' name='crearBBDD' value="Crear BBDD" />
    </form>

    <!-- INSERTAR DATOS -->
    <h2 id="insertarEncabezado">Insertar Datos</h2>
    <p>Insertar datos en una tabla de la base</p>
    <form class="formBase" action='#' method='post'>
        <!-- DEPARTAMENTO -->
        <p>DEPARTAMENTO</p>
        <p>Nombre del departamento:<input type="text" title="nombredep" class="text" name="nombreDep" /> </p>
        <p>Ubicación del departamento:<input type="text" title="ubicaciondep" class="text" name="ubicacionDep" /> </p>
        <input type='submit' class='button' name='insertarDep' title="insertardep" value='Insertar Datos Departamento' />

        <!-- FACULTAD -->
        <p>FACULTAD</p>
        <p>Nombre de la facultad:<input type="text" title="nombrefac" class="text" name="nombreFac" /> </p>
        <p>Ubicación del departamento:<input type="text" title="ubicacionfac" class="text" name="ubicacionFac" /> </p>

        <input type='submit' class='button' title="insertarfac" name='insertarFac' value='Insertar Datos Facultad' />

        <!-- DOCENTE -->
        <p>DOCENTE</p>
        <p>Nombre del docente:<input type="text" title="nombredoc" class="text" name="nombreDoc" /> </p>
        <p>Apellidos del docente:<input type="text" title="apellidosdoc" class="text" name="apellidosDoc" /> </p>
        <p>Edad del docente:<input type="text" title="edaddoc" class="text" name="edadDoc" /> </p>
        <p>Sexo del docente:<input type="text" title="sexodoc" class="text" name="sexoDoc" /> </p>
        <p>ID departamento del docente:<input type="text" title="iddep" class="text" name="idDep" /> </p>
        <p>ID Facultad del docente:<input type="text" title="idfac" class="text" name="idFac" /> </p>
        <input type='submit' class='button' title="insertardoc" name='insertarDoc' value='Insertar Datos Docente' />
    </form>

    <!-- BUSCAR DATOS -->
    <h2 id="buscarEncabezado">Buscar Datos</h2>
    <p>Buscar datos en una tabla de la base de datos</p>
    <form class="formBase" action='#' method='post'>
        <p>Mostrar datos almacenados:
            <input type='submit' title="buscar" class='button' name='buscar' value="Mostrar Datos" /></p>
    </form>

    <!-- ELIMINAR DATOS -->
    <h2 id="eliminarEncabezado">Eliminar Datos</h2>
    <p>Eliminar datos de una tabla de la base de datos</p>
    <form class="formBase" action='#' method='post'>
        <p>ID a eliminar:<input type="text" class="text" id="id" /></p>

        <input type='submit' title="deletedep" class='button' name='deleteDep' value="Eliminar Departamento" />
        <input type='submit' title="deletefac" class='button' name='deleteFac' value="Eliminar Facultad" />
        <input type='submit' title="deletedoc" class='button' name='deleteDoc' value="Eliminar Docente" />
    </form>

    <?php
    class BaseDatos
    {
        private $server;
        private $username;
        private $password;
        private $database;

        public function __construct()
        {
            $this->server = "localhost";
            $this->username = "DBUSER2020";
            $this->password = "DBPSWD2020";
            $this->database = "uniovi_php";
        }

        public function createDataBase()
        {
            $db = new mysqli($this->server, $this->username, $this->password, $this->database);

            $query = "CREATE DATABASE IF NOT EXISTS uniovi_php COLLATE utf8_spanish_ci";

            if ($db->query($query) === TRUE) {
                echo "<p id=\"confirm\">La base de datos 'uniovi_php' ha sido creada con éxito.</p>";
            } else {
                echo "<p id=\"confirm\">La base de datos ya existe o no se ha podido crear.</p>";
                exit();
            }
            $db->close();
        }

        public function createTable()
        {
            $db = new mysqli($this->server, $this->username, $this->password, $this->database);

            $query = "CREATE TABLE IF NOT EXISTS Departamento(
                id INT NOT NULL AUTO_INCREMENT,
                nombre VARCHAR(255),
                ubicacion VARCHAR(255),
                PRIMARY KEY (id)
            );";

            if ($db->query($query) === TRUE)
                echo "<p id=\"confirm\">La tabla 'Departamento' ha sido creada con éxito.</p>";
            else {
                echo "<p id=\"confirm\">La tabla 'Departamento' ya existe o no se ha podido crear.</p>";
                exit();
            }

            $query = "CREATE TABLE IF NOT EXISTS Facultad(
                id INT NOT NULL AUTO_INCREMENT,
                nombre VARCHAR(255),
                ubicacion VARCHAR(255),
                PRIMARY KEY(id)
            );";

            if ($db->query($query) === TRUE)
                echo "<p id=\"confirm\">La tabla 'Facultad' ha sido creada con éxito.</p>";
            else {
                echo "<p id=\"confirm\">La tabla 'Facultad' ya existe o no se ha podido crear.</p>";
                exit();
            }

            $query = "CREATE TABLE IF NOT EXISTS Docente(
                id INT NOT NULL AUTO_INCREMENT,
                nombre VARCHAR(255),
                apellidos VARCHAR(255),
                edad INT,
                sexo VARCHAR(20),
                id_departamento INT,
                id_facultad INT,
                PRIMARY KEY(id),
                FOREIGN KEY(id_departamento) REFERENCES departamento(id), 
                FOREIGN KEY(id_facultad) REFERENCES facultad(id)
            );";

            if ($db->query($query) === TRUE)
                echo "<p id=\"confirm\">La tabla 'Docente' ha sido creada con éxito.</p>";
            else {
                echo "<p id=\"confirm\">La tabla 'Docente' ya existe o no se ha podido crear.</p>";
                exit();
            }

            $db->close();
        }

        public function insertDataDepartamento()
        {
            $db = new mysqli($this->server, $this->username, $this->password, $this->database);

            $query = $db->prepare("INSERT INTO Departamento(nombre, ubicacion) VALUES (?, ?);");

            if (empty($_POST['nombreDep']) || empty($_POST['ubicacionDep'])) {
                echo "<p id=\"confirm\">No se puede realizar la inserción en la tabla 'Departamento', faltan campos por completar.</p>";
            } else {
                $query->bind_param('ss', $_POST['nombreDep'], $_POST['ubicacionDep']);

                $query->execute();

                echo "<p id=\"confirm\">Inserción de datos en 'Departamento' realizada con éxito.</p>";

                $query->close();
            }

            $db->close();
        }

        public function insertDataFacultad()
        {
            $db = new mysqli($this->server, $this->username, $this->password, $this->database);

            $query = $db->prepare("INSERT INTO Facultad(nombre, ubicacion) VALUES (?, ?);");

            if (empty($_POST['nombreFac']) || empty($_POST['ubicacionFac'])) {
                echo "<p id=\"confirm\">No se puede realizar la inserción en la tabla 'Facultad', faltan campos por completar.</p>";
            } else {
                $query->bind_param('ss', $_POST['nombreFac'], $_POST['ubicacionFac']);

                $query->execute();

                echo "<p id=\"confirm\">Inserción de datos en 'Facultad' realizada con éxito.</p>";

                $query->close();
            }

            $db->close();
        }

        public function insertDataDocente()
        {
            $db = new mysqli($this->server, $this->username, $this->password, $this->database);

            $query = $db->prepare("INSERT INTO Docente(nombre, apellidos, edad, sexo, id_departamento, id_facultad) VALUES (?, ?, ?, ?, ?, ?);");

            if (empty($_POST['nombreDoc']) || empty($_POST['apellidosDoc']) || empty($_POST['edadDoc']) || empty($_POST['sexoDoc']) || empty($_POST['idDep']) || empty($_POST['idFac'])) {
                echo "<p id=\"confirm\">No se puede realizar la inserción en la tabla 'Docente', faltan campos por completar.</p>";
            } else {
                $query->bind_param('ssisii', $_POST['nombreDoc'], $_POST['apellidosDoc'], $_POST['edadDoc'], $_POST['sexoDoc'], $_POST['idDep'], $_POST['idFac']);

                $query->execute();

                echo "<p id=\"confirm\">Inserción de datos en 'Docente' realizada con éxito.</p>";

                $query->close();
            }

            $db->close();
        }

        public function searchDataDepartamento()
        {
            if (empty($_POST['id'])) {
                echo "<p id=\"confirm\">Introduzca el ID del departamento.</p>";
            }

            $db = new mysqli($this->server, $this->username, $this->password, $this->database);

            $query = $db->prepare("SELECT * FROM Departamento WHERE id = ?");

            $query->bind_param('i', $_POST['id']);

            $query->execute();

            $result = $query->get_result();

            if ($result->num_rows >= 1) {
                echo "<h2>Datos del Departamento con ID solicitado:</h2>";

                echo "<ul>";

                while ($row = $result->fetch_assoc()) {
                    echo "<li>ID del departamento: " . $row["id"] . "</li>";
                    echo "<li>Nombre del departamento: " . $row["nombre"] . "</li>";
                    echo "<li>Ubicación del departamento: " . $row["ubicacion"] . "</li>";
                }

                echo "</ul>";
            }

            $query->close();
            $db->close();
        }

        public function searchDataFacultad()
        {
            if (empty($_POST['id'])) {
                echo "<p id=\"confirm\">Introduzca el ID de la facultad.</p>";
            }

            $db = new mysqli($this->server, $this->username, $this->password, $this->database);

            $query = $db->prepare("SELECT * FROM Facultad WHERE id = ?");

            $query->bind_param('i', $_POST['id']);

            $query->execute();

            $result = $query->get_result();

            if ($result->num_rows >= 1) {
                echo "<h2>Datos de la Facultad con ID solicitado:</h2>";

                echo "<ul>";

                while ($row = $result->fetch_assoc()) {
                    echo "<li>ID de la facultad: " . $row["id"] . "</li>";
                    echo "<li>Nombre de la facultad: " . $row["nombre"] . "</li>";
                    echo "<li>Ubicación de la facultad: " . $row["ubicacion"] . "</li>";
                }

                echo "</ul>";
            }

            $query->close();
            $db->close();
        }

        public function searchDataDocente()
        {
            if (empty($_POST['id'])) {
                echo "<p id=\"confirm\">Introduzca el ID del docente.</p>";
            }

            $db = new mysqli($this->server, $this->username, $this->password, $this->database);

            $query = $db->prepare("SELECT * FROM Docente WHERE id = ?");

            $query->bind_param('i', $_POST['id']);

            $query->execute();

            $result = $query->get_result();

            if ($result->num_rows >= 1) {
                echo "<h2>Datos del Docente con ID solicitado:</h2>";

                echo "<ul>";

                while ($row = $result->fetch_assoc()) {
                    echo "<li>ID del docente: " . $row["id"] . "</li>";
                    echo "<li>Nombre del docente: " . $row["nombre"] . "</li>";
                    echo "<li>Apellidos del docente: " . $row["apellidos"] . "</li>";
                    echo "<li>Edad del docente: " . $row["edad"] . "</li>";
                    echo "<li>Sexo del docente: " . $row["sexo"] . "</li>";
                    echo "<li>Departamento del docente: " . $row["id_departamento"] . "</li>";
                    echo "<li>Facultad del docente: " . $row["id_facultad"] . "</li>";
                }

                echo "</ul>";
            }

            $query->close();
            $db->close();
        }

        public function deleteDataDepartamento()
        {
            if (empty($_POST['id'])) {
                echo "<p id=\"confirm\">Introduzca el ID del departamento.</p>";
            }

            $db = new mysqli($this->server, $this->username, $this->password, $this->database);

            $query = $db->prepare("DELETE FROM Departamento WHERE id = ?");

            $query->bind_param('i', $_POST['id']);

            $query->execute();

            $query->close();

            echo "<p id=\"confirm\">Datos eliminados de 'Departamento' con éxito.</p>";

            $db->close();
        }

        public function deleteDataFacultad()
        {
            if (empty($_POST['id'])) {
                echo "<p id=\"confirm\">Introduzca el ID de la facultad.</p>";
            }

            $db = new mysqli($this->server, $this->username, $this->password, $this->database);

            $query = $db->prepare("DELETE FROM Facultad WHERE id = ?");

            $query->bind_param('i', $_POST['id']);

            $query->execute();

            $query->close();

            echo "<p id=\"confirm\">Datos eliminados de 'Facultad' con éxito.</p>";

            $db->close();
        }

        public function deleteDataDocente()
        {
            if (empty($_POST['id'])) {
                echo "<p id=\"confirm\">Introduzca el ID del docente.</p>";
            }

            $db = new mysqli($this->server, $this->username, $this->password, $this->database);

            $query = $db->prepare("DELETE FROM Docente WHERE id = ?");

            $query->bind_param('i', $_POST['id']);

            $query->execute();

            $query->close();

            echo "<p id=\"confirm\">Datos eliminados de 'Docente' con éxito.</p>";

            $db->close();
        }

        public function loadData($filename, $table)
        {
            $db = new mysqli($this->server, $this->username, $this->password, $this->database);

            $file = fopen($filename, "r");

            while (($data = fgetcsv($file, ",")) == true) {
                if ($table == 1) {
                    $query = $db->prepare("INSERT INTO Departamento VALUES (?, ?, ?);");
                    $query->bind_param('iss', $data[0], $data[1], $data[2]);
                    $query->execute();
                } elseif ($table == 2) {
                    $query = $db->prepare("INSERT INTO Facultad VALUES (?, ?, ?);");
                    $query->bind_param('iss', $data[0], $data[1], $data[2]);
                    $query->execute();
                } else {
                    $query = $db->prepare("INSERT INTO Docente VALUES (?, ?, ?, ?, ?, ?, ?);");
                    $query->bind_param('issisii', $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]);
                    $query->execute();
                }
            }
            $query->close();

            echo "<p id=\"confirm\">Datos cargados con éxito.</p>";

            $db->close();
        }
    }

    if (!isset($_SESSION['db'])) {
        $_SESSION['db'] = new BaseDatos();
    }
    $db = $_SESSION['db'];

    if (count($_POST) > 0) {
        if (isset($_POST["crearBBDD"])) {
            $db->createDataBase();
            $db->createTable();
            $db->loadData("departamentos.csv", 1);
            $db->loadData("facultdes.csv", 2);
            $db->loadData("docentes.csv", 3);
        } else if (isset($_POST['insertarDep'])) {
            $db->insertDataDepartamento();
        } else if (isset($_POST['insertarFac'])) {
            $db->insertDataFacultad();
        } else if (isset($_POST['insertarDoc'])) {
            $db->insertDataDocente();
        } else if (isset($_POST["buscar"])) {
            $db->searchDataDepartamento();
            $db->searchDataFacultad();
            $db->searchDataDocente();
        } else if (isset($_POST['deleteDep'])) {
            $db->deleteDataDepartamento();
        } else if (isset($_POST['deleteFac'])) {
            $db->deleteDataFacultad();
        } else if (isset($_POST['deleteDoc'])) {
            $db->deleteDataDocente();
        }
    }
    ?>

    <footer>
        <p>Autor: Sofía Suárez Fernández. Universidad de Oviedo. Software y Estándares para la Web</p>
        <a href="http://validator.w3.org/check/referer" hreflang="en-us">
            <img src="valid-html5-button.png" alt="¡HTML5 válido!" height="31" width="88" /></a>
        <a href="http://jigsaw.w3.org/css-validator/check/referer">
            <img style="border:0;width:88px;height:31px" src="http://jigsaw.w3.org/css-validator/images/vcss" alt="¡CSS Válido!" /></a>
    </footer>
</body>

</html>