import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {Player} from '../../models/player';
import {BracketsService} from '../../services/brackets-service/brackets.service';
import {Bracket} from '../../models/bracket';

@Component({
  selector: 'app-player',
  templateUrl: './player.component.html',
  styleUrls: ['./player.component.scss']
})
export class PlayerComponent implements OnInit {

  @Input()
  player: Player;

  @Output()
  winnerEvent = new EventEmitter<Bracket>();

  constructor(private bracketsService: BracketsService) { }

  ngOnInit() {
  }

  public setWinner(): void {
    if (this.player) {
      this.bracketsService.setWinnerById(this.player.id).then(b => this.winnerEvent.emit(b));
    }
  }

}
