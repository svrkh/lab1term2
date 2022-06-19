<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO</title>
</head>

<body>
    <?php include "conn.php" ?>
    <p>Вариант 0. КИУКИ-19-4, Смирнов Владислав</p>
    <form action="" method="get">
        <p><strong> Информация о книгах издательства: </strong>
            <select name="publisher" id="publisher">
                <?php
                $sql = "SELECT DISTINCT publisher FROM $db.LITERATURE";
                $sql = $dbh->query($sql);
                foreach ($sql as $cell) {
                    echo "<option> $cell[0] </option>";
                }
                ?>
            </select>
            <button>ОК</button>
        </p>
    </form>
    <form action="" method="get">
        <p><strong>Информация о книгах, журналах, газетах, опубликованных за указанный период:</strong>
            <select name="year_min" id="year_min">
                <?php
                $sql = "SELECT DISTINCT year FROM $db.LITERATURE";
                $sql = $dbh->query($sql);
                foreach ($sql as $cell) {
                    if ($cell[0] == 0)
                        continue;
                    else
                        echo "<option> $cell[0] </option>";
                }
                $sql = "Select distinct year(date) from $db.LITERATURE";
                $sql = $dbh->query($sql);
                foreach ($sql as $cell) {
                    if ($cell[0] == 0)
                        continue;
                    else
                        echo "<option> $cell[0] </option>";
                }
                ?>
            </select>
            <select name="year_max" id="year_max">
                <?php
                $sql = "SELECT DISTINCT year FROM $db.LITERATURE";
                $sql = $dbh->query($sql);
                foreach ($sql as $cell) {
                    if ($cell[0] == 0)
                        continue;
                    else
                        echo "<option> $cell[0] </option>";
                }
                $sql = "Select distinct year(date) from $db.LITERATURE";
                $sql = $dbh->query($sql);
                foreach ($sql as $cell) {
                    if ($cell[0] == 0)
                        continue;
                    else
                        echo "<option> $cell[0] </option>";
                }
                ?>
            </select>
            <button>ОК</button>
        </p>
    </form>
    <form action="" method="get">
        <p><strong> Вывести информацию о книгах автора: </strong>
            <select name="author" id="author">
                <?php
                $sql = "SELECT DISTINCT name FROM $db.authors";
                $sql = $dbh->query($sql);
                foreach ($sql as $cell) {
                    echo "<option> $cell[0] </option>";
                }
                ?>
            </select>
            <button>ОК</button>
        </p>
    </form>

    <?php
    if(isset($_GET['publisher'])){
        $publisher = $_GET['publisher'];
        $literate = "Book";
        $sqlSelect = $dbh->prepare(
            "SELECT * FROM $db.LITERATURE 
            JOIN $db.BOOK_AUTHORS 
            on $db.LITERATURE.ID_BOOK = $db.BOOK_AUTHORS.FID_BOOK
            JOIN $db.AUTHORS 
            on $db.BOOK_AUTHORS.FID_AUTHORS = $db.AUTHORS.ID_AUTHORS
            where $db.LITERATURE.LITERATE = :literate and $db.LITERATURE.publisher = :publisher"
        );
        $sqlSelect->execute(array('literate' => $literate, 'publisher' => $publisher));
        echo "Таблица перовго запроса: <table border=1> <tr><th>Книга</th><th>Автор</th><th>Издательство</th><th>Год выпуска</th></tr>";
        while ($cell = $sqlSelect->fetch(PDO::FETCH_BOTH)) {
            echo "<tr><td>$cell[1]</td><td>$cell[13]</td><td>$publisher</td><td>$cell[5]</td></tr>";
        }
        echo "</table>";
        }   
    ?>

    <?php
    if(isset($_GET['year_min']) && isset($_GET['year_max'])){
    $year_min = $_GET['year_min'];
    $date_max = $_GET['year_max'];
    $sqlSelect = $dbh->prepare(
        "SELECT * FROM $db.LITERATURE 
        JOIN $db.BOOK_AUTHORS 
        on $db.LITERATURE.ID_BOOK = $db.BOOK_AUTHORS.FID_BOOK
        JOIN $db.AUTHORS 
        on $db.BOOK_AUTHORS.FID_AUTHORS = $db.AUTHORS.ID_AUTHORS
        where $db.LITERATURE.year >= :year_min and $db.LITERATURE.year <= :year_max"
    );
    $sqlSelect->execute(array('year_min' => $year_min, 'year_max' => $date_max));
    echo "Таблица второго запроса: <table border=1> <tr><th>Вид и название</th><th>Автор</th><th>Издательство</th><th>Год выпуска</th></tr>";
    while ($cell = $sqlSelect->fetch(PDO::FETCH_BOTH)) {
        echo "<tr><td>$cell[1]</td><td>$cell[13]</td><td>$cell[7]</td><td>$cell[5]</td></tr>";
    }
    
    
    $sqlSelect = $dbh->prepare(
        "SELECT * FROM $db.LITERATURE 
        JOIN $db.BOOK_AUTHORS 
        on $db.LITERATURE.ID_BOOK = $db.BOOK_AUTHORS.FID_BOOK
        JOIN $db.AUTHORS 
        on $db.BOOK_AUTHORS.FID_AUTHORS = $db.AUTHORS.ID_AUTHORS
        where year($db.LITERATURE.date) >= :year_min and year($db.LITERATURE.date) <= :year_max"
    );
    $sqlSelect->execute(array('year_min' => $year_min, 'year_max' => $date_max));
    while ($cell = $sqlSelect->fetch(PDO::FETCH_BOTH)) {
        echo "<tr><td>$cell[8]  $cell[1]</td><td>$cell[13]</td><td>$cell[7]</td><td>$cell[4]</td></tr>";
    }
    echo "</table>";
}
    ?>

    <?php
    if(isset($_GET['author'])){
    $author = $_GET['author'];
    $literate = "Book";
    $sqlSelect = $dbh->prepare(
        "SELECT * FROM $db.LITERATURE 
        JOIN $db.BOOK_AUTHORS 
        on $db.LITERATURE.ID_BOOK = $db.BOOK_AUTHORS.FID_BOOK
        JOIN $db.AUTHORS 
        on $db.BOOK_AUTHORS.FID_AUTHORS = $db.AUTHORS.ID_AUTHORS
        where $db.LITERATURE.LITERATE = :literate and $db.AUTHORS.name = :author"
    );
    $sqlSelect->execute(array('literate' => $literate, 'author' => $author));
    echo "Таблица третьего запроса: <table border=1> <tr><th>Книга</th><th>Автор</th><th>Издательство</th><th>Год выпуска</th></tr>";
    while ($cell = $sqlSelect->fetch(PDO::FETCH_BOTH)) {
        echo "<tr><td>$cell[1]</td><td>$author</td><td>$cell[7]</td><td>$cell[5]</td></tr>";
    }
    echo "</table>";
}
    ?>
</body>

</html>