<?php
    session_start();

    $COLORSPALETTE = ['giallo', 'verde', 'rosso', 'azzurro'];
    $DEFAULT_LINK = '"http://localhost/informatica/5A%20IA/Es%20PHP/Es2_Namaki.php"';

    echo '  <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Document</title>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
            </head>
            <body>
                <div class="container text-center mt-2">
                <div class="card bg-light">
                <div class="card-body">';


    echo "<h1 class='card-title bg-dark rounded w-50 ml-auto mr-auto mb-3 p-2 border border-dark'><p class='text-danger d-inline'>Mas</p><p class='text-success d-inline'>ter </p><p class='text-primary d-inline'>Mi</p><p class='text-warning d-inline'>nd</p></h1>";

    //Inizio del gioco
    if (!isset($_SESSION["randomSequence"])){
        //Generazione random sequence
        $_SESSION["randomSequence"] = generateRandomSequence();
        
        //Inizializzazione tentativi a 0
        $_SESSION["attempts"] = 0;

        //Inizializzazione Sequenze Tentate
        $_SESSION['attemptedSequences'] = [];
    } 

    
    //Recupero variabili dalla sessione per semplicità
    $randomSequence = $_SESSION["randomSequence"];

    if (!($_SESSION['attempts'] == 10)) echo "<div class='bg-primary p-2 rounded w-25 m-auto text-white font-weight-light'>TENTATIVO N. " . ($_SESSION['attempts']+1) . '</div>';

    //Aggiunta nuovo tentativo all'array
    if (isset($_GET['color1'])){
        //Creazione Oggetto Sequenza
        $attemptedSequence = new stdClass();
        
        $attemptedSequence->color1 = strtolower($_GET['color1']);
        $attemptedSequence->color2 = strtolower($_GET['color2']);
        $attemptedSequence->color3 = strtolower($_GET['color3']);
        $attemptedSequence->color4 = strtolower($_GET['color4']);
        $attemptedSequence->attempt = $_SESSION['attempts'];
        //Inserimento Sequenza nell'array
        array_push($_SESSION['attemptedSequences'], $attemptedSequence);
    }

    //Sequenza indovinata
    if (isset($attemptedSequence) && 
        $attemptedSequence->color1 == $randomSequence[0] && 
        $attemptedSequence->color2 == $randomSequence[1] &&
        $attemptedSequence->color3 == $randomSequence[2] &&
        $attemptedSequence->color4 == $randomSequence[3]){
    
        echo "<div class='alert alert-success w-50 m-auto'>Hai vinto in " . $_SESSION['attempts'] . " tentativi!</div>";
        session_destroy();
        echo "<button class='btn btn-danger m-3' onclick='location.href=" . $DEFAULT_LINK ."'>RIGIOCA</a></button>";
    }
    else if ($_SESSION['attempts'] == 10){

        echo "<div class='alert alert-danger w-50 m-auto'>Hai raggiunto il numero massimo di tentativi</div>";
        echo "<table class='mr-auto ml-auto mt-2 mb-1 p-3 table table-striped w-75'>
                <tbody>
                    <tr>
                        <td>" . displayImage($randomSequence[0]) . "</td>
                        <td>" . displayImage($randomSequence[1]) . "</td>
                        <td>" . displayImage($randomSequence[2]) . "</td>
                        <td>" . displayImage($randomSequence[3]) . "</td>
                    </tr>
                </tbody>
                </table>";
        generateAttemptsTable();
        session_destroy();
        echo "<button class='btn btn-danger mb-2' onclick='location.href=" . $DEFAULT_LINK ."'>RIGIOCA</a></button>";
    } else {
        echo "  
                
                <form method='GET' class='ml-auto mr-auto m-3 p-1 bg-dark w-75'>
                <table class='m-auto'>
                    <tr>
                        <td>
                            <select class='btn bg-secondary text-white font-weight-light' name='color1'>
                                <optgroup class='bg-dark text-white font-weight-normal' label='Colori'>
                                <option class='bg-dark text-warning font-weight-bold'>GIALLO</option>
                                <option class='bg-dark text-success font-weight-bold'>VERDE</option>
                                <option class='bg-dark text-primary font-weight-bold'>AZZURRO</option>
                                <option class='bg-dark text-danger font-weight-bold'>ROSSO</option>
                                </optgroup>
                            </select>
                        </td>
                        <td>
                            <select class='btn bg-secondary text-white font-weight-light' name='color2'>
                                <optgroup class='bg-dark text-white font-weight-normal' label='Colori'>
                                <option class='bg-dark text-warning font-weight-bold'>GIALLO</option>
                                <option class='bg-dark text-success font-weight-bold'>VERDE</option>
                                <option class='bg-dark text-primary font-weight-bold'>AZZURRO</option>
                                <option class='bg-dark text-danger font-weight-bold'>ROSSO</option>
                                </optgroup>
                            </select>
                        </td>
                        <td>
                            <select class='btn bg-secondary text-white font-weight-light' name='color3'>
                                <optgroup class='bg-dark text-white font-weight-normal' label='Colori'>
                                <option class='bg-dark text-warning font-weight-bold'>GIALLO</option>
                                <option class='bg-dark text-success font-weight-bold'>VERDE</option>
                                <option class='bg-dark text-primary font-weight-bold'>AZZURRO</option>
                                <option class='bg-dark text-danger font-weight-bold'>ROSSO</option>
                                </optgroup>
                            </select>
                        </td>
                        <td>
                            <select class='btn bg-secondary text-white font-weight-light' name='color4'>
                                <optgroup class='bg-dark text-white font-weight-normal' label='Colori'>  
                                <option class='bg-dark text-warning font-weight-bold'>GIALLO</option>
                                <option class='bg-dark text-success font-weight-bold'>VERDE</option>
                                <option class='bg-dark text-primary font-weight-bold'>AZZURRO</option>
                                <option class='bg-dark text-danger font-weight-bold'>ROSSO</option>
                                </optgroup>
                            </select>
                        </td>
                        <td><button class='btn' type='submit'>" . displayImage('spunta') . "</button></td>
                    </tr>
                </table>
                </form>";


        //Se c'è almeno un tentativo già fatto
        if ($_SESSION['attempts']){
            generateAttemptsTable();
        }

        $_SESSION['attempts']++;       
    }


    
        
    
        


    function generateAttemptsTable(){

        global $randomSequence;
        echo "<table class='m-auto p-3 table table-striped w-75'>
                    <thead class='thead-dark'>
                    <tr>
                        <th scope='col'><b>    ATTEMPT     </b></th>
                        <th scope='col'><b>    1°          </b></th>
                        <th scope='col'><b>    2°          </b></th>
                        <th scope='col'><b>    3°          </b></th>
                        <th scope='col'><b>    4°          </b></th>
                        <th scope='col' colspan='4'><b>    CHECK       </b></th>
                    </tr>
                    </thead>
                    <tbody>";

        foreach ($_SESSION['attemptedSequences'] as $sequence){

            echo '<tr>
                    <th scope="row">' . $sequence->attempt . '</th>
                    <td>' . displayImage($sequence->color1) . '</td>
                    <td>' . displayImage($sequence->color2) . '</td>
                    <td>' . displayImage($sequence->color3) . '</td>
                    <td>' . displayImage($sequence->color4) . '</td>';


            $arr = getSequenceInArray($sequence);
            $arrRandomToExclude = $randomSequence;
            $arrSequenceToExclude = $arr;
            $checkBallsLeft = 4;

            //PALLINE NERE
            for ($i=0; $i < count($arr); $i++) { 
                if ($arr[$i] == $randomSequence[$i]){
                    echo '<td>' . displayImage('nero') . '</td>';
                    $arrRandomToExclude[$i] = "";
                    $arrSequenceToExclude[$i] = "";
                    $checkBallsLeft--;
                }
            }
        
            //PALLINE BIANCHE
            for ($i=0; $i < count($arr); $i++) { 
                for ($j=0; $j < count($randomSequence); $j++) { 
                    if ($arrSequenceToExclude[$i] != "" && $arr[$i] == $randomSequence[$j] && $arrRandomToExclude[$j] != ""){
                        echo '<td>' . displayImage('bianco') . '</td>';
                        $arrRandomToExclude[$j] = "";
                        $checkBallsLeft--;
                    }
                }
            }

            //GRID AUTOFILL
            for ($i=0; $i < $checkBallsLeft; $i++) 
                echo '<td>' . displayImage('null') . '</td>';
        
            echo '</tbody></tr>';
        }
    }

    //Funzione che genere la sequenza randomica di colori
    function generateRandomSequence(){
        global $COLORSPALETTE;
        for ($i=0; $i < count($COLORSPALETTE); $i++) { 
            $tempArr[$i] = $COLORSPALETTE[rand(0,3)];
        }
        return $tempArr;
    }

    function getSequenceInArray($sequence){
        $temp = [];

        $temp[0] = $sequence->color1;
        $temp[1] = $sequence->color2;
        $temp[2] = $sequence->color3;
        $temp[3] = $sequence->color4;
        
        return $temp;
    }

    function displayImage($image){
        switch ($image) {
            case 'rosso':
                return "<img src='./images/rosso.gif' alt='rosso'>";
                break;
            case 'giallo':
                return "<img src='./images/giallo.gif' alt='giallo'>";
                break;
            case 'verde':
                return "<img src='./images/verde.gif' alt='verde'>";
                break;
            case 'azzurro':
                return "<img src='./images/blu.gif' alt='blu'>";
                break;
            case 'nero':
                return "<img src='./images/nero.gif' alt='nero'>";
                break;
            case 'bianco':
                return "<img src='./images/bianco.gif' alt='bianco'>";
                break;
            case 'null':
                return "<img src='./images/null.gif' alt='null'>";
                break;
            case 'spunta':
                return "<img src='./images/spunta.gif' alt='spunta'>";
                break;
            default:
                break;
        }
    }

    echo '</div>
          </div>
          </div> 
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        </body>
        </html>';

?>
    