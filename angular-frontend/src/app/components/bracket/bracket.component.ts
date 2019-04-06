import {Component, Input, OnInit} from '@angular/core';
import {Bracket} from '../../models/bracket';

@Component({
  selector: 'app-bracket',
  templateUrl: './bracket.component.html',
  styleUrls: ['./bracket.component.scss']
})
export class BracketComponent implements OnInit {

  @Input()
  bracket: Bracket;

  constructor() { }

  ngOnInit() {
  }

}
