import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {Game} from '../../models/game';
import {Bracket} from '../../models/bracket';

@Component({
  selector: 'app-game-layer',
  templateUrl: './game-layer.component.html',
  styleUrls: ['./game-layer.component.scss']
})
export class GameLayerComponent implements OnInit {

  @Input()
  public games: Game[];

  @Output()
  winnerEvent = new EventEmitter<Bracket>();

  constructor() { }

  ngOnInit() {
  }

}
