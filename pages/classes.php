<?php

class Tools
{
    static function connect(
        $host = "localhost",
        $user = "root",
        $pass = "server",
        $dbname = "news")
    {
        $cs = 'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8;';
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
        );
        //$pdo = new PDO($cs, $user, $pass, $options);
        //return $pdo;
        try {
            $pdo = new PDO($cs, $user, $pass, $options);
            return $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}

class News
{
    public $id, $idate, $title, $announce, $content;

    function __construct($id = 0, $idate=0, $title, $announce, $content)
    {
        $this->id = $id;
        $this->idate = $idate;
        $this->title = $title;
        $this->announce = $announce;
        $this->content = $content;
    }

    function intoDb()
    {
        try {
            $pdo = Tools::connect();
            $ps = $pdo->prepare("INSERT INTO news (idate, title, announce, content) 
                            VALUES (:idate, :title, :announce, :content)");
            $ar = (array)$this;
            array_shift($ar);
            $ps->execute($ar);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    static function fromDb($id)
    {
        $item = null;
        try {
            $pdo = Tools::connect();
            $ps = $pdo->prepare("SELECT * FROM news WHERE id=?");
            $ps->execute(array($id));
            $row = $ps->fetch();
            $item = new News($row['id'], $row['idate'], $row['title'], $row['announce'], $row['content']);
            return $item;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function GetNews($newsid = 0)
    {
        $ps = null;
        $news = null;
        try {
            $pdo = Tools::connect();
            var_dump($pdo);
            if ($newsid == 0) {
                $ps = $pdo->prepare("SELECT * FROM news");
                $ps->execute();
            } else {
                $ps = $pdo->prepare("SELECT *FROM news WHERE id=?");
                $ps->execute(array($newsid));
            }
            while ($row = $ps->fetch()) {
                $item = new News($row['id'], $row['idate'], $row['title'], $row['announce'], $row['content']);
                $news[] = $item;
            }
            return $news;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function DrawAll()
    {
        echo "<div><span class='pull-right' style='margin-left:10px; background: darkmagenta; 
                    color:white;font-size:12pt;'>";
        echo $this->idate;
        echo "</span>";
        echo "<a href='pages/view.php?id='" . $this->id .
            "' class='pull-left' style='margin-left:10px;' >";
        echo $this->title;
        echo "</a>";
        echo "<p>";
        echo $this->announce;
        echo "</p>";
        echo "</div>";
    }
    function DrawContent()
    {
        echo "<h2>";
        echo $this->title;
        echo "</h2><hr>";
        echo "<div>";
        echo $this->content;
        echo "</div>";
    }
}