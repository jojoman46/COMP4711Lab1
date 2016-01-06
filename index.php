<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        class Game
        {
            var $position;

            function __construct($squares)
            {
                $this->position = str_split($squares);
            }

            function winner($token)
            {
                $result = true;
                for ($row = 0; $row < 3; $row++) {
                    $result = true;
                    for ($col = 0; $col < 3; $col++)
                        if ($this->position[3 * $row + $col] != $token) {
                            $result = false; // note the negative test
                            break;
                        } else if ($col = 2) {
                            return $result;
                        }
                }
                for ($col = 0; $col < 3; $col++) {
                    $result = true;
                    for ($row = 0; $row < 3; $row++)
                        if ($this->position[3 * $col + $row] != $token) {
                            $result = false; // note the negative test
                            break;
                        } else if ($row = 2) {
                            return $result;
                        }
                }

                if (($this->position[0] == $token) &&
                    ($this->position[4] == $token) &&
                    ($this->position[8] == $token)
                ) {
                    $result = true;
                } else if (($this->position[3] == $token) &&
                    ($this->position[4] == $token) &&
                    ($this->position[6] == $token)
                ) {
                    $result = true;
                }
                return $result;
            }

        }
        $squares = $_GET['board'];


        $game = new Game($squares);
        if ($game->winner('x'))
            echo 'You win. Lucky guesses!';
        else if ($game->winner('o'))
            echo 'I win. Muahahahaha';
        else
            echo 'No winner yet, but you are losing.';
        ?>
    </body>
</html>