<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {

    protected $players;
    protected $paired_players;  //list of players who are paired. Each player is in fact a connection.
    protected $unpaired_players;  //list of players who are available. 
    protected $player_to_player; //a dictioanry mapping a player to another player
    protected $player_to_sign;  //a dictionary mapping a player to its sign.
    protected $player_to_time; // a ditionary mapping a player to 0 or 1. 1 means this is the player turn and 0 means 
    //otherwise
    protected $player_to_positions; // a ditionary mapping a player to positions it has clicked. it is used to determine
    //the winner

    public function __construct() {
        //note SplObjectStorage can be used both as list and map. 
        $this->players = new \SplObjectStorage; 
        $this->paired_players = new \SplObjectStorage; //list
        $this->unpaired_players = new \SplObjectStorage; //list
        $this->player_to_player =new \SplObjectStorage; //map
        $this->player_to_sign =new \SplObjectStorage; //map
        $this->player_to_turn = new \SplObjectStorage; //map
        $this->player_to_positions = new \SplObjectStorage; //map 

    }

    public function onOpen(ConnectionInterface $new_player) {
        // Store the new connection to send messages to later
        $this->players->attach($new_player);

        if ($this->unpaired_players->count()!=0) {

           // goes to the first element of the list 
           $this->unpaired_players->rewind(); 
           //gets the first element of the list
           $selected_player = $this->unpaired_players->current(); 

           //remove the selected player from unpaired and add it to the paired
           $this->paired_players->attach($selected_player);
           $this->unpaired_players->detach($selected_player);

           //map each player to the other
           $this->player_to_player->attach($selected_player, $new_player);
           $this->player_to_player->attach($new_player, $selected_player);

           //assign sign to each of the two players
           $this->player_to_sign->attach($selected_player,"X");
           $this->player_to_sign->attach($new_player,"O");

           //each player has played zero rounds in the current game
           $this->player_to_turn->attach($new_player,0);
           $this->player_to_turn->attach($selected_player,1);

           //the positions each player clicks is stored into a dictionary
           $this->player_to_positions->attach($new_player, array());
           $this->player_to_positions->attach($selected_player, array());


           $arr = array('type' => 'command_update', 'msg' =>'This is your turn!');
           $arr1 = array('type' => 'command_update', 'msg' =>'This is not your turn!');
           $selected_player->send(json_encode($arr));
           $new_player->send(json_encode($arr1));
           echo "New player event: new player {$new_player->resourceId} paired with player {$selected_player->resourceId}\n";

        }
        elseif ($this->unpaired_players->count()==0) {
            $this->unpaired_players->attach($new_player);
            echo "New player event: unpaired player: {$new_player->resourceId}\n";

        }
        //echo "New Player! {$new_player->resourceId}\n";
    }


    public function checkWinner($from){
      #print_r($positions);
      $pos = $this->player_to_positions[$from];

      if(count(array_intersect(array(1,2,3), $pos)) == 3
        ||count(array_intersect(array(4,5,6), $pos)) == 3
        ||count(array_intersect(array(7,8,9), $pos)) == 3
        ||count(array_intersect(array(1,4,7), $pos)) == 3
        ||count(array_intersect(array(2,5,8), $pos)) == 3
        ||count(array_intersect(array(3,6,9), $pos)) == 3
        ||count(array_intersect(array(1,5,9), $pos)) == 3
        ||count(array_intersect(array(3,5,7), $pos)) == 3){
        return 1;

      }

      else{

        return 0;
      }
    }

    public function onMessage(ConnectionInterface $from, $msg_json) {
        $numRecv = count($this->players) - 1;
        // echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
        //     , $from->resourceId, $msg_json, $numRecv, $numRecv == 1 ? '' : 's');

        $other_player = $this->player_to_player[$from];
        $msg_obj = json_decode($msg_json);

        // the server recieves position update messages (type=position_click, position=x)
        // then it looks up the sign of sending player and sends two position update two 
        //both players (i.e., type=position_update, position=2, sign='X' to player 1
        // and type=position_update, position=2, sign='Y' to player 2)

        if ($msg_obj->{'type'} == 'position_click'){

            $clicked_position = $msg_obj->{'position'};
            echo "Player {$from->resourceId} clicked on {$clicked_position}\n";
            $from_sign = $this->player_to_sign[$from];
            $from_turn = $this->player_to_turn[$from];

            echo $other_time+"\n";
            echo $from_time+"\n";

            if($from_turn==1){
              // position update
                $to_from_pos = array('type' => 'position_update', 'position' =>$clicked_position , 'sign'=>$from_sign);
                $to_other_pos = array('type' => 'position_update', 'position' =>$clicked_position , 'sign'=>$from_sign);
                $other_player->send(json_encode($to_other_pos));
                $from->send(json_encode($to_from_pos));
                

                $from_positions = $this->player_to_positions[$from];
                print_r($from_positions);
                array_push($from_positions, $clicked_position);
                $this->player_to_positions->attach($from, $from_positions);


                if($this->checkWinner($from)==1){ //the game has a winner!

                  $to_from_com = array('type' => 'command_update', 'msg' =>"You are winner!");
                  $to_other_com = array('type' => 'command_update', 'msg' =>"You are looser!");
                  $other_player->send(json_encode($to_other_com));
                  $from->send(json_encode($to_from_com));

                  //the game ends!
                  $this->player_to_turn[$other_player] = 0;
                  $this->player_to_turn[$from] = 0;
                  
                }
                else{
                  //the game ends!
                  $this->player_to_turn[$other_player] = 1;
                  $this->player_to_turn[$from] = 0;

                  $to_from_com = array('type' => 'command_update', 'msg' =>"This is not your turn!");
                  $to_other_com = array('type' => 'command_update', 'msg' =>"This is your turn now!");
                  $other_player->send(json_encode($to_other_com));
                  $from->send(json_encode($to_from_com));

                  
                }
              //message update   
            } 
        }
        else{
            echo "Received message {$msg_obj->{'type'}}";

        }
    }
    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->players->detach($conn);
     //    $this->player_to_positions->detach($conn);
//         $this->player_to_positions->detach($conn);
//         $this->player_to_sign->detach($conn);
//         $this->player_to_positions->detach($conn);
// 
//         $other_player = $this->player_to_player[$conn];
//         $to_other = array('type' => 'command_update', 'msg' =>"You are winner!");
//         $other_player->send(json_encode($to_other));
//         echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}