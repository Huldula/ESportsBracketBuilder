import {Game} from './game';
import {Player} from './player';

export interface Bracket {
  id: number;
  name: string;
  games: Game[];
  players: Player[];
}
