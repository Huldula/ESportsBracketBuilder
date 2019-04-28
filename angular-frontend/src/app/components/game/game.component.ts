import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {Game} from '../../models/game';
import {Bracket} from '../../models/bracket';

@Component({
  selector: 'app-game',
  templateUrl: './game.component.html',
  styleUrls: ['./game.component.scss']
})
export class GameComponent implements OnInit {

  @Input()
  game: Game;

  @Output()
  winnerEvent = new EventEmitter<Bracket>();

  constructor() { }

  ngOnInit() {
  }

}
