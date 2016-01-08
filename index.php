<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $gameover=false;

        class Game
        {
            var $position;
            var $newposition;
            var $turn;
            var $count = 0;

            function __construct($squares)
            {
                $this->position = str_split($squares);
            }

            function winner($token)
            {
                $result = false;
                for ($row = 0; $row < 3; $row++) {

                    for ($col = 0; $col < 3; $col++) {
                        if ($this->position[3 * $row + $col] != $token) {
                            $result = false; // note the negative test
                            break;
                        } else if ($col == 2) {
                            $result = true;
                            $this->count = 10;
                            return $result;
                        }
                    }
                }
                for ($col = 0; $col < 3; $col++) {

                    for ($row = 0; $row < 3; $row++){
                        if ($this->position[3 * $row + $col] != $token) {
                            $result = false; // note the negative test
                            break;
                        } else if ($row == 2) {
                            $result = true;
                            $this->count = 10;
                            return $result;
                        }
                    }
                }

                if (($this->position[0] == $token) &&
                    ($this->position[4] == $token) &&
                    ($this->position[8] == $token)
                ) {
                    $result = true;
                    $this->count = 10;
                } else if (($this->position[2] == $token) &&
                    ($this->position[4] == $token) &&
                    ($this->position[6] == $token)
                ) {
                    $result = true;
                    $this->count = 10;
                }
                return $result;
            }

            function display() {
                echo '<table style="font-size:large; font-weight:bold">';
                echo '<tr>'; // open the first row
                for ($pos=0; $pos<9;$pos++) {
                    echo $this->show_cell($pos);
                    if ($pos %3 == 2) echo '</tr><tr>'; // start a new row for the next square
            }
                echo '</tr>'; // close the last row
                echo '</table>';
            }

            function show_cell($which) {
                $token = $this->position[$which];
                // deal with the easy case
                if ($token <> '-'){$this->count++; return '<td>'.$token.'</td>';}
                // now the hard case
                $this->newposition = $this->position; // copy the original
                $this->turn = $this->pick_move();
                $this->newposition[$which] = $this->turn; // this would be their move
                $move = implode($this->newposition); // make a string from the board array
                    $link = '?board='.$move; // this is what we want the link to be
                // so return a cell containing an anchor and showing a hyphen
                return '<td><a href="'.$link.'">-</a></td>';
            }

            function pick_move(){
            	if ($this->count >= 10)
            		return '-';
                if ($this->count % 2 == 0){
                    return 'o';
                } else
                    return 'x';
            }

        }
        $squares = $_GET['board'];


        $game = new Game($squares);
        if ($game->winner('x')) {
            echo 'You win. Lucky guesses!';
        }
        else if ($game->winner('o')) {
            echo 'I win. Muahahahaha';
        }
        else {
            echo 'No winner yet, but you are losing. ';
        }

        $game->display();
        ?>


    </body>
</html>