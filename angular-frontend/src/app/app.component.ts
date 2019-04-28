import {Component, OnInit} from '@angular/core';
import {BracketsService} from './services/brackets-service/brackets.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {

  constructor(public bs: BracketsService) {

  }

  ngOnInit(): void {
    this.bs.loadFromServer();
  }
}
