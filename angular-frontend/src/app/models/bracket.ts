import {Game} from './game';

export interface Bracket {
  id: number;
  name: string;
  games: Game[];
}
