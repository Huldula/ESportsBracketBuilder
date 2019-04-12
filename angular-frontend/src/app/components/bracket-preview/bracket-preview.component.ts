import {Component, Input, OnInit} from '@angular/core';
import {Bracket} from '../../models/bracket';

@Component({
  selector: 'app-bracket-preview',
  templateUrl: './bracket-preview.component.html',
  styleUrls: ['./bracket-preview.component.scss']
})
export class BracketPreviewComponent implements OnInit {

  @Input()
  bracket: Bracket;

  constructor() { }

  ngOnInit() {
  }

  public removeBracket(): void {

  }
}
