import {Component, OnInit} from '@angular/core';
import {Bracket} from '../../models/bracket';
import {BracketsService} from '../../services/brackets-service/brackets.service';
import {ActivatedRoute} from '@angular/router';
import {Title} from '@angular/platform-browser';

@Component({
  selector: 'app-bracket',
  templateUrl: './bracket.component.html',
  styleUrls: ['./bracket.component.scss']
})
export class BracketComponent implements OnInit {

  bracket: Bracket;

  constructor(private bracketsService: BracketsService,
              private route: ActivatedRoute,
              private title: Title) { }

  ngOnInit() {
    this.bracket = this.bracketsService.getBracketById(Number(this.route.snapshot.paramMap.get('id')));
    this.title.setTitle('EsportsBracketBuilder/' + this.bracket.name);
  }

}
