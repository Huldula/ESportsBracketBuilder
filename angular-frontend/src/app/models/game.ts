import {Player} from './player';

export interface Game {
  id: number;
  roundIndex: number;
  positionIndex: number;
  player1: Player;
  player2: Player;
}
