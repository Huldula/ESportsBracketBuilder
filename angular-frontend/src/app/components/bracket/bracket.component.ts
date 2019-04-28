import {Component, OnInit} from '@angular/core';
import {Bracket} from '../../models/bracket';
import {BracketsService} from '../../services/brackets-service/brackets.service';
import {ActivatedRoute} from '@angular/router';
import {Title} from '@angular/platform-browser';
import {Game} from '../../models/game';

@Component({
  selector: 'app-bracket',
  templateUrl: './bracket.component.html',
  styleUrls: ['./bracket.component.scss']
})
export class BracketComponent implements OnInit {

  bracket: Bracket;

  gameLayers: Game[][];

  constructor(private bracketsService: BracketsService,
              private route: ActivatedRoute,
              private title: Title) { }

  ngOnInit() {
    this.bracket = this.bracketsService.getBracketById(Number(this.route.snapshot.paramMap.get('id')));
    this.title.setTitle('ESportsBracketBuilder/' + this.bracket.name);

    this.initGameLayers(this.bracket);
  }

  public initGameLayers(bracket: Bracket): void {
    this.gameLayers = [];

    bracket.games.forEach(game => {
      while (!this.gameLayers[game.roundIndex]) {
        this.gameLayers.push([]);
      }
      while (this.gameLayers[game.roundIndex].length < (this.bracket.playerCount / 2) / (Math.pow(2, game.roundIndex))) {
        this.gameLayers[game.roundIndex].push(null);
      }
      this.gameLayers[game.roundIndex][game.positionIndex] = game;
    });
  }

}
