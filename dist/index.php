<?php
if (file_exists('config.php')) {
    header('Location: config.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Support Center</title>
    <style>
        * {
            outline: none;
            font-family: Helvetica;
        }

        .result {
            border: 1px solid black;
            border-radius: 5px;
            background-color: darkgray;
            color: white;
            margin: 2vh;
            padding: 2vh;
            font-family: Helvetica;
            display: block;
        }

        .result .title {
            color: #DFFFFE;
            text-decoration: underline;
        }

        .desc {
            text-decoration: none;
        }

        h1,
        input,
        button {
            font-family: Helvetica;
            padding: 0.75vh;
            margin: 0.75vh;
        }

        input {
            border: 1px solid black;
            border-radius: 5px;
        }

        button {
            border: 1px solid black;
            border-radius: 5px;
            background: transparent;
            transition: 0.25s;
            cursor: pointer;
        }

        button:hover {
            background: black;
            color: white;
        }

        button:active {
            background: transparent !important;
            color: black !important;
        }

    </style>
</head>

<body>

    <h1>Search Articles</h1>
    <form method="get" action="">
        <input type="text" name="search" autofocus="" value="<?= $_GET['search'] ?>" id="searchbar" onfocus="this.selectionStart = this.selectionEnd = this.value.length;">
        <button type="submit">Search!</button>
    </form>

    <?php
    function shorten($string, $maxLength)
    {
        return substr($string, 0, $maxLength);
    }

    // (B) PROCESS SEARCH WHEN FORM SUBMITTED
    //if (isset($_POST['search'])) {
    // (B1) SEARCH FOR USERS
    require "search.php";

    // (B2) DISPLAY RESULTS
    if (count($results) > 0) {
        foreach ($results as $r) {
            //print('<a href="article?name=' . $r['url'] . '">' . $r['name'] . '</a><p>' . shorten($r['text'], 3) . '...</p>';
            printf(
                '<a class="result" href="article?name=get-started-lottamo-dev">
    <div class="title">' .
                    $r['name'] .
                    '</div>
    <p class="desc">' .
                    shorten(str_replace("\n", '<br>', $r['text']), 75) .
                    '...</p>
    </a>'
            );
            //printf("<div class=\"result\"><a href=\"article?name=" . $r['url'] . "\">%s</a><p>" . shorten(str_replace("\n", '<br>', $r['text']), 75) . '...</p></div>', $r['name']);
        }
    } else {
        echo "No results found";
    }

//}
?>
       <script>
        /*
        document.onkeydown = function() {
            document.getElementById('searchbar').focus();
        }
        window.onkeyup = function() {
            window.location.search = '?search=' + escape(document.getElementById('searchbar').value);
        }*/

    </script>
    <p>Powered by FakeryBakery's support system. 100% Free and Open Source. <a href="https://github.com/fakerybakery/Help-System">View GitHub Project</a>!</p>
</body>

</html>
