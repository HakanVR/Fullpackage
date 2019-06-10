<?php
session_start();

define('DATA_CHUNK', 160000);

$installerName = 'Sample Data Installer';
$projectUrl = substr("http://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]", 0, -strlen('/installer.php'));
$filename = __DIR__ . '/dump.sql';
$response = array();
$messages = array();

if(count($_POST) > 0){
    $_SESSION = array_merge($_SESSION, $_POST);
}

if(!isset($_GET['ajax'])):
    $_SESSION['counter'] = 1;
    $_SESSION['read_position'] = 0;

    //Test db connection
    if(isset($_SESSION['dbHost'])) {
        dbConnect(null, true);
    }

    //Test filecheck
    if(!file_exists($filename)){
        $messages[] = "$filename not found.";
    } else {
        if(!isset($_SESSION['dump_size'])){
            $_SESSION['dump_size'] = strlen(file_get_contents($filename));
        }
    } ?>

    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title><?php echo $installerName ?></title>
        <link rel="icon" type="image/x-icon" href="<?php echo $projectUrl ?>/setup/pub/images/favicon/favicon.ico"
              sizes="16x16">
        <link href="<?php echo $projectUrl ?>/setup/pub/styles/setup.css" media="screen" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">

            <header class="page-header row">
                <div class="page-header-hgroup col-l-8 col-m-6">
                    <div class="page-title-wrapper">
                        <h1 class="page-title">
                            <?php echo $installerName ?></h1>
                    </div>
                </div>
                <div class="page-header-actions col-l-4 col-m-6"></div>
            </header>

            <main class="page-content">

                    <!-- Messages -->
                    <div class="messages" id="messages">
                        <?php foreach($messages as $message): ?>
                            <div class="message message-warning">
                        <span class="message-text">
                           <?php echo $message; ?>
                        </span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php if(!empty($messages)): ?>
                    <a href="<?php echo $projectUrl . '/installer.php' ?>"
                       class="btn btn-large btn-prime btn-submit">Retry</a>
                <?php else: ?>

                    <input type="hidden" id="script_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">

                    <?php if(!isset($_SESSION['dbHost'])): ?>

                        <!-- Form -->
                        <form action="" method="post">
                            <fieldset class="form-fieldset">

                                <div class="form-row row">
                                    <div class="col-m-3">
                                        <label class="form-label required" for="dbHost">
                                            Database Server Host
                                        </label>
                                    </div>
                                    <div class="col-m-4">
                                        <input type="text" class="form-el-input" name="dbHost" id="dbHost" required />
                                    </div>
                                </div>
                                <div class="form-row row">
                                    <div class="col-m-3">
                                        <label class="form-label required" for="dbUser">
                                            Database Server Username
                                        </label>
                                    </div>
                                    <div class="col-m-4">
                                        <input type="text" class="form-el-input" name="dbUser" id="dbUser" required />
                                    </div>
                                </div>
                                <div class="form-row row">
                                    <div class="col-m-3">
                                        <label class="form-label required" for="dbPassword">
                                            Database Server Password
                                        </label>
                                    </div>
                                    <div class="col-m-4">
                                        <input type="password" class="form-el-input" name="dbPassword" id="dbPassword"
                                               required />
                                    </div>
                                </div>
                                <div class="form-row row">
                                    <div class="col-m-3">
                                        <label class="form-label required" for="dbname">
                                            Database Name
                                        </label>
                                    </div>
                                    <div class="col-m-4">
                                        <input type="text" class="form-el-input" name="dbname" id="dbname" required />
                                    </div>
                                </div>
                                <div class="form-row row">
                                    <div class="col-m-3">
                                        <label class="form-label" for="dbPrefix">
                                            Tables prefix
                                        </label>
                                    </div>
                                    <div class="col-m-4">
                                        <input type="text" class="form-el-input" name="dbPrefix" id="dbPrefix" />
                                    </div>
                                </div>

                                <input type="submit" value="Check Connection" class="btn btn-large btn-prime btn-submit">
                                <a href="<?php echo $projectUrl ?>/setup/index.php" class="btn btn-large btn-secondary">Skip import</a>
                            </fieldset>
                        </form>

                    <?php else: ?>

                        <div class="row form-row start_import">
                            <button onclick="makeAjaxRequest()" class="btn btn-large btn-prime btn-submit">Start Import</button>
                            <a href="<?php echo $projectUrl ?>/setup/index.php" class="btn btn-large btn-secondary">Skip import</a>
                        </div>

                    <?php endif; ?>
                <?php endif; ?>

                <div class="progress" style="display:none">
                    <div class="progress-bar" role="progressbar" style="width: 1%;">
                    </div>
                </div>

                <div class="console_wrap" style="display:none">
                    <span>Console Log</span>
                    <div id="console">
                        <div class="console" id="console_inner"></div>
                    </div>
                </div>

                <div class="row form-row proceed_to_install" style="display:none">
                    <a href="<?php echo $projectUrl ?>/setup/index.php" class="btn btn-large btn-prime
                    btn-submit">Proceed</a>
                </div>
            </main>
        </div>

        <script type="text/javascript" language="javascript">

            //console.log(sessionStorage);
            //sessionStorage.clear();

            function makeAjaxRequest()
            {
                var url = document.getElementById('script_url').value + "?ajax=1",
                    xhr = null,
                    console = document.getElementById('console_inner'),
                    messages = document.getElementById('messages'),
                    response = '';


                if(window.XMLHttpRequest){
                    xhr = new XMLHttpRequest();
                } else if(window.ActiveXObject){
                    try {
                        xhr = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch(e) {
                        try {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch(e) {}
                    }
                }

                document.getElementsByClassName('progress')[0].style.display = "block";
                document.getElementsByClassName('console_wrap')[0].style.display = "block";
                document.getElementsByClassName('start_import')[0].style.display = "none";

                if (!xhr) {
                    alert("Cannot create an XMLHTTP instance");
                }

                xhr.open("GET", url, true);
                xhr.onreadystatechange = function () {
                    if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {

                        response = JSON.parse(xhr.response);

                        if(response.status == "1") {
                            document.getElementsByClassName('progress-bar')[0].style.width =
                                Math.round(response.progress * 100) + "%";

                            response.tables[1].forEach(function (element, index, array) {
                                console.innerHTML += "<span class='text-info'>" + element + "</span><br>";
                            });
                            setTimeout("makeAjaxRequest()", 100);
                        }

                        if(response.status != "1"){
                            messages.innerHTML += "<div class='message'>" + response.error + "</div>";
                        }

                        if(response.status == "2"){
                            document.getElementsByClassName('proceed_to_install')[0].style.display = "block";
                        }
                    }
                };
                xhr.send(null);
            }
        </script>
    </body>
    </html>
<?php endif;

if(isset($_GET['ajax'])){
    $query = readDumpFile();
    dbConnect($query);
}

/**
 * Read dump file and create sql request
 *
 * @return bool|string
 */
function readDumpFile()
{
    global $filename, $response;

    //Read file from the $_SESSION['read_position'] position
    $file = file_get_contents($filename, null, null, $_SESSION['read_position'], DATA_CHUNK);

    $delimiter = ";\n";
     if(strpos($file, ";\r\n")){
        $delimiter = ";\r\n";
    }

    $delimiterLen = strlen($delimiter);

    //Find last occurrence of the semicolon
    $delimiterPos = strrpos($file, $delimiter);

    $readPosition = $delimiterPos + $delimiterLen;

    $result = substr($file, 0, $readPosition);
    $_SESSION['read_position'] += $readPosition;

    if(!$delimiterPos){
        $response['error'] = "Import complete.";
        $response['status'] = 2;

        return false;
    }

    $response['progress'] = $_SESSION['read_position']/$_SESSION['dump_size'];

    //Get processed tables names
    preg_match_all("/DROP TABLE IF EXISTS\s[`](\w*)[`][;]/", $result, $response['tables'] );

    if(isset($_SESSION['dbPrefix'])){
        $result = addPrefix($result);
    }

    return $result;
}

/**
 * @param $query
 * @return mixed
 */
function addPrefix($query)
{
    $needlesArray = array(
        "Table structure for table `",
        "DROP TABLE IF EXISTS `",
        "CREATE TABLE `",
        "LOCK TABLES `",
        "INSERT INTO `",
        "ALTER TABLE `",
        "REFERENCES `",
        "UPDATE `"
    );

    foreach($needlesArray as $needle){
        $query = str_replace($needle, $needle . $_SESSION['dbPrefix'], $query);
    }

    return $query;
}


/**
 * Connect to database
 *
 * @param $query
 * @param bool|false $test
 * @return bool
 */
function dbConnect($query, $test = false)
{
    global $response, $messages;

    //Create connection to database
    mysqli_report(MYSQLI_REPORT_STRICT);

    try{
        $mysqli = @new mysqli($_SESSION['dbHost'], $_SESSION['dbUser'], $_SESSION['dbPassword'], $_SESSION['dbname']);
    } catch(Exception $e){
        $messages[] = $e->getMessage();
        $response['error'] = $e->getMessage();
        $response['status'] = 0;

        session_destroy();

        return false;
    }

    if(!$test) {
        importDump($mysqli, $query);
    }

    $mysqli->close();

    return true;
}

/**
 * Import request to database
 *
 * @param $mysqli
 * @param $query
 */
function importDump($mysqli, $query)
{
    global $response;

    if($query){
        $mysqli->query("SET NAMES `utf8mb4`");

        //Get max allowed packet size
        $mysql_vars = $mysqli->query("SHOW VARIABLES LIKE 'max_allowed_packet'")->fetch_array();
        $max_packet_size = $mysql_vars[1];

        $query_length = strlen($query);
        if($query_length > $max_packet_size){
            $response['error'] = "Error: max_pachet_size exceed: " . $query_length;
            $response['status'] = 0;
            exit;
        }

        if ($mysqli->multi_query($query)) {
            do {
                if ($result = $mysqli->store_result()) {
                    $result->free();
                }
            } while ($mysqli->more_results() && $mysqli->next_result());
            $response['success'] = 'Query imported >>> ' . strip_tags(substr($query, 0, 200)) . '...';
            $response['status'] = 1;
        } else {
            $response['error'] = "Error: " . $mysqli->error;
            $response['status'] = 0;
        }
        $response['counter'] = $_SESSION['counter']++;

    } else {
        indexFix($mysqli);
        if($response['status'] != 2){
            $response['status'] = 0;
        }
    }

    echo json_encode($response);
}

/**
 * @param $mysqli
 */
function indexFix($mysqli){
    $prefix='';
    if(isset($_SESSION['dbPrefix'])){
        $prefix = $_SESSION['dbPrefix'];
    }

    $indexFixQuery = <<<EOT
SET FOREIGN_KEY_CHECKS=0;
UPDATE `{$prefix}store` SET store_id = 0 WHERE code='admin';
UPDATE `{$prefix}store_group` SET group_id = 0 WHERE name='Default';
UPDATE `{$prefix}store_website` SET website_id = 0 WHERE code='admin';
UPDATE `{$prefix}customer_group` SET customer_group_id = 0 WHERE customer_group_code='NOT LOGGED IN';
SET FOREIGN_KEY_CHECKS=1;
EOT;
    $mysqli->multi_query($indexFixQuery);

    session_unset();
    session_destroy();
}
