import { Component, OnInit } from '@angular/core';
import {BracketsService} from '../../services/brackets-service/brackets.service';
import {Title} from '@angular/platform-browser';

@Component({
  selector: 'app-bracket-list',
  templateUrl: './bracket-list.component.html',
  styleUrls: ['./bracket-list.component.scss']
})
export class BracketListComponent implements OnInit {

  constructor(private bracketService: BracketsService, private title: Title) { }

  ngOnInit() {
    this.title.setTitle('EsportsBracketBuilder/home');
  }

}
